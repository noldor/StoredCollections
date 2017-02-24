<?php
declare(strict_types=1);
namespace Noldors\CommerceElements\Tests;

use Noldors\CommerceElements\DataResolvers\CookiesResolver;
use Noldors\CommerceElements\DataResolvers\SessionResolver;
use Noldors\CommerceElements\Exceptions\UnsupportedStorageException;
use Noldors\CommerceElements\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @covers Factory
 */
final class FactoryTest extends TestCase
{
    public function testCanCreateCollectionFromSession()
    {
        $this->assertInstanceOf(SessionResolver::class, Factory::create(Factory::SESSION, 'cart'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testCanCreateCollectionFromCookies()
    {
        $this->assertInstanceOf(CookiesResolver::class, Factory::create(Factory::COOKIES, 'cart'));
    }

    public function testCouldNotCreateCollectionFromDatabase()
    {
        $this->assertFalse(Factory::create(Factory::DATABASE, 'cart'));
    }

    public function testUnsupportedResolverType()
    {
        $this->expectException(UnsupportedStorageException::class);
        Factory::create(5, 'cart');
    }
}