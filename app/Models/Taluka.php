<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Taluka extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'district_id','taluka_name', 'created_by', 'updated_by', 'deleted_by'];

    public $timestamps = true;

    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public static function booted()
    {
        static::creating(function (self $taluka) {
            if (Auth::check()) {
                $taluka->created_by = Auth::user()->id;
            }
        });

        static::updating(function (self $taluka) {
            if (Auth::check()) {
                $taluka->updated_by = Auth::user()->id;
            }
        });

        static::deleting(function (self $taluka) {
            if (Auth::check()) {
                $taluka->deleted_by = Auth::user()->id;
                $taluka->save(); // Save the changes to the deleted_by field
            }
        });
    }
}


