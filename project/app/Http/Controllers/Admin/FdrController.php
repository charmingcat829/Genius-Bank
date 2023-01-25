<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\User;
use App\Models\UserFdr;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Carbon;

class FdrController extends Controller
{
    public function __construct()
    {

    }

    public function datatables(Request $request)
    {
         if($request->status == 'all'){
            $datas = UserFdr::orderBy('id','desc')->get();
          }else{
            $datas = UserFdr::where('status',$request->status)->orderBy('id','desc')->get();
          }

         return Datatables::of($datas)

                            ->editColumn('transaction_no', function(UserFdr $data) {
                                return '<div>
                                        '.$data->transaction_no.'
                                        <br>
                                        <span class="text-info">'.$data->plan->title.'</span>
                                </div>';

                            })
                            ->editColumn('amount', function(UserFdr $data){
                                return  '<div>
                                            '.showNameAmount($data->amount).'
                                            <br>
                                            <span class="text-info">Profit Rate '.$data->interest_rate.' (%)</span>
                                        </div>';
                            })
                            ->editColumn('user_id', function(UserFdr $data){

                                return '<div>
                                            <span>'.$data->user->name.'</span>
                                            <p>'.$data->user->account_number.'</p>
                                        </div>';
                            })

                            ->editColumn('profit_type', function(UserFdr $data) {
                                return $data->profit_type;
                            })

                            ->editColumn('profit_amount', function(UserFdr $data) {
                                $curr = Currency::where('is_default','=',1)->first();
                                $nextProfitTime = $data->next_profit_time != NULL ? $data->next_profit_time->toDateString() : 'Closed FDR';
                                if($data->profit_type == 'partial'){
                                    return '<div>
                                            '.showNameAmount($data->profit_amount).'
                                            <br>
                                            <span class="text-info"> '.__('Next Frofit Days').' ('.$nextProfitTime.')</span>
                                        </div>';
                                }else{
                                    if($data->status == 2){
                                        return '<div>
                                                <span class="text-success">'.showNameAmount($data->profit_amount).'</span>
                                            </div>';
                                    }
                                    return '<div>
                                                '.showNameAmount($data->profit_amount).'
                                                <br>
                                                <span class="text-info"> '.__('Profit will get after locked period').' </span>
                                            </div>';
                                }
                            })

                            ->editColumn('status', function(UserFdr $data) {
                                $status      = $data->status == 1 ? _('Running') : _('Closed');
                                $status_sign = $data->status == 1 ? 'info'   : 'danger';

                                return '<div class="btn-group mb-1">
                                        <span class="badge bg-'.$status_sign.' text-white">'.$status .'</span>
                              </div>';
                            })

                            ->rawColumns(['transaction_no','amount','user_id','profit_type','profit_amount','status'])
                            ->toJson();
    }

    public function index(){
        $this->nextProfitCheck();
        return view('admin.fdr.index');
    }

    public function running(){
        $this->nextProfitCheck();
        return view('admin.fdr.running');
    }

    public function closed(){
        return view('admin.fdr.closed');
    }

    public function nextProfitCheck(){
        $fdrs = UserFdr::whereStatus(1)->orderBy('id','desc')->get();
        $now = Carbon::now();

        foreach($fdrs as $key=>$data){
            if($data->profit_type == 'partial'){
                if($now->gt($data->next_profit_time)){
                    $this->getPartialProfit($data->id);

                    if($now->gt($data->matured_time)){
                        $this->closedFdr($data->id);
                    }
                }
            }else{
                if($now->gt($data->matured_time)){
                    $this->getFixedProfit($data);
                }
            }
        }
    }

    public function getPartialProfit($id){
        $fdr = UserFdr::findOrFail($id);
        if($fdr){
            $this->getUserProfit($fdr->user_id,$fdr->profit_amount);

            $fdr->next_profit_time = Carbon::now()->addDays($fdr->plan->interest_interval);
            $fdr->update();
        }
    }

    public function getFixedProfit($data){
        $fdr = UserFdr::findOrFail($data->id);

        if($fdr){
            $this->getUserProfit($fdr->user_id,$fdr->profit_amount);
            $this->getMainAmount($fdr->user_id,$fdr->amount);

            $fdr->status = 2;
            $fdr->update();
        }
    }

    public function getUserProfit($userId,$profitAmount){
        $user = User::whereId($userId)->first();
        $user->balance += $profitAmount;
        $user->update();
    }

    public function closedFdr($id){
        $fdr = UserFdr::findOrFail($id);
        $this->getMainAmount($fdr->user_id,$fdr->amount);
        $fdr->next_profit_time = NULL;
        $fdr->status = 2;
        $fdr->update();
    }

    public function getMainAmount($userId,$amount){
        $user = User::whereId($userId)->first();
        $user->balance += $amount;
        $user->update();
    }
}
