<?php

namespace Noldors\CommerceElements\DataResolvers;


use Illuminate\Support\Collection;
use Noldors\CommerceElements\Exceptions\CookiesAutoSaveException;
use Noldors\CommerceElements\Exceptions\CookieSaveException;

/**
 * There are some restrictions. Cookie can't be bigger, than 4kb, and you can't have more, than 20
 * cookies for domain, use this resolver at your own risk/
 */
class CookiesResolver extends Resolver
{
    /**
     * CookieResolver constructor.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->items = new Collection(isset($_COOKIE[$type]) ? json_decode($_COOKIE[$type],
            true) : []);
        $this->type = $type;
    }

    /**
     * Save collection to cookies, if auto save throw error.
     * @throws CookieSaveException
     */
    public function save()
    {
        try {
            setcookie(
                $this->type,
                json_encode($this->items),
                time() + 3600 * 24 * 365 * 10,
                $_SERVER['HTTP_HOST']
            );
        } catch (\Exception $exception) {
            throw new CookieSaveException($exception);
        }
    }

    /**
     * In this case, it save collection to session.
     */
    public function __destruct()
    {
        try {
            setcookie(
                $this->type,
                json_encode($this->items->toArray()),
                time() + 3600 * 24 * 365 * 10,
                $_SERVER['HTTP_HOST']
            );
        } catch (\Exception $exception) {
            throw new CookiesAutoSaveException('Cannot modify header information - headers already sent. You should save cookie manually by using save() method after collection update.');
        }
    }
}