<?php
/**
 * Block - Image + Headline + Text
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

echo CONTENT_CLOSE;

?>

?>

<!-- component: image + headline + text -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_ac relative z-1 c_ac--<?=$fields['layout']?>">

	<div class="c_ac__container container grid gap-48 lg:gap-60">

		<div class="layout-grid gap-12 lg:gap-48">
			<!-- headline -->
			<?php if($fields['headline']) : ?>
				<h2 class="c_ac__headline col-4 lg:col-6 lg:pr-24 xl:pr-60 max-w-600">
					<?=$fields['headline']?>
				</h2>
			<?php endif; ?>

			<!-- text -->
			<?php if($fields['text']) : ?>
				<div class="c_ac__text relative z-1 col-4 lg:col-5 lg:start-col-7 self-end max-w-600 t_wysiwyg t_body t_body--sm"><?=$fields['text']?></div>
			<?php endif; ?>
		</div>

		<div class="grid gap-48 lg:gap-0">
			<?php foreach($fields['items'] as $index=>$i) : 
				$aos = ($index % 2 === 1)
				? 'data-aos="fade-right" data-aos-duration="1000"'
				: 'data-aos="fade-left" data-aos-duration="1000"';
				?>
				<!-- item -->
				<div id="<?=$i['anchor_id']?>" class="c_ac__item layout-grid gap-24 lg:gap-48" style="--bg: var(--<?=$i['color']?>" <?=$aos?>>

					<!-- image -->
					<div class="c_ac__image relative z-1 col-4 lg:col-6 ar-5:4">
						
						<?php echo core::get_custom_srcset(
							array(
								'lazy'=>true,
								'attachment_id'=>$i['image'],
								'size'=>'original',
								'sizes'=>'(min-width: 1520px) 633px, (min-width: 1040px) calc(38.26vw + 57px), calc(119.86vw - 47px)',
								'classes'=>'c_ac__img absolute inset-0 object-cover w-full',
							)
						); ?>
						
					</div>
			
					<div class="c_ac__content relative z-1 col-4 lg:col-6 lg:start-col-7 flex flex-col gap-24 self-center">
						
							<div  class="grid gap-12 lg:gap-24 max-w-500">


								<!-- eyebrow -->
								<?php if($i['eyebrow']) : ?>
									<div class="c_ac__eyebrow t_label text-rust">
										<?=$i['eyebrow']?>
									</div>
								<?php endif; ?>

								<!-- headline -->
								<?php if($i['headline']) : ?>
									<h3 class="c_ac__headline">
										<?=$i['headline']?>
									</h3>
								<?php endif; ?>

								<!-- text -->
								<?php if($i['text']) : ?>
									<div class="c_ac__text relative z-1 t_wysiwyg t_body t_body--sm"><?=$i['text']?></div>
								<?php endif; ?>

								<!-- buttons -->
								<?php if($i['buttons']) :
									$classes = 'c_ac__btns relative z-1 mt-12';
									$buttons = $i['buttons'];
									$style = 'auto';
									include locate_template('partials/base/buttons.php', false, false);
								endif; ?>
							</div>

						

					</div>
				</div>
			<?php endforeach; ?>
		
		</div>

	</div>


</section>

<?php 

echo CONTENT_OPEN;