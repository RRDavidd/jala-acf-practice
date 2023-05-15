<?php $jdf_block_anchor = jdf_block_anchor();?>
<div class="carousel-block block-m block-wrapper">
  <div class="wrap wrap-px">
    <div class="d-flex carousel-slider">
      <?php if (have_rows('carousel')) :
              while(have_rows('carousel')) : the_row();
              $title = get_sub_field('title');
              $content = get_sub_field('content');
              $image = get_sub_field('image');
              $link = get_sub_field('button');
              ?>
              <div class="d-flex p-3">
                <div class="left d-flex flex-column justify-content-center">
                  <h3><?php echo $title;?></h3>
                  <div class="w-75">
                    <?php echo $content;?>
                  </div>
                  <div class="mt-3">
                    <?php jdf_the_button($link); ?>
                  </div>
                </div>
                <figure>
                  <?php jdf_the_image($image); ?>
                </figure>
              </div>
      <?php
              endwhile;
          endif;
        ?>
    </div>
  </div>
</div>