<?php
/**
 * Plugin Name: Workana Qualifications
 * Plugin URI: https://github.com/douglasfanucchi/workana-qualifications
 * Description: Shows Workana's freelancer qualifications.
 * Author: Douglas Fanucchi
 * Version: 1.0.0
 * Text Domain: workana-qualifications
 */

if( !defined("ABSPATH") )
    die("I\m just a plugin. I can't be accessed directly :)");

require __DIR__ . "/vendor/autoload.php";

define("PLUGIN_PATH", __FILE__);

Classes\WorkanaQualifications::instance();
