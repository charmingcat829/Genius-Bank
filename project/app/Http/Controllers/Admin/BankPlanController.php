<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankPlan;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Datatables;

class BankPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = BankPlan::orderBy('id','desc')->get();

         return Datatables::of($datas)
                            ->editColumn('created_at', function(BankPlan $data) {
                                return $data->created_at->toDateString();
                            })
                            ->editColumn('amount', function(BankPlan $data) {
                                $curr = Currency::where('is_default','=',1)->first();
                                return  '<div>
                                            '.showNameAmount($data->amount).'
                                        </div>';
                            })
                            ->addColumn('action', function(BankPlan $data) {
                                $delete = $data->id == 1 ? '':'<a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.bank.plan.delete',$data->id).'">'.__("Delete").'</a>';
                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.bank.plan.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>'.$delete.'
                                  </div>
                                </div>';

                              })
                            ->rawColumns(['amount','action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.bankplan.index');
    }

    public function create(){
        return view('admin.bankplan.create');
    }

    public function store(Request $request){
        $rules=[
            'title' => 'required',
            'amount' => 'required|numeric|min:0',
            'daily_send' => 'required|numeric|gt:0',
            'monthly_send' => 'required|numeric|gt:0',
            'daily_receive' => 'required|numeric|gt:01',
            'monthly_receive' => 'required|numeric|gt:0',
            'daily_withdraw' => 'required|numeric|gt:0',
            'monthly_withdraw' => 'required|numeric|gt:0',
            'loan_amount' => 'required|numeric|gt:0',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $data = new BankPlan();
        $data->title = $request->title;
        $data->amount = $request->amount;
        $data->daily_send = $request->daily_send;
        $data->monthly_send = $request->monthly_send;
        $data->daily_receive = $request->daily_receive;
        $data->monthly_receive = $request->monthly_receive;
        $data->daily_withdraw = $request->daily_withdraw;
        $data->monthly_withdraw = $request->monthly_withdraw;
        $data->loan_amount = $request->loan_amount;
        if($request->attribute){
            $data->attribute = json_encode($request->attribute,true);
        }
        $data->days = $request->days;
        $data->save();

        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.bank.plan.index").'">View Plan Lists</a>';
        return response()->json($msg);
    }

    public function edit($id){
        $data = BankPlan::findOrFail($id);
        $data['attributes'] = json_decode($data->attribute,true);
        $data['data'] = $data;
        return view('admin.bankplan.edit',$data);
    }

    public function update(Request $request,$id){
        $rules=[
            'title' => 'required',
            'amount' => 'required|numeric|min:0',
            'daily_send' => 'required|numeric|gt:0',
            'monthly_send' => 'required|numeric|gt:0',
            'daily_receive' => 'required|numeric|gt:01',
            'monthly_receive' => 'required|numeric|gt:0',
            'daily_withdraw' => 'required|numeric|gt:0',
            'monthly_withdraw' => 'required|numeric|gt:0',
            'loan_amount' => 'required|numeric|gt:0',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $data = BankPlan::findOrFail($id);
        $data->title = $request->title;
        $data->amount = $request->amount;
        $data->daily_send = $request->daily_send;
        $data->monthly_send = $request->monthly_send;
        $data->daily_receive = $request->daily_receive;
        $data->monthly_receive = $request->monthly_receive;
        $data->daily_withdraw = $request->daily_withdraw;
        $data->monthly_withdraw = $request->monthly_withdraw;
        $data->loan_amount = $request->loan_amount;
        $data->days = $request->days;
        if($request->attribute){
            $data->attribute = json_encode($request->attribute,true);
        }
        $data->update();

        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.bank.plan.index").'">View Plan Lists</a>';
        return response()->json($msg);
    }

    public function destroy($id){
        if($id == 1){
            return response()->json('This plan should not be removed.');
        }
        BankPlan::findOrFail($id)->delete();

        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
    }
}
