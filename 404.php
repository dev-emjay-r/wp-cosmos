<?php get_header(); ?>




<main>
    <section class="py-50 not-found">
        
        <div class="container">
            <div class="not-found__wrapper">
                <div class="not-found__logo area-glow">
                    <span class="text-glow area-glow">🧑‍🚀</span>
                </div>
                <div class="not-found__title">
                    <h1 class="">404</h1>
                    <p class="font-semibold">Houston, We Have a Problem</p>
                    <p class=" text-secondary/80 text-center">The page you're looking for has drifted into deep space. It might have been moved, deleted, or never existed in this universe.</p>
                </div>
                <!-- Nav Option Buttons -->
                <div class="flex flex-col md:flex-row gap-6 w-full md:w-fit px-16">
                    <!-- To Home -->
                    <a href="<?= esc_url(home_url('/')) ?>" class="btn btn-glow w-full  md:w-fit"><span>🚀</span> Return to Earth</a>
                    <!-- To Missions -->
                    <a href="<?= esc_url(home_url('/missions')) ?>" class="btn btn--no-bg w-full  md:w-fit"><span>📡</span> Browse Mission</a>
                </div>

                <!-- Popular Destination -->
                 <div class="border rounded-2xl py-6 px-8 bg-secondary/10 border-secondary/50 w-full md:w-3xl">
                    <h4 class="text-center font-space-grotesk">Popular Destinations</h4>
                    <!-- Wrapper -->
                     <div class="not-found__destinations">
                        <ul>
                           <?php 
                           $pages = get_pages([
                            'post_status'=> 'publish',
                            'sort_column'=>'menu_order',
                            'sort_order'=>'ASC' 
                           ]);
                           foreach($pages as  $page):
                            $slug  = $page->post_name;
                            $title = $page->post_title;
                            $url   = get_permalink($page->ID);

                            $icon = get_field('destination_emoji', $page->ID);
                            $destination = get_field('destination_name', $page->ID);
                           ?>
                            <li>
                                <a href="<?= esc_html($url); ?>">
                                    <span><?= esc_html($icon);?></span> <?=esc_html($destination)?>
                                </a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                     </div>
                 </div>
            </div>
        </div>
    </section>
</main>







<?php get_footer(); ?>