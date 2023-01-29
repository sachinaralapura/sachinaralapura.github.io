<?php
session_start();
$user_id = $_SESSION['userid'];
$total = 0;
require '../dbinc.php';
$fromdate = $_SESSION['fromdate'];
$todate = $_SESSION['todate'];
$incometitle = $_SESSION['incometitle'];
$currentdate = date("Y-m-d");


if($incometitle && $todate){
    echo "<h1>INCOME FROM $incometitle</h1>";
    $sql = "SELECT title,income.date,income.amount,income.accountid FROM income, accounts WHERE income.date BETWEEN '$fromdate' AND '$todate' AND income.accountid=accounts.accid AND income.title='$incometitle' AND accounts.userid='$user_id' ";
    $incomedetails = mysqli_query($conn, $sql);
}
else if ($incometitle) {
    echo "<h1>INCOME FROM $incometitle</h1>";
    $sql = "SELECT title,income.date,income.amount,income.accountid FROM income, accounts WHERE income.date BETWEEN '$fromdate' AND '$currentdate' AND income.accountid=accounts.accid AND income.title='$incometitle' AND accounts.userid='$user_id' ";
    $incomedetails = mysqli_query($conn, $sql);
} 
else if($todate){
    echo "<h1>INCOME FROM ALL</h1>";
    $sql = "SELECT title,income.date,income.amount,income.accountid FROM income, accounts WHERE income.date BETWEEN '$fromdate' AND '$todate' AND income.accountid=accounts.accid  AND accounts.userid='$user_id' ";
    $incomedetails = mysqli_query($conn, $sql);
}
else {
    $sql = "SELECT title,income.date,income.amount,income.accountid  FROM income, accounts WHERE income.accountid=accounts.accid AND accounts.userid='$user_id' ";
    $incomedetails = mysqli_query($conn, $sql);
}

// sql query to fetch income details

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Income</title>
    <link rel="stylesheet" href="../static/css/displayincome.css">
</head>

<body>
    <div class="table incometable ">
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Amount(in rupees)</th>
                <th>Account Id</th>
            </tr>
            <tr>
                <?php
                while ($row = mysqli_fetch_assoc($incomedetails)) {
                    $total += $row['amount'];
                ?>

                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['accountid']; ?></td>

            </tr>

        <?php
                }
        ?>
        </table>
    </div>

    <button style="background-color:green;">
       
        <?php
        echo "<h2>TOTAL $total <h2/>";
        ?>
    </button>
              
    <a href="main.php">
        <button>
            <h2>
                GO BACK
            </h2>
        </button>
    </a>
</body>

</html>     