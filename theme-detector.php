<?php
/* 
Plugin Name: Theme detector
Plugin URI: http://websitethemedetector.com/
Description: Want to detect what wordpress theme it is used in website , Wordpress theme detector is a free online tool will help you to detect the wordpress theme . simply enter website url and hit button.
Version: 1.0.0
Author: Wizard Infosys
Author URI: http://wizardinfosys.com/
License: GPL2 
*/


/*
 * Main dtctr class
 * @since 1.0.0
 */

class dtctr
{
    
    /*
     * Initialize function
     * This init function call at load time
     * @since 1.0.0
     */
    function _init()
    {
        add_action('admin_menu', array($this, 'dtctr_plugin_menu'));
        add_shortcode( 'detector_searchform', array($this, 'dtctr_searchform_shortcode'));
        add_shortcode( 'detector_layout', array($this, 'dtctr_layout_shortcode'));
        add_action( 'wp_enqueue_scripts', array($this, 'load_dtctr_scripts_and_style'));
        add_action( 'admin_enqueue_scripts', array($this, 'load_dtctr_scripts_and_style_admin'));
        add_action( 'admin_init', array(&$this, 'dtctr_css_option'));
        add_action('wp_ajax_dtctr_theme_result_',  array(&$this, 'dtctr_theme_result_'));
        
    }
        
    
    /*
     * Detector plugin menu
     * This menu appear in admin panel 
     * Menu name is Theme detector
     * @since 1.0.0
     */
    function dtctr_plugin_menu() {
        add_menu_page('Detector setting page', 'Theme Detector', 'manage_options', 'theme-detector', array($this, 'dtctr_settings'),'dashicons-search');
    }
    
    
    
    /*
     * Detector settings page content and layout
     * @since 1.0.0
     */
    function dtctr_settings()
    {
       include_once( plugin_dir_path( __FILE__ ) . 'admin/dtctr_setting.php' );
    }
    
    
    /*
     * Shortcode for user
     * @since 1.0.0
     */
    function dtctr_searchform_shortcode()
    {
        include_once( plugin_dir_path( __FILE__ ) . 'core/_form.php' );
    }
     
    
    
    /*
     * result form for user
     * @since 1.0.0
     */
    function dtctr_theme_result_()
    {
        include_once( plugin_dir_path( __FILE__ ) . 'core/theme_layout.php' ); 
    }
    
    
    /*
     * Shortcode for user 
     * if user wants default design
     * @since 1.0.0
     */
    function dtctr_layout_shortcode()
    {
        echo '<section class="theme-wrapper" id="theme_layout"></section>';
    }
    
    
    
     /*
     * Detector js and css
     * js load after jquery 
     * @since 1.0.0
     */
    function load_dtctr_scripts_and_style() 
    {
        wp_register_script( 
            'dtctr_script', 
            plugins_url() . '/theme-detector/js/scripts.js', 
            array( 'jquery' )
        );
        wp_enqueue_script( 'dtctr_script' );
         wp_enqueue_style( 'detector-loader', plugins_url('/css/detector-loader.css', __FILE__) );
        if(!get_option('disable_css')) :
        wp_enqueue_style( 'detector-style', plugins_url('/css/styles.css', __FILE__ ));
        endif;
    }

    
      
     /*
     * Detector admin js and css
     * js load after jquery
     * @since 1.0.0
     */
    function load_dtctr_scripts_and_style_admin() 
    {
        wp_enqueue_style( 'detector-style', plugins_url('/admin/css/styles.css', __FILE__) );
        wp_enqueue_style( 'detector-fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    }
    
    
    /*
     * Detector Save Save 
     * @since 1.0.0
     */
    function dtctr_css_option()
    {
        register_setting( 'my-plugin-settings-group', 'disable_css' );
    }
}


/*
 * create detector object 
 * and call init function at load time
 * @since 1.0.0
 */
$dtctr = new dtctr;
$dtctr->_init();
?>