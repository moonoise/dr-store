<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = ['title','body' ,'categories_id','user_id'];

    protected $casts = [
        'files' => 'json',
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function Uploads()
    {
        return $this->hasMany(Uploads::class);
    }
}
