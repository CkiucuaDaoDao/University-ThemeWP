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

    <div class="generic-content">
        <div class="row group">
            <div class="one-third">
                <img src="<?php the_post_thumbnail_url('professorLandscape'); ?>"  alt="<?php the_title(); ?>">
            </div>
            <div class="two-third">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php
    $relatedPrograms = get_field("related_programs");
    if ($relatedPrograms) {
    ?>
        <hr class="section-break">
        <h3 class="headline headline--medium">Related <?php echo get_the_title(); ?> Programmes</h3>
        <ul class="link-list min-list">
            <?php
            foreach ($relatedPrograms as $program) {
            ?>
                <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
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