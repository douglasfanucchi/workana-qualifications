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

        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    static function instance() {
        if( self::$instance === NULL )
            self::$instance = new self;

        return self::$instance;
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
