<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class WithdrawMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = WithdrawMethod::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
         
         return Datatables::of($datas)
                            ->editColumn('status', function(WithdrawMethod $data) {
                                return  $data->status == 1 ? '<span class="badge badge-success">active</span>' : '<span class="badge badge-danger">deactived</span>';
                            })

                            ->addColumn('action', function(WithdrawMethod $data) {
                                
                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.withdraw.method.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.withdraw.method.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                            })
                            ->rawColumns(['action','status'])
                            ->toJson();//--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.withdrawmethod.index');
    }

    public function create(){
        return view('admin.withdrawmethod.create');
    }

    public function store(Request $request){
        $rules = [
            'method'=> 'required',
            'fixed'=> 'required|gt:0',
            'percentage'=> 'required|gt:0',
            'status'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        WithdrawMethod::create([
            'method' => $request->method,
            'fixed' => $request->fixed,
            'percentage' => $request->percentage,
            'status' => $request->status
        ]);

        return response()->json('Data Added Successfully');
    }

    public function edit($id){
        $data['data'] = WithdrawMethod::findOrFail($id);
        return view('admin.withdrawmethod.edit',$data);
    }

    public function update(Request $request,$id){
        $rules = [
            'method'=> 'required',
            'fixed'=> 'required|gt:0',
            'percentage'=> 'required|gt:0',
            'status'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $data = WithdrawMethod::findOrFail($id);

        $data->method = $request->method;
        $data->fixed = $request->fixed;
        $data->percentage = $request->percentage;
        $data->status = $request->status;

        $data->save();

        return response()->json('Data Updated Successfully');
    }

    public function destroy($id){
        $data = WithdrawMethod::findOrFail($id)->delete();

        return response()->json('Data Deleted Successfully');
    }
}
