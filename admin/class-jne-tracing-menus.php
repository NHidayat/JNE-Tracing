<?php 

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'TP_Admin_Menus', false ) ) {
	return new TP_Admin_Menus();
}

class TP_Admin_Menus {
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_menu'));
    }
    
    public function add_menu() {
        $icon = plugin_dir_url(__FILE__) . '/img/menu-icon20.png';
        
        add_menu_page(
            'JNE Tracing',              // Page title
            'JNE Tracing',              // Menu Title
            'manage_options',           // Capability
            'jne-tracing',             // Page slug 
            array($this, 'page_tracing'),              // function
            $icon,
            '55.5'              // Position
        );
    
        add_submenu_page(
            'jne-tracing',                     // parent slug
            'Configuration',       // page title
            'Configuration',                    // menu title
            'manage_options',                   // capability
            'jne-tracing-config',                               // slug
            array($this, 'page_config')                // callback
        ); 
        
    }

    public function page_tracing()
    {
        require_once 'partials/view-tracing.php';
    }

    function page_config() 
    {
        require_once 'partials/view-config.php';
    }

}

return new TP_Admin_Menus();