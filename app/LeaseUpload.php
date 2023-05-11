<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseUpload extends Model
{
    protected $guarded = ['id', 'leaseuploadid'];
    protected $primaryKey = 'leaseuploadid';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'leaseuploadid';
    }
}
