<?php
namespace ACA\ShopBundle\Shop;

use ACA\ShopBundle\Util\ShopFactory;

class Product
{
    /**
     * Unique numeric product identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Name of this product
     *
     * @var string
     */
    protected $name;

    /**
     * Category this product is in
     *
     * @var string
     */
    protected $category;

    /**
     * Price
     *
     * @var float
     */
    protected $price;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Load one product from the database
     */
    public function load()
    {

        $db = ShopFactory::getDB();
        print_r($db);
    }
}