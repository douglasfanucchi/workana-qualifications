<?php

namespace Classes;

use WPackio\Enqueue;
use Controllers\WorkanaController;

class WorkanaQualifications {
    private static $instance = NULL;
    public $version = '1.0.0';
    private $enqueue;
    private $app_name = 'workanaQualifications';

    private function __construct() {
        $this->enqueue = new Enqueue( $this->app_name, 'dist', $this->version, 'plugin', PLUGIN_PATH );

        $this->register_actions();
    }

    static function instance() {
        if( self::$instance === NULL )
            self::$instance = new self;

        return self::$instance;
    }

    private function register_actions() {
        add_action( 'rest_api_init', [new WorkanaController, 'register_routes'] );
        add_action('init', [$this, 'register_blocks']);

        register_activation_hook( PLUGIN_PATH, [$this, 'activated']);
    }

    public function activated() {
        if( version_compare(get_bloginfo('version'), '5.0.0', '<') )
            wp_die(__('You should update your WordPress before using this plugins!', 'workana-qualifications'));
    }

    public function register_blocks() {
        $this->enqueue->register( 'fnwq-admin-js', 'admin', []);
        $this->enqueue->register( 'fnwq-admin-css', 'admin', [] );

        $assets = $this->enqueue->getAssets('fnwq-admin-js', 'admin', ['js' => true, 'css' => false]);

        $handles = array_map(function($js) {
            return $js['handle'];
        }, $assets['js']);

        $handlejs = array_pop( $handles );

        $assets = $this->enqueue->getAssets('fnwq-admin-css', 'admin', ['js' => false, 'css' => true]);
        
        $csses = $assets['css'];

        $handles = array_map(function($css) {
            return $css['handle'];
        }, $csses);

        $handlecss = array_pop($handles);

        wp_localize_script($handlejs, 'api', [
            'url' => site_url('/wp-json')
        ]);

        register_block_type('fnwq/workana-qualifications', [
            'editor_script' => $handlejs,
            'editor_style' => $handlecss
        ]);
    }
}
