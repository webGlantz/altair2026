<?php
/**
 * Block - Tabs
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

echo CONTENT_CLOSE;

?>

<!-- component: tabs -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_tabs relative z-1" x-data="{ active: 0 }">

	<div class="c_tabs__container container layout-grid gap-48">

		<!-- headline -->
		<?php if($fields['headline']) : ?>
			<h2 class="c_tabs__headline col-4 lg:col-5">
				<?=$fields['headline']?>
			</h2>
		<?php endif; ?>

		<div class="c_tab col-4 lg:col-12 layout-grid gap-24">
			<?php foreach($fields['tabs'] as $index=>$tab) : ?>

				<!-- image -->
				<div x-show="<?=$index?> === active" class="c_tab__image relative z-1 col-4 lg:col-5 ar-5:4">
					
					<?php echo core::get_custom_srcset(
						array(
							'lazy'=>true,
							'attachment_id'=>$tab['image'],
							'size'=>'original',
							'sizes'=>'(min-width: 1520px) 633px, (min-width: 1040px) calc(38.26vw + 57px), calc(119.86vw - 47px)',
							'classes'=>'c_tab__img absolute inset-0 object-cover w-full',
						)
					); ?>
					
				</div>
			<?php endforeach; ?>

			<div class="c_tab__content relative z-1 col-4 lg:col-6 lg:start-col-7 flex flex-col gap-24">

				<div class="tab-group">
					<?php foreach($fields['tabs'] as $index=>$tab) : ?>
						<button @click.prevent="active = <?=$index?>" class="tab" :class="{ 'is-active' : <?=$index?> === active }">
							<?=$tab['title']?>
						</button>
					<?php endforeach; ?>
				</div>	

				<?php foreach($fields['tabs'] as $index=>$tab) : ?>
					<div x-show="<?=$index?> === active" class="c_tab__text grid gap-12 lg:gap-24">

						<!-- headline -->
						<?php if($tab['headline']) : ?>
							<h3 class="c_tab__headline text-rust">
								<?=$tab['headline']?>
							</h3>
						<?php endif; ?>

					
						<!-- text -->
						<?php if($tab['text']) : ?>
							<div class="c_tab__text relative z-1 t_wysiwyg t_body t_body--sm"><?=$tab['text']?></div>
						<?php endif; ?>

						<!-- buttons -->
						<?php if($tab['buttons']) :
							$classes = 'c_tab__btns relative z-1 mt-12';
							$buttons = $tab['buttons'];
							$style = 'auto';
							include locate_template('partials/base/buttons.php', false, false);
						endif; ?>
					</div>

				<?php endforeach; ?>

			</div>
		</div>
		

	</div>


</section>

<?php 

echo CONTENT_OPEN;