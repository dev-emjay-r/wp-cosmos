<?php 
    require_once get_template_directory() . '/includes/assets.php';
    require_once get_template_directory() . '/includes/cpt.php';
    require_once get_template_directory() . '/includes/meta-box.php';
    require_once get_template_directory() . '/includes/blocks.php';
add_filter('mime_types', 'dd_add_jfif_files');
function dd_add_jfif_files($mimes){
    $mimes['jfif'] = "image/jpeg";
    return $mimes;
}

?>