<?php
/**
 * Misc: Search Form
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

?>


<form role="search" action="/" class="search-form search-form__<?=$location?> relative z-1 flex items-stretch">

	<?php if('blog' === $location) : ?>
		<input type="hidden" name="post_type" value="post" />
	<?php endif; ?>

	<label for="search-<?=$location?>" class="sr-only"><?=__('Search', TEXTDOMAIN)?></label>
	<input id="search-<?=$location?>" type="search" class="search__field" placeholder="Search…" value="<?=the_search_query()?>" name="s">
	<button type="submit" class="search__btn" aria-label="<?=__('Submit Search', TEXTDOMAIN)?>">
		<svg class="i" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160.29 169.47">
			<path fill="currentColor" class="cls-1" d="M160.29,163.1l-52.66-52.66c12.41-11.66,20.18-28.21,20.18-46.54C127.81,28.67,99.14,0,63.9,0S0,28.67,0,63.9s28.67,63.9,63.9,63.9c13.66,0,26.32-4.32,36.72-11.65l53.31,53.31,6.36-6.36ZM9,63.9c0-30.27,24.63-54.9,54.9-54.9s54.9,24.63,54.9,54.9-24.63,54.9-54.9,54.9S9,94.18,9,63.9Z"/>
		</svg>
	</button>
</form>