<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    protected $fillable = ['pathname','filename','oldname','newname','article_id'];

    public function Articles()
    {
        return $this->belongsTo(Articles::class);
    }



}
