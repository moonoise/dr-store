<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    protected $fillable = ['path','file_name','source_name','articles_id','download_count'];

    public function Articles()
    {
        return $this->belongsTo(Articles::class);
    }
}