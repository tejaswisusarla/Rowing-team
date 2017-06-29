<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table#t01 tr:nth-child(even) {
                background-color: #eee;
                color: red ; 
            }
            table#t01 tr:nth-child(odd) {
                background-color:#fff;
                color: blue;
            };
        </style>



    </head>
    <?php $ad = $_GET['page'];
    ?>
    <?php             
    if (isset($_GET['action']) && $_GET['action']=='inactive') { ?>
        <form id="myForm" action="?page=<?php echo $ad ?>&action=<?php echo $_GET['action'] ?>" method="post" style="float: left">

        <select name="RIM" onchange="this.form.submit();">
            <?php
            if (isset($_POST['RIM'])) {
                if ($_POST['RIM'] == '30') {
                    echo "<option value='30' selected>Inactive Members for less than 1 month</option>";
                } else {
                    echo "<option value='30'>Inactive Members for less than 1 month</option>";
                }

                if ($_POST['RIM'] == '90') {
                    echo "<option value='90' selected >Inactive Members for less than 3 months</option>";
                } else {
                    echo "<option value='90' >Inactive Members for less than 3 months</option>";
                }

                if ($_POST['RIM'] == '180') {
                    echo "<option value='180' selected>Inactive Members for less than 6 months</option>";
                } else {
                    echo "<option value='180' >Inactive Members for less than 6 months</option>";
                }

                if ($_POST['RIM'] == '365') {
                    echo "<option value='365' selected>Inactive Members for less than an Year</option>";
                } else {
                    echo "<option value='365' >Inactive Members for less than an Year</option>";
                }
            } else {
                echo "<option value='30'>Inactive Members for less than 1 month</option>" .
                "<option value='90' >Inactive Members for less than 3 months</option>" .
                "<option value='180' >Inactive Members for less than 6 months</option>" .
                "<option value='365' >Inactive Members for less than an Year</option>";
            }
            ?>

        </select>
        &nbsp;&nbsp;&nbsp;
    </form>  
<br><br>
   <?php }?>
     <?php             
    if (isset($_GET['action']) && $_GET['action']=='review') { ?>
    <form id="form1" action="?page=<?php echo $ad ?>&action=<?php echo $_GET['action']?>" method="post"  style="float: left"> 
        <select name="RRM" onchange="this.form.submit()">
            <?php
            if (isset($_POST['RRM'])) {
                if ($_POST['RRM'] == '30') {
                    echo "<option value='30' selected>Registerd Members  Not attended practice for less than 1 month</option>";
                } else {
                    echo "<option value='30'>Registerd Members  Not attended practice for less than 1 month</option>";
                }

                if ($_POST['RRM'] == '60') {
                    echo "<option value='60' selected >Registerd Members  Not attended practice for less than 2 months</option>";
                } else {
                    echo "<option value='60' >Registerd Members  Not attended practice for less than 2 months</option>";
                }

                if ($_POST['RRM'] == '90') {
                    echo "<option value='90' selected>Registerd Members  Not attended practice for less than 3 months</option>";
                } else {
                    echo "<option value='90' >Registerd Members  Not attended practice for less than 3 months</option>";
                }

                if ($_POST['RRM'] == '120') {
                    echo "<option value='120' selected>Registerd Members  Not attended practice for less than 4 months</option>";
                } else {
                    echo "<option value='120' >Registerd Members  Not attended practice for less than 4 months</option>";
                }
            } else {
                echo "<option value='30'>Registerd Members  Not attended practice for less than 1 month</option>" .
                "<option value='60'>Registerd Members  Not attended practice for less than 2 months</option>" .
                "<option value='90'>Registerd Members  Not attended practice for less than 3 months</option>" .
                "<option value='120'>Registerd Members  Not attended practice for less than 4 months</option>";
            }
            ?>
        </select>
        &nbsp;&nbsp;&nbsp;
    </form>
    <br><br>
 <?php }?>
    <?php             
    if (isset($_GET['action']) && $_GET['action']=='budget') { ?>
    <form action="?page=<?php echo $ad ?>&action=<?php echo $_GET['action']?>" id="form2" method="post"  style="float: left"> 
        <input type="hidden" name="action" id="action">
        <input type="button" value="get Revenue" onclick="javascript:getRevenue();">
        <script>
            function getRevenue() {
                document.getElementById("action").value = 'revenue';
                document.getElementById("form2").submit();
            }
        </script>
    </form>
    <br><br>
<?php }?>
    <?php
// put your code here
    include 'connection.php';

//execute the SQL query and return records
//
    if (isset($_POST['RIM'])) {

        $a = $_POST['RIM'];
        $result2 = mysql_query("SELECT * FROM paddler_info WHERE Total_Attendance = 0 AND DATEDIFF(NOW(),Join_Date)<'$a'");
        echo "<div><table id= t01 align=center cellpadding=10 border=1>";
        echo "<tr>
                            <th>Member_ID</th>
                             <th>Name</th> 
                             <th>Email</th>
                              <th>Phone_No</th>
                                </tr>";

        while ($row = mysql_fetch_assoc($result2)) {
            //display the results
            echo "<tr >";
            echo "<td>" . $row['Member_ID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>" . $row['Phone_No'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br/>";
        echo "</div>";
    }
    if (isset($_POST['RRM'])) {
        $a = $_POST['RRM'];
        $result1 = mysql_query("SELECT * FROM paddler_info WHERE DATEDIFF(NOW(),last_attended) <= '$a'");
        //fetch tha data from the database
        echo "<table id= t01 align=left cellpadding=10 border=1>";
        echo "<tr>
                            <th>Member_ID</th>
                             <th>Name</th> 
                             <th>Email</th>
                              <th>Phone_No</th>
                                </tr>";

        while ($row = mysql_fetch_assoc($result1)) {
            //display the results
            echo "<tr >";
            echo "<td>" . $row['Member_ID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>" . $row['Phone_No'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br/>";
    }


    if (isset($_POST['action']) && $_POST['action'] == 'revenue') {

        $result3 = mysql_query("SELECT REVENUE_EXPENSES, category , SUM(case when acc_year in (SELECT max(year(date)) FROM account) then amount_sum else 0 end) AS CURRENT_YEAR, SUM(case when acc_year in (select (max(year(date)) -1) from account) then amount_sum else 0 end) AS PREVIOUS_YEAR
                FROM
                (SELECT 'REVENUES' as 'REVENUE_EXPENSES',year(date) AS acc_year,category,sum(amount) AS amount_sum FROM account WHERE amount > 0  GROUP BY category 
                    UNION
                    SELECT 'EXPENSES' AS 'REVENUE_EXPENSES',year(date) AS acc_year,category,sum(amount) AS '2016_TOTAL' FROM account WHERE amount <= 0  GROUP BY category
                    ) aT
                        GROUP BY 1,2
                            ORDER BY 1 DESC, 2 ASC;");

        echo "<table id= t01 align=right cellpadding=10 border=1>";
        echo "<tr>
            <th>REVENUE_EXPENSES</th>
            <th>category</th> 
            <th>CURRENT_YEAR</th>
            <th>PREVIOUS_YEAR</th>
            </tr>";

        while ($row = mysql_fetch_assoc($result3)) {
            //display the results
            echo "<tr >";
            echo "<td>" . $row['REVENUE_EXPENSES'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['CURRENT_YEAR'] . "</td>";
            echo "<td>" . $row['PREVIOUS_YEAR'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</html>

