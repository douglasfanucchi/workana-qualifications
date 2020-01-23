<?php

namespace Controllers;

use Classes\Webscrapper;

class WorkanaController extends \WP_REST_Controller {
    
    public function register_routes() {
        register_rest_route( 'fnwq/v1', '/qualifications', [
            'methods' => 'GET',
            'callback' => [$this, 'get_items']
        ]);
    }

    public function get_items($request) {
        $webscrapper = new Webscrapper;
        $args = [];

        if( $request->get_param("forced_load") )
            $args["forced_load"] = true;

        $qualifications = $webscrapper->get_qualifications($args);

        return new \WP_REST_Response($qualifications);
    }
}
