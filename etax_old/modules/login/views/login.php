<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
	<title>:: SIMPATDA-KOTA BEKASI ::</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" media="all" type="text/css" href="assets/styles/style_login.css" />

	<script type="text/javascript" src="assets/scripts/jquery/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="assets/scripts/jquery/cmxforms.js"></script>
	<script type="text/javascript" src="assets/scripts/jquery/jquery.metadata.js"></script>
	<style>
		input::placeholder {
			color: white;
			font-weight: bold;
			text-align: left;
		}
	</style>
</head>

<body>
	<div class="container">
		<img src="assets/images/login/Simpatda.png" />
		<h1>BADAN PENDAPATAN KOTA BEKASI</h1>
		<div class="contact-form">
			<div class="profile-pic">
				<img src="assets/images/login/logo.png" alt="User Icon" />
			</div>
			<div class="signin">
				<form name="form_login" id="form_login" method="post" onsubmit="return false;">
					<input name="user_name" class="user" id="username" type="text" size="15" autocomplete="off" placeholder="Username" />
					<input name="pswd" class="pass" id="password" type="password" size="15" placeholder="Password" />
				</form>
			</div>
			<input type="submit" class="butlogin" name="login" id="login" value="Login" />
		</div>
	</div>
	<div class="footer">
		<p>Copyright &copy; 2023 BAPENDA Kota BEKASI. All Rights Reserved </p>
	</div>
</body>

</html>

<script type="text/javascript">
	var GLOBAL_MAIN_VARS = new Array();
	GLOBAL_MAIN_VARS["BASE_URL"] = "<?= base_url(); ?>";
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/scripts/private/login.js"></script>