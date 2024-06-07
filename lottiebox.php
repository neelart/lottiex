<?php
/**
 * Plugin Name: lottieX 🚀 for Elementor
 * Plugin URI: https://dutopia.artora.in/lbx
 * Description: 😎 Elementor widget to add beautiful, lightweight animations to your website. Customize colors, position and transitions with Editor. Get 🥝free lottiex Plugin 🥝Access of Copy paste tool 🥝Free Lifetime updates and more with the lottiebox animation bundle.
 * Version: 1.0
 * Author: Lottiebox
 * Author URI: https://codecanyon.net/user/dutopian/portfolio
 * Text Domain: lottiebox
 * Elementor tested up to: 3.17.3
 * Elementor Pro tested up to: 3.17.1
 */

// Prevent direct access to files
if (!defined('ABSPATH')) exit;

// Define plugin constants
define('LOTTIEBOX_VERSION', '1');
define('LOTTIEBOX_PATH', plugin_dir_path(__FILE__));
define('LOTTIEBOX_URL', plugin_dir_url(__FILE__));

// Require other plugin files
require_once LOTTIEBOX_PATH . 'include/lottiebox-check.php';

/**
 * Lottiebox Class
 */
class Lottiebox_Animation {

    // Instance holder
    public static $instance = null;

    // Fetch instance
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Lottiebox_Animation();
        }
        return self::$instance;
    }

    // Constructor
    public function __construct() {

        // Enqueue the styles for the Elementor editor.
        add_action('elementor/editor/before_enqueue_styles', array(
            $this,
            'enqueueEditorFiles'
        ));

        // Add hooks
        register_activation_hook(__FILE__, [$this, 'init']);
        add_action('admin_notices', [$this, 'adminNotice']);
        add_action('elementor/init', [$this, 'addElementorCategory']);
        add_action('elementor/widgets/widgets_registered', [$this, 'registerWidgets']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueueFrontendFiles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminFiles']);
        add_action('admin_enqueue_scripts', [$this, 'lottiebox_enqueue_scripts']);

        // Load plugin text domain
        add_action('plugins_loaded', function () {
            load_plugin_textdomain('lottiebox');
        });
    }

    // Enqueue editor files
    public function enqueueEditorFiles() {
        wp_enqueue_style('lottiebox', LOTTIEBOX_URL . 'assets/css/lottiebox_css.min.css', array() , LOTTIEBOX_VERSION);
    }

    // Initialization
    public function init() {
        // Return if Elementor is not loaded
        if (!did_action('elementor/loaded')) {
            return;
        }
    }

    // Admin notice
    public function adminNotice() {
        // TODO - Add your admin notice here
        
    }

    // Add Elementor category
    public function addElementorCategory() {
        \Elementor\Plugin::instance()
            ->elements_manager
            ->add_category('lottiebox', array(
            'title' => esc_html__('✨LottieBox Animations', 'lottiebox')
        ) , 1);
    }

    // Register Widgets
    public function registerWidgets() {
        require_once LOTTIEBOX_PATH . 'include/lottiebox-widget.php';
    }

    // Enqueue frontend files
    public function enqueueFrontendFiles() {
        wp_enqueue_script('lottie', LOTTIEBOX_URL . 'assets/js/extra/lottie.min.js', array(
            'jquery'
        ) , LOTTIEBOX_VERSION, true);
        wp_enqueue_script('lottiebox', LOTTIEBOX_URL . 'assets/js/main/lottiebox_script.min.js', array(
            'jquery'
        ) , LOTTIEBOX_VERSION, true);
        wp_register_style('lottiebox', LOTTIEBOX_URL . 'assets/css/lottiebox_css.min.css', array() , LOTTIEBOX_VERSION);

        if (isset($_GET['elementor-preview']) || (isset($_REQUEST['action']) && $_REQUEST['action'] == 'elementor')) {
            wp_enqueue_style('lottiebox');
        }
    }

    // Enqueue admin files
    public function enqueueAdminFiles() {
        wp_enqueue_script('lottiebox-admin', LOTTIEBOX_URL . 'assets/js/admin/lottiebox_note.js', array(
            'jquery'
        ) , LOTTIEBOX_VERSION, true);
    }

    // Enqueue main JS files
    public function lottiebox_enqueue_scripts() {
        if (defined('ELEMENTOR_VERSION') && Elementor\Plugin::$instance
            ->editor
            ->is_edit_mode()) {
            wp_enqueue_script('lottiebox-script', plugins_url('/assets/js/main/lottiebox_script.js', __FILE__) , ['jquery'], '1.0');
        }
    }
}

// Initialize the Lottiebox_Animation class
$lottiebox = Lottiebox_Animation::getInstance();

