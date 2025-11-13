<?php

use App\Helpers\MenuHelper;

if (!function_exists('render_menu')) {
    /**
     * Render menu by position
     *
     * @param string $position
     * @param string $classes
     * @return string
     */
    function render_menu($position = 'header', $classes = 'navbar-nav')
    {
        return MenuHelper::renderMenu($position, $classes);
    }
}

if (!function_exists('render_footer_menu')) {
    /**
     * Render footer menu
     *
     * @param string $position
     * @param string $classes
     * @return string
     */
    function render_footer_menu($position = 'footer', $classes = 'list-unstyled')
    {
        return MenuHelper::renderFooterMenu($position, $classes);
    }
}

if (!function_exists('get_menus')) {
    /**
     * Get menus by position
     *
     * @param string $position
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function get_menus($position = 'header')
    {
        return MenuHelper::getMenus($position);
    }
}

if (!function_exists('get_breadcrumb')) {
    /**
     * Get breadcrumb for current page
     *
     * @return array
     */
    function get_breadcrumb()
    {
        return MenuHelper::getBreadcrumb();
    }
}

if (!function_exists('is_menu_active')) {
    /**
     * Check if menu URL is active
     *
     * @param string $url
     * @return bool
     */
    function is_menu_active($url)
    {
        return MenuHelper::isActive($url);
    }
}
