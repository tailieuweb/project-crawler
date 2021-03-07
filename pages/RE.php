<?php
//Regular Expression
return $pages = array(
    0   =>  array(
        //vietnamworks
        /*<h2 class="title.*?><a itemprop="title" target="_blank" href="(.*?)" title=".*?">(.*?)<\/a>
         * 
         */
        'id'    =>  0,
        'name'  =>  'Vietnam Works',
        'url'   =>  'http://www.vietnamworks.com/ke-toan-kv',
        're'    => array(
            'pagination'    =>  '/[^-]<ul id="pagination">(.*?)<\/ul>/',
            'page'  =>  '/<li.*?>(<a.*?>|)(\d+)(<\/a>|)<\/li>/',
            'sum_results'   =>  '/<h1 class="search-info floatLeft">.*?<strong.*?>(.*?)<\/strong>/',
            'list'  => '/<li.*?itemscope.*?itemtype="http:\/\/schema.org\/JobPosting".*?>[\n\r\s\t]*<div class="list-item">[\n\r\s\t]*<h2 class="title.*?><a.*?href="(.*?)".*?>(.*?)<\/a>.*?<\/h2>[\n\s\r\t]*<span.*?itemprop="datePosted".*?>(.*?)<\/span>[\n\r\s\t]*<span.*?>[\n\r\s\t]*<span.*?>[\n\r\s\t]*<span.*?>(.*?)<\/span>[\n\r\s\t]*<\/span><\/span>[\n\r\s\t]*<\/div>[\n\r\s\t]*<!--<[\s\S]*?-->[\n\r\s\t]*<span.*?itemscope.*?itemtype="http:\/\/schema\.org\/Organization">[\n\r\s\t]*<span.*?>(.*?)<\/span>/',
            'detail'    =>  ''
        ),
        'start' =>  'trang-%u',
        'per_page' =>   '50-viec-lam-moi-trang'
    )    
);