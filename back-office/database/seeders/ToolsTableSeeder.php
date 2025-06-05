<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            ['name' => 'Adobe After Effects', 'description' => 'A digital visual effects, motion graphics, and compositing application developed by Adobe Systems', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/Adobe_After_Effects_CC_icon.svg/1200px-Adobe_After_Effects_CC_icon.svg.png'],
            ['name' => 'Adobe Premiere Pro', 'description' => 'A timeline-based video editing software application developed by Adobe Systems', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Adobe_Premiere_Pro_CC_icon.svg/1200px-Adobe_Premiere_Pro_CC_icon.svg.png'],
            ['name' => 'Adobe Photoshop', 'description' => 'A raster graphics editor developed and published by Adobe Inc.' , 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Adobe_Photoshop_2021_icon.svg/1200px-Adobe_Photoshop_2021_icon.svg.png'],
            ['name' => 'Adobe Illustrator', 'description' => 'A vector graphics editor and design program developed by Adobe Inc.', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Adobe_Illustrator_CC_icon.svg/1200px-Adobe_Illustrator_CC_icon.svg.png'],
            ['name' => 'Adobe InDesign', 'description' => 'A desktop publishing software application produced by Adobe Systems', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Adobe_InDesign_CC_icon.svg/1200px-Adobe_InDesign_CC_icon.svg.png'],
            ['name' => 'Adobe XD', 'description' => 'A vector-based user experience design tool for web apps and mobile apps', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Adobe_XD_CC_icon.svg/1200px-Adobe_XD_CC_icon.svg.png'],
            ['name' => 'Adobe Lightroom', 'description' => 'A family of image organization and image manipulation software', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Adobe_Lightroom_Classic_CC_icon.svg/1200px-Adobe_Lightroom_Classic_CC_icon.svg.png'],
            ['name' => 'Final Cut Pro', 'description' => 'A non-linear video editing software program developed by Apple Inc.', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/c/c1/Final_Cut_Pro_X_logo.svg/1200px-Final_Cut_Pro_X_logo.svg.png'],
            ['name' => 'DaVinci Resolve Studio', 'description' => 'A color correction and non-linear video editing software application', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/d/d5/Davinci_Resolve_Studio_logo.png/1200px-Davinci_Resolve_Studio_logo.png'],
            ['name' => 'DaVinci Resolve', 'description' => 'A color correction and non-linear video editing software application', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/d/d5/Davinci_Resolve_Studio_logo.png/1200px-Davinci_Resolve_Studio_logo.png'],
            ['name' => 'Cinema 4D', 'description' => 'A 3D modeling, animation, motion graphic, and rendering application developed by Maxon', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e7/Cinema_4D_logo.svg/1200px-Cinema_4D_logo.svg.png'],
            ['name' => 'Blender', 'description' => 'An open-source 3D computer graphics software toolset used for creating animated films, visual effects, art, 3D games, and more', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Blender_Logo.svg/1200px-Blender_Logo.svg.png'],
            ['name' => 'Figma', 'description' => 'A web-based app that allows users to design, prototype, and collaborate on user interface designs', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e6/Figma-logo.svg/1200px-Figma-logo.svg.png'],
            ['name' => 'Procreate', 'description' => 'A raster graphics editor app for digital painting, created and published by Savage Interactive', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Procreate_Logo.png/1200px-Procreate_Logo.png'],
        ];

        foreach ($tools as $tool) {
            Tool::updateOrCreate(
                [ 'name' => $tool['name'] ],
                [
                    'description' => $tool['description'],
                    'logo_url' => $tool['logo_url'],
                ]
            );
        }
    }
}