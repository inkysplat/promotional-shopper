<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 16/04/15
 * Time: 00:02
 */

namespace src\PromotionalShoppper\Services\Promotions;

use src\PromotionalShopper\Interfaces\PromotionInterface;
use src\PromotionalShopper\Models\Order;

/**
 * Class HalfPriceHairCombo
 * @package src\PromotionalShoppper\Services\Promotions
 */
class HalfPriceHairCombo implements PromotionInterface
{
    /**
     * @const String
     */
    const CATEGORY_SHAMPOO = 'Shampoo';

    /**
     * @const String
     */
    const CATEGORY_CONDITIONER = 'Conditioner';

    /**
     * @var float
     */
    private $price = 0.00;

    /**
     * @var float
     */
    private $discount = 0.00;

    /**
     * @var Order
     */
    private $order;

    /**
     * Get Description for this Promotion
     * @return string
     */
    public function getDescription()
    {
        return "Buy Shampoo & get Conditioner for 50% off";
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order &$order)
    {
        $this->order = $order;

        $discountable = [
            self::CATEGORY_SHAMPOO => [],
            self::CATEGORY_CONDITIONER => []
        ];

        foreach ($this->order->getProducts() as $product) {
            if ($product->hasCategory(self::CATEGORY_SHAMPOO)) {
                $discountable[self::CATEGORY_SHAMPOO][] = $product;
            }
            elseif ($product->hasCategory(self::CATEGORY_CONDITIONER)) {
                $discountable[self::CATEGORY_CONDITIONER][] = $product;
            }
            else{
                $discountable['MISC'][] = $product;
            }
        }

        $this->price = $this->order->getPrice();

        if (count($discountable[self::CATEGORY_SHAMPOO]) >= count($discountable[self::CATEGORY_CONDITIONER])) {

            $this->price = 0.00;
            foreach($discountable as $key => $products) {
                foreach($products as $product){
                    if($key == self::CATEGORY_CONDITIONER){
                        $discount = ($product->getPrice() / 2);
                        $order->applyDiscount($product, $discount);
                        $this->price += $discount;
                    }else{
                        $this->price += $product->getPrice();
                    }
                }
            }
        }
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}