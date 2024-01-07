<?php
    get_header();
    if(have_posts()) {
        while(have_posts()) {
            the_post();
            getBanner();
        }
    }
    ?>
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo site_url('/programmes'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Programmes</a> <span class="metabox__main">
                Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?>
            </span></p>
        </div>
        <div class="generic-content">
            <?php the_content(); ?>
        </div>
        <?php
        $relatedPrograms = get_field("related_programs");
        if($relatedPrograms) {
            ?>
            <hr class="section-break">
            <h3 class="headline headline--medium">Related Programmes</h3>
            <ul class="link-list min-list">
            <?php 
            foreach ($relatedPrograms as $program) {
                ?>
                    <li><a href="<?php echo get_the_permalink( $program ); ?>"><?php echo get_the_title($program); ?></a></li>
                <?php
            }
            ?>
            </ul>
            <?php
        }
        ?>
    </div>
    
    

    <?php

    get_footer();
?>