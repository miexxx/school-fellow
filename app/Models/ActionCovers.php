<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:22
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Tanmo\Search\Traits\Search;
class ActionCovers extends Model
{
    use Search;
    protected $guarded=[];

    public function action(){
        return $this->belongsTo(Actions::class);
    }

    public function getPathAttribute($key)
    {
        return Storage::disk('public')->url($key);
    }
}