<?php get_header(); ?>
<?php
// Get the ID of the page set as the Posts Page
$missions_page_id = get_option('page_for_posts');
?>
<main>
    <!-- Content -->
    <section class="py-50 to-nebula-purple max-h-fit md:max-h-screen">
      <div id="tsparticles"></div>
      <div class="container">
        <!-- Wrapper -->
        <div class="flex flex-col items-center justify-center">
          <div class="title">
                <h1><?= get_field('title', $missions_page_id) ?></h1>
                <p><?= get_field('description', $missions_page_id) ?></p>
            </div>
          <div class="card-wrapper">
            <?php 
                $missions = new WP_Query([
                    'post_type' => 'mission',
                    'posts_per_page' => -1,
                    'orderby'=>'menu_order',
                    'order'=>'ASC'
                ]);
            ?>
            <!-- 1 -->
             <?php 
             if($missions-> have_posts()) :
                while($missions->have_posts()):
                    $missions->the_post();
                    $status = get_field('status');
             ?>
            <div
              data-aos="fade-down"
              data-aos-easing="linear"
              data-aos-duration="500"
            >
            <div class="mission-card"  id="<?=get_the_ID()?>">
                <div class="mission-card__preview">
                <?php if (has_post_thumbnail()) : ?>
                    <img 
                        src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" 
                        alt="<?= get_the_title() ?>"
                        class="w-full h-full object-cover"
                    />
                <?php endif; ?>
                  <div class="mission-card__status <?= esc_html($status)?>"><?= esc_html($status)?></div>
                </div>
                <div class="mission-card__content">
                  <small class="text-starlight font-medium mb-6"
                    >📅 <?= the_field('launch'); ?></small
                  >
                 
                  <a href="<?= get_permalink(); ?>">
                     <h5 class="font-bold my-3"><?= the_title(); ?></h5>
                    <p>
                    <?= the_excerpt(); ?>
                  </p>
                  </a>
                  
                  <div class="mission-card__footer">
                    <p>🎯 <?=the_field('destination'); ?></p>
                    <p>⏱️ <?=the_field('capacity'); ?></p>
                  </div>
                </div>
                </div>
            </div>
            <?php endwhile;wp_reset_postdata();endif;?>
            
          </div>
        </div>
      </div>
    </section>
    <section class="bg-deep-space h-screen hidden md:block">
      <div class="container">
        <div class=""></div>
      </div>
    </section>
</main>

<?php get_footer(); ?>