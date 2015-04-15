<?php
/**
 * Include all our code...
 */
define('ROOT_PATH', realpath(dirname(__FILE__)). DIRECTORY_SEPARATOR);

require_once ROOT_PATH . 'vendor/autoload.php';

//if I had time I'd write a AutoLoader... c'est la vie!
require_once ROOT_PATH . 'src/PromotionalShopper/Models/Promotions.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Services/XmlParser.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Commands/PromoCommand.php';
require_once ROOT_PATH . 'src/PromotionalShopper/Application.php';

$app = new \src\PromotionalShopper\Application();
$app->add(new \src\PromotionalShopper\Commands\PromoCommand());
$app->run();