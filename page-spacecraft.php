<?php get_header(); ?>
<main>
    <!-- Content -->
    <section class="py-30 max-h-fit">
      <div id="tsparticles"></div>
      <div class="container">
        <!-- Wrapper -->
        <div class="flex flex-col items-center justify-center">
          <div class="title">
            <h1 data-aos="fade-down" data-aos-duration="900"><?= the_field('title'); ?></h1>
            <p data-aos="fade-down" data-aos-duration="1000">
              <?= the_field('description'); ?>
            </p>
          </div>
          <!-- Fleet Wrapper -->
          <div class="fleet__wrapper">
            <?php $fleet = new WP_Query([
              'post_type' => 'spacecraft',
              'posts_per_page' => -1,
              'orderby'=> 'menu_order',
              'order'=> 'ASC'
            ]);

            if($fleet->have_posts()){
              // echo 'i have fleets';
              while($fleet->have_posts()) {
                $fleet->the_post();
                
            ?>
            <!-- Fleet 1 -->
            <div class="fleet-item" data-aos="fade-up">
              <!-- left -->
              <div class="fleet-item__left">
                <?php 
               
                //Outer box
                
                $outer_box = get_field('outer_box');
                $size_o = $outer_box['size'];
                $color_o =  $outer_box['color'];

                $inner_box = get_field('inner_box');
                $shape = $inner_box['shape'];
                $size_i = $inner_box['size'];
                $height_i = $inner_box['height'];
                $width_i = $inner_box['width'];
                $color_i = $inner_box['color'];

               
                $inner_height = 0;
                $inner_width = 0;
                if($shape === 'square' || $shape === 'circle') {
                  $inner_height = $size_i*4;
                  $inner_width = $size_i*4;
                }else {
                  $inner_height = $height_i;
                  $inner_width = $width_i;
                }

                
                $shiny = get_field('shiny') ? "shiny-card" : "";

                 // Map shape to your CSS class
                $shape_class = match($shape) {
                    'circle'    => 'shape--circle',
                    'rectangle' => 'shape--rectangle',
                    'square'    => 'shape--square',
                    default     => '',
                };
                ?> 
                <!-- Outer Box -->
                <div
                  class="outer-box size-40 md:size-64 rounded-2xl flex justify-center <?=$shiny?>" 
                  style="
                        --color-o: <?= esc_attr($color_o) ?>;
                        "
                >
                  <!-- Inner box -->
                  <div
                    class="inner-box  self-center <?= esc_attr($shape_class) ?>" 
                    style="background-color: <?= esc_attr($color_i) ?>;
                    --height-i: <?= esc_attr($inner_height) ?>px;
                    --width-i: <?= esc_attr($inner_width) ?>px;
                    "
                  ></div>
                </div>
              </div>
              <!-- right -->
              <div class="fleet-item__right">
                <h2><?= get_the_title() ?></h2>
                <p>
                  <?= get_field('description') ?>
                </p>
                <!-- Grid -->
                <div class="grid grid-cols-2 gap-4">
                  <?php $spacecraft_data = get_post_meta(get_the_ID(), '_spacecraft_data', true); ?>
                  <?php if (!empty($spacecraft_data)) : ?>
                  <?php foreach ($spacecraft_data as $row) : ?>
                  <div class="fleet-item__detail">
                    <span><?= esc_html($row['name']) ?></span>
                    <p><?= esc_html($row['value']) ?></p>
                  </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </div>
                <a href="<?= get_permalink() ?>" class="btn btn-glow w-full mt-6 md:w-fit"
                  >View Specifications</a
                >
              </div>
            </div>
            <?php } wp_reset_postdata();
            } ?>
          </div>
        </div>
      </div>
    </section>

</main>
<?php get_footer(); ?>