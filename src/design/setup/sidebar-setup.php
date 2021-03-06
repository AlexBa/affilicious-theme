<?php
namespace Affilicious_Theme\Design\Setup;

use Affilicious_Theme\Design\Sidebar\Footer_Sidebar;
use Affilicious_Theme\Design\Sidebar\Main_Sidebar;
use Carbon_Fields\Container as Carbon_Container;
use Carbon_Fields\Field as Carbon_Field;

if(!defined('ABSPATH')) {
    exit('Not allowed to access pages directly.');
}

class Sidebar_Setup
{
    const PRODUCT_SIDEBAR = 'affilicious_theme_product_sidebar';

    /**
     * @var Main_Sidebar
     */
    private $main_sidebar;

    /**
     * @var Footer_Sidebar
     */
    private $footer_sidebar;

    /**
     * @since 0.6
     */
    public function __construct()
    {
        $this->main_sidebar = new Main_Sidebar();
        $this->footer_sidebar = new Footer_Sidebar();
    }

    /**
     * @inheritdoc
     * @since 0.6
     */
    public function init()
    {
        $this->main_sidebar->init();
        $this->footer_sidebar->init();
    }

    /**
     * @since 0.6
     * @param array $params
     * @return array
     */
    function modify_sidebar_params($params)
    {
        global $wp_registered_widgets;

        if(!isset($wp_registered_widgets[$params[0]['widget_id']]['callback'][0])) {
            return $params;
        }

        $settings_getter = $wp_registered_widgets[$params[0]['widget_id']]['callback'][0];
        if(!method_exists($settings_getter, 'get_settings')) {
            return $params;
        }

        $settings = $settings_getter->get_settings();
        $id_base = $settings_getter->id_base;

        if(!isset($settings[$params[1]['number']])) {
            return $params;
        }

        $settings = $settings[$params[1]['number']];

        if ($id_base == 'search' && isset($settings['title']) && empty($settings['title'])) {
            $params[0]['before_widget'] .= '<div class="widget-body">';
        }

        return $params;
    }
}
