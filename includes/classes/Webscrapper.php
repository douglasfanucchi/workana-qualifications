<?php

namespace Classes;

use PHPHtmlParser\Dom;

class Webscrapper {
    private $profile_url = 'https://www.workana.com/freelancer/6f88914f75b5d1ec9f6335a601368a1a?ref=user_dropdown';
    private $dom;

    public function __construct() {
        $this->dom = new Dom();
        $this->dom->loadFromUrl($this->profile_url);
    }

    public function get_qualifications() : array {
        $rating_items = $this->dom->find('#ratings-table .box-common.js-rating-item');
        $return       = [];

        foreach( $rating_items as $rating_item ) {
            $message         = new \stdClass;
            $message->text   = $rating_items->find('cite')->text;
            $message->client = new \stdClass;

            $img                     = $rating_item->find('.img.profile-photo img');
            $message->client->name   = $img->getAttribute('title');
            $message->client->avatar = $img->getAttribute('src');
            
            $return[] = $message;
        }

        return $return;
    }
}
