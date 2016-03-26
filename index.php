<?php
/**
 * index.php
 *
 * The main template file.
 */
?>

<?php
/* Load header.php */
get_header();
?>

<div class="container-fluid text-center">
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1><?php _e('My thoughts on and off the web', 'versover'); ?></h1>
				<p class="lead">
					<?php _e('Web-design, development, and parent-teacher conferences.', 'versover'); ?>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="page-blog container-fluid">
	<div class="row">

		<aside class="sidebar col-md-3 col-md-offset-1 col-md-push-8">
			<?php
				/* load sidebar */
				get_sidebar();
			?>
		</aside>

		<div class="posts col-md-8 col-md-pull-4">
			<div class="row">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

				<?php
					/* Pagination */
					versover_numbered_pagination();
				?>
			</div>
		</div>

	</div>
</div>

<?php
	/* Load footer.php */
	get_footer();
?>
