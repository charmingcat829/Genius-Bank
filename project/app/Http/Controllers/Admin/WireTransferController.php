<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\User;
use App\Models\WireTransfer;
use Illuminate\Http\Request;
use Datatables;

class WireTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = WireTransfer::orderBy('id','desc');

         return Datatables::of($datas)
                            ->editColumn('wire_transfer_bank_id', function(WireTransfer $data) {
                                return $data->bank->title;
                            })
                            ->editColumn('user_id', function(WireTransfer $data) {
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
                            ->editColumn('account_number', function(WireTransfer $data){

                                return '<div>
                                        <span>'.$data->account_holder_name.'</span>
                                        <p>'.$data->account_number.'</p>
                                </div>';

                            })
                            ->editColumn('amount', function(WireTransfer $data) {
                                return showNameAmount($data->amount);
                            })


                            ->editColumn('status', function(WireTransfer $data) {
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
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.wire.transfer.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Completed").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.wire.transfer.status',['id1' => $data->id, 'id2' => 2]).'">'.__("Rejected").'</a>
                                </div>
                              </div>';
                            })
                            ->addColumn('action', function(WireTransfer $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.wire.transfer.show',$data->id) . '"  class="dropdown-item">'.__("Details").'</a>
                                  </div>
                                </div>';

                              })

                            ->rawColumns(['wire_transfer_bank_id','user_id','account_number','amount','status','action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.wiretransfers.index');
    }

    public function show($id){
        $data = WireTransfer::whereId($id)->first();
        return view('admin.wiretransfers.show',compact('data'));
    }

    public function status($id1,$id2){

        $data = WireTransfer::findOrFail($id1);
        if($data->status == 1){
          $msg = 'Already Completed';
          return response()->json($msg);
        }

        if($id2 == 2){
          $user = User::whereId($data->user_id)->first();
          if($user){
            $user->increment('balance',$data->amount);
          }
        }

        $data->status = $id2;
        $data->update();

        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
      }
}
