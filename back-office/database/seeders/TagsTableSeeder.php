<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => '2D', 'color' => '#FF6F61'],
            ['name' => '3D', 'color' => '#6B5B95'],
            ['name' => 'Animation', 'color' => '#88B04B'],
            ['name' => 'Video Editing', 'color' => '#F7CAC9'],
            ['name' => 'Motion Graphics', 'color' => '#92A8D1'],
            ['name' => 'Photography', 'color' => '#955251'],
            ['name' => 'Post-Production', 'color' => '#B565A7'],
            ['name' => 'Video Production', 'color' => '#009B77'],
            ['name' => 'Graphic Design', 'color' => '#E7B10A'],
            ['name' => 'Content Creation', 'color' => '#F7CAC9'],
            ['name' => 'Visual Effects', 'color' => '#92A8D1'],
            ['name' => 'Illustration', 'color' => '#EFC050'],
            ['name' => 'Social Media Content', 'color' => '#5B5EA6'],
            ['name' => 'Branding', 'color' => '#DFCFBE'],
            ['name' => 'Visual Storytelling', 'color' => '#BC243C'],
            ['name' => 'Infographics', 'color' => '#98B4D4'],
            ['name' => 'Instagram Stories', 'color' => '#F7786B'],
            ['name' => 'Instagram Carousel', 'color' => '#D3C0CD'],
            ['name' => 'YouTube Videos', 'color' => '#F6D55C'],
            ['name' => 'LinkedIn Posts', 'color' => '#3A5A98'],
            ['name' => 'TikTok Ads', 'color' => '#FF6F61'],
            ['name' => 'TikTok Videos', 'color' => '#6C4F3D'],
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(
                [ 'name' => $tag['name'] ],
                [ 'color' => $tag['color'] ]
            );
        }
    }
}