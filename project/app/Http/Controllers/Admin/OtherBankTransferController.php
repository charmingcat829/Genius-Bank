<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\Beneficiary;
use App\Models\Currency;
use App\Models\OtherBank;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;

class OtherBankTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = BalanceTransfer::whereType('other')->orderBy('id','desc');

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

                            ->editColumn('beneficiary_id', function(BalanceTransfer $data){
                                $data = Beneficiary::whereId($data->beneficiary_id)->first();

                                if($data){
                                    return '<div>
                                            <span>'.$data->account_name.'</span>
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
                                if($data->status == 1){
                                    $status  = __('Completed');
                                  }elseif($data->status == 2){
                                    $status  = __('Rejected');
                                  }else{
                                    $status  = __('Pending');
                                  }

                                  if($data->status == 1){
                                    $status_sign  = 'success';
                                  }elseif($data->status == 2){
                                    $status_sign  = 'danger';
                                  }else{
                                    $status_sign = 'warning';
                                  }

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.other.banks.transfer.status',['id1' => $data->id, 'status' => 1]).'">'.__("completed").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.other.banks.transfer.status',['id1' => $data->id, 'status' => 2]).'">'.__("rejected").'</a>
                                </div>
                              </div>';
                            })

                            ->addColumn('action', function(BalanceTransfer $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.other.banks.transfer.show',$data->id) . '"  class="dropdown-item">'.__("Details").'</a>
                                  </div>
                                </div>';

                              })

                            ->rawColumns(['user_id','beneficiary_id','amount','cost','status','action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.otherbanktransfer.index');
    }

    public function show($id){
        $data = BalanceTransfer::whereId($id)->first();
        $banefeciary = Beneficiary::whereId($data->beneficiary_id)->first();

        return view('admin.otherbanktransfer.show',compact('data','banefeciary'));
    }

    public function status($id1,$id2)
    {
        $data = BalanceTransfer::findOrFail($id1);
        if($data->status == 1){
            $msg = __('Status already Completed.');
            return response()->json($msg);
        }
        if($id2 == 2){
            $user = User::whereId($data->user_id)->first();
            if($user){
              $user->increment('balance',$data->final_amount);
            }
          }

        $data->status = $id2;
        $data->update();

        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
    }
}
