<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
