<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
    ];

    protected $guarded = ['id'];

    // public function itemDetails(){
    //     return $this->belongsTo(ItemDetail::class, 'live_id');
    // }
}
