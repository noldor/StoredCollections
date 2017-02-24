<?php

namespace Noldors\CommerceElements\Tests;


use Noldors\CommerceElements\DataResolvers\CookiesResolver;
use Noldors\CommerceElements\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @covers CookiesResolver
 */
class CookieResolverTest extends TestCase
{
    /**
     * @var CookiesResolver
     */
    protected $collection;

    protected function setUp()
    {
        //$_COOKIE['cart'] = '%7B%2212%22%3A%7B%22quantity%22%3A11%2C%22price%22%3A900%7D%7D';
    }

    /**
     * TODO: need to test cookies resolver/
     */
    public function testGetCollectionFromCookies()
    {
        /*$this->collection = (new Factory)->create(CookiesResolver::class, 'cart');

        $this->assertEquals(
            [12 => ['quantity' => 11, 'price' => 900]],
            $this->collection->toArray()
        );*/
    }
}