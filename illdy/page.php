<?php
/**
 *  The template for dispalying the page.
 *
 *  @package WordPress
 *  @subpackage illdy
 */
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <?php if ( is_active_sidebar( 'page-sidebar' ) ) { ?>
            <div class="col-sm-8">
        <?php } else { ?>
            <div class="col-sm-12">
        <?php } ?>
            <section id="blog">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'page' );
                    endwhile;
                endif;
                ?>
            </section><!--/#blog-->
            <?php 
            if( $post->post_name == "du-an") :
                $args = array(
                    'parent' => $post->ID,
                    'post_type' => 'page',
                    'post_status' => 'publish'
                ); 
                $pages = get_pages($args);
            ?>
                <div class="row child-pages"> 
                    <?php foreach($pages as $page) : ?>
                        <div class="col-md-3 child-page">
                            <a href="<?php echo  get_permalink($page->ID); ?>" rel="bookmark" title="<?php echo $page->post_title; ?>">
                                <span class="thumbnail"><?php echo get_the_post_thumbnail($page->ID, 'small-thumb'); ?></span>
                                <span class="title"><?php echo $page->post_title; ?></span>
                                <p class="desc"><?php echo get_post_meta($page->ID, 'desc', true); ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div><!--/.col-sm-7-->
        <?php if ( is_active_sidebar( 'page-sidebar' ) ) { ?>
            <div class="col-sm-4">
                <div id="sidebar">
                    <?php dynamic_sidebar( 'page-sidebar' ); ?>
                </div>
            </div>
        <?php } ?>
    </div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
