<?php
/**
 * Search
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


if(isset($_GET['post_type']) && 'post' === $_GET['post_type']) :
	include locate_template('index.php', false, false); 
	exit;
endif;


get_header();

if (have_posts()) :

	$hero = array(
		'headline'=>'Search results for &ldquo;' . get_search_query() . '&rdquo;',
		'style'=>'interior',
		'image'=>0,
		'text'=>'',
		'cta_configuration'=>'disable',
	);

	include locate_template('partials/hero/' . $hero['style'] . '.php', false, false); ?>


	<section class="search-results component">
		<div class="container flex flex-col gap-24 lg:gap-48">
			<div class="grid gap-24 lg:gap-48">
		 		<?php 

		 		// Post.
		 		while(have_posts()) :
		 			the_post();
		 			include locate_template('partials/misc/search-result.php', false, false);
		 		endwhile; 

		 		?>
			</div>

			<?php include locate_template('partials/misc/pagination.php', false, false); ?>
		</div>
	</section>


 	

<?php 

else :
 	get_template_part('partials/misc/404');

endif;

get_footer();
