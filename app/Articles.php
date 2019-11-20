<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = ['title','body'];

    public function User()
    {
        $this->belongsTo(User::class);
    }

    public function Categories()
    {
        $this->belongsTo(Categories::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }


}
