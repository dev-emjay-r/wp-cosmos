<?php 
function cosmos_register_blocks() {
    if (!function_exists('acf_register_block_type')) return;

    acf_register_block_type([
        'name'            => 'mission-hero',
        'title'           => 'Mission Hero',
        'description'     => 'A hero block for mission pages',
        'render_template' => 'blocks/content.php', // ← your template file
        'category'        => 'common',
        'icon'            => 'rocket',
        'keywords'        => ['mission', 'hero', 'cosmos'],
        'supports'        => ['align' => false],
    ]);
}
add_action('acf/init', 'cosmos_register_blocks');