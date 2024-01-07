<?php
get_header();
getBanner(array(
  "title" => get_the_archive_title(),
  "subtitle" => get_the_archive_description()
));
?>

<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post();
    // Hiển thị thông tin bài viết
    get_template_part("/template-part/content", "event");
  }
  echo paginate_links();
  ?>
  <hr class="divider_break">
  <p><a href="<?php echo site_url('/past-events') ?>">Looking our past events here</a></p>
</div>

<?php

get_footer();
?>