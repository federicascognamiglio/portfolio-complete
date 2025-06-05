<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['name', 'description', 'logo_url'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tool');
    }
}