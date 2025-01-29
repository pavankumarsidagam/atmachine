<?php
  require_once("config.php");
  session_start();
  
  if (isset($_POST['no_withdraw'])) {
    sleep(1);
    header("Location: select_transaction.php");
    exit();
  }


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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Your UniBank</title>
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
    .small_nav{
        margin-top: 0px;
        padding-top: 0px;
    }
    .navbar1 {
      background-color: #0066cc;
      color: white;
    }
    p{
        font-weight: 600;
        font-size: 30px;
    }


    .amount_input{
        width: 100%;
        height: 200px;
       /* background-color: aqua;*/
        align-items: center;
        display: flex;
       justify-content: center;
    }
    .ruppess{
        text-align: center;
        border-radius: 20px;
        font-size: 20px;
        padding: 20px 60px;
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
        margin-right: 20px;
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
        margin-top: 10px;
        display: flex;
        justify-content: center;
    }
    
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }

    input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            appearance: none;
        }

    @media (max-width: 700px) {

        .press_button{
        margin-right: 0px;
    }
    .press_here {
        font-size: 25px;
        padding-right: 38px;
    }
    .ruppess{
        padding: 20px 32px;
    }
    .amount_input{
        height: 150px;
    }
    .exit{
        margin-top: 10px;
    }
    }
  </style>
<body>

 <?php

 //Why i'm adding these comments for only withdrawal to understand easily the code.
        if (isset($_POST['yes_withdraw'])) {

          // first we getting input value of withdrawal amount the user needed and the userid of user by using SESSION.
            $withdrawal_amount = intval($_POST['withdrawal_amount']);
            $user_id = $_SESSION['user_id'];

            $atm_avl = $atm_machine->findOne(["status_" => '1']);
            $atm_amount = $atm_avl->atm_blnc;
          
          //Now we getting the balance of ATM machine and asighing the value to $atm_amount variable.
            // $atm_avl = mysqli_query($conn, "SELECT * FROM atm_manchine WHERE status_ = '1'") or die(mysqli_error($conn));
            // $atm_blnc = mysqli_fetch_object($atm_avl);
            // $atm_amount = $atm_blnc->atm_blnc;

            $avl = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($user_id)]);
            $enoungh_user_blnc = $avl->account_blnc;
           // Fetching the User total blnc the user have.
          //  $avl = mysqli_query($conn, "SELECT account_blnc FROM users_table WHERE user_id = '$user_id'") or die(mysqli_error($conn));
          //  $avl_blnc = mysqli_fetch_object($avl);
          //  $enoungh_user_blnc = $avl_blnc->account_blnc;

          // we checking whether the input amount of user needed is valid or not.
        
            if ($withdrawal_amount % 100 !== 0 || $withdrawal_amount==0) {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please enter valid Amount!",
                          });
                      </script>';
            } else {

              // Now we checking whether amount the user needed in avaliable in the ATM machine or not.
                if ($atm_amount < $withdrawal_amount) {
                    echo "<script>
                          Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: 'ATM balance is too low. Please try a smaller amount or visit another ATM.',
                          });
                          </script>";

                // Now we checking whether the user as enough balance to withdraw the amount.
                } else if ($enoungh_user_blnc <= $withdrawal_amount){
                  echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Your balance is low. Please Check Your Bank Balance.',
                        });
                        </script>";
                }
                else {

                  // asighing the withdraw amount to another variable to update values in transaction and for adding to SESSION.
        
                    $withdrawal_transaction = $withdrawal_amount;

                  // Fecthing the number of notes avaliable in the ATM machine.
        
                    $total_500 = $atm_avl->note_500;
                    $total_200 = $atm_avl->note_200;
                    $total_100 = $atm_avl->note_100;
        
                    $note500 = 500;
                    $note200 = 200;
                    $note100 = 100;
        
                    $count500 = 0;
                    $count200 = 0;
                    $count100 = 0;

                  // If notes are avaliable the Count will be increased and ATM amount will be decreased.
        
                    while ($withdrawal_amount > 0) {
                        if ($withdrawal_amount >= $note500 && $total_500 > 0) {
                            $withdrawal_amount -= $note500;
                            $atm_amount -= $note500;
                            $count500++;
                        } elseif ($withdrawal_amount >= $note200 && $total_200 > 0) {
                            $withdrawal_amount -= $note200;
                            $atm_amount -= $note200;
                            $count200++;
                        } elseif ($withdrawal_amount >= $note100 && $total_100 > 0) {
                            $withdrawal_amount -= $note100;
                            $atm_amount -= $note100;
                            $count100++;
                        } else {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'ATM does not have enough notes to fulfill the requested amount.',
                                    });
                                    </script>";
                            break;
                        }
                    }
                    //Following block of code is executed if the withdrawal amount is successfully dispensed in the form of notes.
                    if ($withdrawal_amount == 0) {
                        $total_500 -= $count500;
                        $total_200 -= $count200;
                        $total_100 -= $count100;
                        $total = $enoungh_user_blnc - $withdrawal_transaction;
        
                    //Updating the ATM Machine Notes,Balance and USERS Balance and Have to Insert the transaction Of the USER.
                        // mysqli_query($conn, "UPDATE atm_manchine SET atm_blnc = $atm_amount, note_500 = '$total_500',note_200 = '$total_200',note_100 = '$total_100' WHERE status_ = '1'") or die(mysqli_error($conn));

                        $atm_machine->updateOne(
                          ["status_" => "1"],
                          ['$set' => [
                            "atm_blnc" => $atm_amount,
                            "note_500" => $total_500,
                            "note_200" => $total_200,
                            "note_100" => $total_100
                          ]]
                        );

                        // mysqli_query($conn, "UPDATE users_table SET account_blnc = '$total' WHERE user_id = '$user_id'") or die(mysqli_error($conn));

                        $collection->updateOne(
                          ["_id" => new MongoDB\BSON\ObjectId($user_id)],
                          ['$set' => ["account_blnc" => $total]]
                        );

                        $atm_transactions->insertOne([
                            "user_id" => $user_id,
                            "transaction_type" => "withdraw",
                            "amount" => -$withdrawal_transaction,
                            "date" => new MongoDB\BSON\UTCDateTime()
                        ]);
        
                        // $transaction_deposit = mysqli_query($conn, "INSERT INTO atm_transactions (user_id,transaction_type,amount) VALUES ('$user_id','withdraw','$withdrawal_transaction-')") or die(mysqli_error($conn));
        
                        $_SESSION['withdrawal_amount'] = $withdrawal_transaction;

                      //Sweet Alert for successful withdrawal and redirecting to Another Page.
        
                        echo '<script>
                                let timerInterval;
                                Swal.fire({
                                  title: "Withdrawing Amount!",
                                  html: "Withdrawing Amount In <b></b> Milliseconds.",
                                  timer: 2000,
                                  timerProgressBar: true,
                                  didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                      timer.textContent = `${Swal.getTimerLeft()}`;
                                    }, 100);
                                  },
                                  willClose: () => {
                                    clearInterval(timerInterval);
                                    // Redirect after the alert is closed
                                    window.location.href = "success_withdraw.php";
                                  }
                                }).then((result) => {
                                  if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log("I was closed by the timer");
                                  }
                                });
                                </script>';
        
                        exit();
                    }
                }
            }
        }
        ?>
    <main>
      <form method="POST">
          <div>
              <nav class="navbar navbar-expand-lg">
                  <img src="./images/Untitled_design__1_-removebg-preview.png" alt="UniBank Logo">
                  <span>UNI Bank</span>
              </nav>
          </div>
          <div class="small_nav">
              <nav class="navbar1 navbar-expand-lg">
                  <div><p class="text-center">Please Enter Amount.</p></div>
                  <div><p class="text-center" id="amount_avaliable">Avaliable : Rs 100, Rs 200 , Rs 500</p></div>
              </nav>
          </div>
          <div class="amount_input">
            <input type="number" class="ruppess" name="withdrawal_amount" id="withdrawal_amount" placeholder="Rs : 0" maxlength="5" inputmode="numeric" pattern="[0-9]*">
          </div>
          <div class="press_button pb-4">
            <input type="submit" value="   Yes" name="yes_withdraw" id="yes_withdraw" class="press_here"/>
          </div>
          <div class="press_button">
            <input type="submit" value="    No" name="no_withdraw" id="no_withdraw" class="press_here"/>
          </div>
          <div class="text-center exit"><input type="submit" value="Main Menu" name='exit' id='exit' class="btn btn-success"></div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>