<?php
require_once("validate.php");
require_once("db.php");
require_once('ai.php');

require_once('../config/config.inc.php');
require_once('../init.php');
require_once('../classes/Product.php');

function getProducts($id_lang){
    $productObj = new Product();
    $products = $productObj->getProducts($id_lang, 0, 0, 'id_product', 'DESC');
    return $products;
}

function getOneProductLang($id_product, $id_lang){    
    $productLang = new Product($id_product, true, $id_lang); 
    $productLangData = $productLang->getFieldsLang(); 
    return $productLangData;
}

$lang = 1;

//Update category
if( isset($_GET['x']) && isset($_GET['id']) && isset($_GET['txt']) && isset($_GET['gcase'])){
    $x = $_GET['x'];
    $id = $_GET['id'];
    $txt = $_GET['txt'];
    $genCase = $_GET['gcase'];

    echo $genCase . "</br>";
    if($x == 'c'){
        $status = updateEmpty($genCase, "ps_category_lang", $txt , "id_category", $id, $lang);
    }

    if($x == 'p'){
        $status = updateEmpty($genCase, "ps_product_lang", $txt , "id_product", $id, $lang);
    }

    if($x == 'm'){
        $status = updateEmpty($genCase, "ps_manufacturer_lang", $txt , "id_manufacturer", $id, $lang);
        echo "Status: " . $status;
    }
    die();
}

//Get one 
if(isset($_GET['x']) && isset($_GET['id'])){
    $x = $_GET['x'];
    $id = $_GET['id'];
    if($x == 'c'){
        $category = selectByIdByLang("ps_category_lang", "id_category", $id, $lang);
        $response = "<response>";
        foreach ($category as $el) {
            $response .= "<description><![CDATA[" . $el['description'] . "]]></description>";
            $response .= "<additional_description><![CDATA[" . $el['additional_description'] . "]]></additional_description>";
            $response .= "<meta_title><![CDATA[" . $el['meta_title'] . "]]></meta_title>";
            $response .= "<meta_keywords><![CDATA[" . $el['meta_keywords'] . "]]></meta_keywords>";
            $response .= "<meta_description><![CDATA[" . $el['meta_description'] . "]]></meta_description>";
        }
        $response .= "</response>";

        echo $response;
    }

    if($x == 'p'){
        $product = getOneProductLang($x, $lang);
        $productXml = "<response>";
        $productXml .= "<description><![CDATA[" . $el['description'] . "]]></description>";
        $productXml .= "<meta_title><![CDATA[" . $el['meta_title'] . "]]></meta_title>";
        $productXml .= "<meta_keywords><![CDATA[" . $el['meta_keywords'] . "]]></meta_keywords>";
        $productXml .= "<meta_description><![CDATA[" . $el['meta_description'] . "]]></meta_description>";
        $productXml .= "</response>";
        echo $productXml;
    }

    if($x == 'm'){
        $query = new DbQuery();
        $query->select('*');
        $query->from('manufacturer', 'm');
        $query->leftJoin('manufacturer_lang', 'ml', 'm.id_manufacturer = ml.id_manufacturer');
        $query->where('ml.id_lang = ' . $lang);
        $query->where('m.active = 1');
        $query->where('m.id_manufacturer = ' . $id); 
    
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
    
        $productXml = "<response>";
        foreach ($result as $el) {    
            $productXml .= "<description><![CDATA[" . $el['description'] . "]]></description>";
            $productXml .= "<short_description><![CDATA[" . $el['short_description'] . "]]></short_description>";
            $productXml .= "<meta_title><![CDATA[" . $el['meta_title'] . "]]></meta_title>";
            $productXml .= "<meta_keywords><![CDATA[" . $el['meta_keywords'] . "]]></meta_keywords>";
            $productXml .= "<meta_description><![CDATA[" . $el['meta_description'] . "]]></meta_description>";
        }
        $productXml .= "</response>";
        echo $productXml;
    }
    die();
}

//Get category, product, manufacturerr
if(isset($_GET['x']) ){
    $x = $_GET['x'];
    if($x == 'c'){
        $category = selectByLangOnlyActiveCategory($lang);
        $response = "<response>";
        foreach ($category as $el) {
            $response .= "<id_category>" . $el['id_category'] . "</id_category>";
            $response .= "<name>" . $el['name'] . "</name>";
        }
        $response .= "</response>";
        echo $response;
    }

    if($x == 'p'){
        $products = getProducts($lang);
        $response = "<response>";
        foreach ($products as $el) {
            $response .= "<id_product>" . $el['id_product'] . "</id_product>";
            $response .= "<name>" . $el['name'] . "</name>";
        }
        $response .= "</response>";
        echo $response;
    }

    if($x == 'm'){
        $query = new DbQuery();
        $query->select('*');
        $query->from('manufacturer', 'm');
        $query->leftJoin('manufacturer_lang', 'ml', 'm.id_manufacturer = ml.id_manufacturer');
        $query->where('ml.id_lang = ' . $lang);
        $query->where('m.active = 1');

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

        $response = "<response>";
        foreach ($result as $el) {
            $response .= "<id_manufacturer>" . $el['id_manufacturer'] . "</id_manufacturer>";
            $response .= "<name>" . $el['name'] . "</name>";
        }
        $response .= "</response>";
        echo $response;
    }
    die();
}