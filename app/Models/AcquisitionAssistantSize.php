<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AcquisitionAssistantSize extends Model
{
    use HasFactory, SoftDeletes;

    public function acquisition_assistants()
    {
        return $this->belongsTo(AcquisitionAssistant::class);
    }
    public static function booted()
    {
        // static::creating(function (self $user) {
        //     if (Auth::check()) {
        //         $user->created_by = Auth::user()->id;
        //     }
        // });

        static::updating(function (self $user) {
            if (Auth::check()) {
                $user->updated_by = Auth::user()->id;
            }
        });

    }

    protected $fillable = [
        'acquisition_assistant_id', // Add this line
        'survey_or_group',
        'number',
        'area',
    ];

}
