<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sitemap;
use Datatables;
use Illuminate\Http\Request;
use Validator;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Sitemap::orderBy('id','desc');

         return Datatables::of($datas)
                            ->addColumn('action', function(Sitemap $data) {
                                $delete = '<a href="javascript:;" data-href="' . route('admin.sitemap.delete',$data->id) . '" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm btn-rounded"><i class="fas fa-trash-alt"></i></a>';
                                $download = '<a href="'.asset('assets/sitemaps/'.$data->filename).'" class="btn btn-dark btn-sm btn-rounded" download><i class="fa fa-download"></i> Download</a>';
                                return '<div class="actions-btn">'.$delete.$download.'</div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function index()
    {
        return view('admin.sitemap.index');
    }

    public function create()
    {
        return view('admin.sitemap.create');
    }

    public function store(Request $request){
        $rules = [
            'sitemap_url' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        $data = new Sitemap();
        $input = $request->all();

        $filename = 'sitemap'.uniqid().'.xml';
        SitemapGenerator::create($request->sitemap_url)->writeToFile('assets/sitemaps/'.$filename);
        $input['filename']    = $filename;
        $input['sitemap_url'] = $request->sitemap_url;
        $data->fill($input)->save();

        $msg = 'Data Added Successfully.';
        return response()->json($msg);
    }

    public function delete($id){
        $data = Sitemap::find($id);
        @unlink('assets/sitemaps/'.$data->filename);
        $data->delete();
        $msg = 'Data Deleted SuccessFully';
        return response()->json($msg);
    }
}
