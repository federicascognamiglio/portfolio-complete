<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Type;
use App\Models\Media;
use App\Models\Tag;
use App\Models\Tool;
use App\ProjectStatus;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $casts = [
        'status' => ProjectStatus::class,
    ];

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'cover_image',
        'client',
        'description',
        'category_id',
        'type_id',
        'status',
        'start_date',
        'end_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'project_tool');
    }

    public static function generateUniqueSlug($title) 
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $i = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
