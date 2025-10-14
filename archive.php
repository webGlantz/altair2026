<?php
/**
 * Archive
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $hero;
global $archive;

$path = parse_url(get_post_type_archive_link($post->post_type))['path'];
$archive = get_page_by_path($path);
$arcontent = $archive->post_content;
$hero = core::get_hero($archive->ID);

get_header();

// Hero. 
if($hero) :
	include locate_template('partials/hero/' . $hero['style'] . '.php', false, false);
endif;

// Content.
if(!empty($arcontent)) :
	echo apply_filters('the_content', $arcontent);
endif;


get_footer();
