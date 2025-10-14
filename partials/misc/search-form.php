<?php
/**
 * Misc: Search Form
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

?>


<form role="search" action="/" class="search-form search-form__<?=$location?> relative z-1 flex items-stretch">
	<label for="search-<?=$location?>" class="sr-only"><?=__('Search', TEXTDOMAIN)?></label>
	<input id="search-<?=$location?>" type="search" class="search__field" placeholder="Search…" value="" name="s">
	<button type="submit" class="search__btn" aria-label="<?=__('Submit Search', TEXTDOMAIN)?>">
		<i class="fa fa-search"></i>
	</button>
</form>