<?php

namespace Noldors\CommerceElements;


use Noldors\CommerceElements\DataResolvers\CookiesResolver;
use Noldors\CommerceElements\DataResolvers\SessionResolver;
use Noldors\CommerceElements\Exceptions\UnsupportedStorageException;

class Factory
{
    const SESSION = 1;
    const COOKIES = 2;
    const DATABASE = 3;

    private function __construct()
    {
    }

    public static function create(int $from, string $type)
    {
        switch ($from) {
            case self::SESSION:
                return new SessionResolver($type);
                break;
            case self::COOKIES:
                return new CookiesResolver($type);
                break;
            case self::DATABASE:
                return false;
                break;
            default:
                throw new UnsupportedStorageException();
                break;
        }
    }

}