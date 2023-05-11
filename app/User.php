<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id', 'userid'];
    protected $primaryKey = 'userid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'userid';
    }
}
