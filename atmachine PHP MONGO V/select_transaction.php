<?php
  require_once("config.php");
  session_start();

  if(isset($_POST["withdrawal"])){
    $_SESSION['withdrawal'] = "withdrawal";
    sleep(1);
    header("Location: enterpin.php" );
    exit();
  }else {
    $_SESSION['withdrawal'] = "";
  }


  if(isset($_POST["balance_enquiry"])){
    $_SESSION['balance_enquiry'] = "balance_enquiry";
    sleep(1);
    header("Location: enterpin.php" );
    exit();
  }else {
    $_SESSION['balance_enquiry'] = "";
  }


  if(isset($_POST["pin_change"])){
    $_SESSION['pin_change'] = "pin_change";
    sleep(1);
    header("Location: enterpin.php" );
    exit();
  }else {
    $_SESSION['pin_change'] = "";
  }


  if(isset($_POST["deposit"])){
    $_SESSION['deposit'] = "deposit";
    sleep(1);
    header("Location: enterpin.php" );
    exit();
  }else {
    $_SESSION['deposit'] = "";
  }


  if(isset($_POST["transactions"])){
    $_SESSION['transactions'] = "transactions";
    sleep(1);
    header("Location: enterpin.php" );
    exit();
  }else {
    $_SESSION['transactions'] = "";
  }

  
  if(isset($_POST["mini_statement"])){
    $_SESSION['mini_statement'] = "mini_statement";
    sleep(1);
    header("Location: enterpin.php" );
    exit();
  }else {
    $_SESSION['mini_statement'] = "";
  }

  if (isset($_POST['exit'])) {
    sleep(1);
    session_destroy();
    header("Location: login_atm.php");
    exit();
}
?>


<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    .navbar1 {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #0066cc;
      color: white;
    }
    p{
        font-weight: 600;
        font-size: 30px;
        margin-bottom: 0;
        margin: 20px;
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

    .button {
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
        width: 100%; /* Make buttons fill the width */
    }

    /*input{
        font-weight: 600;
        background-color: #4CAF50;
        color: white;
        border: none;
        font-size: 30px;
    }*/

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
        width: 100px;
    }
    .exit{
        margin-top: 20px;
    }

    .button-containers{
        display: flex;
        justify-content: space-between;
        width: 100%;  
    }
    .button-container {
      margin-top: 5px;
    }

    /* Align the first set of buttons to the left */
    .button-container.left .button {
      float: left;
    }
    /* Align the second set of buttons to the right */
    .button-container.right .button {
      float: right;
    }

    .button-container.left div{
        padding: 60px 0 60px 50px;
    }

    .button-container.right div{
        padding: 60px 50px 60px 0;
    }

    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }


    @media (max-width: 750px) {
      .button-containers {
        flex-direction: column;
        align-items: center; 
      }

    .button-container.right div{
        padding: 50px 0px 50px 0;
    }
    .button-container.left div{
        padding: 50px 0px 50px 0;
    }
    .button {
        font-size: 25px;
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
                  <p class="text-center" style="align-items: center; height: 100%;"> Customer, Please Select Transaction</p>
              </nav>
          </div>
          <div class="button-containers"> 
          <!-- First set of buttons on the left -->
              <div class="button-container left clearfix">
                  <div><input name="deposit" id="deposit" type="submit" class="button" value="Deposit"></div>
                  <div><input name="transactions" id="transactions" type="submit" class="button" value="Transactions"></div>
                  <div><input name="mini_statement" id="mini_statement" type="submit" class="button" value="Mini Statement"></div>
              </div>

              <!-- Second set of buttons on the right -->
              <div class="button-container right clearfix">
                  <div><input name="withdrawal" id="withdrawal" type="submit" class="button" value="Withdrawal"></div>
                  <div><input name="balance_enquiry" id="balance_enquiry" type="submit" class="button" value="Balance Enquiry"></div>
                  <div><input name="pin_change" id="pin_change" type="submit" class="button" value="Pin Change"></div>
              </div>
          </div>
          <div>
            <div class="text-center exit"><input type="submit" value="EXIT" name="exit" id='exit' class="btn btn-danger" ></div>
          </div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>