<?php

namespace App\Models;

use App\TypeEnum;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $casts = [
        'name' => TypeEnum::class,
    ];

    protected $fillable = ['name', 'category_id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
