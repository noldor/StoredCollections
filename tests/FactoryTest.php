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
        $this->assertInstanceOf(SessionResolver::class, (new Factory)->create(SessionResolver::class, 'cart'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testCanCreateCollectionFromCookies()
    {
        $this->assertInstanceOf(CookiesResolver::class, (new Factory)->create(CookiesResolver::class, 'cart'));
    }

    public function testUnsupportedResolverType()
    {
        $this->expectException(UnsupportedStorageException::class);
        (new Factory)->create(UnsupportedStorage::class, 'cart');
    }
}