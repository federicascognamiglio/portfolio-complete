<?php

namespace App;

enum TypeEnum: string
{
    case EDITORIAL = 'Editorial';
    case BRAND_IDENTITY = 'Brand Identity';
    case PACKAGING = 'Packaging';
    case INSTAGRAM = 'Instagram';
    case TIK_TOK = 'TikTok';
    case YOUTUBE = 'YouTube';
    case LINKEDIN = 'LinkedIn';
    case PRODUCT = 'Product';
    case ANALOGICAL = 'Analogical';
    case CONCEPTUAL = 'Conceptual';
    case THREE_D_MODELING = '3D Modeling';
    case THREE_D_ANIMATION = '3D Animation';
    case TWO_D_ANIMATION = '2D Animation';
    case INFOGRAPHICS = 'Infographics';
    case GIFS = 'GIFs';



    public function categoryId(): int
    {
        return match ($this) {
            // Categoria: "Graphic Design"
            self::EDITORIAL, self::BRAND_IDENTITY, self::PACKAGING  => 1,
            // Categoria: "Social Media"
            self::INSTAGRAM, self::TIK_TOK, self::YOUTUBE, self::LINKEDIN => 2,
            // Categoria: "Photography"
            self::PRODUCT, self::ANALOGICAL, self::CONCEPTUAL => 3,
            // Categoria: "3D"
            self::THREE_D_MODELING, self::THREE_D_ANIMATION => 4,
            // Categoria: "Motion Graphics"
            self::TWO_D_ANIMATION, self::INFOGRAPHICS, self::GIFS => 5,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::EDITORIAL => 'Editorial',
            self::BRAND_IDENTITY => 'Brand Identity',
            self::PACKAGING => 'Packaging',
            self::INSTAGRAM => 'Instagram',
            self::TIK_TOK => 'TikTok',
            self::YOUTUBE => 'YouTube',
            self::LINKEDIN => 'LinkedIn',
            self::PRODUCT => 'Product',
            self::ANALOGICAL => 'Analogical',
            self::CONCEPTUAL => 'Conceptual',
            self::THREE_D_MODELING => '3D Modeling',
            self::THREE_D_ANIMATION => '3D Animation',
            self::TWO_D_ANIMATION => '2D Animation',
            self::INFOGRAPHICS => 'Infographics',
            self::GIFS => 'GIFs',
        };
    }

    public function typeId(): int
    {
        return match ($this) {
            self::EDITORIAL => 1,
            self::BRAND_IDENTITY => 2,
            self::PACKAGING => 3,
            self::INSTAGRAM => 4,
            self::TIK_TOK => 5,
            self::YOUTUBE => 6,
            self::LINKEDIN => 7,
            self::PRODUCT => 8,
            self::ANALOGICAL => 9,
            self::CONCEPTUAL => 10,
            self::THREE_D_MODELING => 11,
            self::THREE_D_ANIMATION => 12,
            self::TWO_D_ANIMATION => 13,
            self::INFOGRAPHICS => 14,
            self::GIFS => 15,
        };
    }
}