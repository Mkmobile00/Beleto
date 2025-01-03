<?php
namespace App\Enum\Star;

enum StarTypeEnum:string{
    case ACTOR='1';
    case DIRECTOR='2';
    case WRITER='3';
    case CINEMATOGRAPER='4';
    case EDITOR='5';
    case MUSIC='6';
    case PRODUCER='7';
}