<?php
/**
 * Single Team
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('single-team');
});

global $hero;

$hero = core::get_hero($post->ID);

$sections = array(

	'Education'=>get_field('education'),
	'Professional Certifications'=>get_field('certifications'),
	'Personal'=>get_field('personal'),

);

get_header();

if (have_posts()) :
		
	while (have_posts()) :
		the_post(); 

		// Hero. 
		if($hero) :

			include locate_template('partials/hero/team.php', false, false);
			 
		endif; ?>

		<section class="c_single-team component">
			<div class="container layout-grid gap-y-48 items-start">

				<aside class="c_single-team__aside col-4 grid gap-24 lg:gap-48">
					<?php foreach($sections as $label=>$content) :

						if(empty($content)) :
							continue;
						endif;  ?>

						<div class="xl:pr-24 grid gap-12">
							<h2 class="t_h6 text-rust"><?=$label?></h2>
							<div class="t_body t_body--sm"><?=$content?></div>
						</div>
					<?php endforeach; ?>
				</aside>

				<div class="col-4 lg:col-7 lg:start-col-6 grid gap-48">
					
					<div class="t_wysiwyg t_body t_body--sm"><?=the_content()?></div>
				</div>

					
				
			</div>
		</section>

		<?php 

		// Posts by this person.
		$fname = substr($post->post_title, 0, strpos($post->post_title, ' '));

		$data = array(
			'configuration'=>'override',
			'article_cards'=>array(
				'display'=>'author',
				'headline'=>$fname . '\'s Content',
				'author'=>get_the_ID(),
				'button'=>null,
			),
		);

		$block = '<!-- wp:glantz/article-cards {"name":"glantz/article-cards","data":' . json_encode($data) . '} /-->';

		$parsed_blocks = parse_blocks( $block );

		if ( $parsed_blocks ) {
			foreach ( $parsed_blocks as $block ) {
				echo render_block( $block ) ;
			}
		}

	endwhile;

else :
	include locate_template('partials/misc/404', false, false);

endif;

get_footer(); ?>
