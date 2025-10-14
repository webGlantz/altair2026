<?php
/**
 * Functions: Main
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

// The file must be called through WP.
if (! defined('ABSPATH')) {
	exit;
}

// ---------------------------------------------------------------------
// Constants
// ---------------------------------------------------------------------

// Text domain.
define('TEXTDOMAIN', 'altairadvisers');

// Theme URL.
define('THEME_URL', trailingslashit(get_bloginfo('template_url')));

// Theme Path.
define('THEME_PATH', trailingslashit(dirname(__FILE__)));

if (! defined('TESTMODE')) {
	define('TESTMODE', false !== strpos(site_url(), 'local') ||  false !== strpos(site_url(), 'wpengine'));
}

define('VERSION', (TESTMODE ? microtime() : '20250324953am'));

define('CONTENT_OPEN', '<section class="component component_wysiwyg"><div class="component_wysiwyg__container container container--md t_wysiwyg t_body">');
define('CONTENT_CLOSE', '</div></section>');

// --------------------------------------------------------------------- end constants


// --------------------------------------------------------------------
// Init
// ---------------------------------------------------------------------

require dirname(__FILE__) . '/app/base/common.php';
require dirname(__FILE__) . '/app/base/hook.php';
require dirname(__FILE__) . '/app/hook.php';
require dirname(__FILE__) . '/app/hookGravityForms.php';
require dirname(__FILE__) . '/app/core.php';

\glantz\hook::init();
\glantz\hookGravityForms::init();

// --------------------------------------------------------------------- end init


// Load separate block assets.
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

// Disable auto-sizes.
add_filter('wp_img_tag_add_auto_sizes', '__return_false');
