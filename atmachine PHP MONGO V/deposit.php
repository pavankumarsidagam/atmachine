<?php
    require_once('config.php');
    

    
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
  <title>Deposit</title>
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
    .navbar1 p{
        font-weight: 600;
        font-size: 40px;
        margin-bottom: 0;
        margin: 20px;
    }

    .deposit p{
        font-weight: 600;
        font-size: 40px;
        margin: 0 15px;
        color: white;
    }


    .pin_input{
        width: 100%;
        height: 50px;
       /* background-color: aqua;*/
        align-items: center;
        display: flex;
       justify-content: center;
    }
    .deposit_amount{
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
        padding: 15px 40px;
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
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }
    
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }


    .deposit, .notes{
        display: flex;
        justify-content: center;        
    }
    .notes{
        margin-top: 20px;
    }
    .notes p{
        font-size: 20px;
        color: white;
        font-weight: 400;
        padding-right: 10px;
    }
    .note_count{
        text-align: center;
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 10px;
        background-color: white;
        border :none;
        outline: none;
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
    .deposit_amount{
        padding: 10px 20px;
    }
    .exit{
        margin-top: 10px;
    }
    .deposit, .notes{
        width: 100%;
        display: flex;
        flex-direction: column;
    }}
  </style>
</head>
<body>

    <?php
        if(isset($_POST["deposit_press"])){
            session_start();
            $deposit_amount=$_POST['deposit_amount'];
            $f500_count = $_POST['f500_count'];
            $t200_count= $_POST['t200_count'];
            $h100_count = $_POST['h100_count'];
            $user_id = $_SESSION['user_id'];

            // $avl = mysqli_query($conn,"SELECT account_blnc FROM users_table WHERE user_id = '$user_id'") or die(mysqli_error($conn));
            // $avl_blnc = mysqli_fetch_object($avl);

            $avl = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($user_id)]);
            $avl_blnc = $avl->account_blnc;

            $atm_blnc = $atm_machine->findOne(["status_" => '1']);

            // $atm_avl =  mysqli_query($conn,"SELECT * FROM atm_manchine WHERE status_ = '1'") or die(mysqli_error($conn));
            // $atm_blnc = mysqli_fetch_object($atm_avl);

            if($deposit_amount == 500*$f500_count + 200*$t200_count + 100*$h100_count && $deposit_amount>0){

                $total = $avl_blnc + $deposit_amount;

                $atm_total = $atm_blnc->atm_blnc + $deposit_amount;

                $total_500 = $f500_count+ $atm_blnc->note_500;
                $total_200 =  $t200_count+$atm_blnc->note_200;
                $total_100 =$h100_count+ $atm_blnc->note_100;

                $atm_machine->updateOne(
                  ["status_" => '1'],
                  ['$set' => [
                    "atm_blnc" => $atm_total,
                    "note_500" => $total_500,
                    "note_200" => $total_200,
                    "note_100" => $total_100
                  ]] 
                );

                $collection->updateOne(
                  ["_id" => new MongoDB\BSON\ObjectId($user_id)],
                  ['$set' => [
                    "account_blnc" => $total
                  ]]
                );

                $transaction_deposit = [
                  "user_id" => $user_id,
                  "transaction_type" => "deposit",
                  "amount" => $deposit_amount,
                  "date" => new MongoDB\BSON\UTCDateTime() 
                ];

                $atm_transactions->insertOne($transaction_deposit);


                // $atm_balance_update =  mysqli_query($conn,"UPDATE atm_manchine SET atm_blnc = '$atm_total', note_500 = '$total_500',note_200 = '$total_200',note_100 = '$total_100' WHERE status_ = '1'") or die(mysqli_error($conn));
                // $deposited_amount = mysqli_query($conn,"UPDATE users_table SET account_blnc = '$total' WHERE user_id = '$user_id'") or die(mysqli_error($conn));

                
                // $transaction_deposit = mysqli_query($conn, "INSERT INTO atm_transactions (user_id, transaction_type, amount) VALUES ('$user_id', 'deposit', '$deposit_amount+')") or die(mysqli_error($conn));




                $_SESSION['deposit_amount']= $deposit_amount;


                //Sweet Alert for successful withdrawal and redirecting to Another Page.
        
                echo '<script>
                let timerInterval;
                Swal.fire({
                  title: "Depositing Amount!",
                  html: "Wepositing Amount In <b></b> Milliseconds.",
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
                    window.location.href = "success_deposit.php";
                  }
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                  }
                });
                </script>';

                exit();
            }else{
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "The Amount and Number of Notes Must be equal!",
                        });
                        </script>';
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
          <div>
              <nav class="navbar1 navbar-expand-lg">
                  <p class="text-center" style="align-items: center; height: 100%;">Enter Deposit Amount</p>
              </nav>
          </div>
          <div class="mt-4" style="width: 100%;">
            <div class="deposit">
                <div><p>Enter Amount</p></div>
                <div><input type="number" class="deposit_amount" name="deposit_amount" id="deposit_amount" autocomplete="off" required></div>
          </div>
          <div >
            <div class="notes">
                <div><p>500 x </p></div>
                <div><input type="number" value="" class="note_count" name="f500_count" id="f500_count" maxlength="6" autocomplete="off" required></div>
            </div>
            <div class="notes">
                <div><p>200 x </p></div>
                <div><input type="number" value="" class="note_count" name="t200_count" id="t200_count" maxlength="6" autocomplete="off" required></div>
            </div>
            <div class="notes">
                <div><p>100 x </p></div>
                <div><input type="number" value="" class="note_count" name="h100_count" id="h100_count" maxlength="6" autocomplete="off" required></div>
            </div>
          </div>
          <div class="press_button">
            <input type="submit" value="Deposit Amount" name="deposit_press" id="deposit_press" class="press_here"/>
          </div>
          <div class="text-center exit"><input type="submit" value="Main Menu" class="btn btn-success" name='exit' id='exit'></div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>