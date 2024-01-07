<?php
get_header();
getBanner(array(
  "subtitle" => "Events have been organized"
))
?>

<div class="container container--narrow page-section">
  <?php
  $today = date('Ymd');
  $pastEvents = new WP_Query(
    array(
      'paged' => get_query_var('paged', 1),
      'posts_per_page' => 2,
      'post_type' => 'event',
      'meta_key' => 'events_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          "key" => 'events_date',
          "compare" => '<=',
          "value" => $today,
          "type" => 'numeric'
        )
      )
    )
  );
  while ($pastEvents->have_posts()) {
    $pastEvents->the_post();
    // Hiển thị thông tin bài viết
    get_template_part("/template-part/content", "event");
  }
  echo paginate_links(array(
    'total' => $pastEvents->max_num_pages,
  ));
  ?>
  <hr class="divider_break">
  <p><a href="<?php echo site_url('/event') ?>">Return New Events</a></p>
</div>

<?php

get_footer();
?>