<?php get_header('',array('current'=>'home'));?>
    <main>
        <!-- Content -->
    <section class="py-50 min-h-fit w-full overflow-hidden">
      <div id="tsparticles"></div>
      <div class="container">
        <!-- Wrapper -->
        <div class="flex flex-col items-center justify-center">
          <!-- Explore the unknown -->
          <div
            class="bg-glow/20 px-4 rounded-3xl py-2 border-starlight border-2 mb-12"
          >
            <p class="text-starlight">🌌 Exploring the unknown</p>
          </div>
          <!-- Reference:  bg-gradient-to-r from-indigo-500 to-pink-600 -->
          <div class="">
            <h1
            class="home-title"
            data-aos="fade-down"
          >
            <?php the_field('title'); ?>
          </h1>
          </div>
          <p
            class="text-center max-w-md text-secondary my-8"
            data-aos="fade-down"
          >
           <?php the_field('description') ?>
          </p>
          <!-- Flex buttons -->
          <div class="flex gap-8 items-center justify-center w-full">
            
            <a
              href="<?= home_url('/missions')?>"
              class="btn btn-glow px-8 shadow-glow"
              data-aos="fade-right"
              data-aos-duration="800"
              >View Missions &rarr;</a
            >
            <a
              href=" <?= home_url('/spacecraft') ?>"
              class="btn btn--no-bg px-8"
              data-aos="fade-left"
              data-aos-duration="800"
              >Our Fleet</a
            >
          </div>
        </div>
      </div>
    </section>
    <!-- Stats -->
    <section class="pt-32 pb-16 bg-deep-space w-screen">
      <div class="container">
        
        <div
          class="flex md:flex-row flex-col gap-8 justify-center items-center"
        >
        <?php
        $stats = new WP_Query([
            'post_type'      => 'cosmos_stat',
            'posts_per_page' => -1,        // get all stats
            'post_status'    => 'publish',
            'orderby'        => 'menu_order', // client can drag to reorder
            'order'          => 'ASC',
        ]);

        if ($stats->have_posts()) :
            while ($stats->have_posts()) : $stats->the_post(); ?>
          <!-- 1 -->
          <div data-aos="fade-up" data-aos-duration="900" class="w-full md:w-3xs">
            <div class="card" >
              <h2 class="text-4xl text-starlight font-bold font-space-grotesk">
                <?= esc_html(get_post_meta(get_the_ID(),'_stat_value',true)) ?>
              </h2>
              <p class="text-secondary"><?= esc_html(get_the_title())?></p>
            </div>
          </div>
         <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>
        </div>
      </div>
    </section>
    </main>

<?php get_footer(); ?>