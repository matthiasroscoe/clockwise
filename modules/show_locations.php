<?php 
if ($m['filter_type'] == 'none') {
    include('show_locations/show-all-locations.php');
} else {
    include('show_locations/show-locations-by-region.php');
}
?>