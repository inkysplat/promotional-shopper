<?php

namespace src\PromotionalShopper\Services;

/**
 * Class PromotionService
 * @package src\PromotionalShopper\Services
 */
class PromotionFactory
{
    /**
     * List of Promotions Available
     *
     * @static
     * @var array
     */
    private static $promotions = [
        "ThreeForTwo" => "3 for the price of 2",
        "HalfPriceHairCombo" => "Buy Shampoo And Get Condition 50% off"
    ];

    /**
     * Returns a Promotion
     *
     * @param string $promotion
     * @return mixed
     * @throws \Exception
     */
    public static function create($promotion)
    {
        if (!isset(self::$promotions[$promotion])) {
            throw new \Exception("Invalid Promotion.");
        }

        $namespace = "src\\PromotionalShoppper\\Services\\Promotions\\";
        $class = $namespace . $promotion;

        if(!class_exists($class)){
            throw new \Exception("Promotion Not Found.");
        }

        return new $class();
    }
}