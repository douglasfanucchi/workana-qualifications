<?php

namespace Classes;

use WPackio\Enqueue;

class Block {
    private $enqueue;
    private $block_name;
    private $block_config;
    private $assets;
    private $handles;

    public function __construct(string $block_name, array $block_config = []) {
        $this->block_name   = $block_name;
        $this->block_config = $block_config;
    }

    public function set_asset(string $asset, array $args) : void {
        if( $asset !== 'js' && $asset !== 'css' )
            wp_die('Tipo invalido!');    
    
        $this->assets[$asset][] = $args;
    }

    public function register_assets() : void {
        foreach( $this->assets as $asset_type => $asset )
            foreach( $asset as $file ) {
                $enqueued_assets = $this->enqueue->register( $file['file_name'], $file['entry'], [] );

                $this->set_handle( $asset_type, $enqueued_assets, $file );
            }
    }

    public function register_block() {
        register_block_type($this->block_name, $this->handles);
    }

    public function get_block_name() : string {
        return $this->block_name;
    }

    public function get_block_config() : array {
        return $this->block_config;
    }

    public function set_enqueue(Enqueue $enqueue) : void {
        $this->enqueue = $enqueue;
    }

    private function set_handle( string $asset_type, array $enqueued_assets, array $file ) : void {
        if( $asset_type === 'js' ) {
            if( !empty( $file['editor_script'] ) )
                $key = 'editor_script';
            else
                $key = 'script';

            $jses = $enqueued_assets['js'];
            $handle = array_pop( $jses )['handle'];

            $this->handles[ $key ] = $handle;
        } else if( $asset_type === 'css' ) {
            if( !empty( $file['editor_style'] ) )
                $key = 'editor_style';
            else
                $key = 'style';

            $csses = $enqueued_assets['css'];
            $handle = array_pop($csses)['handle'];

            $this->handles[ $key ] = $handle;
        }
    }
}
