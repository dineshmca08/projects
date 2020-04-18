<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Video extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo("App\Category", "category_id","id");
    }
    public function videocategory()
    {
        return $this->belongsTo("App\VideoCategory", "category_type","id");
    }
}
