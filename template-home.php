<?php
/**
 * template-home.php
 *
 * Template name: Homepage
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

<div class="filterable-portfolio container-fluid">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills portfolio-filter">
                <li class="portfolio-title">
                    <?php _e( 'Filter by', 'verover' ); ?>
                </li>
                <li role="presentation" class="active">
                    <a href="#" data-filter="*"><?php _e( 'All', 'versover' ) ?></a>
                </li>

                <?php
                    $args = array(
                        'orderby' => 'name',
                        'order' => 'ACS',
                        'hide_empty' => true,
                        'exclude' => '1'
                    );

                    $categories = get_categories( $args );

                    foreach ( $categories as $category ) { ?>
                        <li role="presentation">
                            <a href="#" data-filter=".<?php $category->slug; ?>">
                                <?php echo $category->name?>
                            </a>
                        </li>
                    <?php }
                ?>
            </ul>
        </div>
    </div>

    <div class="portfolio-items row">
        <?php
            $queryArgs = array(
                'cat' => '-1',
                'posts_per_page' => '-1',
            );

            $query = new WP_Query( $queryArgs );
        ?>

        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <?php
                    $slugs = '';
                    $currentCategories = get_the_category();

                    foreach ( $currentCategories as $currentCategory ) {
                        $slug .= ' ' . $currentCategory->slug;
                    }
                ?>

                <figure class="portfolio-item col-sm-4 item <?php echo $slugs; ?>">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?>
                    </a>
                </figure>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php
/* Load footer.php */
get_footer();
?>
