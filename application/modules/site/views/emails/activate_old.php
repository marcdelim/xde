<html>
	<head><title>Welcome to <?=SYSTEM_NAME;?>!</title></head>
	<body>
		<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Welcome to <?=SYSTEM_NAME;?>!</h2>
		To fully activate your account we need to verify your email address, please follow this link:<br />
		<br />
		<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/user/activate/'.$user_id.'/'.$password_key); ?>" style="color: #3366cc;">Activate</a></b></big><br />
		<br />
		Link doesn't work? Copy the following link to your browser address bar:<br />
		<nobr><a href="<?php echo site_url('/auth/user/activate/'.$user_id.'/'.$password_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/user/activate/'.$user_id.'/'.$password_key); ?></a></nobr><br />
		<br />
		<br />
		Best Regards,<br />
		<?=POWERED_BY;?>, <?=COMPANY_NAME;?>
	</body>
</html>