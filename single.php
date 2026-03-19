<?php get_header(); ?>

<?php the_post(); ?>

<main>
    <!-- Main Article -->
      <section class="article" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'full') ?>);">
        <div class="container">
          <div>
            <div class="article__banner">
              <!-- Breadcrumb -->
              <div class="article__breadcrumb" data-aos="fade-down">
              <ul>
                  <li>
                      <a href="<?= esc_url(home_url('/')) ?>">Home</a>
                  </li>
                  <li>
                      <span>&rarr;</span>
                      <?php
                      // Get the page by slug
                      $missions_page = get_page_by_path('missions');
                      ?>
                      <a href="<?= esc_url(get_permalink($missions_page->ID)) ?>">Missions</a>
                  </li>
                  <li>
                      <span>&rarr;</span>
                      <?= esc_html(get_the_title()) ?>
                  </li>
              </ul>
              </div>
              <!-- Status and Date -->
              <div class="flex flex-col md:flex-row md:items-center gap-4 mb-8" data-aos="fade-down">
                <span class="badge badge--<?= the_field('status') ?>">● <?= the_field('status') ?> Mission</span>
                <p class="text-secondary/80">📅 <?= get_field('status') === 'active' ? 'Launched' : 'Launch'?>: <?= the_field('launch');?></p>
              </div>
              <!-- Title -->
              <h1 class="text-5xl text-center md:text-left mb-8" data-aos="fade-down">
                <?= the_title(); ?>
              </h1>
              <!-- description -->
              <p class="px-2 text-justify text-xl text-secondary/80" data-aos="fade-down">
                <?= get_the_excerpt(); ?>
              </p>
            </div>
          </div>
        </div>
      </section>
    
      <div>
        <section class="pb-10 max-h-fit">
        
        <div class="container">
            <!-- Wrapper -->
             <div
              class="flex flex-col md:flex-row items-center justify-center gap-8"
            >
            <!-- Left -->
             <div class="wp-block-content">
                <?php the_content(); ?>
             </div>
              <!-- Right -->
              <div class="top-30 self-start shrink-0 w-full md:w-sm sticky" >
                <!-- Stat Cards -->
                <div class="stat-wrapper">
                  <?php $mission_data = get_post_meta(get_the_ID(), '_mission_data', true); ?>
                  <!-- 1 -->
                   <?php if (!empty($mission_data)) { ?>
                  <div class="stat-card" data-aos="fade-left">
                    <h5><span aria-hidden="true">📊</span> Mission Data</h5>
                    
                    <?php foreach ($mission_data as $row) { ?>
                    <div class="stat-row mission-data">
                      <div class="flex justify-between items-center w-full">
                        <span><?= esc_html($row['name']) ?></span>
                        <span class="font-bold text-primary"><?= esc_html($row['value']) ?></span>
                      </div>
                      <?php if($row['goal']): ?>
                      <div class="progress-track">
                        <div class="progress-bar" style="--width: 75%"></div>
                      </div>
                      <?php endif;?>
                    </div>
                    <?php }?>
                  </div>
                  <?php } ?>
                  <!-- 2 -->
                  <div class="stat-card" data-aos="fade-left">
                    <h5><span aria-hidden="true">🔗</span> Quick Links</h5>
                    <div class="stat-row">
                      <h6>
                        <span>📡</span> <a href="#"> Live Mission Control</a>
                      </h6>
                    </div>
                    <div class="stat-row">
                      <h6><span>📷</span> <a href="#">Raw Image Gallery</a></h6>
                    </div>
                    <div class="stat-row">
                      <h6><span>📍</span> <a href="#">Interactive Map</a></h6>
                    </div>
                    <div class="stat-row">
                      <h6><span>📺</span> <a href="#">Mission Videos</a></h6>
                    </div>
                    <div class="stat-row">
                      <h6><span>📚</span> <a href="#">Scientific Papers</a></h6>
                    </div>
                  </div>
                  <!-- 3 -->
                  <div class="stat-card" >
                    <h5><span aria-hidden="true">📥</span> Share Missions</h5>
                    <div class="stat-row">
                      <ul class="links">
                        <li> <a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                        <li> <a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href="#">✉️</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </section>
      </div>
       <!-- Related Missions -->
       <section class="bg-deep-space py-8">
        <div class="container">
          <!-- Title -->
           <div class="text-center mb-6">
            <h2 class="font-bold mb-2">Related Missions</h2>
            <p>Explore other active mission in our solar system</p>
           </div>
          <!-- Wrapper -->
          <div class="flex flex-col md:flex-row gap-8" data-aos="fade-down">
            <?php $related = new WP_Query([
                'post_type'      => 'mission',
                'posts_per_page' =>  3,
                'post_status'    => ['active', 'upcoming'],
                'post__not_in'   => [get_the_ID()],  // ← excludes current post
                'orderby'        => 'rand',          // optional: random order
                'suppress_filters' => false,   // ← allows filters to modify the query
                'no_found_rows'    => true,    // ← improves performance for loops
            ]);
            ?>
            <?php if ($related->have_posts()) : ?>
                 <?php while ($related->have_posts()) : $related->the_post(); ?>
            <a href="<?= get_permalink() ?>" class="related-m-card">
              <div class="related-img">
                <?php if (has_post_thumbnail()) : ?>
                    <img
                        src="<?= esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')) ?>"
                        alt="<?= esc_attr(get_the_title()) ?>"
                        class="w-full h-48 object-cover rounded-xl"
                    />
                <?php endif; ?>
              </div>
              <div class="related-content">
                  <h5><?= get_the_title(); ?></h5>
                  <p><?= get_the_excerpt(); ?></p>
              </div>
            </a>
            <?php endwhile; wp_reset_postdata();endif;?>
            
            
          </div>
        </div>
       </section>
</main>

<?php get_footer(); ?>