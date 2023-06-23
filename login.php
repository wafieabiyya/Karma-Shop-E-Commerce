<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
	header('location: index.php');
	exit;
}

if (isset($_POST['login_btn'])) {
	$email = $_POST['user_email'];
	$password = ($_POST['user_password']);

	$query = "SELECT * FROM users WHERE user_email = ? AND user_password = ? LIMIT 1";

	$stmt_login = $conn->prepare($query);
	$stmt_login->bind_param('ss', $email, $password);

	if ($stmt_login->execute()) {
		$stmt_login->bind_result($user_id, $user_name, $user_email, $user_password, $user_phone, $user_address, $user_city, $user_photo);
		$stmt_login->store_result();

		if ($stmt_login->num_rows() == 1) {
			$stmt_login->fetch();

			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_name'] = $user_name;
			$_SESSION['user_email'] = $user_email;
			$_SESSION['user_phone'] = $user_phone;
			$_SESSION['user_address'] = $user_address;
			$_SESSION['user_city'] = $user_city;
			$_SESSION['user_photo'] = $user_photo;
			$_SESSION['logged_in'] = true;

			header('location: account.php?message=Logged in successfully');
		} else {
			header('location: login.php?error=Could not verify your account');
		}
	} else {
		// Error
		header('location: login.php?error=Something went wrong!');
	}
}
?>
<?php include 'layouts/header.php' ?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="login.php">Login</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="img/login.jpg" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="register.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="login.php" method="POST" id="contactForm" novalidate="novalidate">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" name="user_email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="passwrod" name="user_password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" name="login_btn" value="Login" class="primary-btn">Log In</button>
								<a href="#">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
<?php  include 'layouts/footer.php' ?>