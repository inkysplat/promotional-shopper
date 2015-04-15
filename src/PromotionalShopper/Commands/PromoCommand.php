<?php

namespace src\PromotionalShopper\Commands;

use src\PromotionalShopper\Helpers\FileHelper;
use src\PromotionalShopper\Helpers\XmlParser;
use src\PromotionalShopper\Models\Category;
use src\PromotionalShopper\Models\Order;
use src\PromotionalShopper\Models\Product;
use src\PromotionalShopper\Models\Promotions;
use src\PromotionalShopper\Services\PromotionFactory;
use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PromoCommand
 * @package src\PromotionalShopper\Commands
 */
class PromoCommand extends Command
{
    /**
     * Configures our Command's input and interfaces
     */
    protected function configure()
    {
        $this
            ->setName('promotional:shopper')
            ->setDescription('Parses XML feed for a promotions')
            ->addOption(
                'promotion',
                null,
                InputOption::VALUE_OPTIONAL,
                'Promotion to be used for this product feed'
            )
            ->addOption(
                'file',
                null,
                InputOption::VALUE_REQUIRED,
                'Path to XML product file'
            )
        ;
    }

    /**
     * Our main execute method for this Command... where the magic happens.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getOption('file');
        if(trim($filename) == ''){
            throw new \Exception("Missing File Parameter.");
        }

        $output->writeln("Reading file...".$filename);
        $file = FileHelper::getFile($filename);
        $products = XmlParser::parse($file, true);

        $promotion = false;

        $promo = $input->getOption('promotion');
        if($promo && trim($promo) != ''){
            $output->writeln("Using promotion ".$promo);
            $promotion = PromotionFactory::create($promo);
            $output->writeln("Promotion is '".$promotion->getDescription()."''");
        }

        $order = new Order();

        if($promotion){
            $output->writeln("Setting promotion...");
            $order->setPromotion($promotion);
        }

        foreach ($products['products']['product'] as $prod) {

            $category = new Category($prod['category']);

            $output->writeln("Creating category '".$category->getName()."''");

            $output->writeln("Creating product...");

            $product = new Product();
            $product->addCategory($category);
            $product->setTitle($prod['@attributes']['title']);
            $product->setPrice($prod['@attributes']['price']);

            $output->writeln("With name '".$product->getTitle()."''");
            $output->writeln("With price '".$product->getPrice()."''");

            $order->addProduct($product);
        }

        $output->writeln("Order has ".$order->getProductCount()." products");

        $price = $order->getPrice();
        $output->writeln("Price of order (including promotion); ".$price);

        $products['total'] = $price;

        $filename = basename($filename);
        $filename = OUTPUT_PATH . $filename;

        $output->writeln("Writing new price to XML file");
        $output->writeln("Saving to '".$filename."''");

        XmlParser::save($products, $filename);
    }

}