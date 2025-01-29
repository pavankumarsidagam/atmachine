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
  <title>Pin Change</title>
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

    .pin p{
        color: white;
    }


    .pin_input{
        width: 100%;
        height: 50px;
       /* background-color: aqua;*/
       margin-top: 20px;
        align-items: center;
        display: flex;
       justify-content: center;
    }
    .atm_pin{
        text-align: center;
        border-radius: 20px;
        font-size: 20px;
        padding: 15px 40px;
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
    }
    .press_button{
        display: flex;
        justify-content: flex-end;
        margin-right: 30px;
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
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }
    
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }


    .pin{
        display: flex;
        justify-content: space-between;
        width: 70%;
    }
    
    @media (max-width: 700px) {
    .press_here {
        font-size: 25px;
        padding-right: 38px;
    }
    .press_button{
        margin-top: 15px;
        margin-right: 10px;
    }
    .atm_pin{
        padding: 10px 20px;
    }
    .pin_input{
        margin-top: 10px;
        height: 0px;
    }
    .exit{
        margin-top: 10px;
    }
    .pin{
        width: 100%;
        display: flex;
        flex-direction: column;
    }}
  </style>
  
<body>
    <main>
        <!--     PHP CODE START HERE!      -->

        <?php
                       
                        session_start();

                        if(isset($_POST["pin_press"])){
                            
                            $old_pin = $_POST['old_pin'];
                            $new_pin = $_POST['new_pin'];
                            $confirm_new_pin = $_POST['confirm_new_pin'];
                            $user_id = $_SESSION['user_id'];

                            // $pin_qry =  mysqli_query($conn,"SELECT atm_pin FROM users_table WHERE user_id = '$user_id'")or die(mysqli_error($conn)); 

                            // $atm_pin =  mysqli_fetch_object($pin_qry);

                            $atm_pin = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($user_id)]);


                            if($old_pin == $atm_pin->atm_pin && $old_pin!='' && $new_pin!='' && $confirm_new_pin!=''){

                                if($new_pin == $confirm_new_pin){

                                    // $update_pin = mysqli_query($conn,"UPDATE users_table SET atm_pin = '$new_pin' WHERE user_id = '$user_id'") or die(mysqli_error($conn)); 

                                    $update_pin = $collection->updateOne(
                                        ["_id" => new MongoDB\BSON\ObjectId($user_id)],
                                        ['$set' => ["atm_pin" => $new_pin]]
                                    );

                                    header("Location: s_pinchange.php");

                                }else{
                                    echo '<script>
                                            Swal.fire({
                                                title: "Error",
                                                text: "The new PIN and the confirm new PIN must match.",
                                                icon: "error"
                                            });
                                        </script>';
                                }

                            }else{
                                echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "You entered wrong old Pin!",
                                        });
                                    </script>';
                            }
                        }

                    ?>
      <form method="POST">
          <div>
              <nav class="navbar navbar-expand-lg">
                  <img src="./images/Untitled_design__1_-removebg-preview.png" alt="UniBank Logo">
                  <span>UNI Bank</span>
              </nav>
          </div>
          <div>
              <nav class="navbar1 navbar-expand-lg">
                  <p class="text-center" style="align-items: center; height: 100%;">Change Your Pin</p>
              </nav>
          </div>
          <div class="mt-4" style="width: 100%;">
            <div class="pin">
                <div><p>Enter Old Pin</p></div>
                <div><input type="password" class="atm_pin" name="old_pin" id="old_pin" maxlength="4" autocomplete="off" required></div>
            </div>
            <div class="pin">
                <div><p>Enter New Pin</p></div>
                <div><input type="password" class="atm_pin" name="new_pin" id="new_pin" maxlength="4" autocomplete="off" required></div>
            </div>
            <div class="pin">
                <div><p>Confirm New Pin</p></div>
                <div><input type="password" class="atm_pin" name="confirm_new_pin" id="confirm_new_pin" maxlength="4" autocomplete="off" required></div>
            </div>
          </div>
          <div class="press_button">
            <input type="submit" value="Change Pin " class="press_here" name="pin_press" id="pin_press"/>
          </div>
          <div class="text-center exit"><input type="submit" value="Main Menu" name='exit' id='exit' class="btn btn-success"></div>
</form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>