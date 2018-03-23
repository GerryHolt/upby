<?php if ( is_user_logged_in() ) {
    $geo = WPEngine\GeoIp::instance();
    if(isset($_COOKIE['override']))  {
        // Do Nothing
    } else {
        $country = getenv('HTTP_GEOIP_COUNTRY_CODE');
        $country = strtolower($country);
        setcookie('location',$country,time() + 24 * 3600); // 24 hours
        if(isset($_COOKIE['location']) && $_COOKIE['location'] == 'us'){
            if(isset($_COOKIE['dontLoop']) && $_COOKIE['dontLoop'] == 'stop'){
            } else {
                setcookie('dontLoop','stop',time() + 24 * 3600); // 24 hours?>
                <script language="javascript">
                    window.location.href = "https://uppababy.com"
                </script>
            <?php }
        } elseif(isset($_COOKIE['location']) && $_COOKIE['location'] == 'ca') {
            if(isset($_COOKIE['dontLoop']) && $_COOKIE['dontLoop'] == 'stop'){
            } else {
                setcookie('dontLoop','stop',time() + 24 * 3600); // 24 hours?>
                <script language="javascript">
                    window.location.href = "https://uppababy.com/ca"
                </script>
            <?php }
        } elseif(isset($_COOKIE['location']) && $_COOKIE['location'] == 'uk') {
            if(isset($_COOKIE['dontLoop']) && $_COOKIE['dontLoop'] == 'stop'){
            } else {
                setcookie('dontLoop','stop',time() + 24 * 3600); // 24 hours?>
                <script language="javascript">
                    window.location.href = "https://uk.uppababy.com"
                </script>
            <?php }
        }

    }
} else {

}?>

<!-- // New method once all sites are moved
<?php if(isset($_COOKIE['location'])){
    if(isset($_COOKIE['dontLoop']) && $_COOKIE['dontLoop'] == 'stop'){
    } else {
        setcookie('dontLoop','stop',time() + 24 * 3600); // 24 hours?>
        <script language="javascript">
            window.location.href = "https://uppababy.com"
        </script>
    <?php }
} ?>

-->
