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
  <title>Your UniBank</title>
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


    /*     Vertical Table    */

    .scrollable-div{
        margin: 15px 0px;
        display: flex;
        justify-content: center; 
    }

    table {
            border-collapse: collapse;
        }

    th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        tbody td{
            color: white;
        }

    .scrollable-table {     
            width: 380px;  
            max-height: 400px; 
        }

    .scrollable-table thead {
            position: sticky;
            top: 0;
            background-color: #f2f2f2;
        }
        tr td img{
            max-width: 80px;
        }
        tr td span{
            font-size: 35px;
        }

    @media (max-width: 450px) {
        .scrollable-div{
            margin: 20px 0 0 0;
        }
        tr td img{
            max-width: 50px;
        }
        tr td span{
            font-size: 20px;
        }
        
    }

    

  </style>
</head>
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
                  <p class="text-center">Mini Statement.</p>
              </nav>
          </div>
          <div class="scrollable-div">
            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <td colspan="3" class="text-center"><img src="./images/Untitled_design__1_-removebg-preview.png" alt="UniBank Logo">
                                <span>UNI Bank</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Date Time</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                     $user_id = $_SESSION['user_id'];
                     
                     $transactions = $atm_transactions->find(
                        ["user_id" => $user_id],
                        [
                            "sort" => ["_id" => -1],
                            "limit" => 5
                        ]
                    );

                    // $transactionArray = iterator_to_array($transactions);

                    // Encode the array as JSON
                    // echo json_encode($transactionArray);
                    // return;

                    // $query = mysqli_query($conn, "SELECT * FROM atm_transactions WHERE user_id ='$user_id' AND status_='1' ORDER BY transaction_id DESC LIMIT 5") or die(mysqli_error($conn));
                    // while($transaction = mysqli_fetch_object($query)){ 
                    foreach ($transactions as $transaction){
                        $timestamp = $transaction['date']->toDateTime();
                        $formatted_date = $timestamp->format('Y-m-d');

                        echo "<tr>";
                        echo "<td>" . $formatted_date . "</td>";
                        echo "<td>" . $transaction['transaction_type'] . "</td>";
                        if($transaction['transaction_type'] == 'withdraw'){
                            echo "<td style='color:red'>" . $transaction['amount'] . "</td>";
                        } else {
                            echo "<td style='color:#00ff00'>" . $transaction['amount'] . "</td>";
                        }
                        echo "</tr>";
                    }

                    $acc_blnc = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($user_id)]);


                    echo '<tr class="footer">';
                    echo '<td style="color:#00bfff">Avl Blnc:</td>';
                    echo '<td colspan="2" style="color:#00bfff;">'. $acc_blnc->account_blnc .' rs/-</td>';
                    echo '</tr>';


                    ?>
                         
                    
                    </tbody>
                  </table>
              </div>
          </div>
          <div>
            <div class="text-center exit"><input type="submit" name='exit' id='exit' value="Main Menu" class="btn btn-success"></div>
          </div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>