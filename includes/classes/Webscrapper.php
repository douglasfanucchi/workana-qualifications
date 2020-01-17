<?php

namespace Classes;

use PHPHtmlParser\Dom;

class Webscrapper {
    private $profile_url = 'https://www.workana.com/freelancer/6f88914f75b5d1ec9f6335a601368a1a?ref=user_dropdown';
    private $dom;
    private $transient_time = DAY_IN_SECONDS;

    public function __construct() {
        $this->dom = new Dom();
    }

    public function get_qualifications(array $args = []) : array {
        $args = wp_parse_args($args, ["forced_load" => false]);

        if( !$args['forced_load'] )
            return $this->saved_qualifications();

        return $this->request_qualifications();
    }

    private function saved_qualifications() : array {
        $transient = get_transient('saved_qualifications');

        if( $transient )
            return maybe_unserialize($transient);

        return $this->request_qualifications();
    }

    private function request_qualifications() : array {
        $this->dom->loadFromUrl( $this->profile_url );

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

        $this->set_transient($return);

        return $return;
    }

    private function set_transient( array $array ) : void {
        set_transient('saved_qualifications', maybe_serialize($array), $this->transient_time);
    }
}
