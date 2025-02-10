<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Village extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['district_id', 'taluka_id', 'village_name', 'village_init', 'created_by', 'updated_by', 'deleted_by'];

    public $timestamps = true;


    public function taluka()
    {
        return $this->belongsTo(Taluka::class, 'taluka_id', 'id');
    }
    
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
