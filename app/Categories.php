<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['title','overview','user_id'];

    // public function User()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function Articles()
    {
        return $this->hasMany(Articles::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
    }

    public function getOverViewHtmlAttribute() {
        return $this->bodyHtml();
    }

    private function bodyHtml()
    {
        return \Parsedown::instance()->text( $this->overview );
    }



}
