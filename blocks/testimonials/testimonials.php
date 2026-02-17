<?php
/**
 * Block - Testimonials
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

$args = array(
	'display'=>$fields['display'],
	'showposts'=>5,
	'post_type'=>'testimonial',
	'exclude'=>null,
);

$fields = array_merge($fields, $args);

$items = core::post_selector($fields);

if(!$items) :
	return;
endif; 

echo CONTENT_CLOSE;

?>

<!-- component: testimonials -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_testimonials relative z-1" data-aos="fade-up" data-aos-duration="1000">

	<div class="c_testimonials__container container ">
		

		<div class="c_testimonials__content relative z-1 layout-grid grid items-end gap-12 lg:gap-24">

			<!-- headline -->
			<?php if($fields['headline']) : ?>
				<h2 class="c_testimonials__headline col-4 lg:col-5 pr-96">
					<?=$fields['headline']?>
				</h2>
			<?php endif; ?>

			<!-- text -->
			<?php if($fields['text']) : ?>
				<div class="c_testimonials__text relative z-1 col-4 lg:col-5 xl:col-6 xl:pl-36 t_wysiwyg t_body"><?=$fields['text']?></div>
			<?php endif; ?>


			<button class="c_testimonials__pause-btn hidden lg:block lg:start-col-12">
				<i class="fa fas fa-pause"></i>
				<i class="fa fas fa-play hidden"></i>
			</button>

		</div>
	</div>


		<?php if(!empty($items)) : ?>
			<div class="c_testimonials__wrapper mt-96 lg:mt-72">

				<ul class="c_testimonials__track">
					
					<?php foreach($items as $slide) : 


						$name = get_field('name', $slide->ID);
						$position = get_field('position', $slide->ID); ?>

						<li class="c_testimonials__slide">
							
							<div class="lg:flex">
								<div class="c_testimonials__image relative z-1 ar-1:1 lg:ar-4:5">
									<?php echo core::get_custom_srcset(
										array(
											'lazy'=>true,
											'attachment_id'=>get_post_thumbnail_id($slide->ID),
											'size'=>'original',
											'sizes'=>'(min-width: 1040px) 572px, (min-width: 960px) 1625px, calc(177.5vw - 44px)',
											'classes'=>'c_testimonials__img absolute inset-0 object-cover',
										)
									); ?>
								</div>

								<div class="c_testimonials__attr flex flex-col justify-center gap-24 lg:gap-36 p-24 xl:py-72 xl:px-48">
									<div class="c_testimonials__quote t_h5">
										<?=apply_filters('the_content', $slide->post_content)?>
									</div>

									<?php if(!empty($name) || !empty($position)) : ?>
										<div class="">
											<?php if(!empty($name)) : ?>
												<div class="t_label t_label--lg text-rust"><?=$name?></div>
											<?php endif; ?>

											<?php if(!empty($position)) : ?>
												<div class="t_body t_body--sm"><?=$position?></div>
											<?php endif; ?>

										</div>
									<?php endif; ?>
								</div>
							</div>


						</li>
					<?php endforeach; ?>
		
				</ul>
			</div>

		<?php endif; ?>



</section>

<?php 

echo CONTENT_OPEN;