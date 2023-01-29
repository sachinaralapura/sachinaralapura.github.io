<!-- userid and email initialization ======================================== -->
<?php
require '../dbinc.php';
session_start();                    // session start
if (!(isset($_SESSION['userid']))) {
    header("location:../index.html");
}
$user_id = $_SESSION['userid'];     // getting userid


// destroying session


//===================fetching email for the current user using user_id======

$sql = "SELECT email FROM user WHERE uid = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$user_email = $row[0];
$total  = 0;
//-----------------------------------------------------------------

//======================fetching current users accounts details=========

$sql = "SELECT * FROM accounts  WHERE userid ='$user_id';";
$accresult = mysqli_query($conn, $sql);
$sql  = "SELECT * FROM accounts  WHERE userid ='$user_id';";
$accnameresult = mysqli_query($conn, $sql);
$sql  = "SELECT * FROM accounts  WHERE userid ='$user_id';";
$accnameresult1 = mysqli_query($conn, $sql);
$sql  = "SELECT * FROM accounts  WHERE userid ='$user_id';";
$accnameresult2 = mysqli_query($conn, $sql);
$sql  = "SELECT * FROM accounts  WHERE userid ='$user_id';";
$accnameresult3 = mysqli_query($conn, $sql);

?>

<!--====================== fetching the titles of income ============-->

<?php
$sql = "SELECT DISTINCT title FROM income, accounts WHERE  income.accountid=accounts.accid AND accounts.userid='$user_id' ";
$incometitleresult = mysqli_query($conn, $sql);
//$incometitle = mysqli_fetch_assoc($result);
//header("location:accounts.php");

//---------------------------------------------------------------------
?>


<!-- ========================fetching the titles of expenses =========-->
<?php
$sql = "SELECT DISTINCT title FROM expenses, accounts WHERE  expenses.accountid=accounts.accid AND accounts.userid='$user_id' ";
$expensetitleresult = mysqli_query($conn, $sql);
//$incometitle = mysqli_fetch_assoc($result);
//header("location:accounts.php");
//-----------------------------------------------------------------------
?>



<!--===========fetching income detials  ========================== -->

<?php
$sql = "SELECT title,income.date,income.amount,income.accountid  FROM income, accounts WHERE income.accountid=accounts.accid AND accounts.userid='$user_id' ";
$incomedetails = mysqli_query($conn, $sql);

//------------------------------------------------------------------------
?>


<!--  =========================fetching expense details ======================== -->

<?php
$sql = "SELECT title,expenses.date,expenses.ammount,expenses.accountid  FROM expenses, accounts WHERE expenses.accountid=accounts.accid AND accounts.userid='$user_id' ORDER BY expenses.date ";
$expensedetails = mysqli_query($conn, $sql);
//-------------------------------------------------------------------
?>



<!--  =========================fetching credits details ======================== -->

<?php
$sql = "SELECT credit.credid,credit.name,credit.date,credit.ammount,credit.accountid  FROM credit, accounts WHERE credit.accountid=accounts.accid AND accounts.userid='$user_id' ORDER BY credit.date ";
$creditsdetails = mysqli_query($conn, $sql);
$sql = "SELECT credit.credid,credit.name  FROM credit, accounts WHERE credit.accountid=accounts.accid AND accounts.userid='$user_id' ORDER BY credit.date ";
$creditsdetails1 = mysqli_query($conn, $sql);
//========================================================================
?>

<!-- ============INSERTING INTO ACCOUNT ================ -->

<?php
if (isset($_POST['addaccform'])) {
    require '../dbinc.php';
    $accname = $_POST['accountname'];
    $amount  = $_POST['amount'];
    $accnumber = $_POST['accno'] or 0;


    $sql = "INSERT INTO accounts(accname,userid ,amount,Accountnumber) VALUES ('$accname','$user_id','$amount','$accnumber')";
    $result = mysqli_query($conn, $sql);
    header("location:main.php");
}
//---------------------------------------------------------------------
?>



<!-- ====================================INSERTING INTO INCOME AND UPDATING ACCOUNTS TABLE ============================== -->

<?php
if (isset($_POST['addincomeform'])) {
    $incometitle = $_POST['incometitle'];
    $incomeamount = $_POST['amount'];
    $incomeaccount = $_POST['toaccount'];
    $incomedate = $_POST['incomedate'];
    if (!($incomedate)) {
        $incomedate = date("Y-m-d");
    }
    $incomeaccount = explode(" ", $incomeaccount);
    $inacc = $incomeaccount[1];
    $inaccname = $incomeaccount[0];

    // sql
    $sql = "INSERT INTO income VALUES('$incometitle','$incomedate','$incomeamount','$inacc')";
    $incomeresult = mysqli_query($conn, $sql);
    // updating account amount
    // fetch the amount in the account
    $sql = "SELECT amount FROM accounts WHERE accid = '$inacc'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $totalamount = $row[0] + $incomeamount;

    //updating account amount  UPDATE `accounts` SET `amount` = '100' WHERE `accounts`.`accid` = 101;
    $sql = "UPDATE accounts SET amount='$totalamount' WHERE accounts.accid='$inacc'";
    $result = mysqli_query($conn, $sql);


    header("location:main.php");
}
//--------------------------------------------------------------------
?>

<!-- =====================================INSERTING INTO EXPENSES TABEL AND UPDATING ACCOUNTS TABLE  ============== -->

<?php
if (isset($_POST['addexpenseform'])) {
    // echo '<script>alert("Welcome to Geeks for Geeks")</script>';

    $expensetitle = $_POST['expensetitle'];
    $expenseamount = $_POST['expenseamount'];
    $expenseaccount = $_POST['extoaccount'];
    $expensedate = $_POST['expensedate'];


    if (!($expensedate)) {
        $expensedate = date("Y-m-d");
    }
    $expenseaccount = explode(" ", $expenseaccount);
    $exaccno = $expenseaccount[1];
    $_SESSION['exaccno'] = $exaccno;

    // fetch the amount from account to check if account have enough money
    $sql = "SELECT amount FROM accounts WHERE accid = '$exaccno'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    if ($row[0] < $expenseamount) {
        $_SESSION['nobalance'] = "<h1>This account have lesss balance</h1>";
        echo $_SESSION['nobalance'];
        header("location:main.php");
        exit();
    }

    // sql to insert  into expenses table
    $sql = "INSERT INTO expenses VALUES('$expensetitle','$exaccno','$expenseamount','$expensedate')";
    mysqli_query($conn, $sql);
    // updating account amount


    // subtracting expense from then account
    $totalamount = $row[0] - $expenseamount;

    //updating account amount  UPDATE `accounts` SET `amount` = '100' WHERE `accounts`.`accid` = 101;
    $sql = "UPDATE accounts SET amount='$totalamount' WHERE accounts.accid='$exaccno'";
    mysqli_query($conn, $sql);


    header("location:main.php");
}
//---------------------------------------------------------------------
?>


<!-- ===============INSERTING INTO CREDITS AND UPDATING ACCOUNTS TABLE ======================== -->

<?php
if (isset($_POST['addcreditsform'])) {
    // echo '<script>alert("Welcome to Geeks for Geeks")</script>';

    $creditstitle = $_POST['creditstitle'];
    $creditsamount = $_POST['creditsamount'];
    $cretoaccount = $_POST['cretoaccount'];
    $creditsdate = $_POST['creditsdate'];


    if (!($creditsdate)) {
        $creditsdate = date("Y-m-d");
    }
    $cretoaccount = explode(" ", $cretoaccount);
    $creaccno = $cretoaccount[1];



    // sql to insert  into credits table
    $sql = "INSERT INTO credit(name,accountid,ammount,date) VALUES('$creditstitle','$creaccno','$creditsamount','$creditsdate')";
    mysqli_query($conn, $sql);
    // updating account amount


    // adding credit to account balance
    $sql = "SELECT amount FROM accounts WHERE accid = '$creaccno'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $totalamount = $row[0] + $creditsamount;

    //updating account amount  UPDATE `accounts` SET `amount` = '100' WHERE `accounts`.`accid` = 101;
    $sql = "UPDATE accounts SET amount='$totalamount' WHERE accounts.accid='$creaccno'";
    mysqli_query($conn, $sql);


    header("location:main.php");
}

//----------------------------------------------------------------------
?>

<!--  ==================================== deleting credits ======================================= -->
<?php

if (isset($_POST['deletecredits'])) {
    $creditsdetail = $_POST['creditsdetail'];
    $sql = "SELECT credit.ammount FROM credit WHERE credit.credid = '$creditsdetail';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $delamount = $row['0'];
    $_SESSION['delamount'] = $delamount;

    $sql = "SELECT credit.accountid FROM credit WHERE credit.credid = '$creditsdetail';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $delaccountid = $row['0'];
    $_SESSION['delaccountid'] = $delaccountid;

    $sql = "SELECT accounts.amount FROM accounts WHERE accounts.accid = '$delaccountid' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $delaccountidamount = $row['0'];
    $_SESSION['delaccountidlamount'] = $delaccountidamount;

    $res = $delaccountidamount - $delamount;

    $sql = "UPDATE accounts SET amount ='$res' WHERE accounts.accid ='$delaccountid';";
    $res = mysqli_query($conn, $sql);
    $sql = "DELETE FROM credit WHERE credit.credid = '$creditsdetail'";
    mysqli_query($conn, $sql);
    header("location:main.php");
}
//-----------------------------------------------------------------
?>

<!-- ======================= Expenses catogory and  total spend on the catorgory ============== -->
<?php
$sql = "SELECT expenses.title , sum(expenses.ammount) as total FROM expenses,accounts WHERE expenses.accountid=accounts.accid AND accounts.userid='$user_id' GROUP BY expenses.title;";
$catogory = mysqli_query($conn, $sql);
//-------------------------------------------------------------------
?>



<!-- f============================ displaying  DETAILS of INCOME ======================  -->
<?php
if (isset($_POST['displayincome'])) {
    $_SESSION['fromdate'] =  $_POST['fromdate'];
    $_SESSION['todate'] = $_POST['todate'];
    $_SESSION['incometitle'] = $_POST['incometitle'];

    header("location:displayincome.php");
    // sql query to fetch income details
}
//---------------------------------------------------------------
?>

<!--  ====================================== DISPLAYING DETAILS OF EXPENSES =================== -->
<?php
if (isset($_POST['displayexpense'])) {
    $_SESSION['fromdate'] =  $_POST['fromdate'];
    $_SESSION['todate'] = $_POST['todate'];
    $_SESSION['expensetitle'] = $_POST['expensetitle'];
    header("location:expenses.php");
}
//----------------------------------------------------------------------
?>

<!--  ==============================CARD=================================== -->
<!----------------------------inserting into cards table ----------------------------------- -->
<?php

if (isset($_POST['addcardformsubmit'])) {
    $cardname = mysqli_real_escape_string($conn, $_POST['cardsname']);
    $cardnumber = mysqli_real_escape_string($conn, $_POST['cardnumber']);
    $cardaccount = mysqli_real_escape_string($conn, $_POST['cardaccount']);

    $sql  = "INSERT INTO cards (Name,accid,number) VALUES ('$cardname','$cardaccount','$cardnumber')";
    mysqli_query($conn, $sql);
    header("location:main.php");
}

?>


<!-- --------------fetching details of cards-------------- -->
<?php
$sql = "SELECT * FROM cards";
$cardsdetails = mysqli_query($conn, $sql);

?>

<!-- ===========================deleting card ============ -->

<?php
if (isset($_GET['cardid'])) {
    $cardid = $_GET['cardid'];
    $sql = "DELETE FROM cards WHERE cardid = '$cardid'";
    mysqli_query($conn, $sql);

    header("location:main.php");
}
?>

<?php

if (isset($_GET['accid'])) {
    $acc = $_GET['accid'];
    $sql = " DELETE FROM accounts WHERE accid = '$acc' ";
    mysqli_query($conn, $sql);
    header("location:main.php");
}
?>


<!--  ==================================STRUCTURE ==================== -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>
<?php
error_reporting(0);
?>

<body>
    <nav class="open">
        <div class="logo">
            <i class='bx bx-menu menu-icon'></i>
            <span class="logo-name" style="color:#1149e3;">project </span>
        </div>

        <div class="sidebar">
            <div class="logo">
                <i class='bx bx-menu menu-icon'></i>
                <span class="logo-name" style="color: #1149e3;">project</span>
            </div>
            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a href="#" class="nav-link Dashboard">
                            <i class='bx bxs-home icon'></i>
                            <span class="link">Dashboard</span>
                        </a>
                    </li>

                    <li class="list">
                        <a href="#" class="nav-link Accounts">
                            <i class='bx bxs-wallet icon'></i>
                            <span class="link">Accounts</span>
                        </a>
                    </li>

                    <li class="list">
                        <a href="#" class="nav-link Income">
                            <i class='bx bx-rupee icon'></i>
                            <span class="link">Income</span>
                        </a>
                    </li>

                    <li class="list">
                        <a href="#" class="nav-link Expenses">
                            <i class='bx bxs-wallet-alt icon'></i>
                            <span class="link">Expenses</span>
                        </a>
                    </li>

                    <li class="list">
                        <a href="#" class="nav-link Credit">
                            <i class='bx bx-credit-card-front icon'></i>
                            <span class="link">Credit</span>
                        </a>
                    </li>

                    <li class="list">
                        <a href="#" class="nav-link cards">
                            <i class='bx bx-calendar icon'></i>
                            <span class="link">cards</span>
                        </a>
                    </li>

                </ul>

                <div class="bottom-content">
                    <li class="list">
                        <a href="#" class="nav-link">
                            <i class='bx bxs-radiation icon'></i>
                            <span class="link">About</span>
                        </a>
                    </li>

                    <li class="list">
                        <a href="signout.php" class="nav-link">
                            <i class='bx bxs-log-out icon'></i>
                            <span class="link">Sign-out</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>


    <div class="mainpanel show">

        <div class="Dashboardpanel">
            <div class="dashacc">
                <p>
                    <span>Accounts</span><br><br>
                    It’s not practical to pay with cash everywhere, especially for larger purchases. Instead, having a
                    bank account means that you will have access to all your funds anytime you need it, because of
                    services like ATMs at every street corner, and banking apps and website available on your
                    smartphone. Even if you prefer to pay by cash, you will be able to withdraw it when you need it, and
                    not just carry your money around.<br>
                    Cash transactions are hard to keep track of you often end up wondering where you spent the money
                    and it’s very difficult to stick to a budget. However, making purchases through your bank account
                    means that you will always have a record of the transaction and can always pull it up when you need
                    to, through your bank passbook, SMSes from your bank, or a virtual passbook through your bank app.


                </p>
                <img src="../assets/images/accounts.svg" alt="">
            </div>

            <div class="dashincomes">
                <img src="../assets/images/incomes.svg" alt="">
                <p>
                    <span>Incomes</span><br><br>
                    Financial tracking can help you cut costs, prepare for taxes and identify growth opportunities.
                    Financial tracking is essential to managing your business because if you don’t have a clear idea of
                    how much money is coming in and going out, you could end up with a shortfall when you need the money
                    the most. That may prevent you from pursuing a new initiative or bringing on more staff or otherwise
                    blunt your growth prospects. It could also spell your business’s demise if you can’t keep the lights
                    on because your budgeting fell to the wayside.
                </p>

            </div>

            <div class="dashexpenses">
                <p>
                    <span>Expenses</span><br><br>
                    Financial tracking, otherwise known as expense tracking, is the process of keeping tabs on your
                    income and spending, ideally on a daily basis. It’s achieved by recording receipts, invoices, and
                    business expenses into some form of the accounting ledger. It goes hand in hand with budgeting and
                    is a valuable way to keep tabs on your business finances. <br>
                    Without financial tracking, you will have no idea of whether you are making a profit or have a loss.
                    Over time, financial tracking will give you a clear idea of incoming cash and outgoing costs,
                    enabling you to forecast your finances, find ways to slash costs, and identify growth opportunities
                </p>
                <img src="../assets/images/expenses.svg" alt="">
            </div>

            <div class="dashcredits">
                <img src="../assets/images/credit.svg" alt="">
                <p>
                    <span>Credits</span><br><br>
                    Money plays a vital role in the life of humans. It has become more than a necessity in today’s
                    world. No work is possible without the aid of money. It is not really possible for every individual
                    to have a sufficient amount of money to accomplish his wishes. Thus to get the required sum of money
                    he borrows money which he later pays off. This activity of borrowing money is an important feature
                    of the loan.
                    Loans allow for growth in the overall money supply in an economy and open up competition by lending
                    to new businesses.
                </p>

            </div>
            <div class="dashcards">

                <p>
                    <span>Cards</span><br><br>
                    Credit cards let you borrow money from a bank under the agreement that you’ll repay it by your
                    bill’s due date or incur interest charges.

                    The ability to buy now and pay later outmatches other forms of payment, such as debit cards or cash,
                    which both require you to have the money available for payment at the time of purchase. In addition
                    to having more flexibility with payments, credit cards help you to establish a credit score so you
                    can qualify for other financial products, such as loans and mortgages.

                    There also can be some monetary perks to having a credit card, where cardholders can earn rewards on
                    every purchase, which can be later cashed in for travel, statement credits and more. Some credit
                    cards also offer intro interest-free periods.
                </p>
                <img src="../assets/images/credit_card.svg" alt="">
                
            </div>



        </div>
        <!-- ========================accounts contents ============================== -->

        <div class="accontents">
            <h1>Accounts you have.</h1>

            <div class="table">
                <table>
                    <tr>
                        <th>Account Name</th>
                        <th>AccountID</th>
                        <th>Amount</th>
                        <th>Account Number</th>
                        <th>Delete Account</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($accresult)) {
                            $total = $total + $row['amount'];
                        ?>

                        <td><?php echo $row['accname']; ?></td>
                        <td><?php echo $row['accid']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['Accountnumber']; ?></td>
                        <td>
                            <a href='main.php?accid=<?php echo $row['accid']; ?>' class='btn'>Delete</a>
                        </td>

                    </tr>

                    <?php
                        }
                ?>
                </table>
                <div class=" total">
                    <span>
                        <h3>Total</h3>
                    </span>
                    <span><?php echo $total ?></span>
                </div>
                <button class="addacc">
                    <h2>ADD ACCOUNT</h2>
                </button>



                <div class="form accform hideform">
                    <form action="#" method="POST">
                        <div class="accountname">
                            <input type="text" name="accountname" placeholder="Enter account Name" required>
                        </div>

                        <div class="amount">
                            <input type="text" name="amount" placeholder="Enter Amount" required>
                        </div>

                        <div class="accountnumber">
                            <input type="text" name="accno" placeholder="Enter account number">
                        </div>

                        <div>
                            <button type="submit" name="addaccform">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ========================income contents ============================== -->

        <div class="incontents">
            <h1>INCOMES</h1>
            <button class="addincome">
                <!-- adding income button -->
                <h2>Add Income</h2>
            </button>

            <div class="form incomeform hideform">
                <!-- adding income form-->
                <form action="#" method="POST">
                    <div class="title">
                        <input type="text" name="incometitle" placeholder="Enter income title" required>
                    </div>

                    <div class="amount">
                        <input type="text" name="amount" placeholder="Enter Amount" required>
                    </div>

                    <div class="toaccount">
                        <select name="toaccount" required>
                            <option value="">select</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($accnameresult)) :
                            ?>

                            <option value="<?php echo $row['accname'];
                                                echo " " . $row['accid'] ?>"><?php echo $row['accname'];
                                                                                echo " " . $row['accid'] ?></option>

                            <?php
                            endwhile;
                            ?>
                        </select>

                    </div>


                    <div class="incomedate">
                        <input type="date" name="incomedate">
                    </div>

                    <div>
                        <button type="submit" name="addincomeform">Submit</button>
                    </div>
                </form>
            </div>

            <!-- =====================  displaying income ================== -->
            <!-- =====================  displaying income  form================== -->


            <button class="displayincomeform">
                <!-- display income button -->
                <h2>Display incomes</h2>
            </button>

            <div class="form incomedisplayform hideform">
                <!-- form  for displaying incomes-->
                <form action="#" method="POST">
                    <div class="fromdate">
                        <label for="fromdate">From : </label>
                        <input id="fromdate" type="date" name="fromdate" required>
                    </div>

                    <div class="todate">
                        <label for="todate">To : </label>
                        <input id="todate" type="date" name="todate" placeholder="Enter Amount">
                    </div>

                    <div class="incometitle">
                        <select name="incometitle">
                            <option value="">select title</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($incometitleresult)) :
                            ?>

                            <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>

                            <?php
                            endwhile;
                            ?>
                        </select>

                    </div>

                    <div>
                        <button type="submit" name="displayincome" class="displayincome">
                            <h3>Submit</h3>
                        </button>
                    </div>
                </form>
            </div>

            <!-- ======================== income display table============================== -->

            <div class="table incometable ">
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Account Name</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($incomedetails)) {
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
        </div>

        <!--=======================================expenses contents =============================  -->

        <div class="expcontents">

            <h1>EXPENSES</h1>
            <button class="addexpense">
                <!-- add expenses button -->
                <h2>Add Expenses</h2>
            </button>

            <div class="form expenseform hideform">
                <!-- adding expenses form-->
                <form action="#" method="POST">
                    <div>
                        <input type="text" name="expensetitle" placeholder="Enter expenses title" required>
                    </div>

                    <div>
                        <input type="text" name="expenseamount" placeholder="Enter Amount">
                    </div>

                    <div class="toaccount">
                        <select name="extoaccount" required>
                            <option value="">select</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($accnameresult1)) :
                            ?>

                            <option value="<?php echo $row['accname'];
                                                echo " " . $row['accid'] ?>"><?php echo $row['accname'];
                                                                                echo " " . $row['accid'] ?></option>

                            <?php
                            endwhile;
                            $total = 0;
                            ?>
                        </select>

                    </div>


                    <div class="incomedate">
                        <input type="date" name="expensedate">
                    </div>

                    <div>
                        <button type="submit" name="addexpenseform">Submit</button>
                    </div>
                </form>
            </div>

            <!-- =====================  displaying expenses ================== -->
            <!-- =====================  displaying expense form================== -->


            <button class="displayexpenseform">
                <!-- button for displaying expenses  -->
                <h2>Display expenses</h2>
            </button>

            <div class="form expensedisplayform hideform">
                <!-- form  for displaying incomes-->
                <form action="#" method="POST">
                    <div class="fromdate">
                        <label for="fromdate">From : </label>
                        <input id="fromdate" type="date" name="fromdate" required>
                    </div>

                    <div class="todate">
                        <label for="todate">To : </label>
                        <input id="todate" type="date" name="todate" placeholder="Enter Amount">
                    </div>

                    <div class="expensetitle">
                        <select name="expensetitle">
                            <option value="">select title</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($expensetitleresult)) :
                            ?>

                            <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>

                            <?php
                            endwhile;
                            ?>
                        </select>

                    </div>

                    <div>
                        <button type="submit" name="displayexpense" class="displayexpense">
                            <h3>Submit</h3>
                        </button>
                    </div>
                </form>
            </div>

            <!-- ======================== expense display table============================== -->

            <div class="table incometable ">
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Account Id</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($expensedetails)) {
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
            <h2>category of expenses</h2>

            <div class="categcontainer">
                <?php
                while ($row = mysqli_fetch_assoc($catogory)) :
                ?>

                <div class="catogory">
                    <h2><?php echo $row['title']  ?></h2>
                    <h3><?php echo $row['total'] ?></h3>
                </div>

                <?php
                endwhile;
                ?>

            </div>

        </div>

        <!--=======================================credits contents =============================  -->

        <div class="creditcontents">
            <h1>CREDITS/LOANS</h1>
            <button class="addcredits">
                <!-- add expenses button -->
                <h2>Add Credits</h2>
            </button>

            <div class="form creditsform hideform">
                <!-- adding credits form-->
                <form action="#" method="POST">
                    <div>
                        <input type="text" name="creditstitle" placeholder="Enter credits/loan title" required>
                    </div>

                    <div>
                        <input type="text" name="creditsamount" placeholder="Enter Amount" required>
                    </div>

                    <div class="toaccount">
                        <select name="cretoaccount" required>
                            <option value="">select account</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($accnameresult2)) :
                            ?>

                            <option value="<?php echo $row['accname'];
                                                echo " " . $row['accid'] ?>"><?php echo $row['accname'];
                                                                                echo " " . $row['accid'] ?></option>

                            <?php
                            endwhile;
                            $total = 0;
                            ?>
                        </select>

                    </div>


                    <div class="incomedate">
                        <input type="date" name="creditsdate">
                    </div>

                    <div>
                        <button type="submit" name="addcreditsform">Submit</button>
                    </div>
                </form>
            </div>

            <!-- =====================  displaying credits ================== -->
            <!-- =====================  displaying credits form================== -->


            <button class="deletecredits">
                <!-- button for displaying credits  -->
                <h2>Delete Credits</h2>
            </button>

            <div class="form deletecreditsform hideform">
                <!-- form  for displaying incomes-->
                <form action="#" method="POST">
                    <div class="creditsdetails">
                        <select name="creditsdetail" required>
                            <option value="">select credits</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($creditsdetails1)) :
                            ?>

                            <option value="<?php echo $row['credid'] ?>">
                                <?php echo $row['credid'] . "  " . $row['name'] ?></option>

                            <?php
                            endwhile;
                            ?>
                        </select>

                    </div>

                    <div>
                        <button type="submit" name="deletecredits" class="displaycredits">
                            <h3>Submit</h3>
                        </button>
                    </div>
                </form>
            </div>

            <!-- ======================== credits display table============================== -->

            <div class="table creditstable ">
                <table>
                    <tr>
                        <th>credits id</th>
                        <th>credits name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Account Id</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($creditsdetails)) {
                        ?>
                        <td><?php echo $row['credid']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['ammount']; ?></td>
                        <td><?php echo $row['accountid']; ?></td>

                    </tr>

                    <?php
                        }
                ?>
                </table>
            </div>


        </div>

        <!--=======================================cards contents =============================  -->

        <div class="cardscontents">

            <h1>
                Credits/Debit cards
            </h1>
            <button class="addcardbutton">
                <h2>Add cards</h2>
            </button>

            <div class="form addcardsform hideform">
                <!-- adding cards form-->
                <form action="#" method="POST">
                    <div>
                        <input type="text" name="cardsname" placeholder="Enter card name" required>
                    </div>

                    <div>
                        <input type="text" name="cardnumber" placeholder="Enter number" required>
                    </div>

                    <div class="cardaccount">
                        <select name="cardaccount" required>
                            <option value="">select account</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($accnameresult3)) :
                            ?>

                            <option value="<?php echo $row['accid'] ?>"><?php echo $row['accname'];
                                                                            echo " " . $row['accid'] ?></option>

                            <?php
                            endwhile;
                            ?>
                        </select>

                    </div>

                    <div>
                        <button type="submit" name="addcardformsubmit">Submit</button>
                    </div>
                </form>
            </div>

            <div class="table cardsdisplaytable">
                <table>
                    <tr>
                        <th>Card name</th>
                        <th>Card number</th>
                        <th>Account</th>
                        <th>delete</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($cardsdetails)) {
                        echo "<tr>
                                    <td>" . $row['Name'] . "</td>
                                    <td>" . $row['number'] . "</td>
                                    <td>" . $row['accid'] . "</td>
                                    <td>
                                        <a href='main.php?cardid=" . $row['cardid'] . "' class='btn'>Delete</a>
                                    </td>
                                  </tr>";
                    }
                    ?>

                </table>
            </div>

        </div>
    </div>



    <script src="../static/javascript/main.js"> </script>
</body>

</html>