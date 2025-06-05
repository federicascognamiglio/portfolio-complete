<?php

namespace App;

enum CategoryEnum: string
{
    case GRAPHIC_DESIGN = 'Graphic Design';
    case SOCIAL_MEDIA = 'Social Media';
    case PHOTOGRAPHY = 'Photography';
    case THREE_D = '3D';
    case MOTION_GRAPHICS = 'Motion Graphics';

    public function description(): string
    {
        return match ($this) {
            self::GRAPHIC_DESIGN => 'Visual design, branding, and layout projects.',
            self::SOCIAL_MEDIA => 'Content tailored for social media platforms.',
            self::PHOTOGRAPHY => 'Photography-based content and editing.',
            self::THREE_D => '3D modeling, rendering, and sculpting.',
            self::MOTION_GRAPHICS => 'Animated visual effects and transitions.',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::GRAPHIC_DESIGN => 'Graphic Design',
            self::SOCIAL_MEDIA => 'Social Media',
            self::PHOTOGRAPHY => 'Photography',
            self::THREE_D => '3D',
            self::MOTION_GRAPHICS => 'Motion Graphics',
        };
    }

    public function categoryId(): int
    {
        return match ($this) {
            self::GRAPHIC_DESIGN => 1,
            self::SOCIAL_MEDIA => 2,
            self::PHOTOGRAPHY => 3,
            self::THREE_D => 4,
            self::MOTION_GRAPHICS => 5,
        };
    }
}