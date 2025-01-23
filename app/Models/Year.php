<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Year extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'years';

    protected $fillable = ['year'];


    public static function booted()
    {
        static::created(function (self $year)
        {
            if(Auth::check())
            {
                self::where('id', $year->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (self $year)
        {
            if(Auth::check())
            {
                self::where('id', $year->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (self $year)
        {
            if(Auth::check())
            {
                self::where('id', $year->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
