<?php
/**
Plugin Name: GeoIP Redirect
Version: 1.0
Description: Depends on GeoIP Detection plugin and redirects based on country.
Author: Maurice Faber
Author URI: https://github.com/morriz
License: GPL2
*/
function geoip_redirect_header() {
    if (is_admin()) return;
    $country = geoip_detect2_get_info_from_current_ip()->country->isoCode;
    ?>
    <script>
        var baseUrl = 'https://' + window.location.hostname + '/'
        var otherUrl = 'https://yourdomain.com/'
       	var target = {
            All: baseUrl + 'nl/',
            NL : baseUrl + 'nl/',
            GB : baseUrl + 'uk/',
            IE : baseUrl + 'uk/',
            FR : baseUrl + 'fr/',
            MC : baseUrl + 'fr/',
            IT : baseUrl + 'it/',
            SM : baseUrl + 'it/',
            ES : baseUrl + 'es/',
            AD : baseUrl + 'es/',
            AT : baseUrl + 'de/',
            CH : baseUrl + 'de/',
            DE : baseUrl + 'de/',
            LI : baseUrl + 'de/',
            CZ : baseUrl + 'de/',
            US : otherUrl,
            CA : otherUrl,
        }
        var country = '<?php echo $country; ?>';
        console.log('detected country: ', country);
        var targetCountry = target[country] || target.All;
        if (window.top.location.href.indexOf(targetCountry) === -1) window.top.location.href = targetCountry;
    </script>
    <?php
}
add_action('wp_head', 'geoip_redirect_header');