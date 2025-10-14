<?php
/**
 * Glantz: Hooks
 *
 * All action and filter binding for the plugin happens by calling
 * ::init() once after load.
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

namespace glantz;

class hook extends base\hook {

	// Actions: hook=>[callbacks].
	const ACTIONS = array(
		'wp_enqueue_scripts'=>array(
			'scripts'=>array('priority'=>100),
			'styles'=>array('priority'=>100),
		),

		'admin_enqueue_scripts'=>array(
			'admin_styles'=>array('priority'=>100),
		),

		'after_setup_theme'=>array(
			'theme_config'=>array('priority'=>5),
			'menus'=>null,
		),

		'init'=>array(
			'post_types'=>null,
			'taxonomies'=>null,
			'image_sizes'=>null,
			'register_blocks'=>null,
		),

		'wpseo_metabox_prio'=>array(
			'yoasttobottom'=>null,
		),

		

	);

	// Actions to remove. 
	const REMOVE = ARRAY(
		'wp_head'=>array(
			'rest_output_link_wp_head'=>null,
			'wp_oembed_add_discovery_links'=>null,
		),

		'template_redirect'=>array(
			'rest_output_link_header'=>array(
				'priority'=>11,
			),
		),
	);


	// Filters: hook=>[callbacks].
	const FILTERS = array(
		'body_class'=>array(
			'body_class'=>null,
		),
		'jpeg_quality'=>array(
			'jpeg_quality'=>null,
		),
		'upload_mimes'=>array(
			'upload_mimes'=>null,
		),
		'big_image_size_threshold'=>array(
			'big_image_size_threshold'=>null,
		),

		'block_categories_all'=>array(
			'add_block_categories'=>null,
		),

		'tiny_mce_before_init'=>array(
			'remove_h1_from_heading'=>array(
				'remove_h1_from_heading'=>null,
			)
		),
	);


	/**
	 * Blocks
	 *
	 * An array to hold all the blocks in the theme. 
	 * We will use this to dynamically register them,
	 * as well as their scripts and styles.
	 *
	 * @var array
	 */
	protected static $_blocks = array();

	/**
	 * Get Blocks
	 *
	 * Get the blocks
	 *
	 * @return array
	 */
	public static function get_blocks() : array {

		$blocks = static::$_blocks;
		$base = THEME_PATH . "blocks/";
		$glob = glob($base . "*");

		if(!$blocks) {
			foreach ($glob as $filename) {
				$slug = str_replace($base, '', $filename);
				$blocks[] = $slug;
			}
		}

		return $blocks;
	}


	// -----------------------------------------------------------------
	// Header Business
	// -----------------------------------------------------------------

	/**
	 * Enqueue Scripts
	 *
	 * @return void Nothing.
	 */
	public static function scripts() : void {

		\wp_enqueue_script(
			'libs',
			\get_stylesheet_directory_uri() . '/assets/js/libs.min.js',
			array(),
			\VERSION,
			array(
				'in_footer'=> true,
		        'strategy' => 'defer'
		    )
		);

		$deps = array('libs');

		\wp_enqueue_script(
			'core',
			\get_stylesheet_directory_uri() . '/assets/js/core.min.js',
			array(),
			\VERSION,
			true
		);

		$blocks = static::get_blocks();

		foreach($blocks as $block) :
			\wp_register_script(
				$block,
				\get_stylesheet_directory_uri() . '/assets/js/block-' . $block . '.min.js',
				array(),
				\VERSION,
				true
			);
		endforeach;

		\wp_register_script(
			'carousel',
			\get_stylesheet_directory_uri() . '/assets/js/carousel.min.js',
			array(),
			\VERSION,
			true
		);

		\wp_register_script(
			'feed-blog',
			\get_stylesheet_directory_uri() . '/assets/js/feed-blog.min.js',
			array(),
			\VERSION,
			true
		);
	}

	/**
	 * Enqueue Styles
	 *
	 * @return void Nothing.
	 */
	public static function styles() : void {
		//\wp_dequeue_style( 'wp-block-library' );
		//\wp_dequeue_style( 'wp-block-library-theme' );

		\wp_enqueue_style(
			'core',
			\get_stylesheet_directory_uri() . '/assets/css/core.min.css',
			array(),
			\VERSION
		);

		$blocks = static::get_blocks();

		foreach($blocks as $block) :
			\wp_register_style(
				$block,
				\get_stylesheet_directory_uri() . '/assets/css/block-' . $block . '.min.css',
				array(),
				\VERSION,
			);
		endforeach;

		\wp_register_style(
			'carousel',
			\get_stylesheet_directory_uri() . '/assets/css/carousel.min.css',
			array(),
			\VERSION,
		);

		\wp_register_style(
			'single-post',
			\get_stylesheet_directory_uri() . '/assets/css/single-post.min.css',
			array(),
			\VERSION,
		);

		\wp_register_style(
			'feed-blog',
			\get_stylesheet_directory_uri() . '/assets/css/feed-blog.min.css',
			array(),
			\VERSION,
		);
		
	}

	/**
	 * Enqueue Admin Styles
	 *
	 * @return void Nothing.
	 */
	public static function admin_styles() : void {
		

		\wp_enqueue_style(
			'clean-editor',
			\get_stylesheet_directory_uri() . '/assets/css/clean-editor.min.css',
			array(),
			\VERSION
		);
		
		
	}

	// ----------------------------------------------------------------- end header


	// -----------------------------------------------------------------
	// General Config
	// -----------------------------------------------------------------

	/**
	 * Misc Theme Settings
	 *
	 * @return void Nothing.
	 */
	public static function theme_config() : void {

		// Use modern WP titles.
		\add_theme_support('title-tag');

		if ( \function_exists('acf_add_options_page') ) {
			\acf_add_options_page(array(
				'page_title'=>'Theme Options'
			));
		}

	}


	/**
	 * Menus
	 *
	 * @return void Nothing.
	 */
	public static function menus() : void {
		\register_nav_menus(array(
			'header-primary-navigation'=>'Header Primary Navigation',
			'footer-quick-links'=>'Footer Quick Links',
			'footer-contact'=>'Footer Contact',
			'footer-utility'=>'Footer Utility',
		));
	}


	/**
	 * Image Sizes
	 *
	 * @return void Nothing.
	 */
	public static function image_sizes() : void {
		// Enable thumbnails.
		\add_theme_support('post-thumbnails');

		add_image_size('preview', 100, 100, true);

		add_image_size('altair-450', 450, 9999, false);
		add_image_size('altair-780', 780, 9999, false);
		add_image_size('altair-1080', 1080, 9999, false);
		add_image_size('altair-1380', 1380, 9999, false);
		add_image_size('altair-1620', 1620, 9999, false);
		add_image_size('altair-1850', 1850, 9999, false);
		add_image_size('altair-2048', 2048, 9999, false);
		add_image_size('altair-2560', 2560, 9999, false);
		
	}


	/**
	 * Register Blocks
	 *
	 * @return void Nothing.
	 */

	public static function register_blocks() {

		$blocks = static::get_blocks();

		foreach($blocks as $block) :
			register_block_type(dirname(dirname(__FILE__)) . '/blocks/' . $block);
		endforeach;
	}


	/**
	 * Add block categories
	 *
	 * @return array $categories
	 */

	public static function add_block_categories($categories) {

		// Adding a new category.
		$categories[] = array(
			'slug'  => 'glantz-blocks',
			'title' => 'Glantz Blocks'
		);

		return $categories;
	}


	/**
	 * Post Types
	 *
	 *	@return void Nothing.
	 */
	public static function post_types() : void {

		\register_post_type(
			'person',
			array(
				'label'=>'Team Members',
				'labels'=>array(
					'add_new_item'=>'Add New Team Member',
				),
				'public'=>true,
				'show_ui'=>true,
				'show_in_menu'=>true,
				'hierarchical'=>true,
				'has_archive'=>'our-team',
				'rewrite'=>array('slug'=>'team'),
				'menu_icon'=>'dashicons-groups',
				'supports'=>array('title', 'thumbnail', 'revisions'),
				'taxonomies'=>array('team_category'),
			)
		);

		\register_post_type(
			'testimonial',
			array(
				'label'=>'Testimonials',
				'labels'=>array(
					'add_new_item'=>'Add New Testimonial',
				),
				'public'=>false,
				'show_ui'=>true,
				'show_in_menu'=>true,
				'hierarchical'=>false,
				'has_archive'=>false,
				'menu_icon'=>'dashicons-testimonial',
				'supports'=>array('title', 'thumbnail', 'editor', 'revisions'),
				'taxonomies'=>array('testimonial_category'),
			)
		);
	}

	/**
	 * Taxonomies
	 *
	 *	@return void Nothing.
	 */
	public static function taxonomies() : void {
		register_taxonomy(
			'team_category',
			array('person'),
			array(
				'label'=>'Categories',
				'labels'=>array(
					'add_new_item'=>'Add New Category',
				),
				'public'=>false,
				'show_ui'=>true,
				'show_in_menu'=>true,
				'show_in_quick_edit'=>true,
				'show_admin_column'=>true,
				'show_in_rest'=>true,
				'hierarchical'=>true,
			)
		);

		register_taxonomy(
			'testimonial_category',
			array('testimonial'),
			array(
				'label'=>'Categories',
				'labels'=>array(
					'add_new_item'=>'Add New Category',
				),
				'public'=>false,
				'show_ui'=>true,
				'show_in_menu'=>true,
				'show_in_quick_edit'=>true,
				'show_admin_column'=>true,
				'show_in_rest'=>true,
				'hierarchical'=>true,
			)
		);
	}


	/**
	 * Extend Body Classes
	 *
	 * @param array $classes Classes.
	 * @return array Classes.
	 */
	public static function body_class(array $classes) : array {
		if (\is_singular()) {
			global $post;
			$classes[] = "type:{$post->post_type}";
			$classes[] = "slug:{$post->post_name}";
			$classes[] = "{$post->post_type}:{$post->post_name}";
		}

		global $template;
		$file_slug = \basename($template);
		$file_slug = \preg_replace('/\.php$/i', '', $file_slug);
		$classes[] = 'template:' . $file_slug;

		$classes[] = (\TESTMODE ? 'mode:test' : 'mode:live');
		$classes[] = 'user:' . get_current_user_id();

		return $classes;
	}

	/**
	 * JPEG Quality
	 *
	 * WordPress sets the JPEG quality too low by default. This runs
	 * with the default priority, so if a theme needs to it can set its
	 * own quality level by hooking at a higher priority (11+).
	 *
	 * @param int $quality Quality.
	 * @return int Quality.
	 */
	public static function jpeg_quality(int $quality) : int {
		$quality = 95;
		return $quality;
	}


	/**
	 * Upload Mimes
	 *
	 * @param array $allowed Allowed Mimetypes.
	 * @return array Allowed.
	 */
	public static function upload_mimes (array $allowed=array()) : array {
		$allowed['svg'] = 'image/svg+xml';
		return $allowed;
	}


	/**
	 * Big Image size threshold
	 *
	 * @return int Threshhold.
	 */
	public static function big_image_size_threshold() : int {
		return 2560;
	}

	// ----------------------------------------------------------------- end config

	public static function yoasttobottom() {
		return 'low';
	}

	public static function remove_h1_from_heading($args) {
		// Just omit h1 from the list
		$args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Pre=pre';
		return $args;
	}
}
