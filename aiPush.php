<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("validate.php");
require_once("db.php");
require_once('ai.php');

//Presta Entry
//$genCase =  descripiton
function category_generater_push($aiPrestaCategory, $lang, $keywords, $genCase, $n){
    $arr = selectByLangWithoutEmptyOnlyActiveCategory($genCase);

    $n = count($arr);
    $counter = 0;
    $flagOff = 0;
    foreach ($arr as $el) {
        if($n == $counter)
            break;

        $categoryNameArr = selectChildCategoryByParentIdActiveLang($el['id_category'], $lang);
        $categoryStr = " ";
        foreach($categoryNameArr as $str) {
            $categoryStr .= $str['name'] . ",";
        }
            
        $keywords = $categoryStr;

        switch ($genCase){
            case ("description"):            
                $content = $aiPrestaCategory->category_description($lang, $el['name'], $keywords);
                break;
            case ("additional_description"):
                $content = $aiPrestaCategory->category_additional_description($lang, $el['name'], $keywords);
                break;
            case ("meta_title"):
                $content = $aiPrestaCategory->category_meta_title($lang, $el['name'], $keywords);
                echo "meta_title: ". $el['name'] . "</br>";
                echo "content: " . $content . "</br>";
                $flagOff = 1;
                break;
            case ("meta_keywords"):
                $content = $aiPrestaCategory->category_meta_keywords($lang, $el['name'], $keywords);
                $flagOff = 1;
                break;
            case ("meta_description"):
                $content = $aiPrestaCategory->category_meta_description($lang, $el['name'], $keywords);
                break;
        }
        
        $checkDot = check_is_end_dot($content);
        $checkXYZ = search_text($content, "XYZ");
        $check60_character_limit = search_text($content, "60 character limit!");
        $checkReg1 = search_regex($content, "/\[.*\]/");
        
        if($flagOff == 1){
            echo "END DOT: " . $checkDot . "</br>";
            $checkDot = 1;
        }
        echo "XYZ: " . $checkXYZ . "</br>";
        echo "[*]: " . $checkReg1 . "</br>";
        echo "NAME: " . $el['name'] . "</br>";

        if($checkDot &&  $checkXYZ != true &&  $checkReg1 != true && $check60_character_limit != true){
            echo "<pre style='width: 800px; white-space: pre-wrap; word-break: break-word'>";
            //var_dump($el);
            var_dump($el['id_category']);
            echo $content;
            echo  "</pre>";

            $status = updateEmpty($genCase, "ps_category_lang", $content , "id_category", $el['id_category'], '1');

            echo "Update status: " . $status . "</br>";
        }else{
            echo "No dot !!!" . "</br>";
        }
        $counter++;
    }
}

function generate_manufacturerr_push($aiPrestaManufacturerr, $lang, $keywords, $genCase, $n){
    $query = new DbQuery();
    $query->select('*');
    $query->from('manufacturer', 'm');
    $query->leftJoin('manufacturer_lang', 'ml', 'm.id_manufacturer = ml.id_manufacturer');
    $query->where('ml.id_lang = ' . $lang);
    $query->where('m.active = 1');
    $arr = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

    $n = count($arr);
    $counter = 0;
    $flagOff = 0;
    foreach ($arr as $el) {
        if($n == $counter)
            break;

        switch ($genCase){
            case ("description"):            
                $content = $aiPrestaCategory->manufacturer_description($lang, $el['name'], $keywords);
                break;
            case ("short_description"):
                $content = $aiPrestaCategory->manufacturer_short_description($lang, $el['name'], $keywords);
                break;
            case ("meta_title"):
                $content = $aiPrestaCategory->manufacturer_meta_title($lang, $el['name'], $keywords);
                echo "meta_title: ". $el['name'] . "</br>";
                echo "content: " . $content . "</br>";
                $flagOff = 1;
                break;
            case ("meta_keywords"):
                $content = $aiPrestaCategory->manufacturer_meta_keywords($lang, $el['name'], $keywords);
                $flagOff = 1;
                break;
            case ("meta_description"):
                $content = $aiPrestaCategory->manufacturer_meta_description($lang, $el['name'], $keywords);
                break;
        }
        
        $checkDot = check_is_end_dot($content);
        $checkXYZ = search_text($content, "XYZ");
        $check60_character_limit = search_text($content, "60 character limit!");
        $checkReg1 = search_regex($content, "/\[.*\]/");
        
        if($flagOff == 1){
            echo "END DOT: " . $checkDot . "</br>";
            $checkDot = 1;
        }
        echo "XYZ: " . $checkXYZ . "</br>";
        echo "[*]: " . $checkReg1 . "</br>";
        echo "NAME: " . $el['name'] . "</br>";

        if($checkDot &&  $checkXYZ != true &&  $checkReg1 != true && $check60_character_limit != true){
            echo "<pre style='width: 800px; white-space: pre-wrap; word-break: break-word'>";
            //var_dump($el);
            var_dump($el['id_category']);
            echo $content;
            echo  "</pre>";

            $status = updateEmpty($genCase, "ps_manufacturer_lang", $txt , "id_manufacturer", $id, $lang);

            echo "Update status: " . $status . "</br>";
        }else{
            echo "No dot !!!" . "</br>";
        }
        $counter++;
    }
}

$lang = 1;
$aiRussiangoldCategory = new AiRussiangoldCategory();

category_generater_push($aiRussiangoldCategory, $lang, " ", 'description' , 0);
category_generater_push($aiRussiangoldCategory, $lang, " ", 'additional_description' , 0);
category_generater_push($aiRussiangoldCategory, $lang, " ", 'meta_title' , 0);
category_generater_push($aiRussiangoldCategory, $lang, " ", 'meta_keywords' , 0);
category_generater_push($aiRussiangoldCategory, $lang, " ", 'meta_description' , 0);

//unit1();
//unit2();
//unit3();


function unit3(){
    $lang = 1;
    $aiRussiangoldCategory = new AiRussiangoldCategory();
    $categoryNameArr = selectChildCategoryByParentIdActiveLang('97', $lang);
    $categoryStr = "";
    foreach($categoryNameArr as $str) {
        $categoryStr .= $str['name'] . " ,";
    }

    $categoryStr = substr($categoryStr, 0, strlen($categoryStr) - 1);

    echo $categoryStr . "</br>";
                
    $keywords = $categoryStr;
    $content = $aiRussiangoldCategory->category_meta_description($lang, 'Vintage Jewelry' , $categoryNameArr);

    echo $content . "</br>";
}

function unit2(){
    $lang = 1;
    $aiRussiangoldCategory = new AiRussiangoldCategory();
    $categoryNameArr = selectChildCategoryByParentIdActiveLang('97', $lang);
    $categoryStr = "";
    foreach($categoryNameArr as $str) {
        $categoryStr .= $str['name'] . " ,";
    }

    $categoryStr = substr($categoryStr, 0, strlen($categoryStr) - 1);

    echo $categoryStr . "</br>";
                
    $keywords = $categoryStr;
    $content = $aiRussiangoldCategory->category_meta_title($lang, 'Vintage Jewelry' , $categoryNameArr);

    echo $content . "</br>";
}

function unit1(){
    $arr = selectChildCategoryByParentIdActiveLang("97" , "1");

    echo "<pre>";
    foreach ($arr as $el) {
        echo $el['name'];
    }
    echo "</pre>";
}
