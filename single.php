<?php get_header(); ?>

<main class="site-main">
	<div class="wrap wrap-p">

		<?php get_template_part( 'inc/partials/breadcrumbs' ); ?>

		<div class="cols-grid grid-large grid-flat">
			<div class="col mb-3 mb-lg-0">

				<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

				<div <?php post_class( 'entry' ); ?> id="post-<?php the_ID(); ?>">

					<h1><?php the_title(); ?></h1>

					<?php get_template_part( 'inc/partials/meta' ); ?>

					<?php
					if ( post_password_required() ) {

						echo get_the_password_form();

					} else {

						jdf_the_featured_image();
						the_content();
						echo '<hr>';
						jdf_the_social_buttons();

					}
					?>

				</div>

				<?php endwhile; endif; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>
</main>

<?php get_footer(); ?>