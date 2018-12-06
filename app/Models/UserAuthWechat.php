<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuthWechat extends Model
{
    protected $guarded = [];
    protected $table="user_auth_wechat";
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param $openId
     * @return Model|null|object
     */
    public function getByOpenId($openId)
    {
        return $this->where('open_id', $openId)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
