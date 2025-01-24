<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcquisitionAssistantSize extends Model
{
    use HasFactory, SoftDeletes;

    public function acquisition_assistants()
    {
        return $this->belongsTo(AcquisitionAssistant::class);
    }

    protected $fillable = [
        'acquisition_assistant_id', // Add this line
        'survey_or_group',
        'number',
        'area',
    ];

}
