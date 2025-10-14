<?php
/**
 * Footer - Logo & SEO
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$seo = get_field('footer_seo', 'options');
		
?>

<div class="grid gap-24">
	<a href="<?=site_url()?>" class="f_logo logo" title="Home - <?=get_bloginfo('name')?>" aria-label="Home - <?=get_bloginfo('name')?>">
		<img src="<?=THEME_URL?>/assets/svg/competition-roofing-logo-white.svg" alt="<?=get_bloginfo('name')?> Logo" />
	</a>

	<div class="t_body max-w-420"><?=$seo?></div>
</div>