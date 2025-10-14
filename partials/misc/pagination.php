<?php
/**
 * Misc: Pagination
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

// Pagination.
$pagination = paginate_links(array(
	'prev_text'=>'<span class="sr-only">Previous Page</span><i class="fa-light fa-arrow-left"></i>',
	'next_text'=>'<span class="sr-only">Next Page</span><i class="fa-light fa-arrow-right"></i>'
)); 


if($pagination) : ?>

<div class="pagination col-4 lg:col-12 flex items-center justify-center gap-12">
	<?=$pagination?>
</div>

<?php endif; 