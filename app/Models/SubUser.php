<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUser extends Model
{
    use HasFactory;

    protected $fillable = ['officer_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
