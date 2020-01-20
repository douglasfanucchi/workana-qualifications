<?php

namespace Controllers;

use Classes\Webscrapper;

class WorkanaController extends \WP_REST_Controller {
    
    public function register_routes() {
        register_rest_route( 'wkqf/v1', '/qualifications', [
            'methods' => 'GET',
            'callback' => [$this, 'get_items']
        ]);
    }

    public function get_items($request) {
        $webscrapper = new Webscrapper;

        $qualifications = $webscrapper->get_qualifications();

        return new \WP_REST_Response($qualifications);
    }
}
