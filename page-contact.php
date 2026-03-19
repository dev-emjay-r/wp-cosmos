<?php get_header(); ?>
<main>
     <!-- Content -->
    <section class="py-50 to-nebula-purple h-fit md:h-fit">
      <div id="tsparticles"></div>
      <div class="container">
        <!-- Wrapper -->
        <div class="flex flex-col items-center justify-center">
          <!-- Title -->
          <div class="title" data-aos="fade-down" data-aos-duration="1000">
            <h1><?= the_field('title'); ?></h1>
            <p>
              <?= the_field('description'); ?>
            </p>
          </div>
          <!-- contact wrapper -->
          <div class="flex flex-col md:flex-row py-8 gap-8" >
            <!-- Contact Details -->
            <div class="contact__details">
              <div>
                <h2 data-aos="fade-right" data-aos-duration="900">Let's Explore Together</h2>
                <p data-aos="fade-right" data-aos-duration="900">
                  Whether you're a student, educator, or space enthusiast, we'd
                  love to hear from you.
                </p>
              </div>
              <ul class="py-8 md:py-0">
                <!-- 1 -->
                <li>
                  <!-- Wrapper -->
                  <div class="contact__info" data-aos="fade-right" data-aos-duration="900">
                    <span>📍</span>
                    <div class="contact__info--content">
                      <h4>Mission Control</h4>
                      <p><?= the_field('address'); ?></p>
                    </div>
                  </div>
                </li>
                <!-- 2 -->
                <li>
                  <!-- Wrapper -->
                  <div class="contact__info" data-aos="fade-right" data-aos-duration="1200">
                    <span>📧</span>
                    <div class="contact__info--content">
                      <h4>Email</h4>
                      <p><?= the_field('email'); ?></p>
                    </div>
                  </div>
                </li>
                <!-- 3 -->
                <li>
                  <!-- Wrapper -->
                  <div class="contact__info" data-aos="fade-right" data-aos-duration="1500">
                    <span>📱</span>
                    <div class="contact__info--content">
                      <h4>Social</h4>
                      <p><?= the_field('social'); ?></p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- Contact Forms -->
            <div class="contact__forms" data-aos="fade-left" data-aos-duration="900">
              <form action="">
                <label for="name">Full Name</label>
                <input
                  type="text"
                  name="name"
                  id="name"
                  placeholder="John Astronaut"
                />

                <label for="email">Email</label>
                <input
                  type="email"
                  name="email"
                  id="email"
                  placeholder="john@example.com"
                />

                <label for="subject">Subject</label>
                <input
                  type="text"
                  name="subject"
                  id="subject"
                  placeholder="Mission Inquiry"
                />

                <label for="message">Message</label>
                <textarea
                  name="message"
                  id="message"
                  placeholder="Tell us about your space interest"
                  rows="6"
                ></textarea>

                <button type="submit" class="btn btn-glow w-full mt-8">Send Message <span>🚀</span></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
<?php get_footer(); ?>