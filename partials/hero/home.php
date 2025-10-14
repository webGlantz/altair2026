<?php
/**
 * Hero - Home
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

?>

<!-- hero: home -->
<section class="hero hero_home relative z-1 grid text-white">


	<!-- content -->
	<div class="hero_home__top relative z-2 py-48 lg:py-96">

		<div class="container flex flex-col align-start gap-12 lg:gap-24">

			<!-- headline -->
			<h1 class="hero_home__headline hero_home__headline t_h1--xl"><?=$hero['headline']?></h1>

			<!-- text -->
			<?php if($hero['text']) : ?>
				<div class="hero_home__text max-w-460 t_wysiwyg t_body"><?=$hero['text']?></div>
			<?php endif; ?>

			<!-- buttons -->
			<?php if($hero['buttons']) :
				$classes = 'hero_home__btns hero_home__btns relative z-1 mt-12 lg:mt-8 max-w-460';
				$buttons = $hero['buttons'];
				$style = 'auto';
				include locate_template('partials/base/buttons.php', false, false);
			endif; ?>
		</div>
	</div>

	<!-- container -->	
	<div class="hero_home__container relative z-2 container grid">


		<!-- media -->	
		<div class="hero_home__media relative z-1 ar-1:1 lg:ar-16:9" x-data="{
			state: 'playing',

			init() {
				console.log(this.state);
			},

			playPauseVideo() {
				if('playing' === this.state) {
					this.state = 'pause';
					this.$refs.video.pause();
				}

				else {
					this.state = 'playing';
					this.$refs.video.play();
				}
			}

		}">

			<?php 
			if($hero['image'] && 'image' === $hero['type']) : 
				echo core::get_custom_srcset(
					array(
						'lazy'=>false,
						'attachment_id'=>$hero['image'],
						'size'=>'original',
						'sizes'=>'(min-width: 1560px) 778px, (min-width: 1280px) calc(36.92vw + 209px), (min-width: 1040px) 100vw, 149.72vw',
						'classes'=>'hero_home__img absolute inset-0 object-cover -z-1',
					)
				); 

			elseif($hero['video'] && 'video' === $hero['type']) : ?>
				<video class="hero_home__video absolute -z-1 inset-0 w-full h-full object-cover -z-1" autoplay loop muted x-ref="video">
					<source type="video/mp4" src="<?=$hero['video']?>" />
				</video>

				<button class="hero_home__control z-1 flex items-center justify-center" @click.prevent="playPauseVideo" :title="('playing' === state ? 'Pause video' : 'Play video')" :aria-label="('playing' === state ? 'Pause video' : 'Play video')">
					
					<i x-show="'playing' === state" class="fa-solid fa-pause"></i>
					<i x-show="'pause' === state" class="fa-solid fa-play"></i>
				</button>
			<?php endif; ?>
		</div>
			
	</div>
</section>