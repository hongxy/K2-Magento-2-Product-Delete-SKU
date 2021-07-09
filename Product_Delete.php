<?php

/**
 * Deletes Products Based On Product SKU
 * Put the file in root folder where Magento is installed (/home/kitto/public_html/)
 * Tested on Magento 2.3.7
 * Author:- Basant Mandal | Kitto
 * https://www.techbasant.in
 * Last Updated - 05-July-2021
 */

/**
 * Step-1 Lets Performs essential initialization routines & create an Instance using bootstrap
 */

use Magento\Framework\App\Bootstrap;
use Magento\Framework\AppInterface;

require __DIR__ . '/app/bootstrap.php';
$params    = $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);

// Define Products SKU to Delete
$products[] = 'Product_SKU1';
$products[] = 'Product_SKU2';
$products[] = 'Product_SKU3';
$counter    = 1;

/**
 * Step-2 Get Object Manager Instance & Use it for Product Repository, Registry Etc
 */

$objectManager = $bootstrap->getObjectManager();
$appState      = $objectManager->get('\Magento\Framework\App\State');
$appState->setAreaCode('frontend');
$productRepository = $objectManager->get('\Magento\Catalog\Model\ProductRepository');
$registry          = $objectManager->get('\Magento\Framework\Registry');
$registry->register('isSecureArea', true);

/**
 * Lets Loops Product SKU and Delete the Products
 * And Prints Which Products were removed Successfully
 * In Case Any Error Prints it.
 */
foreach ($products as $key => $value) {
    $sku = $value;
    try {
        $productRepository->deleteById($sku);
        echo "<br>" . $counter . ") " . $sku . " Product Remove Successfully.";
        $counter++;
    }
    catch (\Exception $e) {
        print_r($e->getMessage());
    }
}

