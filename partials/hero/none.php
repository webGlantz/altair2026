<?php
/**
 * Hero - None
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

?>

<!-- hero: none -->
<section class="hero hero_simple">
	<div class="container grid gap-12 lg:gap-24">

		<?php include locate_template('partials/misc/breadcrumbs.php', false, false); ?>

		<h1><?=(isset($hero['headline']) ? $hero['headline'] : get_the_title())?></h1>

		<!-- text -->
		<?php if($hero['text']) : ?>
			<div class="hero_none__text relative z-1 t_wysiwyg t_body"><?=$hero['text']?></div>
		<?php endif; ?>

		<!-- buttons -->
		<?php if($hero['buttons']) :
			$classes = 'hero_none__btns hero_home__btns relative z-1 mt-12';
			$buttons = $hero['buttons'];
			$style = 'btn--secondary';
			include locate_template('partials/base/buttons.php', false, false);
		endif; ?>
	</div>
</section>