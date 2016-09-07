<?php
use Affilicious\Theme\Design\Domain\Helper\LogoHelper;
use Affilicious\Theme\Design\Domain\Helper\MenuHelper;
use Affilicious\Product\Domain\Helper\PostHelper;
use Affilicious\Product\Domain\Model\Product;
use Affilicious\Product\Domain\Model\Shop;
use Affilicious\Product\Domain\Helper\ProductHelper;
use Affilicious\Theme\Design\Application\Setup\SidebarSetup;
use Affilicious\Theme\Design\Domain\Walker\BootstrapCommentWalker;
use Affilicious\Theme\Settings\Application\Setting\DesignSettings;

/**
 * Check if every requirement like the main plugin is installed correctly
 * before we can print anything to the screen.
 * Print an error message if the required Affilicious Plugin is missing.
 *
 * @since 0.3.5
 */
function affilicious_theme_check_requirements()
{
	if (!class_exists('\AffiliciousPlugin')) {
		wp_footer();
		echo '<br><br><br>';
		exit(__('Failed to find the required Affilicious plugin. Please open your admin area and install the missing plugin.', 'affilicious-theme'));
	}
}

/**
 * Get the used shop of the given product.
 * If you pass in nothing as a product, the current post will be used.
 * If you pass in nothing as a shop, the first shop will be used.
 *
 * @since 0.3
 * @param int|\WP_Post|Product|null $productOrId
 * @param int|\WP_Post|Shop|null $shopOrId
 * @return array|null
 */
function affilicious_theme_get_product_shop($productOrId, $shopOrId)
{
	$product = affilicious_get_product($productOrId);
	$shop = ProductHelper::getShop($product, $shopOrId);

	return $shop;
}

/**
 * Check if there is a main menu.
 *
 * @since 0.2
 * @return bool
 */
function affilicious_theme_has_main_menu()
{
	$mainMenu = MenuHelper::getMainMenu();
	$result = $mainMenu->exists();

    return $result;
}

/**
 * Get the main menu.
 *
 * @since 0.2
 */
function affilicious_theme_main_menu()
{
	$mainMenu = MenuHelper::getMainMenu();
	$mainMenu->render();
}

/**
 * Check if there is a footer 1 menu.
 *
 * @since 0.3.4
 * @return bool
 */
function affilicious_theme_has_bottom_1_menu()
{
	$footer1Menu = MenuHelper::getBottom1Menu();
	$result = $footer1Menu->exists();

	return $result;
}

/**
 * Get the footer 1 menu.
 *
 * @since 0.3.4
 */
function affilicious_theme_bottom_1_menu()
{
	$footer1Menu = MenuHelper::getBottom1Menu();
	$footer1Menu->render();
}

/**
 * Check if there is a footer 2 menu.
 *
 * @since 0.3.4
 * @return bool
 */
function affilicious_theme_has_bottom_2_menu()
{
	$footer2Menu = MenuHelper::getBottom2Menu();
	$result = $footer2Menu->exists();

	return $result;
}

/**
 * Get the footer 2 menu.
 *
 * @since 0.3.4
 */
function affilicious_theme_bottom_2_menu()
{
	$footer2Menu = MenuHelper::getBottom2Menu();
	$footer2Menu->render();
}

/**
 * Check if there is a footer 3 menu.
 *
 * @since 0.3.4
 * @return bool
 */
function affilicious_theme_has_bottom_3_menu()
{
	$footer3Menu = MenuHelper::getBottom3Menu();
	$result = $footer3Menu->exists();

	return $result;
}

/**
 * Get the footer 3 menu.
 *
 * @since 0.3.4
 */
function affilicious_theme_bottom_3_menu()
{
	$footer3Menu = MenuHelper::getBottom3Menu();
	$footer3Menu->render();
}

/**
 * Check if there is a footer 4 menu.
 *
 * @since 0.3.4
 * @return bool
 */
function affilicious_theme_has_bottom_4_menu()
{
	$footer4Menu = MenuHelper::getBottom4Menu();
	$result = $footer4Menu->exists();

	return $result;
}

/**
 * Get the footer 4 menu.
 *
 * @since 0.3.4
 */
function affilicious_theme_bottom_4_menu()
{
	$footer4Menu = MenuHelper::getBottom4Menu();
	$footer4Menu->render();
}

/**
 * Check if there is a default logo.
 *
 * @since 0.2
 * @return bool
 */
function affilicious_theme_has_logo()
{
    return LogoHelper::hasLogo();
}

/**
 * Get the default logo.
 *
 * @since 0.2
 * @return string
 */
function affilicious_theme_get_logo()
{
    return LogoHelper::getLogo();
}

/**
 * Check if there is a retina logo.
 *
 * @since 0.2
 * @return bool
 */
function affilicious_theme_has_retina_logo()
{
    return LogoHelper::hasRetinaLogo();
}

/**
 * Get the retina logo.
 *
 * @since 0.2
 * @return string
 */
function affilicious_theme_get_retina_logo()
{
    return LogoHelper::getRetinaLogo();
}

/**
 * Check if the product sidebar is active.
 *
 * @since 0.3
 * @param int|\WP_Post|Product|null $productOrId
 * @return bool
 */
function affilicious_theme_is_active_product_sidebar($productOrId = null)
{
    $post = PostHelper::getPost($productOrId);
    $sidebar = carbon_get_post_meta($post->ID, SidebarSetup::PRODUCT_SIDEBAR);
    if (empty($sidebar)) {
        return false;
    }

    $active = is_dynamic_sidebar($sidebar);

    return $active;
}

/**
 * Get the product sidebar.
 * This function prints the result directly to the screen.
 *
 * @since 0.4
 * @param int|\WP_Post|Product|null $productOrId
 */
function affilicious_theme_get_product_sidebar($productOrId = null)
{
    $post = PostHelper::getPost($productOrId);
    $sidebar = carbon_get_post_meta($post->ID, SidebarSetup::PRODUCT_SIDEBAR);
    if (!empty($sidebar)) {
        dynamic_sidebar($sidebar);
    }
}

/**
 * List the comments with bootstrap components.
 * This function is just a wrapper for wp_list_comments.
 *
 * @see https://codex.wordpress.org/Function_Reference/wp_list_comments
 * @since 0.3.4
 * @param array $args
 */
function affilicious_theme_list_comments($args = array())
{
	$args = wp_parse_args($args, array(
		'style'       => 'ul',
		'max_depth'   => 1,
		'short_ping'  => true,
		'avatar_size' => '64',
		'walker'      => new BootstrapCommentWalker(),
	));

	wp_list_comments($args);
}

/**
 * Check if we have to link the product image gallerie with an affiliate link
 *
 * @since 0.4.2
 * @return bool
 */
function affilicious_theme_link_product_image_gallery()
{
	$raw = carbon_get_theme_option(DesignSettings::SETTING_PRODUCT_IMAGE_GALLERY_CLICK_ACTION);
	$result = $raw === 'open_shop' ? true : false;

	return $result;
}

/**
 * Check if we have to link the product preview image with an affiliate link
 *
 * @since 0.4.2
 * @return bool
 */
function affilicious_theme_link_product_preview_image()
{
	$raw = carbon_get_theme_option(DesignSettings::SETTING_PRODUCT_PREVIEW_IMAGE_CLICK_ACTION);
	$result = $raw === 'open_shop' ? true : false;

	return $result;
}

/**
 * Check if the post has the current post type
 *
 * @since 0.4.2
 * @param $type
 * @return bool
 */
function affilicious_theme_is_post_type($type)
{
	global $wp_query;

	if($type == get_post_type($wp_query->post->ID)) {
		return true;
	}

	return false;
}
