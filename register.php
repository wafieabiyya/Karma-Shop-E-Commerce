<?php
include 'server/connection.php';

if (isset($_SESSION['logged_in'])) {
        header('location: account.php');
        exit;
    }

    if (isset($_POST['register'])) {
        $name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $phone = $_POST['user_phone'];
        $city = $_POST['user_city'];
        $address = $_POST['user_address'];

        // This is image file
        $photo = $_FILES['photo']['tmp_name'];

        // Photo name
        $photo_name = str_replace(' ', '_', $name) . ".jpg";

        // Upload image
        move_uploaded_file($photo, "img/profile/" . $photo_name);

        // If password didn't match
        if ($password !== $confirm_password) {
            header('location: register.php?error=Password did not match');

         //If password less than 6 characters
         } else if (strlen($password) < 6) {
             header('location: register.php?error=Password must be at least 6 characters');

        // Inf no error
        } else {
            // Check whether there is a user with this email or not
            $query_check_user = "SELECT COUNT(*) FROM users WHERE user_email = ?";

            $stmt_check_user = $conn->prepare($query_check_user);
            $stmt_check_user->bind_param('s', $email);
            $stmt_check_user->execute();
            $stmt_check_user->bind_result($num_rows);
            $stmt_check_user->store_result();
            $stmt_check_user->fetch();

            // If there is a user registered with this email
            if ($num_rows !== 0) {
                header('location: register.php?error=User with this email already exists');
            
            // If no user registered with this email
            } else {
                $query_save_user = "INSERT INTO users (user_name, user_email, user_password, user_phone, user_address, user_city, user_photo) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)";

                // Create a new user
                $stmt_save_user = $conn->prepare($query_save_user);
                $stmt_save_user->bind_param('sssssss', $name, $email, $password, $phone, $address, $city,$photo_name);
                
                // If account was created successfully
                if ($stmt_save_user->execute()) {
                    $user_id = $stmt_save_user->insert_id;

                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_phone'] = $phone;
                    $_SESSION['user_address'] = $address;
                    $_SESSION['user_city'] = $city;
                    $_SESSION['user_photo'] = $photo_name;
                    $_SESSION['logged_in'] = true;
                    
                    header('location: account.php?register_success=You registered successfully!');
                // If account couldn't registered
                } else {
                    header('location: register.php?error=Could not create an account at the moment');
                }
            }
        }
    }
?>
<?php include 'layouts/header.php' ?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Register</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Register</a>
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
                    <div class="login_form_inner">
                        <h3>Creat New Account</h3>
                        <form class="row login_form" action="register.php" method="post" id="contactForm" novalidate="novalidate">
                            <div class="col-md-10 form-group">
                                <input type="text" class="form-control" id="name" name="user_name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                            </div>
                            <div class="col-md-10 form-group">
                                <input type="text" class="form-control" id="name" name="user_email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            </div>
                            <div class="col-md-10 form-group">
                                <input type="password" class="form-control" id="name" name="user_password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-10 form-group">
                                <input type="password" class="form-control" id="name" name="confirm_password" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                            </div>
                            <div class="col-md-10 form-group">
                                <input type="text" class="form-control" id="name" name="user_phone" placeholder="Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'">
                            </div>
                            <div class="col-md-10 form-group">
								<input type="text" class="form-control" id="name" name="user_address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
							</div>
                            <div class="col-md-10 form-group">
								<input type="text" class="form-control" id="name" name="user_city" placeholder="City" onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'">
							</div>
                            <div class="col-md-10 form-group">
								<input type="file" class="form-control" id="name" name="photo" onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'">
							</div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn" name="register" >Register</button>
                                <a href="login.php">Do you have an account? sign in </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Register Box Area =================-->

<?php include 'layouts/footer.php' ?>