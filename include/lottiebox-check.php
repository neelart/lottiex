<?php
if (!defined('ABSPATH')) {
    exit;
}

function lottiebox_addon_load_fail() {
    $plugin = 'elementor/elementor.php';
    $elementor_installed = lottiebox_is_elementor_installed();
    $admin_url = $elementor_installed ? wp_nonce_url('plugins.php?action=activate&plugin=' . $plugin, 'activate-plugin_' . $plugin) : wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor') , 'install-plugin_elementor');
    $action_text = $elementor_installed ? "Activate Elementor" : "Install Elementor";
    $button_html = '<a href="' . $admin_url . '" class="button-primary">' . $action_text . '</a>';

    if (current_user_can('activate_plugins') || current_user_can('install_plugins')) {
        echo '<div class="notice notice-error"><p><b>lottiebox for Elementor</b> requires Elementor to be installed and activated: ' . $button_html . '</p></div>';
    }
}

function lottiebox_is_elementor_installed() {
    return isset(get_plugins() ['elementor/elementor.php']);
}
?>
