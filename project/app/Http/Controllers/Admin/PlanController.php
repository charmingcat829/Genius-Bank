<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Product::orderBy('id','desc')->get();

         return Datatables::of($datas)
                            ->editColumn('price', function(Product $data) {
                                return $price = showNameAmount($data->price);
                            })
                            ->addColumn('action', function(Product $data) {

                                return '<div class="btn-group mb-1">
                                  <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.'Actions' .'
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="' . route('admin.plan.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.plan.delete',$data->id).'">'.__("Delete").'</a>
                                  </div>
                                </div>';

                              })
                            ->rawColumns(['action'])
                            ->toJson();
    }


    public function index()
    {
        return view('admin.plan.index');
    }

    public function info()
    {
        return view('admin.product.info');
    }

    public function create()
    {
        $data['currency'] = Currency::where('is_default','=',1)->first();
        return view('admin.plan.create',$data);
    }

    public function status($id1,$id2)
    {
        $data = Product::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:products',
            'min_price'=> 'required',
            'min_price'=> 'required',
            'days'=> 'required',
            'percentage'=> 'required|numeric|gt:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $percentage = $request->percentage;
        $data = new Product;
        $input = $request->all();

        if($percentage>=100)
        {
            $input['percentage'] =  $percentage;
            $data->fill($input)->save();

            $msg = 'New Plan Added Successfully.<a href="'.route('admin.plan.index').'">View Plan Lists.</a>';
            return response()->json($msg);
        }
        else{
            $msg = 'Payout Rate Must be Larger than 100%';
            return response()->json(array('errors' => [$msg]));
        }

    }


    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $currency = Currency::where('is_default','=',1)->first();
        return view('admin.plan.edit',compact('data','currency'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|unique:products,title,'.$id,
            'min_price'=> 'required',
            'min_price'=> 'required',
            'days'=> 'required',
            'percentage'=> 'required|numeric|gt:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Product::findOrFail($id);
        $input = $request->all();
        $percentage = $request->percentage;
        if($percentage>=100)
            {
                $input['percentage'] =  $percentage;
                $data->update($input);

                $msg = 'Plan Updated Successfully.<a href="'.route('admin.plan.index').'">View Plan Lists.</a>';
                return response()->json($msg);
            }
            else{
                $msg = 'Payout Rate Must be Larger than 100%';
                return response()->json(array('error' => $msg));
            }

    }

    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        $msg = 'Plan Deleted Successfully.';
        return response()->json($msg);
    }
}
