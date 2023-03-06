<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'miner_username',
        'price',
        'size',
        'live_id',
        'process_id',
    ];

    protected $guarded = ['id'];
    public function live(){
        return $this->belongsTo(Live::class);
    }

    public function process(){
        return $this->belongsTo(Process::class);
    }
}
