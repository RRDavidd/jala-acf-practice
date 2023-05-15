<?php $jdf_block_anchor = jdf_block_anchor();

$title = get_sub_field('title');
$button = get_sub_field('button');
$background = get_sub_field('background');

  if($title) : ?>
  <div class="cta-block block-m block-wrapper">
    <div class="wrap wrap-px align-center">
      <figure class="cta-bg">
        <img class="w-100" src="<?php echo $background['url']; ?>" alt="ss">
      </figure>
      <div class="cta-content">
        <h2><?php echo $title; ?></h2>
        <?php jdf_the_button($button); ?>
      </div>
    </div>
  </div>


<?php
  endif;
?>