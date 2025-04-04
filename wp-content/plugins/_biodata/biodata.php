<?php
/*
Plugin Name: Custom Form Plugin
Description: A simple form plugin to collect user details and store them in the WordPress database.
Version: 1.0
Author: Your Name
*/
function enqueue_custom_form_assets() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_script('jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js', array('jquery'), '1.19.3', true);
    wp_enqueue_script('bio-script', plugin_dir_url(__FILE__) . 'bio-script.js', array('jquery', 'jquery-validate'), '1.0.0', true);
    wp_enqueue_style('bio-style', plugin_dir_url(__FILE__) . 'bio-style.css', array(), '1.0.0', 'all');
    wp_localize_script('bio-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_form_assets');



function my_meta_box_callback($post)
{
    $value = get_post_meta($post->ID, '_your_custom_field', true);
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
?>
    <label for="your_custom_field">Enter value:</label>
    <input type="text" name="your_custom_field" id="your_custom_field" value="<?php echo esc_attr($value); ?>" />
<?php
}

function save_my_meta_box($post_id)
{
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['your_custom_field'])) {
        update_post_meta($post_id, '_your_custom_field', sanitize_text_field($_POST['your_custom_field']));
    }
}
add_action('save_post', 'save_my_meta_box');



// Add meta box to show custom fields in the admin panel
function add_personal_details()
{
    add_meta_box(
        'personal_details_meta_box',
        'Personal Details',
        'display_personal_details',
        'resume',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_personal_details');

function display_personal_details($post)
{ 
    $post_id = $post->ID;
    $name = $post->post_title;
    $profile_image = get_post_meta($post_id,'profile_image',true);
    $contact_number = get_post_meta($post_id,'contact_number',true);
    $rashi = get_post_meta($post_id,'rashi',true);
    $dob = get_post_meta($post_id,'dob',true);
    $gender = get_post_meta($post_id,'gender',true);
    $address = get_post_meta($post_id,'address',true);
    $height = get_post_meta($post_id,'height',true);
    $job_occupation = get_post_meta($post_id,'job_occupation',true);
    $place_of_birth = get_post_meta($post_id,'place_of_birth',true);
    $formatted_time = get_post_meta($post_id,'time_of_birth',true);
    $time_of_birth = date("h:i A", strtotime($formatted_time)); 
    
    ?>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <th style="border: 1px solid black; padding: 8px;">Image</th>
                <th style="border: 1px solid black; padding: 8px;">Name</th>
                <th style="border: 1px solid black; padding: 8px;">Gender</th>
                <th style="border: 1px solid black; padding: 8px;">Height</th>
                <th style="border: 1px solid black; padding: 8px;">Date of Birth</th>
                <th style="border: 1px solid black; padding: 8px;">Place of Birth</th>
                <th style="border: 1px solid black; padding: 8px;">Time of Birth</th>
                <th style="border: 1px solid black; padding: 8px;">Rashi</th>
                <th style="border: 1px solid black; padding: 8px;">Job/Occupation</th>
                <th style="border: 1px solid black; padding: 8px;">Contact Number</th>
                <th style="border: 1px solid black; padding: 8px;">Address</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 8px; text-align: center; background: #e8eaed;">
                    <img src="<?php echo $profile_image ; ?>" width="150" style="display: block; margin: auto; border: 1px solid;">
                </td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px; "><?php echo $name ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $gender ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $height ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $dob ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $place_of_birth ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $time_of_birth ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $rashi ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $job_occupation ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $contact_number ; ?></td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px;"><?php echo $address ; ?></td>
            </tr>
        </tbody>
    </table>

<?php 
}

function add_family_details()
{
    add_meta_box(
        'family_details_meta_box',
        'Family Details',
        'display_family_details',
        'resume',
        'normal',
        'low'
    );
}
add_action('add_meta_boxes', 'add_family_details');

function display_family_details($post)
{ 
    $post_id = $post->ID;
    
    ?>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <th style="border: 1px solid black; padding: 8px;">Father Name</th>
                <th style="border: 1px solid black; padding: 8px;">Father Occupation</th>
                <th style="border: 1px solid black; padding: 8px;">Mother Name</th>
                <th style="border: 1px solid black; padding: 8px;">Mother Occupation</th>
                <th style="border: 1px solid black; padding: 8px;">Total Brother</th>
                <th style="border: 1px solid black; padding: 8px;">Total Sister</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px; ">1</td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px; ">1</td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px; ">1</td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px; ">1</td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px; ">1</td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; font-size: 15px; ">1</td>
            </tr>
        </tbody>
    </table>

<?php 
}


















function create_resume_post_type()
{
    include plugin_dir_path(__FILE__) . 'post-type.php';
}
add_action('init', 'create_resume_post_type');
function display_custom_form()
{
    ob_start();
    include plugin_dir_path(__FILE__) . 'user-form.php';
    return ob_get_clean();
}
add_shortcode('custom_form', 'display_custom_form');


function handle_ajax_form_submission()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $post_data = array(
            'post_title'   => sanitize_text_field($_POST['name']),
            'post_content' => 'Resume Submission',
            'post_status'  => 'publish',
            'post_type'    => 'resume'
        );
        $post_id = wp_insert_post($post_data);
        if ($post_id) {
            if (!empty($_FILES['image']['name'])) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                    echo json_encode(array('success' => false, 'message' => 'File upload error: ' . $_FILES['image']['error']));
                    wp_die();
                }
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowed_types)) {
                    echo json_encode(array('success' => false, 'message' => 'Invalid file type.'));
                    wp_die();
                }
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($_FILES['image'], $upload_overrides);

                if ($movefile && !isset($movefile['error'])) {
                    update_post_meta($post_id, 'profile_image', esc_url($movefile['url']));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Image upload failed: ' . $movefile['error']));
                    wp_die();
                }
            }
            $meta_fields = [
                'gender',
                'dob',
                'place_of_birth',
                'time_of_birth',
                'rashi',
                'height',
                'college_name',
                'job_occupation',
                'father_name',
                'father_occupation',
                'mother_name',
                'mother_occupation',
                'contact_number',
                'father_contact_number',
                'address'
            ];
            foreach ($meta_fields as $field) {
                if (isset($_POST[$field])) {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
            $numeric_fields = ['total_brother', 'total_sister'];
            foreach ($numeric_fields as $field) {
                if (isset($_POST[$field]) && is_numeric($_POST[$field])) {
                    update_post_meta($post_id, $field, intval($_POST[$field]));
                }
            }
            echo json_encode(array('success' => true, 'message' => 'Form submitted successfully!'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Error submitting form.'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
    }
    wp_die();
}

add_action('wp_ajax_submit_custom_form', 'handle_ajax_form_submission');
add_action('wp_ajax_nopriv_submit_custom_form', 'handle_ajax_form_submission');

