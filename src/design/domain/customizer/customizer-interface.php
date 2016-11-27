<?php
namespace Affilicious_Theme\Design\Domain\Customizer;

if (!defined('ABSPATH')) {
	exit('Not allowed to access pages directly.');
}

interface Customizer_Interface
{
	/**
	 * Init the options for the theme customizer
	 *
	 * @since 0.3.5
	 * @return array
	 */
	public function init();

	/**
	 * Render the options of the theme customizer
	 *
	 * @since 0.3.5
	 */
	public function render();

	/**
	 * Enqueue all necessary scripts and styles
	 *
	 * @since 0.3.5
	 */
	public function enqueue_scripts();
}
