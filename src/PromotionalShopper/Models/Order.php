<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 15/04/15
 * Time: 22:55
 */

namespace src\PromotionalShopper\Models;
use src\PromotionalShopper\Interfaces\PromotionInterface;

/**
 * Class Order
 * @package src\PromotionalShopper\Models
 */
class Order
{
    /**
     * List of Products
     * @var array
     */
    private $products = [];

    /**
     * @var float
     */
    private $price = 0.00;

    /**
     * @var PromotionInterface
     */
    private $promotion;

    /**
     * Add a Product to this Order.
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        $this->price += $product->getPrice();
        if($this->hasPromotion()){
            $this->applyPromotion();
        }
    }

    /**
     * Returns number of Products
     * @return int
     */
    public function getProductCount()
    {
        return count($this->products);
    }

    /**
     * Returns a list of Products
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Returns the Price
     * @return float
     */
    public function getPrice()
    {
        if($this->hasPromotion())
            return $this->promotion->getPrice();
        return $this->price;
    }

    /**
     * Returns whether an Promotion is on this order
     * @return bool
     */
    public function hasPromotion()
    {
        if($this->promotion instanceof PromotionInterface){
            return true;
        }
        return false;
    }

    /**
     * Will Set the Promotion to be used on this Order
     * @param PromotionInterface $promotion
     */
    public function setPromotion(PromotionInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * Applies a Promotion to this Order
     */
    public function applyPromotion()
    {
        $this->promotion->setOrder($this);
    }
}