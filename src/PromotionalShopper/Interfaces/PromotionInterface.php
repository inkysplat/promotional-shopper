<?php

namespace src\PromotionalShopper\Interfaces;

use src\PromotionalShopper\Models\Order;

/**
 * Interface PromotionInterface
 * @package src\PromotionalShopper\Interfaces\Services\Promotions
 */
interface PromotionInterface
{
    /**
     * Add a Order to this Promotion Interface
     * @param Order $order
     * @return mixed
     */
    public function setOrder(Order &$order);

    /**
     * Description of the Promotion
     * @return mixed
     */
    public function getDescription();

    /**
     * Returns our price for this given promotion
     * @return mixed
     */
    public function getPrice();

    /**
     * Returns our discount for this given promotion
     * @return mixed
     */
    public function getDiscount();
}