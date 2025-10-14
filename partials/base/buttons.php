<?php
/**
 * Base - Buttons
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


$c = count($buttons);

?>

<div class="btn-group <?=(isset($classes) ? $classes : '')?>">
	<?php

	foreach($buttons as $x=>$button) :

		$tmp = $style;

		if('auto' === $style) :
			$tmp = (0 === $x ? 'btn--primary' : 'btn--secondary');
		endif;
		
		$btn = $button['link'];
		$hash = str_starts_with($btn['url'], '#'); 
		$class = 'btn ' . ' ' . $tmp;

		if(isset($btn['url']) && !empty($btn['url'])) : ?>

			<div>
				<?php if($hash) : ?>
					<button @click.prevent="scrollTo('<?=$btn['url']?>')" class="<?=$class?>" x-data>
						<span><?=$btn['title']?></span>
						<i class="fa fas fa-arrow-right"></i>
					</button>
				<?php else : ?>
					<a href="<?=$btn['url']?>" target="<?=$btn['target']?>" class="<?=$class?>">
						<span><?=$btn['title']?></span>
						<i class="fa fas fa-arrow-right"></i>
					</a>
				<?php endif; ?>
			</div>

		<?php endif; 

	endforeach; ?>

</div>