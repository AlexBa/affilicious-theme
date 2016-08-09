<?php
namespace Affilicious\Theme\Helper;

if(!defined('ABSPATH')) exit('Not allowed to access pages directly.');

class LogoHelper
{
    /**
     * Check if there is a default logo
     *
     * @since 0.2
     * @return bool
     */
    public static function hasLogo()
    {
        $logo = get_theme_mod('affilicious_theme_general_logo');
        return $logo != null;
    }

    /**
     * Get the default logo
     *
     * @return string
     */
    public static function getLogo()
    {
        return get_theme_mod('affilicious_theme_general_logo');
    }

    /**
     * Check if there is a retina logo
     *
     * @return bool
     */
    public static function hasRetinaLogo()
    {
        $logo = get_theme_mod('affilicious_theme_general_logo_retina');
        return $logo != null;
    }

    /**
     * Get the retina logo
     *
     * @return string
     */
    public static function getRetinaLogo()
    {
        return get_theme_mod('affilicious_theme_general_logo_retina');
    }
}
