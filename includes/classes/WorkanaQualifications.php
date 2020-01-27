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
        add_action('init', [$this, 'init']);

        register_activation_hook( PLUGIN_PATH, [$this, 'activated']);
    }

    public function activated() {
        if( version_compare(get_bloginfo('version'), '5.0.0', '<') )
            wp_die(__('You should update your WordPress before using this plugins!', 'workana-qualifications'));
    }

    public function init() {
        $fnwq_block = new Block('fnwq/workana-qualifications');
        $fnwq_block->set_enqueue( $this->enqueue );

        $fnwq_block->set_asset('js', [
            'editor_script' => true,
            'file_name' => 'fnwq-admin-js',
            'entry' => 'admin',
            'options' => []
        ]);

        $fnwq_block->set_asset('js', [
            'script' => true,
            'file_name' => 'fnwq-js',
            'entry' => 'app'
        ]);

        $fnwq_block->set_asset('css', [
            'editor_style' => true,
            'file_name' => 'fnwq-admin-css',
            'entry' => 'admin',
            'options' => []
        ]);

        $fnwq_block->set_asset('css', [
            'style' => true,
            'file_name' => 'fnwq-css',
            'entry' => 'app',
            'options' => []
        ]);

        $fnwq_block->register_assets();
        $fnwq_block->register_block();
    }
}
