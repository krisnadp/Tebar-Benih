<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project_category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function project_status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }
}
