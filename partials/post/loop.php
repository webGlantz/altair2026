<?php
/**
 * Post Loop
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$categories = wp_list_pluck(get_the_terms($item['id'], 'category') ?: [], 'name');

?>

<!-- loop: blog post -->
<a href="<?=$item['url']?>" class="loop-post relative z-1 flex flex-col items-stretch <?=$item['size']?> group">

	<?php if($item['image']) : ?>
		<!-- image -->
		<div class="loop-post__image relative overflow-hidden block w-full ar-5:4 zoom-hover bg-blue-light">
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

	<div class="loop-post__content flex flex-col gap-12 p-24 lg:p-48 text-white flex-auto items-start">

		<?php if($categories) : ?>
			<div class="t_label t_label--blog">
				<span class="underline"><?=implode('</span> <span class="underline">', $categories)?></span>	
			</div>
		<?php endif; ?>

		<h3 class="t_h6">
			<?=$item['title']?>
		</h3>
	</div>

</a>