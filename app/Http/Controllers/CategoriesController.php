<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::paginate(25);
        // dd($categories);
        return view('categories.index',compact('categories'))->render();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Categories $categories , Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'overview' => 'required'
        ],[
            'title.required' => 'กรุณากรอกข้อมูล',
            'overview.required' => 'กรุณากรอกข้อมูล คำอธิบาย'
        ]);

        $categories->create($request->only('title','overview')+['user_id'=> \auth::id()]);

        return redirect()->route('categories.index')->with('success','เพิ่มหมวดหมู่แล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories, Articles $articles ,$id)
    {
        $category = Categories::findOrFail($id);
        $articles = $category->Articles()->paginate(5);
        // $articles = Articles::where('categories_id','=',$id)->paginate(5);
        // dd($articles);
        return  view('categories.show',compact('category','articles'))->render();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories,User $user,Request $request)
    {
        // dd($categories::find(2));

        $categories = Categories::find($request->category);
        $user = User::find($categories->user_id);
        // dd($user);
        return view('categories.edit',compact('categories','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories,$id)
    {
        // dd(\auth::id());
        $categories = Categories::find($id);
        $categories->title = $request->input('title');
        $categories->overview = $request->input('overview');
        $categories->user_id = \auth::id();
        $categories->save();

        return redirect('/categories')->with('success',"อัพเดทแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories,$id)
    {
        // dd($id);
       $categories = Categories::findOrFail($id);
       $categories->delete();

       return redirect('/categories')->with('success','ลบแล้ว'.$id);
    }

    public function search(Request $request,Categories $categories)
    {

        $search = $request->get('search');
        // dd($search);
        $categories = Categories::select()->where('title','like','%'.$search.'%')->paginate(10);

        return view('categories.index',compact('categories','search'))->render();
    }


}
