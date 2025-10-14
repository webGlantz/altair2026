<?php
/**
 * Block - Carousel Shell (Caroushell)
 *
 * @package Christopher Duquet
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

$count = count($carousel['slides']);

$location = 'blocks/' . $carousel['type'] . '-carousel/' . $carousel['type'] . '-carousel-slide.php';

?>

<div class="carousel carousel-<?=$carousel['type']?> grid" :class="'slide-' + active + '-active'" x-data="carousel(<?=$count?>, <?=$carousel['autoplay']?>)" @mouseover="pauseAutoplay()" @mouseleave="startAutoplay()">

	<div class="carousel__main relative ">
		

		<div class="carousel__slides" x-swipe:right="goTo(active - 1)" x-swipe:left="goTo(active + 1)">
			<?php foreach($carousel['slides'] as $i=>$slide) : ?>
				<div class="carousel__slide carousel-<?=$carousel['type']?>__slide" :class="{ 'is-active' : <?=$i?> == active, 'is-out' : <?=$i?> == out }">
					<?php include locate_template($location, false, false); ?>
				</div>
			<?php endforeach; ?>
		</div>

		
	</div>

	<?php if($carousel['autoplay']) : ?>
		<!-- pause autoplay -->
		<button @click.prevent="toggleAutoplay()" class="carousel__pause group">
			
			<i x-show="autoplay" class="fa fa-solid fa-pause"></i>
			<span x-show="autoplay" class="btn btn--secondary">Pause Animation</span>

			<i x-show="!autoplay" class="fa fa-solid fa-play"></i>
			<span x-show="!autoplay" class="btn btn--secondary">Resume Animation</span>
		</button>
	<?php endif; ?>

</div>