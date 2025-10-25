<?php
/**
 * Footer - Utility
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$links = glantz\core::get_nav('footer-utility');
		
?>

<div class="f_utility py-8 bg-blue-light t_body t_body--xs font-semibold">
	<div class="container lg:flex items-center gap-8">
		<span class="lg:mr-auto">&copy; <?=date('Y')?> <?=get_bloginfo('site')?>. All rights reserved.</span>

		<?php foreach($links as $index=>$link) : ?>
			<a href="<?=$link['url']?>" class="underline" target="<?=$link['target']?>"><?=$link['title']?></a>
			<span class="text-green">|</span>
		<?php endforeach; ?>

		<span>Site by <a href="https://glantz.net" target="_blank" class="underline">Glantz</a></span>
	</div>

</div>