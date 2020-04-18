<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserVideoLike extends Model
{
    use SoftDeletes;
    public function usersubscribe()
    {
    	return $this->belongsTo("App\Video", "videos_id","id");
    }
}
