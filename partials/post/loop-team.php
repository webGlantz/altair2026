<?php
/**
 * Team Loop
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

?>

<!-- loop: team -->
<a href="<?=$item['url']?>" class="loop-post relative z-1 flex flex-col gap-12 items-stretch <?=$item['size']?> group" x-show="isActive(<?=json_encode($item['cats'])?>)">

	<?php if($item['image']) : ?>
		<!-- image -->
		<div class="loop-post__image relative overflow-hidden block w-full ar-1:1 zoom-hover bg-blue-light">
			<?php echo glantz\core::get_custom_srcset(
				array(
					'lazy'=>true,
					'attachment_id'=>$item['image'],
					'size'=>'original',
					'sizes'=>'(min-width: 1520px) 536px, (min-width: 1040px) calc(32.83vw + 44px), calc(127.92vw - 52px)',
					'classes'=>'loop-post__img absolute inset-0 object-cover',
				)
			); ?>
		</div>
	<?php endif; ?>

	<div class="loop-post__content flex flex-col flex-auto items-center gap-8 text-center">

		

		<h3 class="t_h6">
			<?=$item['title']?>
		</h3>

		<div class="t_body t_body--xs text-rust">
			<?=$item['position']?>
		</div>
	</div>

</a>