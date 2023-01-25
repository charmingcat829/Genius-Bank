<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\WireTransferBank;
use Illuminate\Http\Request;
use Datatables;
use Validator;

class WireTransferBankController extends Controller
{
    public function datatables()
    {
         $datas = WireTransferBank::orderBy('id','desc')->get();
         return Datatables::of($datas)
                            ->editColumn('title', function(WireTransferBank $data) {
                                $title = strlen(strip_tags($data->title)) > 50 ? substr(strip_tags($data->title),0,50).'...' : strip_tags($data->title);
                                return  $title;
                            })
                            ->editColumn('min_amount', function(WireTransferBank $data) {
                                $curr = Currency::where('is_default','=',1)->first();
                                return  '<div>
                                        Min: '.$curr->sign.$data->min_amount.'
                                        <p>Max: '.$curr->sign.$data->max_amount.'</p>
                                </div>';
                            }) 
                            ->editColumn('currency_id', function(WireTransferBank $data){
                                return $data->currency->name;
                            })

                            ->editColumn('status', function(WireTransferBank $data) {
                                $status      = $data->status == 1 ? _('activated') : _('deactivated');
                                $status_sign = $data->status == 1 ? 'success'   : 'danger';

                                return '<div class="btn-group mb-1">
                                        <span class="badge bg-'.$status_sign.'">'.$status .'</span>
                              </div>';
                            })
                            ->addColumn('action', function(WireTransferBank $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.wire.transfer.banks.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.wire.transfer.banks.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';
  
                              })
                            ->rawColumns(['title','min_amount','currency_id','status', 'action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.wiretransferbank.index');
    }

    public function create(){
        $data['currency'] = Currency::whereIsDefault(1)->first();
        $data['currencies'] = Currency::orderBy('id','desc')->get();
        $data['countries'] = Country::orderBy('id','desc')->get();

        return view('admin.wiretransferbank.create',$data);
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required',
            'min_amount' => 'required|min:0',
            'max_amount' => 'required|min:0',
            'currency_id' => 'required',
            'country_id' => 'required',
            'fixed_charge' => 'required',
            'percentage_charge' => 'required',
            'routing_number' => 'required',
            'status' => 'required',
        ];

        $data = new WireTransferBank();
        $data->title = $request->title;
        $data->swift_code = $request->swift_code;
        $data->min_amount = $request->min_amount;
        $data->max_amount = $request->max_amount;
        $data->currency_id = $request->currency_id;
        $data->country_id = $request->country_id;
        $data->fixed_charge = $request->fixed_charge;
        $data->percentage_charge = $request->percentage_charge;
        $data->routing_number = $request->routing_number;
        $data->status = $request->status;
        $data->save();

        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.wire.transfer.banks.index").'">View Bank Lists</a>';
        return response()->json($msg);
    }

    public function edit($id){
        $data['data'] = WireTransferBank::findOrFail($id);
        $data['currency'] = Currency::whereIsDefault(1)->first();
        $data['currencies'] = Currency::orderBy('id','desc')->get();
        $data['countries'] = Country::orderBy('id','desc')->get();

        return view('admin.wiretransferbank.edit',$data);
    }

    public function update(Request $request,$id){
        $rules = [
            'title' => 'required',
            'min_amount' => 'required|min:0',
            'max_amount' => 'required|min:0',
            'currency_id' => 'required',
            'country_id' => 'required',
            'fixed_charge' => 'required',
            'percentage_charge' => 'required',
            'routing_number' => 'required',
            'status' => 'required',
        ];

        $data = WireTransferBank::findOrFail($id);
        $data->title = $request->title;
        $data->swift_code = $request->swift_code;
        $data->min_amount = $request->min_amount;
        $data->max_amount = $request->max_amount;
        $data->currency_id = $request->currency_id;
        $data->country_id = $request->country_id;
        $data->fixed_charge = $request->fixed_charge;
        $data->percentage_charge = $request->percentage_charge;
        $data->routing_number = $request->routing_number;
        $data->status = $request->status;
        $data->update();

        $msg = 'New Data Updated Successfully.'.'<a href="'.route("admin.wire.transfer.banks.index").'">View Bank Lists</a>';
        return response()->json($msg);
    }

    public function destroy($id){
        $data = WireTransferBank::findOrFail($id);
        $data->delete();

        $msg = 'Data deleted Successfully';
        return response()->json($msg);
    }
}
