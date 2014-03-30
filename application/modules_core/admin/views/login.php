<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Admin Login</h1>
	<div class="msg"><?php echo $this->session->flashdata('admin_login_failed'); ?></div>
	<form action="<?php echo base_url().$form_action ?>" method="POST">
		<input type="text" name ="username"/>
		<input type="password" name ="password"/>
		<input type="submit" value="Login">
	</form>

</body>
</html>