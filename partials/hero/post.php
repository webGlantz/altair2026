<?php
/**
 * Hero - Post
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


use glantz\core; 

?>

<!-- hero: post -->
<section class="hero hero_post lg:mt-60">
	<div class="relative z-1 container layout-grid gap-24 lg:gap-y-96 py-24 lg:pb-0">

		<!-- bg -->
		<div class="hero_post__bg hero_interior__bg absolute inset-0 -z-1">
			
		</div>


		<div class="hero-top hero_interior__top hero_post__top relative col-4 lg:col-7 xl:col-8 grid gap-48 lg:gap-120 lg:px-36">
			
			<?php include locate_template('partials/misc/breadcrumbs.php', false, false); ?>

			<div class="grid gap-12 lg:gap-0">

				<?php if(!empty($hero['eyebrow'])) : ?>
					<div class="hero_interior__eyebrow t_h6"><?=$hero['eyebrow']?></div>
				<?php endif; ?>

				<h1><?=(isset($hero['headline']) ? $hero['headline'] : get_the_title())?></h1>
			</div>

		</div>
		
	</div>
</section>