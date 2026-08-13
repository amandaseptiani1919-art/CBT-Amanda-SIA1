<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    protected $table = 'migrations';

    protected $fillable = [
        'migration',
        'batch',
    ];

    public $timestamps = false;
}