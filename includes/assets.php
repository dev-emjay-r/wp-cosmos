<?php

function  cosmos_assets() {
    wp_enqueue_style(
        'tailwind-output',
        get_template_directory_uri() . '/css/output.css',
        [],
        filemtime(get_template_directory() . '/css/output.css') // cache busting
    );
    // ✅ Fixed
wp_enqueue_style('cosmos-icon', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css', [], '7.0.1');
// 1. Enqueue AOS stylesheet
wp_enqueue_style('cosmos-aos-style', 'https://unpkg.com/aos@2.3.4/dist/aos.css', [], '2.3.4');

// 2. Enqueue AOS script
wp_enqueue_script('cosmos-aos', 'https://unpkg.com/aos@2.3.4/dist/aos.js', [], '2.3.4', true);

// 3. Enqueue YOUR script — with cosmos-aos as a dependency
wp_enqueue_script(
    'cosmos-script',
    get_template_directory_uri() . '/js/script.js',
    ['cosmos-aos'],                                             // ← waits for AOS to load first
    filemtime(get_template_directory() . '/js/script.js'),
    true
);
    }


add_action('wp_enqueue_scripts', 'cosmos_assets');

?>