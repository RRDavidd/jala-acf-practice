<?php
$col_count = count(get_sub_field('teams'));
$col_class = "";

if ($col_count >= 4) {
  $col_class = "col-lg-3 col-md-4 col-sm-6";
} else if ($col_count === 3) {
  $col_class = "col-4";
} else if ($col_count === 2) {
  $col_class = "col-6";
}
?>
<?php $jdf_block_anchor = jdf_block_anchor(); ?>

<div class="team-block block-wrapper block-m" <?php echo $jdf_block_anchor; ?>>
  <div class="wrap wrap-px">
    <div class="cols-grid grid-flat-n same-height">
      <?php
        if(have_rows('teams')) :
          while(have_rows('teams')) : the_row();
            $name = get_sub_field('name');
            $biography = get_sub_field('biography');
            $email = get_sub_field('email');
            $image = get_sub_field('image');?>
            <div class="col-item <?php echo $col_class; ?> grid-flat-n same-height">
              <div class="col-item-content-wrapper">
                <div class="col-item-content hentry bg-color1 p-2">
                  <figure>
                  <?php jdf_the_image($image, 'full');?>
                  </figure>
                  <h4 class="mt-1 mb-0"><?php echo $name;?></h4>
                  <p class=""><a href="mailto: <?php $email; ?>"><?php echo $email;?></a></p>
                  <div class="hentry">
                    <?php echo $biography;?>
                  </div>
                </div>
              </div>
            </div>
      <?php
          endwhile;
        endif;
      ?>
    </div>
  </div>
</div>