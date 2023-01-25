<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\OtherBank;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function GuzzleHttp\json_decode;

class BeneficiaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $data['beneficiaries'] = Beneficiary::whereUserId(auth()->id())->orderBy('id','desc')->paginate(10);
        return view('user.beneficiaries.index',$data);
    }

    public function create(){
        $data['othersBank'] = OtherBank::whereStatus(1)->orderBy('id','desc')->get();
        return view('user.beneficiaries.create',$data);
    }

    public function store(Request $request){
        $request->validate([
            'account_number' => 'required',
            'account_name' => 'required',
            'nick_name' => 'required',
        ]);

        $data = new Beneficiary();
        $input = $request->all();

        $bank = OtherBank::findOrFail($request->other_bank_id);

        $requireInformations = [];
        foreach(json_decode($bank->required_information) as $key=>$value){
            $requireInformations[$value->type] = str_replace(' ', '_', $value->field_name);
        }

        $details = [];
        foreach($requireInformations as $key=>$info){
            if($request->has($info)){
                if($request->hasFile($info)){
                    if ($file = $request->file($info))
                    {
                       $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                       $file->move('assets/images',$name);
                       $details[$info] = [$name,$key];
                    }
                }else{
                    $details[$info] = [$request->$info,$key];
                }
            }
        }

        $input['details'] = json_encode($details,true);

        $input['user_id'] = auth()->user()->id;
        $data->fill($input)->save();

        return redirect()->back()->with('success','Beneficiary Added Successfully');
    }

    public function show($id){
        $data['data'] = Beneficiary::findOrFail($id);
        return view('user.beneficiaries.show',$data);
    }
}
