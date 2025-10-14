<?php
/**
 * Header: Utility
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


?>


<ul class="h_utility flex flex-wrap items-center gap-20 lg:gap-24 justify-between">

	<?php if($notification) : ?>
		<li class="hidden lg:block mr-auto">
			<?php include locate_template('partials/header/notification.php', false, false); ?>		
		</li>
	<?php endif; ?>

	<?php if($header_btn) : ?>
		<li class="h_btn lg:hidden w-full">
			<?php include locate_template('partials/header/button.php', false, false); ?>
		</li>
	<?php endif; ?>

	<?php if($utility) :
		foreach($utility as $link) : ?>
			<li class="h_utility-links">
				<a href="<?=$link['link']['url']?>" class="flex gap-8 hover:underline" target="<?=$link['link']['target']?>">
					<span class=""><?=$link['icon']?></span>
					<span style="margin-top: -0.05em;"><?=$link['link']['title']?></span>
				</a>
			</li>
	<?php endforeach; 
	endif; ?>
</ul>
