<?php $jdf_block_anchor = jdf_block_anchor();
$title = get_sub_field('title');
$slider_count = count(get_sub_field('logos'));
$slider_class = " ";
$logo_style = " ";

if($slider_count >= 6) :
  $slider_class = "logos-slider";
  $logo_style = "logos-block";
endif;

if($slider_count === 5) :
  $slider_class = "logos-slider5";
  $logo_style = "logos-block5";
endif;

?>

<div class="<?php echo $logo_style ;?> block-m block-wrapper">
  <div class="wrap wrap-px">
    <h4 class="align-center"><?php echo $title; ?></h4>
    <div class="cols-grid <?php echo $slider_class; ?>">
        <?php
        if (have_rows('logos')) :
          while (have_rows('logos')) : the_row();
            $choice = get_sub_field('icons');
            ?>
              <div class="logos-col pl-0 col-3 align-center slider">
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
                    echo '<div class="icon-1">' . $svg . '</div>';
                    break;
                  case "4":
                    $svg = jdf_get_svg('tesla-4');
                    echo '<div class="icon-1">' . $svg . '</div>';
                    break;
                  default:
                    break;
                }
                ?>
              </div>
              <?php
          endwhile;
        endif;
        ?>
    </div>
  </div>
</div>
