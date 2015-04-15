<?php

namespace src\PromotionalShoppper\Services\Promotions;

use src\PromotionalShopper\Interfaces\PromotionInterface;
use src\PromotionalShopper\Models\Order;

/**
 * Class ThreeForTwo
 * @package src\PromotionalShoppper\Services\Promotions
 */
class ThreeForTwo implements PromotionInterface
{
    /**
     * The Order
     * @var Order
     */
    private $order;

    /**
     * The Price of the Order
     * @var float
     */
    private $price = 0.00;

    /**
     * The Money Taken off the Order!
     * @var float
     */
    private $discount = 0.00;

    /**
     * Returns What the Promotion is!
     * @return string
     */
    public function getDescription()
    {
        return "3 for the price of 2";
    }

    /**
     * Sets the Order to Apply the Promotion to.
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;

        //pointless processing orders under 3 items
        if ($this->order->getProductCount() < 3) {
            $this->price = $this->order->getPrice();
            return;
        }

        //lets sort the products by their prices
        $products = [];
        foreach ($this->order->getProducts() as $product) {
            $products[$product->getPrice()] = $product;
        }
        ksort($products);

        //now lets find how many 3's we have...
        $numberOfThrees = floor($this->order->getProductCount() / 3);

        $discounted = array_slice($products, 0, $numberOfThrees);
        //give us the price of all the remaining items
        foreach ($discounted as $product) {
            $this->discount += $product->getPrice();
        }

        $products = array_slice($products, $numberOfThrees);
        //give us the price of all the remaining items
        foreach ($products as $product) {
            $this->price += $product->getPrice();
        }
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Will Return the Price
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}