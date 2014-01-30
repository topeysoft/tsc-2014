<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<div class="row" id="customer_login">

	<div class="col-xs-12 col-sm-6" style="margin-bottom:20px;">

<?php endif; ?>
		
		<?php include("login.php") ?>
       

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="col-xs-12 col-sm-6">

		<p>
        	<i class="fa fa-info fa-3x pull-left color-blue"></i>
            New user?<br />
			<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/my-account/register' ) ); ?>" rel="home"><?php _e( 'Register now', 'woocommerce' ); ?></a>
        </p>
       

	</div>

</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>