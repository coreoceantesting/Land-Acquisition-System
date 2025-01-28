<?php

namespace App\Models;

use App\Http\Controllers\Admin\Masters\LandAcquisitionController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AcquisitionAssistant extends BaseModel
{
    use HasFactory , SoftDeletes;
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

    // Define the year relationship
    public function year()
    {
        return $this->belongsTo(Year::class); // Adjust to your actual model
    }

    // Define the land_acquisition relationship
    public function land_acquisition()
    {
        return $this->belongsTo(Land_Acquisition::class); // Adjust to your actual model
    }

    public function sr_no()
    {
        return $this->belongsTo(Srno::class); // Adjust to your actual model
    }

    protected $table = 'acquisition_assistants';
    protected $fillable = [
        'district_id',
        'taluka_id',
        'village_id',
        'sr_no_id',
        'land_acquisition_id',
        'project_name',
        'year_id',
        'acquisition_board_name',
        'description',
        'designation',
        'acquisition_proposal',
        'law',
        'acquisition_assistant_id',
        'divisional_officer_status',
        'divisional_officer_remark',
        'acquisition_officer_status',
        'acquisition_officer_remark',
    ];
    public $timestamps = true;


    public function acquisitionAssistantSizes()
    {
        return $this->hasMany(AcquisitionAssistantSize::class);
    }

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
