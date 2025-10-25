<?php
/**
 * Footer - CTA
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$cta = get_field('footer_cta', 'options'); ?>
		

<div class="f_cta grid gap-12 lg:gap-24">
	
	<?php if(!empty($cta['headline'])) : ?>
		<div class="t_h3"><?=$cta['headline']?></div>
	<?php endif; ?>


	<!-- buttons -->
	<?php if($cta['buttons']) :
		$classes = 'f_cta__btns relative z-1 mt-12';
		$buttons = $cta['buttons'];
		$style = 'auto';
		include locate_template('partials/base/buttons.php', false, false);
	endif; ?>

</div>

