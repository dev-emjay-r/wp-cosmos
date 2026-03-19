<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php is_front_page() ? blogInfo('title') : wp_title(""); ?></title>
    <?php wp_head(); ?>
  </head>
  <body>
    <!-- <div class="hidden md:block">Tailwind MD is working</div> -->
    <!-- Header -->
    <header class="py-6 bg-[#0B0B12]">
      <div class="container">
        <!-- Wrapper -->
        <div class="header__wrapper">
          <!-- Logo -->
          <div class="Logo">
            <!-- Reference:  bg-gradient-to-r from-indigo-500 to-pink-600 -->
            <a href="<?= esc_url(home_url('/')) ?>">
              <span
                class="bg-linear-to-br from-starlight to-accent-cyan rounded-full"
                >🚀</span
              >
              <h1>Cosmos</h1>
            </a>
          </div>
          <!-- Nav Links -->
          <nav class="headerNav">
                <?php
                $current = '';

                if (is_front_page()) {
                    $front_page = get_option('page_on_front');
                    $current    = get_post_field('post_name', $front_page);
                } elseif (is_home()) {
                    $posts_page = get_option('page_for_posts');
                    $current    = get_post_field('post_name', $posts_page);
                } elseif (is_page()) {
                    $current = get_post_field('post_name', get_queried_object_id());
                }

                $pages = get_pages(
                  [
                  'post_status' => 'publish',
                  'sort_column'=>'menu_order',
                  'sort_order'=>'ASC' 
                  ]);
                ?>
                <ul>
                    <?php foreach ($pages as $page) :
                        $slug  = $page->post_name;
                        $title = $page->post_title;
                        $url   = get_permalink($page->ID);
                    ?>
                        <li>
                            <a href="<?= esc_url($url) ?>" <?php echo $current === $slug ? 'class="active"' : ''; ?>>
                                <?= esc_html($title) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
          <div class="toggleMenu"><span></span><span></span><span></span></div>
        </div>
      </div>
    </header>
