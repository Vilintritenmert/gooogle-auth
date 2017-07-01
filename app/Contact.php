<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @package App
 */
class Contact extends Model
{
    /**
     * Mass fillable
     *
     * @var array
     */
    public $fillable = ['user_id','data'];

    /**
     * Relationship with User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
       return $this->belongsTo(User::class);
    }

    /**
     * Turn off created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;
}
