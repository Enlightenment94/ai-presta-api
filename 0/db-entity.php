<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../config/config.inc.php');
require_once('../init.php');
require_once('../classes/Product.php');


function getProducts($id_lang){
    $productObj = new Product();
    $products = $productObj->getProducts($id_lang, 0, 0, 'id_product', 'DESC');
    return $products;
}

function unitGetProducts(){
    $id_lang = 1;
    $category_id = 97;

    $products = getProducts($id_lang);

    $productXml = "<response>";
    foreach ($products as $el) {
        $productXml .= "<product>";
        $productXml .= "<description>" . $el['description'] . "</description>";
        $productXml .= "<meta_title>" . $el['meta_title'] . "</meta_title>";
        $productXml .= "<meta_keywords>" . $el['meta_keywords'] . "</meta_keywords>";
        $productXml .= "<meta_description>" . $el['meta_description'] . "</meta_description>";
        $productXml .= "<product>";
    }
    $productXml .= "</response>";
    //echo "<pre>" . $productXml . "</pre>";
    echo count($products);
}

function getManufacturerr(){
    $manufacturers = new ManufacturerCore();

    $manufacturersList = $manufacturers->getManufacturers();

    echo "<pre>";
    foreach ($manufacturersList as $manufacturerr) {
        echo var_dump($manufacturerr);
    }
    echo "</pre>";
}

function getManufacturerr2(){
    $query = new DbQuery();
    $query->select('*');
    $query->from('manufacturer', 'm');
    $query->leftJoin('manufacturer_lang', 'ml', 'm.id_manufacturer = ml.id_manufacturer');
    $query->where('ml.id_lang = ' . (int)Context::getContext()->language->id);

    $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

    echo "<pre>";
    foreach ($result as $manufacturer) {
        echo var_dump($manufacturer); 
    }
    echo "</pre>";
}

getManufacturerr2();

/*
function getOneProductLang($id_product, $id_lang){    
    $productLang = new Product($id_product, true, $id_lang); 
    $productLangData = $productLang->getFieldsLang(); 
    return $productLangData;
}

function getProductsLang($id_lang){    
    $productLang = new Product($id_lang); 
    $productLangData = "";
    $productLangData = $productLang->getFieldsLang(); 
    return $productLangData;
}

function getProductDescripiton(){
    $products = getProducts('1');
    $arr = array();
    foreach ($products as $el) {
        if($el['active'] == '1'){

            $productLang = getOneProductLang($el['id_product'], "1");
            array_push($arr, $productLang);
        }
    }

    echo "<pre>";
    foreach ($arr as $el) {
        echo var_dump($el);
    }
    echo "</pre>";    
}

$arr = getProducts($id_lang);

echo "<pre>";
foreach ($arr as $el) {
    echo var_dump($el);
}
echo "</pre>";

//$category = new Category($category_id);
//$subcategories = $category->getSubCategories();
//$children = Category::getChildren((int)$id_category, (int)$id_lang, true, (int)$id_shop);

//var_dump($children);

/*
foreach ($subcategories as $subcategory) {
    echo 'ID subkategorii: ' . $subcategory['id_category'] . '<br>';
    echo 'Nazwa subkategorii: ' . $subcategory['name'] . '<br>';
    echo 'Ścieżka do subkategorii: ' . $subcategory['link_rewrite'] . '<br>';
}*/
?>

