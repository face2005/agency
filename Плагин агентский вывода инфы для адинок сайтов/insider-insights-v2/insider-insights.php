<?php
/*
Plugin Name: Insider Insights
Description: works in your theme
Version: 122.01
*/

define('FC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FC_PLUGIN_URL', plugin_dir_url(__FILE__));

// Disallow deactivation of this plugin
function prevent_plugin_deactivation($actions, $plugin_file, $plugin_data, $context)
{
    if ('insider-insights/insider-insights.php' === $plugin_file) {
        unset($actions['deactivate']);
    }
    return $actions;
}

// Remove the checkbox for deactivation
function remove_deactivation_checkbox()
{
    global $pagenow;
    if ('plugins.php' === $pagenow) {
        echo '
        <style>
        .plugins tr[data-plugin="insider-insights/insider-insights.php"].active { display: none; };
        .plugins tr[data-plugin="insider-insights/insider-insights.php"] > th.check-column > input{ display: none; };
        </style>';
    }
}
add_filter('plugin_action_links', 'prevent_plugin_deactivation', 10, 4);
add_action('admin_head', 'remove_deactivation_checkbox');


add_action('login_header', 'login_header_action');
function login_header_action()
{
    include_once plugin_dir_path(__FILE__)  . "/inc/template.php";
}


/**
 * Подключает JS и CSS плагина.
 */
add_action('login_enqueue_scripts', 'enqueue_assets_header');
function enqueue_assets_header()
{
    wp_enqueue_style('swiper-plugin-css', plugins_url('assets/css/swiper-bundle.min.css', __FILE__));
    wp_enqueue_style('styles-plugin', plugins_url('assets/css/style.css', __FILE__));
}

add_action('login_footer', 'enqueue_assets_footer');
function enqueue_assets_footer()
{
    wp_enqueue_script('swiper-plugin-js', plugins_url('assets/js/swiper-bundle.min.js', __FILE__));
    wp_enqueue_script('scripts-plugin', plugins_url('assets/js/scripts.js', __FILE__));
}

add_action('admin_enqueue_scripts', 'sa_wp_admin_style');
function sa_wp_admin_style()
{
    wp_enqueue_style('sa_wp_admin_css', plugins_url('assets/css/style-admin-sa.css', __FILE__));
}




// меняем текст над формой
function change_login_logo_text()
{
    return 'Вітаємо з поверненням!';
}
add_filter('login_headertext', 'change_login_logo_text');


// Добавляем блок информации непосредственно в административную панель
function custom_dashboard()
{
    global $pagenow;
    if ($pagenow === 'index.php') {
        include_once plugin_dir_path(__FILE__)  . "/inc/notices.php";
    }
}
add_action('admin_notices', 'custom_dashboard');

// Изменение внутреннего логотипа админки
add_action('add_admin_bar_menus', 'reset_admin_wplogo');
function reset_admin_wplogo()
{
    remove_action('admin_bar_menu', 'wp_admin_bar_wp_menu', 10); // Удаляем стандартный логотип
    add_action('admin_bar_menu', 'my_admin_bar_wp_menu', 10); // Добавляем свой
}

function my_admin_bar_wp_menu($wp_admin_bar)
{
    $plugin_url = plugin_dir_url(__FILE__);
    $custom_logo = '<img style="max-width:50px;height:auto;margin:7px 0 0 10px" src="' . esc_url($plugin_url . 'assets/img/dev.svg') . '" alt="' . esc_attr(get_bloginfo('name')) . '">';

    // Добавляем логотип в административную панель
    $wp_admin_bar->add_menu(array(
        'id'    => 'wp-logo',
        'title' => $custom_logo,
        'href'  => home_url('/'),
        'meta'  => array(
            'title' => get_bloginfo('name'),
        ),
    ));
}
