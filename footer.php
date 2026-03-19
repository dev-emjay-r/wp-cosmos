 <!-- Footer -->
  <?php wp_footer(); ?>
    <footer>
      <div class="container">
        <!-- Wrapper -->
        <div class="flex flex-col gap-1 justify-center items-center">
          <!-- nav Wrapper -->
          <div class="navWrapper">
            <!-- Logo -->
            <div class="Logo">
              <a href="<?= esc_url(home_url('/')) ?>">
                <span class="">🚀</span>
                <h1>Cosmos</h1>
              </a>
            </div>
            <!-- Bottom Nav -->
            <nav class="footerNav">
              <!-- Nav -->
               <?php   $pages = get_pages(['post_status' => 'publish', 'exclude'     => [get_page_by_path('contact')->ID],]); ?>
              <ul class="navLinks">
                 <?php foreach ($pages as $page) :
                        $slug  = $page->post_name;
                        $title = $page->post_title;
                        $url   = get_permalink($page->ID);
                    ?>
                        <li>
                            <a href="<?= esc_url($url) ?>">
                                <?= esc_html($title) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
              </ul>
            </nav>
            <ul class="navSocials">
              <li>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
              </li>
              <li>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </li>
              <li><a href="#">📷</a></li>
              <li><a href="#">▶️</a></li>
            </ul>
          </div>

          <!-- Credits -->
          <div class="text-center">
            <p>&copy; Cosmos Space Exploration. All rights reserved.</p>
            <small class="text-secondary/50">Coded by Emjay</small>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/preset-stars@3/tsparticles.preset.stars.bundle.min.js"></script>
    <script>
        
      (async () => {
        await loadStarsPreset(tsParticles);

        await tsParticles.load({
          id: "tsparticles",
          options: {
            background: {
              image:
                "radial-gradient(ellipse 60% 80% at center, #1a1a2e 0%, #0a0a0f 80%)",
              size: "cover",
              repeat: "no-repeat",
            },
            preset: "stars",
          },
        });
      })();
    </script>
  </body>
</html>
