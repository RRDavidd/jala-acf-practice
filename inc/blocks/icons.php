<?php $jdf_block_anchor = jdf_block_anchor(); ?>
<div class="icons-block block-m block-wrapper">
  <div class="wrap wrap-px">
    <div class="cols-grid">
    <?php
      if(have_rows('icons')) :
        while(have_rows('icons')) : the_row();
        $title = get_sub_field('title');
        $subtitle = get_sub_field('subtitle');
        $choice = get_sub_field('icon_image');
        ?>
        <div class="icons-col col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-0 p-2 align-center">
          <div class="d-flex justify-content-center">
            <div>
              <?php
                switch($choice) {
                  case "1":
                    $svg = jdf_get_svg('team-secret-logo');
                    echo '<div class="icon-1">' . $svg .'</div>';
                    break;
                  case "2":
                    $svg = jdf_get_svg('treasure-data');
                    echo '<div class="icon-1">' . $svg .'</div>';
                    break;
                  case "3":
                    $svg = jdf_get_svg('natus-vincere');
                    echo '<div class="icon-1">' . $svg .'</div>';
                    break;
                  case "4":
                    $svg = jdf_get_svg('tesla-4');
                    echo '<div class="icon-1">' . $svg .'</div>';
                    break;
                  default:
                    break;
                }
              ?>
            </div>
            <div class="p-1">
              <h5><?php echo $title; ?></h5>
              <div>
                <?php echo $subtitle; ?>
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