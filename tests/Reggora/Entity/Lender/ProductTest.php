<?php

namespace Test\Reggora\Entity\Lender;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Lender\Product;

/**
 * Class ProductTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Lender\Product
 */
final class ProductTest extends TestCase
{
    /**
     * @covers \Reggora\Entity\Lender\Product::all
     */
    public function testAll(): void
    {
        $all = Product::all();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $all);
        $this->assertNotEmpty($all->toArray());
    }

    /**
     * @covers \Reggora\Entity\Lender\Product::find
     */
    public function testFind(): void
    {
        $product = Product::create([
            'product_name' => 'My Sample Product ' . uniqid(),
            'amount' => 5000,
            'inspection_type' => 'interior',
        ]);

        $this->assertNotNull($product);

        $foundProduct = Product::find($product->id);
        $this->assertNotNull($foundProduct);
        $this->assertEquals($foundProduct->id, $product->id);
    }

    /**
     * @covers \Reggora\Entity\Lender\Product::create
     */
    public function testCreate(): void
    {
        $product = Product::create([
            'product_name' => 'My Sample Product ' . uniqid(),
            'amount' => 5000,
            'inspection_type' => 'interior',
        ]);

        $this->assertNotNull($product);
    }

    /**
     * @covers \Reggora\Entity\Lender\Product::delete
     */
    public function testDelete(): void
    {
        $product = Product::create([
            'product_name' => 'My Sample Product ' . uniqid(),
            'amount' => 5000,
            'inspection_type' => 'interior',
        ]);
        
        $this->assertNotNull($product);

        $product->delete();

        $foundProduct = Product::find($product->id);
        $this->assertNull($foundProduct);
    }

    /**
     * @covers \Reggora\Entity\Lender\Product::save
     */
    public function testSave(): void
    {
        $product = Product::create([
            'product_name' => 'My Sample Product ' . uniqid(),
            'amount' => 5000,
            'inspection_type' => 'interior',
        ]);

        $this->assertNotNull($product);

        $product->product_name = 'My New Product Name';
        $product->amount = 10000;
        $product->save();

        $foundProduct = Product::find($product->id);
        $this->assertNotNull($foundProduct);

        $this->assertEquals($foundProduct->product_name, $product->product_name);
    }
}
