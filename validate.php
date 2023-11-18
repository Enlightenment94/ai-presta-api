<?php 
/*
[store name]
XYZ
*/

function check_is_end_dot($txt){
  $endChar = "";
  $len = strlen($txt);
  if($len == 0){
    return -1;
  }

  $offset = 1;
  $endChar = $txt[$len - $offset];

  while(true){
    if($offset == $len){
        break;
    }
    if($endChar == " "){
        $offset++;
        $endChar = $txt[$len - $offset];
    }else{
        $endChar = $txt[$len - $offset];
        break;
    }
  }
  //echo "Text legnth : " . $len . "</br>";
  //echo "End sign : " . $endChar . "</br>";
  if($endChar == "!" || $endChar == "."){
      return 1;
  }else{
      return 0;
  }
}

function search_text($text, $keyword) {
  if (strpos($text, $keyword) !== false) {
      return true;
  } else {
      return false;
  }
}

function search_regex($text, $regex_pattern) {
  if (preg_match($regex_pattern, $text)) {
      return true;
  } else {
      return false;
  }
}


/*
$text = "Tekst zawierający [jakis_textsfsdgsdg] wzór regularny.";
$regex_pattern = "/\[.*\]/";
if (search_regex($text, $regex_pattern)) {
  echo "Tekst zawiera wzór regularny.";
} else {
  echo "Tekst nie zawiera wzoru regularnego.";
}*/

//search_text($text "XYZ");