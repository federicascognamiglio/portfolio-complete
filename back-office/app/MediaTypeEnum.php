<?php

namespace App;

enum MediaTypeEnum: string
{
    case IMAGE = 'IMAGE';
    case VIDEO = 'VIDEO';
    case GIF = 'GIF';

    public function label(): string
    {
        return match ($this) {
            self::IMAGE => 'Image File',
            self::VIDEO => 'Video File',
            self::GIF => 'Gif File',
        };
    }
}
