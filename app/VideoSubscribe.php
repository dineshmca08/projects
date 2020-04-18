<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VideoSubscribe extends Model
{
    use SoftDeletes;

    public function usersubscribe()
    {
    	return $this->belongsTo("App\Video", "videos_id","id");
    }

    public function user()
    {
    	return $this->belongsTo("App\User", "user_id","id");
    }
}
