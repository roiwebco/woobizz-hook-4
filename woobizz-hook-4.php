<?php
/*
Plugin Name: Woobizz Hook 4 
Plugin URI: http://woobizz.com
Description: Add widget content after buy button on checkout page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook4
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook4_load_textdomain' );
function woobizzhook4_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook4', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
    add_action( 'widgets_init', 'woobizzhook4_widget',104);
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook4_admin_notice' );
}
//Add Hook 4
function woobizzhook4_widget() {
	$args = array(
				'id'            => 'woobizzhook4_id',
				'name'          =>__( 'Woobizz Hook 4', 'woobizzhook4' ),
				'description'   =>__( 'Add widget content after buy button on checkout page', 'woobizzhook4'),
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
	);
	register_sidebar( $args );

	add_action( 'woocommerce_review_order_after_submit', 'woobizzhook4_display',100);
	function woobizzhook4_display(){
		?>
		<div class="woobizzhook4-widget-div">
			<div class="woobizzhook4-widget-content">
				<?php dynamic_sidebar ( 'Woobizz Hook 4'); ?>
			</div>
		</div>
		<?php
	}
}
//Hook1 Notice
function woobizzhook4_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 4 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook4' ); ?></p>
    </div>
    <?php
}