<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Withdraw;
use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;

class WithdrawController extends Controller
{
    public function datatables()
    {
        $datas = Withdraw::orderBy('id','desc');

        return Datatables::of($datas)
                        ->editColumn('created_at', function(Withdraw $data) {
                            $date = date('d-m-Y',strtotime($data->created_at));
                            return $date;
                            //return $data->created_at;
                        })
                        ->addColumn('withdraw_number',function(Withdraw $data){
                            // $data = User::where('id',$data->user_id)->first();
                            // return $data->name;
                            return $data->txnid;
                        })
                        ->addColumn('customer_name',function(Withdraw $data){
                            $data = User::where('id',$data->user_id)->first();
                            return $data->name;
                            //return $data->acc_name;
                        })
                        ->addColumn('customer_email',function(Withdraw $data){
                            $data = User::where('id',$data->user_id)->first();
                            return $data->email;
                            //return $data->acc_email;
                        })
                        ->editColumn('amount', function(Withdraw $data) {
                            return showNameAmount($data->amount);
                        })
                        ->editColumn('status', function(Withdraw $data) {
                            $status = $data->status == 'pending' ? '<span class="badge badge-warning">pending</span>' : '<span class="badge badge-success">completed</span>';
                            return $status;
                        })
                        ->editColumn('status', function(Withdraw $data) {
                            $status      = $data->status == 'complete' ? _('completed') : _('pending');
                            $status_sign = $data->status == 'complete' ? 'success'   : 'danger';

                            return '<div class="btn-group mb-1">
                            <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              '.$status .'
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.withdraws.status',['id1' => $data->id, 'id2' => 'complete']).'">'.__("Pending").'</a>
                              <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.withdraws.status',['id1' => $data->id, 'id2' => 'pending']).'">'.__("Completed").'</a>
                            </div>
                          </div>';
                        })
                        ->rawColumns(['created_at','withdraw_number','customer_name','customer_email','amount','status'])
                        ->toJson();
    }

    public function index(){
        return view('admin.withdraws.index');
    }

    public function status($id1,$id2){
        $data = Withdraw::findOrFail($id1);

        if($data->status == 'complete'){
          $msg = 'Withdraws already completed';
          return response()->json($msg);
        }

        $user = User::findOrFail($data->user_id);
        $user->balance -= $data->amount;
        $user->save();

        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = $data->amount;
        $trans->type = "Payout";
        $trans->profit = "minus";
        $trans->txnid = $data->txnid;
        $trans->user_id = $user->id;
        $trans->save();

        $data->update(['status' => 'complete']);
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $user->email,
                'type' => "Withdraw",
                'cname' => $user->name,
                'oamount' => $data->amount,
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);
        }
        else
        {
            $to = $user->email;
            $subject = " You have withdrawed successfully.";
            $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }

        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
      }
}

