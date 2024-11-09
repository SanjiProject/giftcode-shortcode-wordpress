<?php
/*
Plugin Name: Customizable Gift Code Shortcode
Description: A plugin to display a customizable gift code with a shortcode, where the gift code and button color can be changed from the plugin settings page. It also allows copying the shortcode from the settings page.
Version: 1.1
Author: Sanji
*/

// Enqueue WordPress default color picker and other necessary styles/scripts
function gift_code_shortcode_styles_custom() {
    // Enqueue the color picker CSS and JS
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    
    ?>
    <style>
        button {
            background-color: var(--button-bg-color, #05571B); /* Use customizable button background color */
            color: var(--button-text-color, white); /* Set button text color */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .flex-container {
            display: flex;
            flex-direction: column; /* Stack items vertically */
            justify-content: center; /* Center items horizontally */
            align-items: stretch; /* Stretch items to full width */
            margin-top: 50px; /* Adjust margin as needed */
        }

        .shortcode-display {
            margin-top: 20px;
            font-size: 16px;
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Simple button style for color pickers */
        .button-color-picker {
            background-color: #05571B; /* Default background color */
            color: white;
            border: 1px solid #ddd;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-color-picker:hover {
            background-color: #003c14; /* Darker shade when hovered */
        }

        input[type="color"] {
            margin-left: 10px;
            cursor: pointer;
            border: none;
        }

        .shortcode-info {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
    <script>
        function copyText() {
            // Get the text field
            var inputField = document.getElementById("myInput");

            // Select the text field
            inputField.select();
            inputField.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(inputField.value).then(() => {
                // Alert the copied text
                alert("Copied the text: " + inputField.value);
            }).catch(err => {
                console.error("Failed to copy: ", err);
            });
        }
    </script>
    <?php
}
add_action('wp_head', 'gift_code_shortcode_styles_custom');

// Add Settings Menu to WordPress Admin
function gift_code_plugin_menu_unique() {
    add_options_page(
        'Gift Code Settings',        // Page title
        'Gift Code Shortcode',       // Menu title
        'manage_options',            // Capability
        'gift-code-settings',        // Menu slug
        'gift_code_settings_page'    // Function that will display the settings page
    );
}
add_action('admin_menu', 'gift_code_plugin_menu_unique');

// Settings Page Content
function gift_code_settings_page() {
    ?>
    <div class="wrap">
        <h1>Gift Code Shortcode Settings</h1>
        <form method="post" action="options.php">
            <?php
            // Output nonce, action, and option fields for settings
            settings_fields('gift_code_settings_group');
            do_settings_sections('gift-code-settings');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Gift Code</th>
                    <td><input type="text" name="gift_code" value="<?php echo esc_attr(get_option('gift_code', 'FB7FA470F6BC0AB1763AA80740858D06')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

        <!-- Shortcode info box -->
        <div class="shortcode-info">
            <h3>Use the following shortcode on your page:</h3>
            <p><strong>[gift_code]</strong></p>
            <p>This shortcode will display the gift code on the front-end with the customizable button. You can copy and paste this shortcode anywhere on your pages or posts where you want the gift code to appear.</p>
        </div>
    </div>
    <?php
}

// Register Settings
function gift_code_register_settings() {
    register_setting('gift_code_settings_group', 'gift_code');
    add_settings_section('gift_code_settings_section', 'Gift Code Settings', null, 'gift-code-settings');

    // Register the Button Background Color and Text Color settings
    add_settings_field('button_bg_color', 'Button Background Color', 'gift_code_button_bg_color_render', 'gift-code-settings', 'gift_code_settings_section');
    add_settings_field('button_text_color', 'Button Text Color', 'gift_code_button_text_color_render', 'gift-code-settings', 'gift_code_settings_section');
}
add_action('admin_init', 'gift_code_register_settings');

// Render color picker for Button Background Color (HTML5 color picker)
function gift_code_button_bg_color_render() {
    $color = get_option('button_bg_color', '#05571B');
    echo '<input type="color" name="button_bg_color" value="' . esc_attr($color) . '" />';
}

// Render color picker for Button Text Color (HTML5 color picker)
function gift_code_button_text_color_render() {
    $color = get_option('button_text_color', 'white');
    echo '<input type="color" name="button_text_color" value="' . esc_attr($color) . '" />';
}

// Shortcode function
function gift_code_shortcode($atts) {
    // Set up default attributes
    $atts = shortcode_atts(
        array(
            'code' => get_option('gift_code', 'FB7FA470F6BC0AB1763AA80740858D06'), // Get code from settings
            'button_color' => get_option('button_bg_color', '#05571B'), // Get button background color from settings
            'button_text_color' => get_option('button_text_color', 'white'), // Get button text color from settings
        ),
        $atts,
        'gift_code'
    );

    // Generate the HTML output for the shortcode
    $output = '<div class="flex-container" style="--button-bg-color: ' . esc_attr($atts['button_color']) . '; --button-text-color: ' . esc_attr($atts['button_text_color']) . ';">';
    $output .= '<label for="myInput">Gift Code:</label>';
    $output .= '<input type="text" value="' . esc_attr($atts['code']) . '" id="myInput" readonly>';
    $output .= '<button onclick="copyText()">Copy code</button>'; // Copy code button will appear on the page where shortcode is used
    $output .= '</div>';

    return $output;
}
add_shortcode('gift_code', 'gift_code_shortcode');
