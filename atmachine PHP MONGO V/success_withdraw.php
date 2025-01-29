<?php
require_once('config.php');
session_start();


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
  <title>Available Blnc</title>
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
      background-color: yellow;
      color:#001f33;
    }
    nav p{
        font-weight: 600;
        font-size: 40px;
        margin-bottom: 0;
        margin: 20px;
    }

    .ava{
        font-weight: 600;
        font-size: 35px;
        color: white;
    }
    .blnc{
        height: 150px;
        margin-left: 50px;
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
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }


    @media (max-width: 700px) {
        .blnc{
        height: 150px;
        margin-left: 30px;
    }
}
    @media (max-width: 500px) {
        .blnc{
        height: 130px;
        margin-left: 0px;
    }
    }

  </style>
<body>
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
                  <p class="text-center">COLLECT YOUR CASH.</p>
              </nav>
          </div>
          <div class="blnc mt-4">
            <span class="ava">WITHDRAWAL AMOUNT :   </span>
            <span class="ava" style="color:red;"><?php echo $_SESSION['withdrawal_amount']?> -</span>
          </div>

          <div class="blnc mt-4">
            <span class="ava">AVAILABLE PRICE :   </span>


             <!--     PHP CODE START HERE!      -->


            
            <?php
            $user_id = $_SESSION['user_id'];

            $acc_blnc = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($user_id)]);

            if($acc_blnc){
              echo '<span class="ava" style="color:#00bfff;">' . $acc_blnc['account_blnc'] . ' rs/-</span>';
            }
            ?>

             <!--     PHP CODE ENDS HERE!      -->
          </div>
          <div>
            <div class="text-center exit"><input type="submit" value="Main Menu" name="exit" id="exit" class="btn btn-success"></div>
          </div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>