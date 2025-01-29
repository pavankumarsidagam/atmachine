<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="UNI BANK LOGIN PAGE">
    <meta property="og:image" content="https://images.app.goo.gl/9Jxc1swN2PNuLKKt9"> <!-- Replace with the absolute URL of your image -->
    <link rel="stylesheet" href="./login_atm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login Form</title>
</head>
<body>
    <form method="POST" action="">
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <div class="sign-in-form">



                     <!--     PHP CODE START HERE!      -->

                    <?php
                        require_once("config.php");

                        if(isset($_POST["log_in"])){

                            session_start();


                            $name_login = $_POST["name_login"];
                            $login_password = md5($_POST["login_password"]);

                            if (empty($name_login) || empty($login_password)) {
                                echo '<script>
                                            Swal.fire({
                                                title: "Error",
                                                text: "Please enter both username and password.",
                                                icon: "question"
                                            });
                                        </script>';
                            } else {
                                // $qry = mysqli_query($conn, "SELECT * FROM users_table WHERE username = '$name_login' AND password_ = '$login_password' AND status_ = '1'") or die(mysqli_error($conn));
                                
                               $user = $collection->findOne([
                                'username' => $name_login,
                                'password_' => $login_password,
                                'status_' => '1'
                               ]);
                                if ($user) {

                                    // $user_details = mysqli_fetch_object($qry);

                                    // $user_id = $user_details->user_id;
                                    // $atm_pin = $user_details->atm_pin;
                                    
                                    $_SESSION['name_login'] = $name_login;
                                    $_SESSION['user_id'] = (string)$user->_id;
                                    $_SESSION['atm_pin'] = $user->atm_pin;


                                    echo '<script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "Signed in successfully",
                                        position: "center",
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal.resumeTimer;
                                        }
                                    }).then(() => {
                                        window.location.href = "select_language.php";
                                    });
                                </script>';

                                } else {
                                    echo '<script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Please enter correct username and password!",
                                      });
                                        </script>';
                                }
                            }
                        }
                        ?>

                        <!--     PHP CODE ENDS HERE!      -->


                        <div class="logo">
                            <img src="./images/Untitled_design__1_-removebg-preview.png" alt="unibank" >
                            <h3>Unibank</h3>
                        </div>
                        <div class="heading">
                            <h2>Log In</h2>
                            <h6>Enter Your ATM Login Details</h6>
                        </div>
                        
                        <div class="actual-form">
                            <div class="input-wrap" >
                                <input type="text" name="name_login" id="name_login" class="input-field">
                                <label>Username</label>
                            </div>
                            <div class="input-wrap">
                                <input type="password" name="login_password" id="login_password" class="input-field" >
                                <label>Password</label>
                                <span class="eye-icon" onclick="togglePasswordVisibility()">&#128065;</span>
                            </div>
                            <input type="submit" value="Log In" class="sign-btn" name="log_in" id="log_in">
                            <p class="text">Please Ensure that Your login Details are correct or Not.</p>
                        </div>
                    </div>
                </div>

                <div class="carousel">
                    <img src="./images/_2d598f96-1ba7-4842-981e-22a6729040b3.jpg" class="image" alt="">
                   <!-- <div class="images-wrapper">
                        
                    </div>-->

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Welcome to Uni Bank</h2>                               
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </main>
</form>
    <script>

        // INPUT FEILD CSS EFFECTS


        const inputs = document.querySelectorAll(".input-field");

        inputs.forEach((inp) =>{
            inp.addEventListener("focus",()=>{
                inp.classList.add("active");
            });
            inp.addEventListener("blur",()=>{
                if(inp.value !="") return;
                inp.classList.remove("active");
            })
        })

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("login_password");
            const eyeIcon = document.querySelector(".eye-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.innerHTML = "&#128064;";
            } else {
                passwordInput.type = "password";
                eyeIcon.innerHTML = "&#128065;"; 
            }
        }
        </script>
</body>
</html>