<form method="post" class=" card-like" style="padding:10px;">
        	<h3><?php _e( 'Login', 'woocommerce' ); ?></h3>
			<p class="form-row row">
				<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text"  placeholder="<?php _e( 'Username or email', 'woocommerce' ); ?>" class="form-control" name="username" id="username" />
			</p>
			<p class="form-row row">
				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="form-control"  placeholder="<?php _e( 'Password', 'woocommerce' ); ?>" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>

			<p class="form-row">
				<?php $woocommerce->nonce_field('login', 'login') ?>
				<button type="submit" class="btn btn-primary" name="login" 
                	value="<?php _e( 'Login', 'woocommerce' ); ?>" ><i class="fa fa-lock"></i> <?php _e( 'Login', 'woocommerce' ); ?></button>
				<a class="lost_password" href="<?php

				$lost_password_page_id = woocommerce_get_page_id( 'lost_password' );

				if ( $lost_password_page_id )
					echo esc_url( get_permalink( $lost_password_page_id ) );
				else
					echo esc_url( wp_lostpassword_url( home_url() ) );

				?>"><?php _e( 'Lost Password?', 'woocommerce' ); ?></a>
			</p>
		</form>