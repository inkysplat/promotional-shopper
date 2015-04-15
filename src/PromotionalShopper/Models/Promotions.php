<?php

namespace src\PromotionalShopper\Models;

/**
 * Class Promotions
 * @package src\PromotionalShopper\Models
 */
class Promotions
{

    /**
     * Lists the Promotions and their Codes
     * @var array
     */
    private $promos = [
        '3for2' => "3 for the price of 2",
        'HalfPriceShampoo' => "Buy Shampoo & get Conditioner 50% off"
    ];

    /**
     * Returns all the Promotions
     * @return array
     */
    public function getPromotions()
    {
        return $this->promos;
    }

    /**
     * Returns a Promotion
     * @param $code
     * @return mixed
     */
    public function getPromo($code)
    {
        if(isset($this->promos[$code]))
            return $this->promos[$code];

        return false;
    }
}