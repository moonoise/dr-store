<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Articles $articles)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ],[
            'title.required' => 'กรุณากรอกข้อมูล',
            'body.required' => 'กรุณากรอกข้อมูล คำอธิบาย'
        ]);

        $articles->create($request->only('title','body','categories_id')+['user_id'=> \auth::id() ,'view_count' => 0, 'download_count' => 0 ] );
        return redirect()->route('categories.show',$request->categories_id)->with('success','เพ่ิมหัวข้อเรียบร้อย');
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
        $category = $article->Categories->title;
        $user = $article->user->only('id','name');
        // dd($user);
        return view('articles.show',compact('article','user','category'));
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
        $category = $article->Categories;
        $user = $article->User;

        $selectCategories = Categories::all('id','title');

        // dd($selectCategories);
        return view('articles.edit',compact('article','category','user','selectCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Articles $articles, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'categories_id' => 'required'
        ],[
            'title.required' => 'กรุณากรอกข้อมูล',
            'body.required' => 'กรุณากรอกข้อมูล รายลเอียด',
            'categories_id.required' => 'กรุณาเลือกหมวด'
        ]);

        // dd($request);
         $article = Articles::find($id);
        //  dd($article);
         $article->title = $request->title;
         $article->body = $request->body;
         $article->categories_id = $request->categories_id;
        $check =  $article->save();
        //  dd($check);
         if($check){
            return  redirect()->route('categories.show',$request->categories_id)->with('success','แก้ไขเนื้อหาแล้ว');
         }else {
            return  redirect()->route('categories.show',$request->categories_id)->with('danger','เกิดข้อผิดพลาด');
         }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , Request $request)
    {
        // dd($request);
        $check = Articles::destroy($id);
        if($check){
            return  redirect()->route('categories.show',$request->categories_id)->with('success','เนื้อหาถูกลบแล้ว');
         }else {
            return  redirect()->route('categories.show',$request->categories_id)->with('danger','เกิดข้อผิดพลาด');
         }



    }
}
