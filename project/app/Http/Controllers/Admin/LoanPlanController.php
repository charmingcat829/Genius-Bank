<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\LoanPlan;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\json_decode;

class LoanPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = LoanPlan::orderBy('id','desc')->get();

         return Datatables::of($datas)
                            ->editColumn('min_amount', function(LoanPlan $data) {
                                return  '<div>
                                        Min: '.showNameAmount($data->min_amount).'
                                        <p>Max: '.showNameAmount($data->max_amount).'</p>
                                </div>';
                            })
                            ->editColumn('total_installment', function(LoanPlan $data){
                                return '<div>
                                    '.$data->per_installment.'% of every '.$data->installment_interval.' days for '.$data->total_installment.' times.
                                </div>';
                            })
                            ->editColumn('status', function(LoanPlan $data) {
                                $status      = $data->status == 1 ? _('activated') : _('deactivated');
                                $status_sign = $data->status == 1 ? 'success'   : 'danger';

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.loan.plan.status',['id1' => $data->id, 'status' => 1]).'">'.__("activated").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.loan.plan.status',['id1' => $data->id, 'status' => 0]).'">'.__("deactivated").'</a>
                                </div>
                              </div>';
                            })
                            ->addColumn('action', function(LoanPlan $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.loan.plan.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.loan.plan.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';

                              })
                            ->rawColumns(['min_amount','total_installment','status','action'])
                            ->toJson();
    }


    public function index(){
        return view('admin.loanplan.index');
    }

    public function create(){
        $data['currency'] = Currency::whereIsDefault(1)->first();

        return view('admin.loanplan.create',$data);
    }

    public function store(Request $request){
        $rules = [
          'title'=>'required|max:255',
          'min_amount'=>'required|numeric|min:1',
          'max_amount'=>'required|numeric|min:1',
          'per_installment'=>'required|numeric|min:1',
          'installment_interval'=>'required|numeric|min:1',
          'total_installment'=>'required|numeric|min:1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $input = $request->all();
        $data = new LoanPlan();

        if($request->form_builder){
          $input['required_information'] = json_encode($request->form_builder);
        }
        $data->fill($input)->save();

        $msg = 'New Plan Added Successfully.<a href="'.route('admin.loan.plan.index').'">View Plan Lists.</a>';
        return response()->json($msg);
    }

    public function edit(Request $request, $id){
        $data['data'] = LoanPlan::findOrFail($id);
        $data['currency'] = Currency::whereIsDefault(1)->first();
        $data['informations'] = $data['data']->required_information ? json_decode($data['data']->required_information,true) : [];

        return view('admin.loanplan.edit',$data);
    }

    public function update(Request $request, $id){
        $data = LoanPlan::findOrFail($id);
        $input = $request->all();

        if($request->form_builder){
          $input['required_information'] = json_encode($request->form_builder);
        }else{
          $input['required_information'] = NULL;
        }
        $data->update($input);

        $msg = 'New Plan Updated Successfully.<a href="'.route('admin.loan.plan.index').'">View Plan Lists.</a>';
        return response()->json($msg);
    }

    public function status($id1,$id2)
    {
        $data = LoanPlan::findOrFail($id1);
        $data->status = $id2;
        $data->update();

        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
    }

    public function destroy($id)
    {
        $data = LoanPlan::findOrFail($id);
        $data->delete();

        $msg = 'Plan Deleted Successfully.';
        return response()->json($msg);
    }
}
