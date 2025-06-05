<?php

namespace App\Models;

use App\CategoryEnum;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    protected $casts = [
        'name' => CategoryEnum::class,
    ];
    
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
