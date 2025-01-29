<?php
 require_once("config.php");
 if (isset($_POST['exit'])) {
  sleep(1);
  header("Location: select_transaction.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Enter Pin</title>
</head>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&family=Roboto:wght@500&display=swap');

    body, input {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      background-color: #001f33;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #002147;
      color: white;
    }
    img {
      padding-right: 10px;
      height: auto;
      max-width: 100px; 
    }

    span {
      font-size: 50px; 
      font-weight: 800;
    }

    .navbar1 {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #0066cc;
      color: white;
    }
    p{
        font-weight: 600;
        font-size: 40px;
        margin-bottom: 0;
        margin: 20px;
    }


    .pin_input{
        width: 100%;
        height: 200px;
       /* background-color: aqua;*/
        align-items: center;
        display: flex;
       justify-content: center;
    }
    .atm_pin{
       /* text-align: center;*/
        border-radius: 20px;
        font-size: 20px;
        padding: 20px 80px;
        background-color: white;
        border :none;
        outline: none;
    }

    .press_here{
        font-weight: 600;
        background-color: #0056b3;
        color: white;
        border: none;
        padding: 20px 38px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 30px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 50px;
        padding-right: 150px;
    }
    .press_button{
        display: flex;
        justify-content: flex-end;
    }

    .btn{
        font-weight: 600;
        border: none;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 3px 2px;
        cursor: pointer;
        border-radius: 50px;
        width: 200px;
    }
    .exit{
        width: 100%;
        margin-top: 80px;
        display: flex;
        justify-content: center;
    }
    
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }


    @media (max-width: 700px) {
    .press_here {
        font-size: 25px;
        padding-right: 38px;
    }
    .atm_pin{
        padding: 20px 32px;
    }
    .pin_input{
        height: 150px;
    }
    .exit{
        margin-top: 50px;
    }
    }
  </style>
<body>
  
                     <!--     PHP CODE START HERE!      -->

                     <?php
                       
                        session_start();

                        if(isset($_POST["press_button"])){
                          $pin_input = $_POST['pin_input'];
                          $user_id = $_SESSION['user_id'];

                          $pin_qry =  mysqli_query($conn,"SELECT atm_pin FROM users_table WHERE user_id = '$user_id'")or die(mysqli_error($conn)); 

                          $atm_pin =  mysqli_fetch_object($pin_qry);

                          $pin = $atm_pin->atm_pin;

                          if($pin_input == $pin){
                              if( $_SESSION['balance_enquiry'] == "balance_enquiry"){
                                sleep(1);
                                header("Location: avaliable_blnc.php");
                                exit();
                              }else if( $_SESSION['deposit'] == "deposit"){
                                sleep(1);
                                header("Location: deposit.php");
                                exit();
                              }else if(  $_SESSION['pin_change'] == "pin_change"){
                                sleep(1);
                                header("Location: pinchange.php");
                                exit();
                              }
                              else if(  $_SESSION['withdrawal'] == "withdrawal"){
                                sleep(1);
                                header("Location: withdrawal.php");
                                exit();
                              }
                              else if( $_SESSION['transactions'] == "transactions"){
                                sleep(1);
                                header("Location: transactions.php");
                                exit();
                              }
                              else if( $_SESSION['mini_statement'] == "mini_statement"){
                                sleep(1);
                                header("Location: ministatement.php");
                                exit();
                              }
                          }else{
                            echo '<script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Please enter correct Atm Pin!",
                                      });
                                        </script>';

                                    }
                        }


                        ?>

                        <!--     PHP CODE ENDS HERE!      -->
    <main>
      <form method="POST">
          <div>
              <nav class="navbar navbar-expand-lg">
                  <img src="./images/Untitled_design__1_-removebg-preview.png" alt="UniBank Logo">
                  <span>UNI Bank</span>
              </nav>
          </div>
          <div>
              <nav class="navbar1 navbar-expand-lg">
                  <p class="text-center" style="align-items: center; height: 100%;">Enter Your Pin</p>
              </nav>
          </div>
          <div class="pin_input">
            <input type="password" class="atm_pin" name="pin_input" id="pin_input" value="" maxlength="4" autocomplete="off" required>
          </div>
          <div class="press_button">
            <input type="submit" value="Press Here" class="press_here" name="press_button" id="press_button" value="" />
          </div>
          <div class="text-center exit"><input type="submit" value="Main Menu" name='exit' id='exit' class="btn btn-success"></div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>