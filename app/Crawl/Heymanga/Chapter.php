<?php
/**
 * Created by PhpStorm.
 * User: super
 * Date: 12/15/2016
 * Time: 4:19 PM
 */

namespace App\Crawl\Heymanga;


use Sunra\PhpSimple\HtmlDomParser;

class Chapter
{
//    public $manga_slug;
    public $number;
    public $link;

    function __construct($number,$link)
    {
        $this->number=$number;
        $this->link=$link;
    }

    public function getArrayImage(){
        $link_http_chapter='https:'.$this->link;
        $this->
        $html=HtmlDomParser::file_get_html($link_http_chapter);
        $node=$html->find('#page_list');
        if (empty($node)){
            return null;
        }
        $options=$node[0]->find('option');
        $array_page=[];
        foreach ($options as $option){
            if ($option->value!=null){
                $array_page[$option->value]='';
            }
        }
        foreach ($array_page as $key=>$value){
            if (empty($value)){
                dd($link_http_chapter);
                $html=HtmlDomParser::file_get_html($link_http_chapter);

                $array_img=$html->find('img[class=img-fill]');
                foreach ($array_img as $img){
                    $alt=trim($img->alt);
                    $array_t=explode(' ',$alt);
                    $page_number=array_pop($array_t);
                    $array_page[$page_number]=$img->src;
                }
            }
        }
        dd($array_page);
        return $array_page;
    }

    public function checkFullArray($array){
        foreach ($array as $item){
        }
    }
}