<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\User;
use Illuminate\Http\Request;

class ArticlesToJsonController extends Controller
{
    public function __construct()
    {
        $this->sizeUpload = 'max:'.env('MAX_UPLOAD',4096);
    }


    public function show($id,Articles $articles,Categories $categories)
    {
        $article = Articles::findOrFail($id);
        $uploads = $article->Uploads;
        $category = $article->Categories->title;
        $user = $article->User->only('id','name');
        // dd($article->file_decode);
        return response(compact('article'),200,['Content-Type','application/json']);
    
    }
}