<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the color picker field including HTML and Validation.
 *
 * @link       http://resulta-code-challenge.com
 * @since      1.0.0
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/admin/partials
 */


?>

<input type="text" name="rcc_header_bg_color" class = "color-picker" id="color_picker" value="<?php echo esc_attr(get_option('rcc_header_bg_color')) ?>">
