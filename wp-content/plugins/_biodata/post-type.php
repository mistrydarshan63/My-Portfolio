<?php

$labels = array(
    'name'               => _x('Resumes', 'post type general name', 'astra'),
    'singular_name'      => _x('Resume', 'post type singular name', 'astra'),
    'menu_name'          => __('Resumes', 'astra'),
    'name_admin_bar'     => __('Resume', 'astra'),
    'add_new'            => '',
    'add_new_item'       => '',
    'new_item'           => __('New Resume', 'astra'),
    'edit_item'          => __('Edit Resume', 'astra'),
    'view_item'          => __('View Resume', 'astra'),
    'all_items'          => __('All Resumes', 'astra'),
    'search_items'       => __('Search Resumes', 'astra'),
    'not_found'          => __('No resumes found.', 'astra'),
    'not_found_in_trash' => __('No resumes found in Trash.', 'astra')
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'resume'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_icon'          => 'dashicons-media-code',
    'menu_position'      => 5,
    'capabilities'       => array(
        'create_posts' => 'do_not_allow', // 🔥 Disables "Add New Resume"
    ),
    'supports'           => array('title')
);

register_post_type('resume', $args);








// Add Custom Columns to Admin Listing
function custom_resume_columns($columns)
{
    unset($columns['date']);
    unset($columns['title']);
    $columns['edit_post'] = __('View', 'astra');
    $columns['profile_image'] = __('Profile Image', 'astra');
    $columns['name'] = __('Name', 'astra');
    $columns['gender'] = __('Gender', 'astra');
    $columns['height'] = __('Height', 'astra');
    $columns['dob'] = __('Date of Birth', 'astra');
    $columns['place_of_birth'] = __('Place of Birth', 'astra');
    $columns['time_of_birth'] = __('Time of Birth', 'astra');
    $columns['rashi'] = __('Rashi', 'astra');
    $columns['job_occupation'] = __('Job/Occupation', 'astra');
    $columns['contact_number'] = __('Contact Number', 'astra');
    $columns['address'] = __('Address', 'astra');

    return $columns;
}
add_filter('manage_resume_posts_columns', 'custom_resume_columns');



// Populate Custom Columns with Data
function custom_resume_column_content($column, $post_id)
{
    switch ($column) {
        case 'edit_post':
            $edit_link = get_edit_post_link($post_id); // Get the edit post link
            if ($edit_link) {
                echo '<br><a href="' . esc_url($edit_link) . '" class="button action" style="display: inline-block; margin-top: 5px; text-decoration: none; color: #0073aa;">View Details</a>';
            }
            break;

        case 'profile_image':
            $profile_image = get_post_meta($post_id, 'profile_image', true);

            if ($profile_image) {
                echo '<img src="' . esc_url($profile_image) . '" width="100" height="100" style="border-radius: 5px;">';
            } else {
                echo '—';
            }
            break;

        case 'name':
            echo esc_html(get_the_title($post_id));
            break;

        case 'gender':
            echo esc_html(get_post_meta($post_id, 'gender', true));
            break;

        case 'height':
            echo esc_html(get_post_meta($post_id, 'height', true));
            break;

        case 'dob':
            echo esc_html(get_post_meta($post_id, 'dob', true));
            break;

        case 'place_of_birth':
            echo esc_html(get_post_meta($post_id, 'place_of_birth', true));
            break;

        case 'time_of_birth':
            $time_of_birth = get_post_meta($post_id, 'time_of_birth', true);
            echo esc_html(date("h:i A", strtotime($time_of_birth))); // Convert to 12-hour format
            break;

        case 'rashi':
            echo esc_html(get_post_meta($post_id, 'rashi', true));
            break;

        case 'job_occupation':
            echo esc_html(get_post_meta($post_id, 'job_occupation', true));
            break;

        case 'contact_number':
            echo esc_html(get_post_meta($post_id, 'contact_number', true));
            break;

        case 'address':
            echo esc_html(get_post_meta($post_id, 'address', true));
            break;
    }
}
add_action('manage_resume_posts_custom_column', 'custom_resume_column_content', 10, 2);
function custom_resume_sortable_columns($columns)
{
    $columns['name'] = 'title';
    $columns['dob'] = 'dob';
    $columns['contact_number'] = 'contact_number';
    return $columns;
}
add_filter('manage_edit-resume_sortable_columns', 'custom_resume_sortable_columns');
function remove_resume_row_actions($actions, $post)
{
    if ($post->post_type === 'resume') {
        return array(); // Remove all row actions
    }
    return $actions;
}
add_filter('post_row_actions', 'remove_resume_row_actions', 10, 2);
