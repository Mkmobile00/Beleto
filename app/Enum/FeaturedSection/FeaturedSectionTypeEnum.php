<?php
namespace App\Enum\FeaturedSection;

enum FeaturedSectionTypeEnum:int{
    case CATEGORY=1;
    case TVSERIES=2;
    case WEBSERIES=3;
    case MOVIES=4;
}