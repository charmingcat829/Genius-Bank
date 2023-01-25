<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\FdrPlan;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class FdrPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = FdrPlan::orderBy('id','desc')->get();

         return Datatables::of($datas)

                            ->editColumn('interest_rate', function(FdrPlan $data) {
                                if($data->interval_type == 'partial'){
                                    return  '<div>
                                                <span class="text-primary">'.$data->interest_rate.' %</span> of total deposited amount for every <span>'.$data->interest_interval.'</span> Days
                                            </div>';
                                }else{
                                    return  '<div>
                                                <span class="text-primary">'.$data->interest_rate.' %</span> of total deposited amount for after <span>'.$data->matured_days.'</span> Matured Days
                                            </div>';
                                }

                            })
                            ->editColumn('min_amount', function(FdrPlan $data){
                                $curr = Currency::where('is_default','=',1)->first();
                                return  '<div>
                                            Min: '.showNameAmount($data->min_amount).'
                                            <p>Max: '.showNameAmount($data->max_amount).'</p>
                                        </div>';
                            })
                            ->editColumn('status', function(FdrPlan $data) {
                                $status      = $data->status == 1 ? _('activated') : _('deactivated');
                                $status_sign = $data->status == 1 ? 'success'   : 'danger';

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.fdr.plan.status',['id1' => $data->id, 'status' => 1]).'">'.__("activated").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.fdr.plan.status',['id1' => $data->id, 'status' => 0]).'">'.__("deactivated").'</a>
                                </div>
                              </div>';
                            })
                            ->addColumn('action', function(FdrPlan $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.fdr.plan.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.fdr.plan.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';

                              })
                            ->rawColumns(['interest_rate','min_amount','status','action'])
                            ->toJson();
    }


    public function index(){
        return view('admin.fdrplan.index');
    }

    public function create(){
        $data['currency'] = Currency::whereIsDefault(1)->first();
        return view('admin.fdrplan.create',$data);
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required|max:255',
            'interest_rate' => 'required',
            'matured_days' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $input = $request->all();
        $data = new FdrPlan();
        $data->fill($input)->save();

        $msg = 'New Plan Added Successfully.<a href="'.route('admin.fdr.plan.index').'">View Plan Lists.</a>';
        return response()->json($msg);
    }

    public function edit(Request $request, $id){
        $data['data'] = FdrPlan::findOrFail($id);
        $data['currency'] = Currency::whereIsDefault(1)->first();

        return view('admin.fdrplan.edit',$data);
    }

    public function update(Request $request, $id){
        $rules = [
            'title' => 'required|max:255',
            'interest_rate' => 'required',
            'matured_days' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = FdrPlan::findOrFail($id);
        $input = $request->all();

        if($request->interval_type == 'fixed'){
            $input['interest_interval'] = NULL;
        }
        $data->update($input);

        $msg = 'New Plan Updated Successfully.<a href="'.route('admin.fdr.plan.index').'">View Plan Lists.</a>';
        return response()->json($msg);
    }

    public function status($id1,$id2)
    {
        $data = FdrPlan::findOrFail($id1);
        $data->status = $id2;
        $data->update();

        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
    }

    public function destroy($id)
    {
        $data = FdrPlan::findOrFail($id);
        $data->delete();

        $msg = 'Plan Deleted Successfully.';
        return response()->json($msg);
    }
}
