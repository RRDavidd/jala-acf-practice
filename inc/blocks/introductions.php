<?php $jdf_block_anchor = jdf_block_anchor(); ?>

<div <?php echo $jdf_block_anchor; ?> class="introductions-block block-wrapper block-m multi-line">
    <div class="wrap wrap-px">
<?php
  if(have_rows('introductions')) :
    while(have_rows('introductions')) : the_row();
    $title = get_sub_field('title');
    $content = get_sub_field('content');
    ?>
    <div class="d-flex align-items-center flex-column">
      <h2><?php echo $title; ?></h2>
      <div class="align-center w-75 hentry">
        <?php echo $content; ?>
      </div>
      <div class="mt-3 button-block block-wrapper block-m multi-line align-center">
        <?php
        while(have_rows('buttons')) : the_row();
          jdf_the_button( get_sub_field( 'buttons' ) );
        endwhile; ?>
      </div>
    </div>
<?php
   endwhile;
  endif;

?>
    </div>
</div>