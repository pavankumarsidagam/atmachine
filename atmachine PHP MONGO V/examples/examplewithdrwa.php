<?php
require_once("config.php");

if(isset($_POST['yes_withdraw'])){
    $withdrawal_amount = intval($_POST['withdrawal_amount']); // Ensure withdrawal amount is an integer

    // Validate withdrawal amount (multiple of 100)
    if ($withdrawal_amount % 100 !== 0) {
        echo "<script>alert('Withdrawal amount must be a multiple of 100, 200, or 500.');</script>";
    } else {
        // Fetch ATM balance from the database
        $atm_avl = mysqli_query($conn, "SELECT * FROM atm_manchine WHERE status_ = '1'") or die(mysqli_error($conn));
        $atm_blnc = mysqli_fetch_object($atm_avl);
        $atm_amount = $atm_blnc->atm_blnc;

        echo "Withdrawal Amount: $withdrawal_amount<br>";
        echo "ATM Amount: $atm_amount<br>";

        // Check if ATM balance is less than or equal to 100
        if ($atm_amount <= 100) {
            echo "<script>alert('ATM balance is too low. Please try a smaller amount or visit another ATM.');</script>";
        } else {
            $note500 = 500;
            $note200 = 200;
            $note100 = 100;

            $count500 = 0;
            $count200 = 0;
            $count100 = 0;

            while ($withdrawal_amount > 0) {
                if ($withdrawal_amount >= $note500 && $atm_amount >= $note500) {
                    $withdrawal_amount -= $note500;
                    $atm_amount -= $note500;
                    $count500++;
                } elseif ($withdrawal_amount >= $note200 && $atm_amount >= $note200) {
                    $withdrawal_amount -= $note200;
                    $atm_amount -= $note200;
                    $count200++;
                } elseif ($withdrawal_amount >= $note100 && $atm_amount >= $note100) {
                    $withdrawal_amount -= $note100;
                    $atm_amount -= $note100;
                    $count100++;
                } else {
                    // Not enough notes in the ATM
                    echo "<script>alert('ATM does not have enough notes to fulfill the requested amount.');</script>";
                    break;
                }
            }

            // Update ATM balance in the database
           // mysqli_query($conn, "UPDATE atm_manchine SET atm_blnc = $atm_amount WHERE status_ = '1'") or die(mysqli_error($conn));

            if ($withdrawal_amount == 0) {
                echo "Count 500: $count500<br>";
                echo "Count 200: $count200<br>";
                echo "Count 100: $count100<br>";
            } else {
                echo "<script>alert('Unable to dispense the requested amount with available notes.');</script>";
            }
        }
    }
}
?>

<html>
<head></head>
<body>
    <form method="POST">
        <input type="number" value="" name="withdrawal_amount" id="withdrawal_amount" />
        <input type="submit" value="Submit" name="yes_withdraw" id="yes_withdraw" />
    </form>
</body>
</html>
ATM balance is too low. Please try a smaller amount or visit another ATM.
ATM does not have enough notes to fulfill the requested amount.