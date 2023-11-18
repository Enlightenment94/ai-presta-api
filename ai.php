<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

require_once("validate.php");
require_once("db.php");

abstract class aiApi{
    protected $key;

    protected function __construct(){
        $this->key = file_get_contents(".env");
    }

    protected function ai($content, $tokens){
        $open_ai = new OpenAi($this->key);
        $chat = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "system",
                    "content" => $content
                ],
            ],
            'temperature' => 0.9,       //zróżnicowanie odpowiedzi
            'max_tokens' => $tokens,    //tokeny dzieleni slow na ich ilocz sprawy monetarne
            'frequency_penalty' => 0, //prawdopodobienstwo podobnych odpowiedzi
            'presence_penalty' => 0.7,    //wplyw danych wejsciowych poprzednich odpowiedzi 
        ]);

        $d = json_decode($chat);
        return $d->choices[0]->message->content;
    }
}


abstract class AiPrestaCategory extends aiApi{
    public abstract function category_description($language, $category, $keywords);
    public abstract function category_additional_description($language, $category, $keywords);
    public abstract function category_meta_title($language, $category, $keywords);
    public abstract function category_meta_keywords($language, $category, $keywords);
    public abstract function category_meta_description($language, $category, $keywords);
};

//Vintage Cateogry Ang
class AiRussiangoldCategory extends AiPrestaCategory{
    function category_description($language, $category, $keywords){
        $prompt = "I Want You To Act As A Content Writer Very Proficient SEO Writer Writes Fluently " . $language. ". Write a 200 words 100% Unique, SEO-optimized, Human-Written category description in '" . $language . "'  that covers the category provided in the Prompt. Write The category description In Your Own Words Rather Than Copying And Pasting From Other Sources. Consider perplexity and burstiness when creating content, ensuring high levels of both without losing specificity or context. Use formal 'we' language with rich, detailed paragraphs that engage the reader. Write In A Conversational Style As Written By A Human (Use An Informal Tone, Utilize Personal Pronouns, Keep It Simple, Engage The Reader, Use The Active Voice, Keep It Brief.
        Avoid sentences like '... is a category ...' or 'Our category ...' and describe only the content of the category.
        
        The current category is a sub-category of the following categories : " . $keywords . "
        
        Write An category description for a category with this name : " . $category . "

        The theme of the shop revolves around gold products and jewelry. The main inspiration for the shop is vintage gold !!!
        
        - Write in " . $language;

        $content = $this->ai($prompt, 800);
        return $content;
    }

    function category_additional_description($language, $category, $keywords){
        $prompt = "I Want You To Act As A Content Writer Very Proficient SEO Writer Writes Fluently " . $language. ". Write a 120 words 100% Unique, SEO-optimized, Human-Written category additional description in '" . $language . "'  that covers the category provided in the Prompt. Write The category additional description In Your Own Words Rather Than Copying And Pasting From Other Sources. Consider perplexity and burstiness when creating content, ensuring high levels of both without losing specificity or context. Use formal 'we' language with rich, detailed paragraphs that engage the reader. Write In A Conversational Style As Written By A Human (Use An Informal Tone, Utilize Personal Pronouns, Keep It Simple, Engage The Reader, Use The Active Voice, Keep It Brief.
        Avoid sentences like '... is a category ...' or 'Our category ...' and describe only the content of the category.
        
        The current category is a sub-category of the following categories : " . $keywords . "
        
        Write An category additional description for a category with this name : " . $category . "

        The theme of the shop revolves around gold products and jewelry. The main inspiration for the shop is vintage gold !!!
        
        - Write in " . $language;;

        $content = $this->ai($prompt, 500);
        return $content;
    }

    function category_meta_title($language, $category, $keywords){
        $prompt = "Create a catchy meta title for category " .  $category ." which is less than or equal to 60 character.
        
        The current category is a sub-category of the following categories: " . $category . "
        
        - do not surround your answer with quotation marks, chevrons or HTML Tag  and write in " . $language;

        echo "PROMPT : <pre>" . $prompt . "</pre>";

        $content = $this->ai($prompt, 300);
        return $content;
    }

    
    function category_meta_keywords($language, $category, $keywords){
        $prompt = "Generate content in the language ". $language . ", these are meta keywords so do it precisely for SEO. Create a meta keywords for the category named " . $category . ". The subject of the store you are describing is a jewelry store selling gold and jewelry products Vintage producents. All must have only 12-15 words because is meta keywords";

        $content = $this->ai($prompt, 200);
        return $content;
    }

    function category_meta_description($language, $category, $keywords){
        $prompt = "You must not answer more than 20 words and 160 characters. Create a catchy meta description for category " . $category  . "
        
        The current category is a sub-category of the following categories : " . $keywords . "
        
        - Write in " . $language;

        $content = $this->ai($prompt, 200);
        return $content;
    }
};

abstract class AiPrestaManufacturerr extends aiApi{
    public abstract function manufacturerr_description($language, $manufacturerr, $keywords);
    public abstract function manufacturerr_short_description($language, $manufacturerr, $keywords);
    public abstract function manufacturerr_meta_title($language, $manufacturerr, $keywords);
    public abstract function manufacturerr_meta_keywords($language, $manufacturerr, $keywords);
    public abstract function manufacturerr_meta_description($language, $manufacturerr, $keywords);
};

?>