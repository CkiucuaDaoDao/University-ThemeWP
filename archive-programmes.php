<?php
    get_header();
    getBanner(array(
        "title" => get_the_archive_title(),
        "subtitle" => get_the_archive_description()
    ));
    ?>

    <div class="container container--narrow page-section">
    <?php
            while(have_posts()) {
                the_post();
                // Hiển thị thông tin bài viết
    ?>
        <ul class="link-list min-list">
            <li><a href="<?php echo the_permalink();?>"><?php the_title()?></a></li>
        </ul>
    <?php
    }
    ?>
</div>

    <?php

    get_footer();
?>