<?php
/**
 * Hero - Team
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


use glantz\core; 

$position = get_field('position');

$contact = array(
	'phone'=>get_field('phone'),
	'email'=>get_field('email'),
	'linkedin'=>get_field('linkedin'),
);

$contact = array_filter($contact, fn($_, $key) => !empty($contact[$key]), ARRAY_FILTER_USE_BOTH);

?>

<!-- hero: team -->
<section class="hero hero_team relative z-1 bg-blue text-white">

	

	<div class="relative z-1 container layout-grid gap-24 lg:gap-y-96 items-start lg:items-center">

		<!-- image -->
		<div class="hero_team__image relative -z-1 col-4 ar-1:1">
			
			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>false,
					'attachment_id'=>$hero['image'],
					'size'=>'original',
					'sizes'=>'(min-width: 1024px) 50vw, 100vw',
					'classes'=>'hero_interior__img absolute inset-0 object-cover -z-1',
				)
			); ?>
		</div>


		<div class="hero-top hero_interior__top hero_team__top relative col-4 lg:col-7 lg:start-col-6 grid gap-12">
			<!-- name -->
			<h1><?=(isset($hero['headline']) ? $hero['headline'] : get_the_title())?></h1>	

			<?php if(!empty($position)) : ?>
				<!-- position -->
				<div class="t_body t_body--lg"><?=$position?></div>
			<?php endif; ?>


			<?php if(!empty($contact)) : ?>
				<div class="flex items-center gap-12 lg:gap-24 t_body t_body--lg">
					<?php foreach($contact as $label=>$i) :
						if('phone' === $label) :
							$i = 'tel:' .  $i;
						elseif('email' === $label) :
							$i = 'mailto:' . $i;
							$label = 'envelope';
						endif;  ?>
						<a href="<?=$i?>">
							<i class="fa fas fa-<?=$label?>"></i>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		
	</div>

</section>