<?php

namespace ACA\ShopBundle\Shop;

/**
 * This class is responsible for instantiating objects for us
 * Class ShopFactory
 *
 * @package ACA\ShopBundle\Util
 */
class Factory
{
    /**
     * @var DBCommon
     */
    protected $db;

    /**
     * @param DBCommon $db Database connection injected via service container
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Get all products
     *
     * @return Product[]
     */
    public function getAllProducts()
    {
        /** @var Product[] $Products */
        $Products = [];

        $query = 'select product_id from aca_product';

        $this->db->setQuery($query);

        $productIdRows = $this->db->loadObjectList();

        foreach ($productIdRows as $productIdRow) {

            $Product = new Product($productIdRow->product_id);
            $Product->setDb($this->db);
            $Product->load();

            array_push($Products, $Product);
        }
        return $Products;
    }

    /**
     * @param array $cartItems Array containing productIds and quantity for each item in the cart
     *
     * @return Product[]
     */
    public function getSomeProducts($cartItems)
    {
        $productIds = array();

        // Extract productIds from the $cartItems array
        foreach($cartItems as $cartItem){
            $productIds[] = $cartItem['productId'];
        }

        /** @var Product[] $Products */
        $Products = [];

        $query = 'select product_id from aca_product where product_id in(' . implode(',', $productIds) . ')';

        $this->db->setQuery($query);

        $productIdRows = $this->db->loadObjectList();

        foreach ($productIdRows as $productIdRow) {

            $Product = new Product($productIdRow->product_id);
            $Product->setDb($this->db);
            $Product->load();

            array_push($Products, $Product);
        }
        return $Products;
    }
}
