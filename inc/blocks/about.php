<?php
$jdf_block_anchor = jdf_block_anchor();
?>
<div class="about-block block-m block-wrapper">
  <div class="wrap wrap-px">
    <div class="cols-grid">
      <?php
        if(have_rows('abouts')) :
          while(have_rows('abouts')) : the_row();
          $title = get_sub_field('title');
          $introduction = get_sub_field('introduction'); ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <h1><?php echo $title; ?></h1>
          </div>
          <div class="col-lg-8 col-md-6 col-sm-12">
            <?php
              if (have_rows('icons')) : ?>
                <div class="d-flex cols-grid">
              <?php
                while (have_rows('icons')) : the_row();
                  $choice = get_sub_field('icon_choice'); ?>
                    <div class="col-sm-6 col-lg-3 align-center">
                      <?php
                      switch ($choice) {
                        case "1":
                          $svg = jdf_get_svg('team-secret-logo');
                          echo  $svg;
                          break;
                        case "2":
                          $svg = jdf_get_svg('treasure-data');
                          echo '<div class="icon-1">' . $svg . '</div>';
                          break;
                        case "3":
                          $svg = jdf_get_svg('natus-vincere');
                          echo '<div class="icon-2">' . $svg . '</div>';
                          break;
                        case "4":
                          $svg = jdf_get_svg('tesla-4');
                          echo '<div class="icon-3">' . $svg . '</div>';
                          break;
                        default:
                          break;
                      }
                      ?>
                    </div>
            <?php
                endwhile; ?>
                </div>
            <?php
              endif;
              ?>
              <div>
                <h5><?php echo $introduction; ?></h5>
                <div class="cols-grid">
                  <?php
                    if(have_rows('content')) :
                      while(have_rows('content')) : the_row();
                        $content = get_sub_field('columns'); ?>
                        <div class="col-6">
                          <?php echo $content; ?>
                        </div>
                  <?php
                      endwhile;
                    endif;
                  ?>
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