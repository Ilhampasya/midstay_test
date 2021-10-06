<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'location',
        'neighborhood_id'
    ];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
