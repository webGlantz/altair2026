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

class core {


	/**
	 * Get Custom Srcset
	 *
	 * Build an image srcset.
	 *
	 * @param array $args The args to pass to the function.
	 * @return string The picture html.
	 */
	public static function get_custom_srcset(array $args) : string {

		$new_image = '';
		$src = \wp_get_attachment_image_src($args['attachment_id'], $args['size']);
		$srcset = \wp_get_attachment_image_srcset($args['attachment_id'], $args['size']);
		$alt = \get_post_meta($args['attachment_id'], '_wp_attachment_image_alt', true);

		if($src) :
			$new_image = '<img ' . ($args['lazy'] ? 'loading="lazy"' : '') . ' src="' . $src[0] . '" srcset="' . $srcset .'" sizes="' . $args['sizes'] . '" alt="' . $alt . '" class="' . $args['classes'] . '" width="' . $src[1] .'" height="' . $src[2] . '" />';
		endif;

		return $new_image;
	}


	/**
	 * Post Selector
	 *
	 * Selects posts based on a block element's display values.
	 * This gives users the ability to choose posts by post type, 
	 * either most recent, by taxonomy, or a custom selection.
	 *
	 * @param array $args The args to pass to the function.
	 * @return array|WP Query The array of returned posts.
	 */
	public static function post_selector(array $args) {

		$settings = array();

		if(empty($args['orderby'])) :
			$args['orderby'] = 'post_date';
		endif; 

		if(empty($args['order'])) :
			$args['order'] = 'DESC';
		endif; 


		if ('recent' === $args['display'] || 'all' === $args['display']) :
			$settings = array(
				'numberposts'=>$args['showposts'],
				'posts_per_page'=>$args['showposts'],
				'post_type'=>$args['post_type'],
				'orderby'=>$args['orderby'],
				'order'=>$args['order'],
				'exclude'=>$args['exclude'],
				'suppress_filters'=>false,
				'paged'=>\get_query_var('paged'),
			);

			if(isset($args['pagination']) && $args['pagination']) :
				$posts = new \WP_Query($settings);
			else :
				$posts = get_posts($settings);
			endif;

		elseif ('custom' === $args['display']) :
			$posts = array();

			if(isset($args['pagination']) && $args['pagination']) :
				$settings = array(
					'numberposts'=>-1,
					'post_type'=>$args['post_type'],
					'exclude'=>$args['exclude'],
					'suppress_filters'=>false,
					'post__in'=>$args['custom'],
					'paged'=>\get_query_var('paged'),
				);

				$posts = new \WP_Query($settings);
			else :
				foreach ($args['custom'] as $i) :
					$posts[] = get_post($i);
				endforeach;
			endif;
			
		else :
			$settings = array(
				'numberposts'=>$args['showposts'],
				'posts_per_page'=>$args['showposts'],
				'post_type'=>$args['post_type'],
				'orderby'=>$args['orderby'],
				'order'=>$args['order'],
				'tax_query'=>array(
					array(
						'taxonomy'=>$args['display'],
						'field'=>'id',
						'terms'=>(is_array($args[$args['display']]) ? $args[$args['display']] : array($args[$args['display']])),
					),
				),
				'exclude'=>$args['exclude'],
				'suppress_filters'=>false,
				'paged'=>\get_query_var('paged'),
			);

			if(isset($args['pagination']) && $args['pagination']) :
				$posts = new \WP_Query($settings);
			else :
				$posts = get_posts($settings);
			endif;
		endif;

		return $posts;
	}


	/**
	 * Get navigation
	 *
	 * Fetches a specic WP menu and returns a formatted version.
	 *
	 * @param string $menu The menu slug.
	 * @return array $navigation The formatted array for the navigation menu.
	 */
	public static function get_nav(string $menu) : array {

		global $wp_query;
		global $post;

		$navigation = array();
		$links = \wp_get_nav_menu_items($menu);
		$subs = array();
		$current = array();


		if ($links) {

			// Get our array of submenus.
			foreach ($links as $l) {

				

				if (0 !== $l->menu_item_parent) {

					$is_current = (\is_single() && (int) $post->ID === (int) $l->object_id ? true : false);

					$p = \get_post($l->object_id);

					if (isset($post->post_parent) && 0 !== (int) $post->post_parent && (int) $l->object_id === (int) $post->post_parent) {
						$is_current = true;
					}

					if (
						(\is_archive() || \is_home() || \is_singular()) &&
						isset($wp_query->query['post_type']) &&
						(! \is_array($wp_query->query['post_type']) || \count($wp_query->query['post_type']) <= 1) &&
						false !== \strpos(\get_post_type_archive_link($post->post_type), $l->url) ) {
						$is_current = true;
					}

					if ($is_current) {
						$current[$l->menu_item_parent] = true;
					}

					$subs[$l->menu_item_parent][] = array(
						'classes'=>$l->classes,
						'current'=>$is_current,
						'target'=>$l->target,
						'title'=>$l->title,
						'url'=>$l->url,

					);
				}
			}

			foreach ($links as $l) {

				if(!empty($wp_query->query['post_type']) || !empty($post->post_type)) :
					$post_type = isset($wp_query->query['post_type']) ? $wp_query->query['post_type'] : $post->post_type;
				else :
					$post_type = 'null';
				endif;

				if (0 !== (int) $l->menu_item_parent) {
					continue;
				}

				$current[$l->ID] = ( (isset($post->ID) && (int) $post->ID === (int) $l->object_id) || (isset($current[$l->ID]) && $current[$l->ID]) || (isset($current['parents'][$l->object_id]) && $current['parents'][$l->object_id]) );

				if (
					(\is_archive() || \is_home() || \is_singular()) &&
					isset($post_type) &&
					(! \is_array($post_type) || \count($post_type) <= 1) &&
					false !== \strpos(\get_post_type_archive_link($post->post_type), $l->url)
				) {

					$current[$l->ID] = true;
				}

				$item = array(
					'classes'=>$l->classes,
					'current'=>$current[$l->ID],
					'id'=>\sanitize_title($l->title),
					'target'=>$l->target,
					'title'=>$l->title,
					'type'=>'regular',
					'sub'=>null,
					'url'=>$l->url,
				);

				if (isset($subs[$l->ID])) :
					$item['sub'] = $subs[$l->ID];
					$item['style'] = 'simple';
				
				elseif($item['url'] === \get_post_type_archive_link('program')) :
					$item['style'] = 'programs';
					$item['sub'] = core::get_programs_by_cat();
				endif; 

				$navigation[] = $item;
			}

		}

		return $navigation;

	}


	/**
	 * Get Hero
	 *
	 * Formats a hero
	 *
	 * @param int $id The page ID.
	 * @return array The formatted hero.
	 */
	public static function get_hero($id) {
		global $hero;

		// Always return an array, even if hero field is empty/null
		$hero = \get_field('hero', $id);
		if (!is_array($hero)) {
			$hero = []; // fallback to empty array
		}

		// Add featured image regardless
		$hero['image'] = get_post_thumbnail_id($id);

		// Determine style
		if(!isset($hero['style']) || !$hero['style']) :
			if (get_option('page_on_front') == $id) {
				$hero['style'] = 'home';
			} 
			elseif(get_option('page_for_posts') == $id) {
				$hero['style'] = 'featured-post';
			} elseif (is_singular('post') && get_the_ID() === $id) {
				$hero['style'] = 'single-post';
			} elseif (!$hero['image']) {
				$hero['style'] = 'interior';
			} else {
				$hero['style'] = 'interior';
			}
		endif;

		// Set fallback headline
		$hero['headline'] = !empty($hero['headline']) ? $hero['headline'] : get_the_title($id);

		// Add body class for styling
		\add_filter('body_class', function($classes) use ($hero) {
			$classes[] = 'hero:' . $hero['style'];
			return $classes;
		});

		return $hero;
	}



	/**
	 * Get Terms by Post Type
	 *
	 * If multiple post types share a taxonomy, 
	 * this function allows you to get only the terms
	 * that include items of a specific post type.
	 *
	 * @param int $id The page ID.
	 * @return array The formatted hero.
	 */
	public static function get_terms_by_post_type( $taxonomy = 'category', $post_type = 'post', $args = array() ) {
		global $wpdb;

		$sql = $wpdb->prepare(
		    "
		        SELECT
		            {$wpdb->prefix}term_taxonomy.term_id
		        FROM
		            {$wpdb->prefix}term_relationships
		        LEFT JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}term_relationships.object_id = {$wpdb->prefix}posts.ID
		        LEFT JOIN {$wpdb->prefix}term_taxonomy ON {$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id
		        WHERE
		            {$wpdb->prefix}term_taxonomy.taxonomy = '%s'
		        AND {$wpdb->prefix}posts.post_type = '%s'
		        GROUP BY
		            term_id
		    ",
		    $taxonomy,
		    $post_type,
		);
		$term_ids = $wpdb->get_col( $sql );

		if ( empty( $term_ids ) ) {
		    return array();
		}

		// custom code to allow for exclude to work
		if ( ! empty( $args['exclude'] ) ) {
		    // allow exclude to be either a string or array
		    $exclude = is_string(  $args['exclude'] ) ? (array) $args['exclude'] : $args['exclude'];
		    
		    // filter $term_ids with array from $args['exclude']
		    $term_ids = array_filter( $term_ids, function( $term_id ) use ( $exclude ) {
		        return ! in_array( $term_id, $exclude );
		    } );
		}

		$args = wp_parse_args(
		    $args,
		    array(
		        'taxonomy' => $taxonomy,
		        'include' => $term_ids,
		    ),
		);

		return get_terms( $args );
	}


}
