<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("validate.php");
require_once("db.php");
require_once('ai.php');

function category_description_test(){
    $arr = selectByLangAng("ps_category_lang");
    $content = category_description("angielskim", $arr[0]['name'], '');
    echo "END DOT: " . checkIsEndDot($content) . "</br>";
    echo "NAME: " . $arr[0]['name'] . "</br>";
    echo $content . "<br></br>";
    return $content;
}

function category_additional_description_test(){
    $arr = selectByLangAng("ps_category_lang");
    $content = category_additional_description("angielskim", $arr[0]['name'], '');
    echo "END DOT: " . checkIsEndDot($content) . "</br>";
    echo "NAME: " . $arr[0]['name'] . "</br>";
    echo $content . "<br></br>";
    return $content;
}

function category_meta_title_test(){
    $arr = selectByLangAng("ps_category_lang");
    $content = category_meta_title("angielskim", $arr[0]['name'], '');
    echo "END DOT: " . checkIsEndDot($content) . "</br>";
    echo "NAME: " . $arr[0]['name'] . "</br>";
    echo $content . "<br></br>";
    return $content;
}

function category_meta_keywords_test(){
    $arr = selectByLangAng("ps_category_lang");
    $content = category_meta_keywords("angielskim", $arr[0]['name'], '');
    echo "END DOT: " . checkIsEndDot($content) . "</br>";
    echo "NAME: " . $arr[0]['name'] . "</br>";
    echo $content . "<br></br>";
    return $content;
}

function category_meta_description_test(){
    $arr = selectByLangAng("ps_category_lang");
    $content = category_description("angielskim", $arr[0]['name'], '');
    echo "END DOT: " . checkIsEndDot($content) . "</br>";
    echo "NAME: " . $arr[0]['name'] . "</br>";
    echo $content . "<br></br>";
    return $content;
}


//$arr = selectByLangAng("ps_category_lang");
//select("ps_category_lang");
//$arr = selectJoin('ps_lang', "ps_category_lang");
//foreach ($arr as $el) {
//    echo $el[''] . ' ' . $el['name']
//}
//selectJoin


/*
echo "<pre>";
var_dump($arr[0]['id_category']);
echo  "</pre>";
echo "<pre>";
var_dump($arr[0]);
echo  "</pre>";
*/

$content = category_description_test();
//$content = "UPDATE TEST";
$arr = selectByLangAng("ps_category_lang");
echo "<pre>";
var_dump($arr[0]);
var_dump($arr[0]['id_category']);
echo  "</pre>";

//$status = update("description", "ps_category_lang", $content , $arr[1]['id_category'], '1';

//echo "Update status: " . $status . "</br>";

$status = updateEmpty("description", "ps_category_lang", $content , $arr[0]['id_category'], '1');

//echo "Update status: " . $status . "</br>";


//category_additional_description_test();
//category_meta_title_test();
//category_meta_keywords_test();
//category_meta_description_test();


