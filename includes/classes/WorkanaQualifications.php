<?php

namespace Classes;

use WPackio\Enqueue;

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
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        register_activation_hook( PLUGIN_PATH, [$this, 'activated']);
    }

    public function activated() {
        if( version_compare(get_bloginfo('version'), '5.0.0', '<') )
            wp_die(__('You should update your WordPress before using this plugins!', 'workana-qualifications'));
    }

    public function enqueue_admin_scripts() {
        $this->enqueue->enqueue( 'fnwq-js', 'admin', [] );
        $this->enqueue->enqueue( 'fnwq-css', 'admin', [] );
    }

    public function enqueue_scripts() {
        $this->enqueue->enqueue( 'fnwq-js', 'app', [] );
        $this->enqueue->enqueue( 'fnwq-css', 'app', [] );
    }
}
