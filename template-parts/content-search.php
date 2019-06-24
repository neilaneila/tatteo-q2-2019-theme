<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tatteo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href=" <?php echo get_the_permalink() ?>" class="search-result-wrapper">
		<img src='https://images.pexels.com/photos/460672/pexels-photo-460672.jpeg?auto=format%2Ccompress&cs=tinysrgb&dpr=1&w=500'>
		<div class="search-result-text">
			<div class="search-result-header">
				<h2>Old Habits</h2>
				<h3>Kingsland, London</h3>
			</div>
			<div class="search-result-footer">
				<p>10% Comission</p>
				<p> *****</p>
			</div>
		</div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
