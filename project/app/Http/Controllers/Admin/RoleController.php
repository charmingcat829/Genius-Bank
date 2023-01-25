<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Role::orderBy('id','desc');
         return Datatables::of($datas)
                            ->addColumn('section', function(Role $data) {
                                $details =  str_replace('_',' ',$data->section);
                                $details =  ucwords($details);
                                return  '<div>'.$details.'</div>';
                            })
                            ->addColumn('action', function(Role $data) {

                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.role.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.role.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';

                            })
                            ->rawColumns(['section','action'])
                            ->toJson();
    }


    public function index()
    {
        return view('admin.role.index');
    }


    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $data = new Role();
        $input = $request->all();

        if(!empty($request->section))
        {
            $input['section'] = implode(" , ",$request->section);
        }
        else{
            $input['section'] = '';
        }

        $data->fill($input)->save();

        $msg = __('New Data Added Successfully.').'<a href="'.route('admin.role.index').'">'.__('View Lists.').'</a>';;
        return response()->json($msg);
    }

    public function edit($id)
    {
        $data = Role::findOrFail($id);
        return view('admin.role.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
               'photo'      => '',
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Role::findOrFail($id);
        $input = $request->all();
        if(!empty($request->section))
        {
            $input['section'] = implode(" , ",$request->section);
        }
        else{
            $input['section'] = '';
        }
        $data->update($input);

        $msg = __('Data Updated Successfully.').'<a href="'.route('admin.role.index').'">'.__('View Lists.').'</a>';
        return response()->json($msg);

    }

    public function destroy($id)
    {
        $data = Role::findOrFail($id);
        $data->delete();

        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
    }
}
