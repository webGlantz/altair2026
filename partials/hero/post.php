<?php
/**
 * Hero - Post
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


use glantz\core; 

$path = parse_url(get_post_type_archive_link($post->post_type))['path'];
$archive = get_page_by_path($path);
$exclude = get_field('exclude_category', $archive->ID);
$cats = get_the_terms($post->ID, 'category');
$categories = wp_list_pluck($cats ?: [], 'name');
$authors = get_field('authors');

?>

<!-- hero: post -->
<section class="hero hero_post relative z-1 text-white <?=(empty($hero['image']) ? 'no-img' : '')?>" style="--bg: <?=(!empty($cats) && in_array($cats[0]->term_id, $exclude) ? 'var(--blue)' : 'var(--green)')?>">

	

	<div class="relative z-1 container layout-grid gap-24 lg:gap-y-96">


		<div class="hero-top hero_interior__top hero_post__top relative col-4 lg:col-8 grid gap-24 lg:gap-36 py-48 lg:py-60 lg:py-72 px-gutter-x lg:px-0 lg:max-w-710">
			
			<?php if($categories) : ?>
				<!-- category -->
				<div class="t_label t_label--blog underline">
					<?=the_category()?>	
				</div>
			<?php endif; ?>

			<!-- title -->
			<h1 class="t_h2"><?=(isset($hero['headline']) ? $hero['headline'] : get_the_title())?></h1>
			
			<?php if(!empty($authors)) : ?>
				<!-- authors -->
				<div class="hero_post__authors grid gap-24">
					<?php foreach($authors as $author) :
						$img = get_post_thumbnail_id($author->ID);
						$position = get_field('position', $author->ID);

						?>
						<a href="<?=get_permalink($author->ID)?>" class="flex gap-24 items-center w-full group">

							<?php if(!empty($img)) : ?>
								<div class="relative z-1 ar-1:1 rounded-full overflow-hidden zoom-hover" style="flex: 0 0 90px;">
									<?php echo core::get_custom_srcset(
										array(
											'lazy'=>false,
											'attachment_id'=>$img,
											'size'=>'original',
											'sizes'=>'90px',
											'classes'=>'hero_interior__bg-img absolute inset-0 object-cover -z-1',
										)
									); ?>
								</div>
							<?php endif; ?>

							<div class="grid">
								<div class="t_label"><?=$author->post_title?></div>

								<?php if(!empty($position)) : ?>
									<div class="t_body t_body--sm"><?=$position?></div>
								<?php endif; ?>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>
		
	</div>

	<?php if(!empty($hero['image'])) : ?>
		<!-- bg -->
		<div class="hero_post__image relative -z-1 ar-4:3 lg:ar-auto">
			
			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>false,
					'attachment_id'=>$hero['image'],
					'size'=>'original',
					'sizes'=>'(min-width: 1024px) 50vw, 100vw',
					'classes'=>'hero_interior__bg-img absolute inset-0 object-cover -z-1',
				)
			); ?>
		</div>
	<?php endif; ?>
</section>