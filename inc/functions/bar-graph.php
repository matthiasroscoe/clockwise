<?php 

/**
 * Calculates the height of a section of a bar (e.g. Rent/Services & Utilities)
 * Pass in both the value of the bar section and the highest y-axis value
 */

function get_bar_section_height($section_value = null) {
    if ($section_value == null || ! get_field('y_axis_total', 'option') ) {
        return 0;
    }

    $y_axis_total = get_field('y_axis_total', 'option');
    
    return ($section_value / $y_axis_total) * 100;
}



/**
 * Format currency value
 * E.g. converts '11000' into '11k', or '1450000' into '1.45m'
 */

function format_currency($num) {
    if($num>1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }
    
    return $num;
}
?>