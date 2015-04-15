<?php
/**
 * Include all our code...
 */
define('ROOT_PATH', realpath(dirname(__FILE__)). DIRECTORY_SEPARATOR);
define('OUTPUT_PATH', ROOT_PATH . 'data/output/');

require_once ROOT_PATH . 'vendor/autoload.php';

//if I had time I'd write a AutoLoader... c'est la vie!
require_once ROOT_PATH . 'src/PromotionalShopper/Helpers/FileHelper.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Helpers/XmlParser.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Models/Order.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Models/Category.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Models/Product.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Interfaces/PromotionInterface.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Services/Promotions/ThreeForTwo.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Services/Promotions/HalfPriceHairCombo.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Services/PromotionFactory.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Commands/PromoCommand.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Application.php';

$app = new \src\PromotionalShopper\Application();
$app->add(new \src\PromotionalShopper\Commands\PromoCommand());
$app->run();