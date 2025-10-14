<?php
/**
 * Hero - Single Post
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

?>

<!-- hero: single post -->
<div class="hero hero_post relative z-1 grid">
	
	<div class="container">
		<div class="hero_post__grid grid gap-24 lg:gap-48 items-start overflow-hidden">

			<!-- content  -->
			<div class="flex flex-col align-start gap-12 lg:gap-24">

				<?php include locate_template('partials/misc/breadcrumbs.php', false, false); ?>

				<!-- headline -->
				<h1 class="hero_post__headline hero_home__headline"><?=$hero['headline']?></h1>

				<!-- text -->
				<?php if(!empty($hero['text'])) : ?>
					<div class="hero_post__text relative z-1 mb-auto t_wysiwyg t_body"><?=$hero['text']?></div>
				<?php endif; ?>

				<!-- buttons -->
				<?php if(!empty($hero['buttons'])) :
					$classes = 'hero_post__btns hero_home__btns relative z-1 mt-12 lg:mt-24';
					$buttons = $hero['buttons'];
					$style = 'btn--secondary mode-dark';
					include locate_template('partials/base/buttons.php', false, false);
				endif; ?>
			</div>

			<!-- image -->	
			<div class="hero_post__image relative z-1 ar-4:3 rounded overflow-hidden">
				<?php echo core::get_custom_srcset(
					array(
						'lazy'=>false,
						'attachment_id'=>$hero['image'],
						'size'=>'original',
						'sizes'=>'(min-width: 1400px) 669px, (min-width: 1140px) calc(-13.33vw + 940px), (min-width: 1040px) calc(-50vw + 1432px), calc(98.75vw - 27px)',
						'classes'=>'hero_post__img absolute inset-0 object-cover -z-1',
					)
				); ?>
			</div>
		</div>
	</div>


</div>
