<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\OtherBank;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class OtherBankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = OtherBank::orderBy('id','desc')->get();

         return Datatables::of($datas)

                            ->editColumn('title', function(OtherBank $data) {
                                return  '<div>
                                            <h6 class="text-primary">'.$data->title.'</h6>
                                            Processing Time : '.$data->processing_time.'
                                        </div>';
                            })
                            ->editColumn('min_limit', function(OtherBank $data){
                                return '<div>
                                            Min : <span class="text-primary">'.showNameAmount($data->min_limit).'</span>
                                            <br>
                                            Max : <span class="text-primary">'.showNameAmount($data->max_limit).'</span>
                                        </div>';
                            })
                            ->editColumn('fixed_charge', function(OtherBank $data){
                                return '<div>
                                            Fixed : <span class="text-primary">'.showNameAmount($data->fixed_charge).'</span>
                                            <br>
                                            Percent : <span class="text-primary">'.showNameAmount($data->percent_charge).'%</span>
                                        </div>';
                            })
                            ->editColumn('status', function(OtherBank $data) {
                                $status      = $data->status == 1 ? _('activated') : _('deactivated');
                                $status_sign = $data->status == 1 ? 'success'   : 'danger';

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.other.banks.status',['id1' => $data->id, 'status' => 1]).'">'.__("activated").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.other.banks.status',['id1' => $data->id, 'status' => 0]).'">'.__("deactivated").'</a>
                                </div>
                              </div>';
                            })
                            ->addColumn('action', function(OtherBank $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.other.banks.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.other.banks.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';

                              })
                            ->rawColumns(['title','min_limit','fixed_charge','status','action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.otherbank.index');
    }

    public function create(){
        $data['currency'] = Currency::whereIsDefault(1)->first();
        return view('admin.otherbank.create',$data);
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required|max:255',
            'processing_time' => 'required',
            'min_limit' => 'required',
            'max_limit' => 'required',
            'daily_maximum_limit' => 'required',
            'daily_total_transaction' => 'required',
            'monthly_maximum_limit' => 'required',
            'monthly_total_transaction' => 'required',
            'fixed_charge' => 'required',
            'percent_charge' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $input = $request->all();
        $data = new OtherBank();

        if($request->form_builder){
            $input['required_information'] = json_encode(array_values($request->form_builder));
        }
        $data->fill($input)->save();

        $msg = 'New Bank Added Successfully.<a href="'.route('admin.other.banks.index').'">View Bank Lists.</a>';
        return response()->json($msg);
    }

    public function edit(Request $request, $id){
        $data['data'] = OtherBank::findOrFail($id);
        $data['currency'] = Currency::whereIsDefault(1)->first();
        $data['informations'] = json_decode($data['data']->required_information,true);

        return view('admin.otherbank.edit',$data);
    }

    public function update(Request $request, $id){
        $rules = [
            'title' => 'required|max:255',
            'processing_time' => 'required',
            'min_limit' => 'required',
            'max_limit' => 'required',
            'daily_maximum_limit' => 'required',
            'daily_total_transaction' => 'required',
            'monthly_maximum_limit' => 'required',
            'monthly_total_transaction' => 'required',
            'fixed_charge' => 'required',
            'percent_charge' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = OtherBank::findOrFail($id);
        $input = $request->all();

        if($request->form_builder){
            $input['required_information'] = json_encode(array_values($request->form_builder));
        }
        $data->update($input);

        $msg = 'Bank Updated Successfully.<a href="'.route('admin.other.banks.index').'">View Bank Lists.</a>';
        return response()->json($msg);
    }

    public function status($id1,$id2)
    {
        $data = OtherBank::findOrFail($id1);
        $data->status = $id2;
        $data->update();

        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
    }

    public function destroy($id)
    {
        $data = OtherBank::findOrFail($id);
        $data->delete();

        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
    }

}
