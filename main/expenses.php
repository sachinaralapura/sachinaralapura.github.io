<?php
session_start();
$user_id = $_SESSION['userid'];
$total = 0;
require '../dbinc.php';
$fromdate = $_SESSION['fromdate'];
$todate = $_SESSION['todate'];
$expensetitle = $_SESSION['expensetitle'];
$currentdate = date("Y-m-d");


if($expensetitle && $todate){
    echo "<h1>EXPENSE FROM $expensetitle</h1>";
    $sql = "SELECT title,expenses.date,expenses.ammount,expenses.accountid FROM expenses, accounts WHERE expenses.date BETWEEN '$fromdate' AND '$todate' AND expenses.accountid=accounts.accid AND expenses.title='$expensetitle' AND accounts.userid='$user_id' ";
    $expensedetails = mysqli_query($conn, $sql);
}
else if ($expensetitle) {
    echo "<h1>EXPENSE FROM $expensetitle</h1>";
    $sql = "SELECT title,expenses.date,expenses.ammount,expenses.accountid FROM expenses, accounts WHERE expenses.date BETWEEN '$fromdate' AND '$currentdate' AND expenses.accountid=accounts.accid AND expenses.title='$expensetitle' AND accounts.userid='$user_id' ";
    $expensedetails = mysqli_query($conn, $sql);
} 
else if($todate){
    echo "<h1>EXPENSE FROM ALL</h1>";
    $sql = "SELECT title,expenses.date,expenses.ammount,expenses.accountid FROM expenses, accounts WHERE expenses.date BETWEEN '$fromdate' AND '$todate' AND expenses.accountid=accounts.accid  AND accounts.userid='$user_id' ";
    $expensedetails = mysqli_query($conn, $sql);
}
else {
    $sql = "SELECT title,expenses.date,expenses.ammount,expenses.accountid  FROM expenses, accounts WHERE expenses.accountid=accounts.accid AND accounts.userid='$user_id' ";
    $expensedetails = mysqli_query($conn, $sql);
}

// sql query to fetch expense details

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
    <div class="table expensetable ">
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Amount(in rupees)</th>
                <th>Account Id</th>
            </tr>
            <tr>
                <?php
                while ($row = mysqli_fetch_assoc($expensedetails)) {
                    $total += $row['ammount'];
                ?>

                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['ammount']; ?></td>
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