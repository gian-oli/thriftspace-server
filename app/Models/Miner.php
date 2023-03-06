<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miner extends Model
{
    use HasFactory;

    protected $fillable = [
        'miner_username',
        'miner_real_name',
        'miner_address'
    ];

    protected $guarded = ['id'];
}
