<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;

class OwnBankTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = BalanceTransfer::whereType('own')->orderBy('id','desc');

         return Datatables::of($datas)

                            ->editColumn('user_id', function(BalanceTransfer $data) {
                                $data = User::whereId($data->user_id)->first();
                                if($data){
                                    return '<div>
                                            <span>'.$data->name.'</span>
                                            <p>'.$data->account_number.'</p>
                                    </div>';
                                }else{
                                    return $data = '';
                                }
                            })
                            ->editColumn('receiver_id', function(BalanceTransfer $data){
                                $data = User::whereId($data->receiver_id)->first();

                                if($data){
                                    return '<div>
                                            <span>'.$data->name.'</span>
                                            <p>'.$data->account_number.'</p>
                                    </div>';
                                }else{
                                    return $data = '';
                                }
                            })
                            ->editColumn('amount', function(BalanceTransfer $data) {
                                return showNameAmount($data->amount);
                            })
                            ->editColumn('cost', function(BalanceTransfer $data) {
                                return showNameAmount($data->cost);
                            })

                            ->editColumn('status', function(BalanceTransfer $data) {
                                $status      = $data->status == 1 ? _('Completed') : _('Pending');
                                $status_sign = $data->status == 1 ? 'success'   : 'warning';

                                return '<div class="btn-group mb-1">
                                        <span class="badge badge-'. $status_sign.'">'.$status.'</span>
                              </div>';
                            })

                            ->rawColumns(['user_id','receiver_id','amount','cost','status'])
                            ->toJson();
    }

    public function index(){
        return view('admin.ownbanktransfer.index');
    }
}
