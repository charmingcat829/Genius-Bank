<?php

namespace App\Http\Controllers\Admin;
use App\Models\Pagesetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Validator;


class PageSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function update(Request $request)
    {
            $data = Pagesetting::findOrFail(1);
            $input = $request->all();


            if ($file = $request->file('newsletter_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->newsletter_photo);
                $input['newsletter_photo'] = $name;
            }

            if ($file = $request->file('about_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->about_photo);
                $input['about_photo'] = $name;
            }

            if ($file = $request->file('service_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->service_photo);
                $input['service_photo'] = $name;
            }


            if ($file = $request->file('hero_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->hero_photo);
                $input['hero_photo'] = $name;
            }

            if ($file = $request->file('quick_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->quick_photo);
                $input['quick_photo'] = $name;
            }

            if ($file = $request->file('quick_background'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->quick_background);
                $input['quick_background'] = $name;
            }

            if ($file = $request->file('app_banner'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->app_banner);
                $input['app_banner'] = $name;
            }

            if ($file = $request->file('app_store_photo'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->app_store_photo);
                $input['app_store_photo'] = $name;
            }

            if ($file = $request->file('app_google_store'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->app_google_store);
                $input['app_google_store'] = $name;
            }

            if ($file = $request->file('strategy_banner'))
            {
                $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->strategy_banner);
                $input['strategy_banner'] = $name;
            }

            if($request->about_attributes){
                $input['about_attributes'] = json_encode($request->about_attributes,true);
             }


            $data->update($input);
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
    }


    public function homeupdate(Request $request)
    {
        $data = Pagesetting::findOrFail(1);
        $input = $request->all();

        $data->update($input);
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }

    public function customization(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.customization',compact('data'));
    }

    public function customizationUpdate(Request $request){
        $data = Pagesetting::find(1);

        if($request->home_module){
            $input['home_module'] = json_encode($request->home_module,true);
        }else{
            $input['home_module'] = [];
        }
        $data->update($input);

        if($request->ajax()){
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
        }else{
            return back()->withSuccess('Data Updated Successfully.');
        }
    }

    public function hero(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.hero_section',compact('data'));
    }

    public function quickStart(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.quick_start',compact('data'));
    }

    public function about(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.about_section',compact('data'));
    }

    public function apps(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.apps_section',compact('data'));
    }

    public function stretegy(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.stretegy_section',compact('data'));
    }

    public function contact()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.contact',compact('data'));
    }

    public function sectionHeading(){
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.sectionheading',compact('data'));
    }

    public function customize()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.customize',compact('data'));
    }


    public function blogsection()
    {
        $ps = HomepageSetting::findOrFail(1);
        return view('admin.pagesetting.blog_section',compact('ps'));
    }


    public function faqupdate($status)
    {
        $page = Pagesetting::findOrFail(1);
        $page->f_status = $status;
        $page->update();
        Session::flash('success', 'FAQ Status Upated Successfully.');
        return redirect()->back();
    }

    public function contactup($status)
    {
        $page = Pagesetting::findOrFail(1);
        $page->c_status = $status;
        $page->update();
        Session::flash('success', 'Contact Status Upated Successfully.');
        return redirect()->back();
    }

    //Upadte Contact Page Section Settings
    public function contactupdate(Request $request)
    {
        $page = Pagesetting::findOrFail(1);
        $input = $request->all();
        $page->update($input);
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }


}
