<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = ['title','body' ,'categories_id','user_id','view_count','download_count'];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Categories()
    {
        return $this->belongsTo(Categories::class);
    }



}
