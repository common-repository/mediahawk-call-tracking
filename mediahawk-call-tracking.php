<?php
/*
Plugin Name: MediaHawk Call Tracking Integration
Plugin URI: http://mediahawk.co.uk/
Description: Plugin adds Mediahawk call tracking software to website.
Version: 2.0
Author: Lukasz Slominski
License: GPLv2
*/
if ( !class_exists( 'mediahawk-call-tracking' ) ) {
    
    class mediahawk_call_tracking {
        function __construct() {
            add_action( 'admin_init', array( &$this, 'admin_init' ) );
            add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
            add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
        }
        function admin_init() {
            register_setting( 'insert-mediahawk-details', 'mediahawk_active', 'trim' );
            register_setting( 'insert-mediahawk-details', 'mediahawk_insert_tracking_id', 'trim' );
        }
        function admin_menu() {
            $menu_page = add_submenu_page( 'options-general.php', 'Mediahawk', 'Mediahawk call tracking', 'manage_options', __FILE__, array( &$this, 'mediahawk_options_panel' ) );
        }
        
        public static function mediahawk_number_shortcode($atts, $content = "") {
            $output = '';
            $mediahawk_number_atts = shortcode_atts( array(
                'number' => '',
                'class'  => ''
            ), $atts);
            $output = '<span class="'. wp_kses_post( $mediahawk_number_atts[ 'class' ] ) .'">'; 
            $output .= wp_kses_post( $mediahawk_number_atts[ 'number' ] ) ;
            $output .='</span>';
        return "$output";
        }
        function wp_footer() {
            if ( !is_admin() && !is_robots() && !is_trackback() && !is_feed() ) {
                $active = get_option( 'mediahawk_active', '' );
                if($active == 1){
                    $tracking_id = get_option('mediahawk_insert_tracking_id', '');
                    
                    $code = "<script type=\"text/javascript\">
var _mhct = _mhct || [];
_mhct.push(['mhCampaignID','$tracking_id']);
!function(){var c=document.createElement('script');c.type='text/javascript',c.async=!0,c.src='//www.dynamicnumbers.mediahawk.co.uk/mhct.min.js';var i=document.getElementsByTagName('script')[0];i.parentNode.insertBefore(c,i)}();
</script>
";

                            
                }
                
            
                if ( $code != '' ) {
                    echo $code, "\n";
                }
            }
        }
        function mediahawk_options_panel() { ?>
            <div id="mediahawk-wrap">
                <div class="wrap">
                <?php screen_icon(); ?>
                    <h2>Mediahawk Number changing options</h2>
                    <hr />
                    <div class="mediahawk-wrap" style="width: 360px;float: left;margin-right: 2rem;">
                    
                        <form name="dofollow" action="options.php" method="post">
                        
                            <?php settings_fields( 'insert-mediahawk-details' ); ?>
                            <h3 class="mediahawk-labels" for="tracking_type">Turn on Mediahawk Call Tracking?</h3>
                            <input type="radio" name="mediahawk_active" value="1" <?php if(esc_html( get_option( 'mediahawk_active' ) ) == 1){echo 'checked';}  ?> />On<br/>
                            <input type="radio" name="mediahawk_active" value="0" <?php if(esc_html( get_option( 'mediahawk_active' ) ) == 0){echo 'checked';}  ?> />Off<br/>
                            
                            <h3 class="mediahawk-labels footerlabel" for="mediahawk_insert_tracking_id">Your tracking ID</h3>
                            <input type="text" name="mediahawk_insert_tracking_id" value="<?php echo esc_html( get_option( 'mediahawk_insert_tracking_id' ) ); ?>"  /><br />
                        <p class="submit">
                            <input class="button button-primary" type="submit" name="Submit" value="Save settings" /> 
                        </p>

                        </form>
                    </div>
                    
                    
                    <div class="mediahawk-sidebar" style="max-width: 360px;float: left;">
                        <div class="mediahawk-improve-site" style="padding: 1rem; background: rgba(0, 0, 0, .02);">
                            <h2>Next Step!</h2>
                            <p>To make numbers changing you have to add class to wrap number with <xmp> <span class="MediahawkNumberClass"> </xmp> element and add Mediahawk number class to it. 
                            <br/>
                            You will find it in your setup email.</p>
                            You can do it manually or using shortcode in posts and pages:<br/>
                            <code>[mediahawk_number number="Your default number" class="MediahawkNumberClass"]</code><br/><br/>
                            If you want to show number as a link add 'mhMobile' to class parameter.</br>

                        </div>
                        <div class="mediahawk-support" style="padding: 1rem; background: rgba(0, 0, 0, .02);">
                            <h2>Need Support?</h2>
                            <p>For any help call our Client Services on 0333 222 8333 </p>
                        </div>
                        
                    </div>
                
                </div>
                </div>

                <?php
        }
    }
    add_shortcode( 'mediahawk_number', array( 'mediahawk_call_tracking', 'mediahawk_number_shortcode' ) );
}
$mediahawk_call_tracking = new mediahawk_call_tracking();
?>