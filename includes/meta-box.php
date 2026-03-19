
 <?php
 
// Register meta box
function cosmos_stat_meta_box() {
    add_meta_box(
        'cosmos_stat_value',
        'Stat Value',
        'cosmos_stat_meta_box_html',
        'cosmos_stat',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cosmos_stat_meta_box');

// Meta box HTML
function cosmos_stat_meta_box_html($post) {
    $value = get_post_meta($post->ID, '_stat_value', true);
    wp_nonce_field('cosmos_stat_nonce', 'cosmos_stat_nonce'); ?>
    <label for="stat_value">Value (e.g. 150+, 4.2B)</label>
    <input 
        type="text" 
        id="stat_value" 
        name="stat_value" 
        value="<?= esc_attr($value) ?>" 
        style="width:100%; margin-top: 6px;"
    />
<?php }

// Save meta box value
function cosmos_save_stat_meta($post_id) {
    if (!isset($_POST['cosmos_stat_nonce']) || 
        !wp_verify_nonce($_POST['cosmos_stat_nonce'], 'cosmos_stat_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['stat_value'])) {
        update_post_meta($post_id, '_stat_value', sanitize_text_field($_POST['stat_value']));
    }
}
add_action('save_post_cosmos_stat', 'cosmos_save_stat_meta');
// inc/meta-boxes.php// Register Meta Box
function cosmos_mission_data_meta_box() {
    add_meta_box(
        'mission_data',
        'Mission Data',
        'cosmos_mission_data_html',
        'mission',          // ← your CPT slug
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cosmos_mission_data_meta_box');

// Meta Box HTML
function cosmos_mission_data_html($post) {
    $rows = get_post_meta($post->ID, '_mission_data', true) ?: [];
    wp_nonce_field('mission_data_nonce', 'mission_data_nonce');
    ?>
    <div id="mission-data-wrapper">
        <table class="widefat" id="mission-data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Goal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)) : ?>
                    <?php foreach ($rows as $i => $row) : ?>
                        <tr>
                            <td>
                                <input 
                                    type="text" 
                                    name="mission_data[<?= $i ?>][name]" 
                                    value="<?= esc_attr($row['name']) ?>"
                                    placeholder="e.g. Distance Traveled"
                                    style="width:100%"
                                />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    name="mission_data[<?= $i ?>][value]" 
                                    value="<?= esc_attr($row['value']) ?>"
                                    placeholder="e.g. 28.5km"
                                    style="width:100%"
                                />
                            </td>
                            <td style="text-align:center">
                                <input 
                                    type="checkbox" 
                                    name="mission_data[<?= $i ?>][goal]" 
                                    <?= !empty($row['goal']) ? 'checked' : '' ?>
                                />
                            </td>
                            <td>
                                <button type="button" class="button remove-row" style="color:red">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <button type="button" id="add-mission-row" class="button button-primary">
            + Add Row
        </button>
    </div>

    <script>
        let rowIndex = <?= count($rows) ?>;

        document.getElementById('add-mission-row').addEventListener('click', function() {
            const tbody = document.querySelector('#mission-data-table tbody');
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <input type="text" name="mission_data[${rowIndex}][name]" 
                           placeholder="e.g. Distance Traveled" style="width:100%" />
                </td>
                <td>
                    <input type="text" name="mission_data[${rowIndex}][value]" 
                           placeholder="e.g. 28.5km" style="width:100%" />
                </td>
                <td style="text-align:center">
                    <input type="checkbox" name="mission_data[${rowIndex}][goal]" />
                </td>
                <td>
                    <button type="button" class="button remove-row" style="color:red">
                        Remove
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
            rowIndex++;
        });

        // Remove row
        document.querySelector('#mission-data-table').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
    <?php
}

// Save Meta Box
function cosmos_save_mission_data($post_id) {
    if (!isset($_POST['mission_data_nonce']) ||
        !wp_verify_nonce($_POST['mission_data_nonce'], 'mission_data_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['mission_data'])) {
        $rows = [];
        foreach ($_POST['mission_data'] as $row) {
            $rows[] = [
                'name'  => sanitize_text_field($row['name'] ?? ''),
                'value' => sanitize_text_field($row['value'] ?? ''),
                'goal'  => isset($row['goal']) ? 1 : 0,
            ];
        }
        update_post_meta($post_id, '_mission_data', $rows);
    } else {
        // no rows — delete the meta
        delete_post_meta($post_id, '_mission_data');
    }
}
add_action('save_post_mission', 'cosmos_save_mission_data');

function cosmos_gallery_meta_box() {
    add_meta_box(
        'gallery_images',
        'Gallery Images',
        'cosmos_gallery_meta_box_html',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cosmos_gallery_meta_box');

function cosmos_gallery_meta_box_html($post) {
    // only show on gallery page
    if ($post->post_name !== 'gallery') return;

    $image_ids = get_post_meta($post->ID, '_gallery_images', true) ?: [];
    wp_nonce_field('gallery_images_nonce', 'gallery_images_nonce');
    ?>
    <div id="gallery-meta-wrapper">

        <!-- Image Preview Grid -->
        <div id="gallery-preview" style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:15px;">
            <?php foreach ($image_ids as $image_id) :
                $url = wp_get_attachment_image_url($image_id, 'thumbnail');
            ?>
                <div class="gallery-thumb" style="position:relative;">
                    <img src="<?= esc_url($url) ?>" style="width:100px; height:100px; object-fit:cover; border-radius:6px;" />
                    <button 
                        type="button" 
                        class="remove-gallery-image" 
                        data-id="<?= $image_id ?>"
                        style="position:absolute; top:-6px; right:-6px; background:red; color:white; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer; font-size:12px; line-height:1;"
                    >✕</button>
                    <input type="hidden" name="gallery_image_ids[]" value="<?= $image_id ?>" />
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" id="add-gallery-images" class="button button-primary">
            + Add Images
        </button>
        <p class="description" style="margin-top:8px;">
            Click images to reorder. Click ✕ to remove.
        </p>
    </div>

    <script>
        jQuery(document).ready(function($) {
            var frame;

            // Open media uploader
            $('#add-gallery-images').on('click', function(e) {
                e.preventDefault();

                if (frame) { frame.open(); return; }

                frame = wp.media({
                    title:    'Select Gallery Images',
                    button:   { text: 'Add to Gallery' },
                    multiple: true                          // ← allows multi select
                });

                frame.on('select', function() {
                    var attachments = frame.state().get('selection').toJSON();

                    attachments.forEach(function(attachment) {
                        var thumb = attachment.sizes.thumbnail
                            ? attachment.sizes.thumbnail.url
                            : attachment.url;

                        var html = `
                            <div class="gallery-thumb" style="position:relative;">
                                <img src="${thumb}" style="width:100px; height:100px; object-fit:cover; border-radius:6px;" />
                                <button type="button" class="remove-gallery-image" data-id="${attachment.id}"
                                    style="position:absolute; top:-6px; right:-6px; background:red; color:white;
                                           border:none; border-radius:50%; width:20px; height:20px;
                                           cursor:pointer; font-size:12px; line-height:1;">✕</button>
                                <input type="hidden" name="gallery_image_ids[]" value="${attachment.id}" />
                            </div>
                        `;
                        $('#gallery-preview').append(html);
                    });
                });

                frame.open();
            });

            // Remove image
            $('#gallery-preview').on('click', '.remove-gallery-image', function() {
                $(this).closest('.gallery-thumb').remove();
            });
        });
    </script>
    <?php
}

// Save
function cosmos_save_gallery_images($post_id) {
    if (!isset($_POST['gallery_images_nonce']) ||
        !wp_verify_nonce($_POST['gallery_images_nonce'], 'gallery_images_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['gallery_image_ids'])) {
        $image_ids = array_map('absint', $_POST['gallery_image_ids']);
        update_post_meta($post_id, '_gallery_images', $image_ids);
    } else {
        delete_post_meta($post_id, '_gallery_images');
    }
}
add_action('save_post', 'cosmos_save_gallery_images');

// Register Meta Box
function cosmos_spacecraft_data_meta_box() {
    add_meta_box(
        'spacecraft_data',
        'Spacecraft Data',
        'cosmos_spacecraft_data_html',
        'spacecraft',          // ← your CPT slug
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cosmos_spacecraft_data_meta_box');

// Meta Box HTML
function cosmos_spacecraft_data_html($post) {
    $rows = get_post_meta($post->ID, '_spacecraft_data', true) ?: [];
    wp_nonce_field('spacecraft_data_nonce', 'spacecraft_data_nonce');
    ?>
    <div id="spacecraft-data-wrapper">
        <table class="widefat" id="spacecraft-data-table">
            <thead>
                <tr>
                    <th>Attribute Name</th>
                    <th>Attribute Value</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)) : ?>
                    <?php foreach ($rows as $i => $row) : ?>
                        <tr>
                            <td>
                                <input
                                    type="text"
                                    name="spacecraft_data[<?= $i ?>][name]"
                                    value="<?= esc_attr($row['name'] ?? '') ?>"
                                    placeholder="e.g. Max Speed"
                                    style="width:100%"
                                />
                            </td>
                            <td>
                                <input
                                    type="text"
                                    name="spacecraft_data[<?= $i ?>][value]"
                                    value="<?= esc_attr($row['value'] ?? '') ?>"
                                    placeholder="e.g. 28,000 km/h"
                                    style="width:100%"
                                />
                            </td>
                            <td>
                                <button type="button" class="button remove-row"
                                    style="color:red;">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <button type="button" id="add-spacecraft-row" class="button button-primary">
            + Add Row
        </button>
    </div>

    <script>
        let rowIndex = <?= count($rows) ?>;

        document.getElementById('add-spacecraft-row').addEventListener('click', function () {
            const tbody = document.querySelector('#spacecraft-data-table tbody');
            const tr    = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <input type="text" name="spacecraft_data[${rowIndex}][name]"
                           placeholder="e.g. Max Speed" style="width:100%" />
                </td>
                <td>
                    <input type="text" name="spacecraft_data[${rowIndex}][value]"
                           placeholder="e.g. 28,000 km/h" style="width:100%" />
                </td>
                <td>
                    <button type="button" class="button remove-row" style="color:red;">
                        Remove
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
            rowIndex++;
        });

        // Remove row
        document.querySelector('#spacecraft-data-table').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
    <?php
}

// Save
function cosmos_save_spacecraft_data($post_id) {
    if (!isset($_POST['spacecraft_data_nonce']) ||
        !wp_verify_nonce($_POST['spacecraft_data_nonce'], 'spacecraft_data_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['spacecraft_data'])) {
        $rows = [];
        foreach ($_POST['spacecraft_data'] as $row) {
            // skip empty rows
            if (empty($row['name']) && empty($row['value'])) continue;
            $rows[] = [
                'name'  => sanitize_text_field($row['name']  ?? ''),
                'value' => sanitize_text_field($row['value'] ?? ''),
            ];
        }
        update_post_meta($post_id, '_spacecraft_data', $rows);
    } else {
        delete_post_meta($post_id, '_spacecraft_data');
    }
}
add_action('save_post_spacecraft', 'cosmos_save_spacecraft_data');