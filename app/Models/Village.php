<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Village extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'taluka_id','village_name', 'created_by', 'updated_by', 'deleted_by'];

    public $timestamps = true;

    public static function booted()
    {
        static::creating(function (self $village) {
            if (Auth::check()) {
                $village->created_by = Auth::user()->id;
            }
        });

        static::updating(function (self $village) {
            if (Auth::check()) {
                $village->updated_by = Auth::user()->id;
            }
        });

        static::deleting(function (self $village) {
            if (Auth::check()) {
                $village->deleted_by = Auth::user()->id;
                $village->save(); // Save the changes to the deleted_by field
            }
        });
    }
}
