<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AcquisitionRegister extends Model
{
    use HasFactory ,SoftDeletes;
    public function district()
    {
        return $this->belongsTo(District::class); // Adjust to your actual model if it's different
    }

    // Define the taluka relationship
    public function taluka()
    {
        return $this->belongsTo(Taluka::class); // Adjust to your actual model
    }

    // Define the village relationship
    public function village()
    {
        return $this->belongsTo(Village::class); // Adjust to your actual model
    }
    public function land_acquisition()
    {
        return $this->belongsTo(Land_Acquisition::class, 'land_acquisition_id');
    }

    protected $table = 'acquisition_registers';
    protected $fillable = [
        'district_id',
        'taluka_id',
        'village_id',
        'sr_no',
        'land_acquisition_id',
         'bundle',
    ];

    public static function booted()
    {
        static::creating(function (self $user) {
            if (Auth::check()) {
                $user->created_by = Auth::user()->id;
            }
        });

        static::updating(function (self $user) {
            if (Auth::check()) {
                $user->updated_by = Auth::user()->id;
            }
        });

    }
}
