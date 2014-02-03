<?php 
$register = isset($_GET['register'])?$_GET['register']:""; 
$reset = isset($_GET['reset'])?$_GET['reset']:""; 
if ($register == true) { ?>

			<div class="message-box card-like tsc-info">
            	<h4 >Success!</h4>
				<p>Check your email for the password and then return to log in.</p>
			</div>
			<?php } elseif ($reset == true) { ?>

			<div class="message-box  card-like tsc-info">
                <h4>Success!</h4>
				<p>Check your email to reset your password.</p>
			</div>
			<?php } else { ?>

			<div class=" hidden-xs message-box  card-like">
            	<h4>Login or Create an Account</h4>
				<p>Log in or sign up! It&rsquo;s fast &amp; <em>free!</em></p>
			</div>
			<?php } ?>