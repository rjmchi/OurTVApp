<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $guarded=[];

     protected function casts(): array
    {
        return [
            'use_vpn' => 'boolean',
        ];
    }
}

