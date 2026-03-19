<?php 
function cosmos_register_cpt() {
    register_post_type('cosmos_stat', [
        'labels' => [
            'name'          => 'Stats',
            'singular_name' => 'Stat',
            'add_new_item'  => 'Add New Stat',
            'edit_item'     => 'Edit Stat',
        ],
        'public'       => false,   // no front-end archive/single page needed
        'show_ui'      => true,    // show in dashboard
        'show_in_menu' => true,
        'supports'     => ['title'], // title = the label e.g. "Missions Completed"
        'menu_icon'    => 'dashicons-chart-bar',
    ]);
}
add_action('init', 'cosmos_register_cpt');



?>