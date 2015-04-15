<?php

namespace src\PromotionalShopper\Models;

/**
 * Class Category
 * @package src\PromotionalShopper\Models
 */
class Category
{

    /**
     * @var string
     */
    private $category = '';

    /**
     * Create a new Category
     * @param $category
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Get the Category Name
     * @return string
     */
    public function getName()
    {
        return $this->category;
    }
}