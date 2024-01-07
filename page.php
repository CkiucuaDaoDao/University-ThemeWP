<?php
  get_header();
  getBanner(array(
    "subtitle" => "DONT FORGET TO REPLACE ME LATER"
  ));
  while(have_posts()) {
    the_post();
?>

  <div class="container container--narrow page-section">
    <?php
    $theParent = wp_get_post_parent_id(get_the_ID());
      if($theParent) {
    ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_the_permalink( $theParent ); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to About Us</a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>
    <?php
      }
    ?>
    
    <?php
    $testArray = get_pages(array(
      'child of' => get_the_ID()
    ));

    if($theParent OR $testArray) {
    ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_the_permalink( $theParent ); ?>"><?php echo get_the_title( $theParent );?></a></h2>
        <ul class="min-list">
          <?php
            if($theParent) {
              $findChildOf = $theParent;
            } else {
              $findChildOf = get_the_ID();
            }

            wp_list_pages( 
              array(
                'title_li' => NULL,
                'child_of' => $findChildOf
              )
            )
          ?>
        </ul>
      </div>
    
    <?php
    }
    ?>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>
    
  <?php }

  get_footer();

?>