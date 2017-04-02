<?php
declare(strict_types=1);
namespace Noldors\CommerceElements\Tests;


use Noldors\Helpers\Collection;
use Noldors\CommerceElements\DataResolvers\SessionResolver;
use Noldors\CommerceElements\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @covers SessionResolver
 */
class SessionResolverTest extends TestCase
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var SessionResolver
     */
    protected $sessionCart;

    protected function setUp()
    {
        $_SESSION['cart'][12] = ['quantity' => 11, 'price' => 900];
        $this->sessionCart = (new Factory)->create(SessionResolver::class, 'cart');
        $this->collection = $this->sessionCart->collection();
    }

    public function testGetCollectionFromSession()
    {
        $this->assertEquals(
            [12 => ['quantity' => 11, 'price' => 900]],
            $this->collection->toArray()
        );
    }

    public function testAddToCollection()
    {
        $this->assertEquals(
            [
                12 => ['quantity' => 11, 'price' => 900],
                15 => ['quantity' => 15, 'price' => 100],
            ],
            $this->collection->add(15, ['quantity' => 15, 'price' => 100])->toArray()
        );
    }

    public function testDeleteElementFromCollection()
    {
        $this->assertEquals(
            [],
            $this->collection->remove(12)->toArray()
        );
    }

    public function testUpdateElementInCollection()
    {
        $this->assertEquals(
            [12 => ['quantity' => 3, 'price' => 300]],
            $this->collection->add(12, ['quantity' => 3, 'price' => 300])->toArray()
        );
    }

    public function testReturnCollection()
    {
        $this->assertInstanceOf(Collection::class, $this->collection);
    }

    public function testReturnArray()
    {
        $this->assertEquals(
            [12 => ['quantity' => 11, 'price' => 900]],
            $this->collection->toArray()
        );
    }

    public function testReturnAll()
    {
        $this->assertEquals(
            [
                12 => ['quantity' => 11, 'price' => 900],
                13 => ['quantity' => 12, 'class' => new Helper([1, 2])]
            ],
            $this->collection->add(13, ['quantity' => 12, 'class' => new Helper([1, 2])])->all()
        );
    }

    public function testReturnTotalByField()
    {
        $this->assertEquals(
            21,
            $this->collection->add(17, ['quantity' => 10])->summary(['quantity'])
        );
    }

    public function testAutoSaveCollectionToSession()
    {
        $this->collection->add(15, ['quantity' => 15, 'price' => 100]);
        $this->sessionCart->__destruct();

        $this->assertEquals(
            [
                12 => ['quantity' => 11, 'price' => 900],
                15 => ['quantity' => 15, 'price' => 100],
            ],
            $_SESSION['cart']
        );
    }
    
}