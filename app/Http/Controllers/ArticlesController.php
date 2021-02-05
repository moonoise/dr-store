<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\Uploads;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Config;

class ArticlesController extends Controller
{
    public $sizeUpload ;

    public function __construct()
    {
        $this->middleware('admin')->only('edit','update','create','destroy','store');
        // $this->middleware('auth')->only('show','search','download','index');

        $this->sizeUpload = 'max:'.env('MAX_UPLOAD',4096);
        // $this->sizeUpload = 'max:4096';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->get('categories_id');
        return view('articles.create',['categories_id' => $id ]);
    }

    public function checkFileSize($files)
    {
            $allowedfileExtension = Config::get('fileupload.allowedfileExtension');

            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $checkExtension[]=in_array($extension,$allowedfileExtension);

            }
            return !in_array(false,$checkExtension) ;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Articles $articles,Uploads $uploads)
    {

        // dd($request);

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'filename' => 'required',
            'filename.*' => $this->sizeUpload
        ],[
            'title.required' => 'กรุณากรอกข้อมูล',
            'body.required' => 'กรุณากรอกข้อมูล คำอธิบาย',
            'filename.required' => 'กรุณาแนบไฟล์',
            'filename.*' => 'ขนาดไฟล์เกินกำหนด '.$this->sizeUpload
        ]);

            // dd($article);
        if($request->hasFile('filename'))
        {

            $files = $request->file('filename');

            if($this->checkFileSize($files)){

                $article = $articles->create($request->only('title','body','categories_id')+['user_id'=> \auth::id() ] );

                   foreach($request->file('filename') as $key => $file)
                   {
                    //    dd($file);
                       $oldname=$file->getClientOriginalName();

                       $filename = date('Y-m-d_H-i-s').'_category-'.$request->categories_id.'_article-'.$article->id.'_'.rand(1,99999).'.'.$file->getClientOriginalExtension();
                    //    dd($filename);
                        $path = $file->storeAs('files',$filename);

                        $article->uploads()->create([
                            'path' => $path,
                            'file_name' => $filename,
                            'source_name' => $oldname,
                            'articles_id' => $article->id
                        ]);
                    }
                //    dd($data);

                return redirect()->route('categories.show',$request->categories_id)->with('success','เพ่ิมหัวข้อเรียบร้อย');

            }else {
                return redirect()->back()->with('danger' ,'แนบไฟล์ได้เฉพาะนามสกุลที่กำหนด '.implode( ", ", Config::get('fileupload.allowedfileExtension') ) )->withInput();
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Articles $articles,Categories $categories)
    {
        $article = Articles::findOrFail($id);
        $uploads = $article->Uploads;
        $category = $article->Categories->title;
        $user = $article->User->only('id','name');
        // dd($article->file_decode);
        return view('articles.show',compact('article','user','category','uploads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Articles $articles,Categories $categories)
    {
        $article = $articles->find($id);
        $uploads = $article->uploads;
        $category = $article->Categories;
        $user = $article->User;

        $selectCategories = Categories::all('id','title');

        // dd($selectCategories);
        return view('articles.edit',compact('article','category','user','selectCategories','uploads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Articles $articles, $id,Uploads $uploads)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'categories_id' => 'required',
            'filename.*' => $this->sizeUpload
        ],[
            'title.required' => 'กรุณากรอกข้อมูล',
            'body.required' => 'กรุณากรอกข้อมูล รายลเอียด',
            'categories_id.required' => 'กรุณาเลือกหมวด',
            'filename.*' => 'ขนาดไฟล์เกินกำหนด'.$this->sizeUpload
        ]);
        // dd($request->has('file_id'));
         $article = Articles::find($id)->update($request->only('title','body','categories_id'));
            // dd($article);

        if ($request->has('file_id')) {
            foreach ($request->file_id  as $key => $fileId) {
                // dd($fileId);

                $upload = Uploads::find($fileId);
                $path = $upload->path;
                // dd($path);
                Storage::delete($path);
                $upload->delete();

             }
        }

         if($request->hasFile('filename')){
            $files = $request->file('filename');

            if($this->checkFileSize($files)){
                foreach($request->file('filename') as $key => $file)
                {
                //    dd($file);
                    $oldname=$file->getClientOriginalName();

                    $filename = date('Y-m-d_H-i-s').'_category-'.$request->categories_id.'_article-'.$id.'_'.rand(1,99999).'.'.$file->getClientOriginalExtension();
                //    dd($filename);
                    $path = $file->storeAs('files',$filename);

                    Uploads::create([
                        'path' => $path,
                        'file_name' => $filename,
                        'source_name' => $oldname,
                        'articles_id' => $id
                    ]);

                }
            }
         }

         if($article){
            return  redirect()->route('articles.show',$id)->with('success','แก้ไขเนื้อหาแล้ว');
         }else {
            return  redirect()->route('articles.show',$id)->with('danger','เกิดข้อผิดพลาด');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , Request $request , Articles $articles)
    {
        // dd($request);
        $article =  $articles::find($id);
        $uploads = $article->Uploads;

        if ($uploads != null) {
            foreach ($uploads as $key => $upload) {
                Storage::delete($upload->path);
                $upload->delete();
            }
        }
        $check = Articles::destroy($id);

        if($check){
            return  redirect()->route('categories.show',$request->categories_id)->with('success','เนื้อหาถูกลบแล้ว');
         }else {
            return  redirect()->route('categories.show',$request->categories_id)->with('danger','เกิดข้อผิดพลาด');
         }

    }

    public function search(Request $request,Articles $articles)
    {

        $search = $request->get('search');
        // dd($search);
        $category = Categories::findOrFail($request->categories_id);
        $articles = Articles::select()
                            ->where('title','like','%'.$search.'%')
                            ->where('categories_id',$request->categories_id)
                            ->paginate(10);
        // dd($articles);

        return  view('categories.show',compact('category','articles'))->render();

    }

    protected function download(Request $request)
    {
        try {
            $file = 'app/'.$request->path;
            $path = storage_path($file);
    
            return response()->download($path , $request->source_name);
        } catch (\Exception $e) {
            abort(404);
        }
    }

}