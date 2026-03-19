<?php get_header(); ?>

<main>
    <section class="py-50 to-nebula-purple max-h-fit">
        <div id="tsparticles"></div>
        <div class="container">
            <div class="flex flex-col items-center justify-center">

                <!-- Title (ACF free text fields) -->
                <div class="title">
                    <h1><?= esc_html(get_field('title')) ?></h1>
                    <p><?= esc_html(get_field('description')) ?></p>
                </div>

                <!-- Gallery Grid -->
                <?php
                $image_ids = get_post_meta(get_the_ID(), '_gallery_images', true);

                $grid_classes = [
                    0 => 'gallery-grid__main',
                    1 => 'gallery-grid__top-mid',
                    2 => 'gallery-grid__top-right',
                    3 => 'gallery-grid__bot-right',
                    4 => 'gallery-grid__tall',
                    5 => 'gallery-grid__small',
                ];

                $aos_directions = [
                    0 => 'fade-right',
                    1 => 'fade-down',
                    2 => 'fade-down',
                    3 => 'fade-left',
                    4 => 'fade-right',
                    5 => 'fade-up',
                ];
                ?>

                <?php if (!empty($image_ids)) : ?>
                    <div class="gallery-grid">
                        <?php foreach ($image_ids as $index => $image_id) :
                            $url   = wp_get_attachment_image_url($image_id, 'large');
                            $alt   = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                            $class = $grid_classes[$index] ?? 'gallery-grid__small';
                            $aos   = $aos_directions[$index] ?? 'fade-up';
                        ?>
                            <div class="<?= esc_attr($class) ?>">
                                <img
                                    src="<?= esc_url($url) ?>"
                                    alt="<?= esc_attr($alt) ?>"
                                    data-aos="<?= $aos ?>"
                                    data-aos-duration="900"
                                />
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>