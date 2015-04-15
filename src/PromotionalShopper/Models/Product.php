<?php

namespace src\PromotionalShopper\Models;

/**
 * Class Product
 * @package src\PromotionalShopper\Models
 */
class Product
{

    /**
     * @var string
     */
    private $title = '';

    /**
     * Price of the Product
     * @var float
     */
    private $price = 0.00;

    /**
     * @var array
     */
    private $categories = [];

    /**
     * @var float
     */
    private $discount = 0.00;

    /**
     * Set the Product Title
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the Product Title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the Price
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Gets the Price
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Adds a Category to this Product
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories[$category->getName()] = $category;
    }

    /**
     * Returns all the Categories
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Whether a Category exists for this product
     * @param string $category
     * @return bool
     */
    public function hasCategory($category)
    {
        return isset($this->categories[$category]) ? true : false;
    }

    /**
     * Sets any discount amount on this product
     * @param $amount
     */
    public function setDiscount($amount){
        $this->discount = $amount;
    }

    /**
     * Gets any discount amount on this product
     * @return float
     */
    public function getDiscount(){
        return $this->discount;
    }
}