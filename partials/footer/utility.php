<?php
/**
 * Footer - Utility
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$links = glantz\core::get_nav('footer-utility');
		
?>

<div class="f_utility f_right__i t_body--sm">

	<span>&copy; <?=date('Y')?> <?=get_bloginfo('site')?>. All rights reserved.</span>


	<?php foreach($links as $index=>$link) : ?>
		<a href="<?=$link['url']?>" class="underline" target="<?=$link['target']?>"><?=$link['title']?></a>
		<span>|</span>
	<?php endforeach; ?>

	<span>Site by <a href="https://glantz.net" target="_blank" class="underline">Glantz</a></span>

</div>