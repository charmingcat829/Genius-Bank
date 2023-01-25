<?php

namespace App\Http\Controllers\Admin;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GeneralSettingController extends Controller
{

    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'affilate_banner'   => 'mimes:jpeg,jpg,png,svg',
        'error_banner'      => 'mimes:jpeg,jpg,png,svg',
        'popup_background'  => 'mimes:jpeg,jpg,png,svg',
        'invoice_logo'      => 'mimes:jpeg,jpg,png,svg',
        'breadcumb_banner'  => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'       => 'mimes:jpeg,jpg,png,svg',
        'cert_sign'         => 'mimes:jpeg,jpg,png,svg',
        'footer'            =>'min:10',
        'copyright'         =>'min:10',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function generalupdate(Request $request)
    {
        $validator =Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else {
            $input = $request->all();
            $data = Generalsetting::findOrFail(1);

            if(isset($input['menu'])){
                $input['menu'] =  $this->setMenu($input);
            }

            if ($file = $request->file('logo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->logo);
                $input['logo'] = $name;
            }
            if ($file = $request->file('favicon'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->favicon);
                $input['favicon'] = $name;
            }
            if ($file = $request->file('loader'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->loader);
                $input['loader'] = $name;
            }
            if ($file = $request->file('admin_loader'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->admin_loader);
                $input['admin_loader'] = $name;
            }

             if ($file = $request->file('error_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->error_photo);
                $input['error_photo'] = $name;
            }

            if ($file = $request->file('breadcumb_banner'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->breadcumb_banner);
                $input['breadcumb_banner'] = $name;
            }

            if ($file = $request->file('footer_logo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->footer_logo);
                $input['footer_logo'] = $name;
            }


            if ($file = $request->file('affilate_banner'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $data->upload($name,$file,$data->affilate_banner);
                $input['affilate_banner'] = $name;
            }

            if(!empty($request->module_section))
            {
                $input['module_section'] = implode(" , ",$request->module_section);
            }
            else{
                $input['module_section'] = '';
            }

            if(!empty($request->user_module))
            {
                $input['user_module'] = implode(" , ",$request->user_module);
            }
            else{
                $input['user_module'] = '';
            }

            $this->emailConfig($input);

            $data->update($input);


            if($request->ajax()){
                $msg = 'Data Updated Successfully.';
                return response()->json($msg);
            }else{
                return back()->withSuccess('Data Updated Successfully.');
            }

        }
    }

    public function generalupdatepayment(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else {
        $input = $request->all();
        $curr = Currency::where('is_default','=',1)->first();
        $data = Generalsetting::findOrFail(1);
        $prev = $data->molly_key;

        if ($request->vendor_ship_info == ""){
            $input['vendor_ship_info'] = 0;
        }

        if ($request->instamojo_sandbox == ""){
            $input['instamojo_sandbox'] = 0;
        }

        if ($request->paypal_mode == ""){
            $input['paypal_mode'] = 'live';
        }
        else {
            $input['paypal_mode'] = 'sandbox';
        }

        if ($request->paytm_mode == ""){
            $input['paytm_mode'] = 'live';
        }
        else {
            $input['paytm_mode'] = 'sandbox';
        }
        $input['fixed_commission'] = $input['fixed_commission'] / $curr->value;
        $data->update($input);


        $this->setEnv('MOLLIE_KEY',$data->molly_key,$prev);


        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        }
    }

    public function setMenu($input)
    {
        unset($input['menu']);
        unset($input['_token']);
        return json_encode($input);
    }

    public function logo()
    {
        return view('admin.generalsetting.logo');
    }

    public function breadcumb()
    {
        return view('admin.generalsetting.breadcumb');
    }

    public function userimage()
    {
        return view('admin.generalsetting.user_image');
    }

    public function fav()
    {
        return view('admin.generalsetting.favicon');
    }

    public function load()
    {
        return view('admin.generalsetting.loader');
    }

    public function contents()
    {
        return view('admin.generalsetting.websitecontent');
    }

    public function moneytransfer()
    {
        return view('admin.generalsetting.moneytransfer');
    }

    public function usermodules(){
        $data = Generalsetting::first();
        return view('admin.generalsetting.usermodules',compact('data'));
    }

    public function footer()
    {
        return view('admin.generalsetting.footer');
    }

    public function menubuilder()
    {
        return view('admin.menubuilder.index');
    }

    public function cookie(){
        return view('admin.generalsetting.cookie');
    }

    public function customcss()
    {
        $file = 'assets/front/css/custom.css';

        if(!file_exists($file)){
            fopen($file,"w+")
            or die("Unable to open file!");
        }
        $data = file_get_contents($file);

        return view('admin.generalsetting.css',compact('data'));
    }

    public function customcssSubmit(Request $request){
        $file = 'assets/front/css/custom.css';

        if(!file_exists($file)){
            fopen($file,"w+")
            or die("Unable to open file!");
        }

        file_put_contents($file,$request->custom_css);

        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }

    public function paymentsinfo()
    {
        $curr = Currency::where('is_default','=',1)->first();
        return view('admin.generalsetting.paymentsinfo',compact('curr'));
    }

    public function affilate()
    {
        return view('admin.generalsetting.affilate');
    }

    public function errorbanner()
    {
        return view('admin.generalsetting.error_banner');
    }

    public function maintain()
    {
        return view('admin.generalsetting.maintain');
    }

    public function twilio(){
        return view('admin.generalsetting.twilio');
    }

    public function nexmo(){
        return view('admin.generalsetting.nexmo');
    }

    public function status($field,$value)
    {
        $prev = '';
        $data = Generalsetting::find(1);
        if($field == 'is_debug'){
            $prev = $data->is_debug == 1 ? 'true':'false';
        }
        $data[$field] = $value;
        $data->update();
        if($field == 'is_debug'){
            $now = $data->is_debug == 1 ? 'true':'false';
            $this->setEnv('APP_DEBUG',$now,$prev);
        }

        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
    }

    public function emailConfig($input)
    {

         try {
             $this->setEnv('MAIL_HOST',$input['smtp_host']);
             $this->setEnv('MAIL_PORT',$input['smtp_port']);
             $this->setEnv('MAIL_USERNAME',$input['smtp_user']);
             $this->setEnv('MAIL_PASSWORD',$input['smtp_pass']);
             $this->setEnv('MAIL_ENCRYPTION','tls');
             if(isset($input['molly_key'])){
                $this->setEnv('MOLLIE_KEY',$input['molly_key']);
             }

         } catch (\Throwable $e) {

         }
    }

    private function setEnv($key, $value)
     {
         file_put_contents(app()->environmentFilePath(), str_replace(
             $key . '=' . env($key),
             $key . '=' . $value,
             file_get_contents(app()->environmentFilePath())
         ));
     }

}
