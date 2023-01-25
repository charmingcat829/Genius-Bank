<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountProcess;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountProcessController extends Controller
{
    public function datatables()
    {
         $datas = AccountProcess::orderBy('id','desc');
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('details', function(AccountProcess $data) {
                                $details = mb_strlen(strip_tags($data->details),'utf-8') > 100 ? mb_substr(strip_tags($data->details),0,100,'utf-8').'...' : strip_tags($data->details);
                                return  $details;
                            })
                            ->addColumn('action', function(AccountProcess $data) {

                              return '<div class="btn-group mb-1">
                              <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.'Actions' .'
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                <a href="' . route('admin.account.process.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.account.process.delete',$data->id).'">'.__("Delete").'</a>
                              </div>
                            </div>';
                            })
                            ->rawColumns(['action','details'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function index()
    {
        return view('admin.account.index');
    }
    public function create()
    {
        return view('admin.account.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title'=>'required',
            'details'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new AccountProcess();
        $input = $request->all();
        $data->fill($input)->save();

        //--- Redirect Section
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.account.process.index").'">Account Process Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function edit($id)
    {
        $data = AccountProcess::findOrFail($id);
        return view('admin.account.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title'=>'required',
            'details'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = AccountProcess::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.account.process.index").'">Account Process Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function destroy($id)
    {
        $data = AccountProcess::findOrFail($id);
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
