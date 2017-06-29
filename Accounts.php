<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> <h2> Accounts Dashboard </h2>
        <main class="rightColumn">
            <form action='?page=accounts' method="POST">
            <br><strong> Update Account Details: </strong><br>
            <i>Must specify Expense ID to update record</i>
            <table style="border:0; text-align: left">
			
			<tr>
                    <td>expense_id:</td>
                    <td><input name="expense_id"></td>
		</tr>
                <tr>
                    <td>sponsor_id:</td>
                    <td><input name="sponsor_id"></td>
		</tr>
                <tr>
                    <td>member_id:</td>
                    <td><input name="member_id"></td>
		</tr>
                <tr>
                    <td>date:</td>
                    <td><input name="date"></td>
                </tr>
		<tr>
                    <td>category :</td>
                    <td><input name="category"></td>
		</tr>
		<tr>
                    <td>amount:</td>
                    <td><input name="amount"></td>
		</tr>
		<tr>
                    <td>memo:</td>
                    <td><input name="memo"></td>
		</tr>
            </table> <br>
            <input type="hidden" name="UpdateSet" value="true">
            <input type="submit" value="Update Account Details">
        </form>
        </main>
        <form action='?page=accounts' method="POST">
            <br>
            <strong> Add Account Details: </strong><br>
            <i>Please enter the below details: </i>
            <table style="border:0; text-align: left">
            <tr>
                    <td>expense_id:</td>
                    <td><input name="expense_id"></td>
		</tr>
                <tr>
                    <td>sponsor_id:</td>
                    <td><input name="sponsor_id"></td>
		</tr>
                <tr>
                    <td>member_id:</td>
                    <td><input name="member_id"></td>
		</tr>
                <tr>
                    <td>date:</td>
                    <td><input name="date"></td>
                </tr>
		<tr>
                    <td>category :</td>
                    <td><input name="category"></td>
		</tr>
		<tr>
                    <td>amount:</td>
                    <td><input name="amount"></td>
		</tr>
		<tr>
                    <td>memo:</td>
                    <td><input name="memo"></td>
		</tr>				
            </table> <br>
            <input type="hidden" name="AddRecord" value="true">
            <input type="submit" value="Add Accounts Details"><br><br>
        </form>
    </body>
    <?php

        
        function addRecord() {
            global $conn;
            if ($_POST['expense_id']=="" || $_POST['sponsor_id']=="") {
                echo "You must enter the expense ID and sponsor id to add accounts details";
                return false;
            }
            else {
                $expense_id = "'".$_POST['expense_id']."'";
                $sponsor_id = "'".$_POST['sponsor_id']."'";
            }
            
            if (($_POST['member_id']) != "") {
                $member_id = "'".$_POST['member_id']."'";
            } else {
                $member_id = "null";
            }
            
            if (($_POST['date']) != "") {
                $date = "'".$_POST['date']."'";
            } else {
                $date = "null";
            }
            
            if (($_POST['category']) != "") {
                $category = "'".$_POST['category']."'";
            } else {
                $category = "null";
            }
            
            if (($_POST['amount']) != "") {
                $amount = "'".$_POST['amount']."'";
            } else {
                $amount = "null";
            }
            
            if (($_POST['memo']) != "") {
                $memo = "'".$_POST['memo']."'";
            } else {
                $memo = "null";
            }
            
            
            //insert data
            $accountdata = "INSERT INTO account (expense_id, sponsor_id, member_id, date, category, amount, memo)
            VALUES (".$expense_id.", ".$sponsor_id.", ".$member_id.", ".$date.", ".$category.", ".$amount.", ".$memo.")";
            $result = $conn->query($accountdata);
            
            //report data to user
            $addedTrial = "SELECT expense_id as a, sponsor_id as a1, member_id as a2, date as a3, category as a4, amount as a5, memo as a6 FROM account WHERE expense_id=".$expense_id."";
            $result = $conn->query($addedTrial);
            echo '<h3>New Accounts Details</h3><table>';
   			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Expense Id</th><th>Sponsor ID</th><th>Member Id</th><th>date</th><th>category</th><th>amount</th><th>memo</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		 echo "<td>" . htmlentities($row['a5']) . "</td>";
         echo "<td>" . htmlentities($row['a6']) . "</td></tr>\n";
     }
	 mysqli_free_result($result);
             echo '</table>';
        }     
        function updateRecord() {
            global $conn;
            if ($_POST['expense_id']=="" || $_POST['sponsor_id']=="") {
                echo "Must specify expense_id and sponsor_id to update record!";
            }
            else {
                $expense_id = "'".$_POST['expense_id']."'";
                $sponsor_id = "'".$_POST['sponsor_id']."'";
            }
            
            if (($_POST['member_id']) != "") {
                $member_id = "'".$_POST['member_id']."'";
            } else {
                $member_id = "null";
            }
            
            if (($_POST['date']) != "") {
                $date = "'".$_POST['date']."'";
            } else {
                $date = "null";
            }
            
            if (($_POST['category']) != "") {
                $category = "'".$_POST['category']."'";
            } else {
                $category = "null";
            }
            
            if (($_POST['amount']) != "") {
                $amount = "'".$_POST['amount']."'";
            } else {
                $amount = "null";
            }
            
            if (($_POST['memo']) != "") {
                $memo = "'".$_POST['memo']."'";
            } else {
                $memo = "null";
            }
            
					
            $priorTrial = "SELECT expense_id as a, sponsor_id as a1, member_id as a2, date as a3, category as a4, amount as a5, memo as a6 FROM account WHERE expense_id=".$expense_id."";
            $result = $conn->query($priorTrial);
            echo '<h3>Previous Account Details</h3><table>';
			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Expense Id</th><th>Sponsor ID</th><th>Member Id</th><th>date</th><th>category</th><th>amount</th><th>memo</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		 echo "<td>" . htmlentities($row['a5']) . "</td>";
         echo "<td>" . htmlentities($row['a6']) . "</td></tr>\n";
     }
	              echo '</table>';
			 
            $updateTimeTrial = "UPDATE account SET sponsor_id = COALESCE(".$sponsor_id.", sponsor_id), member_id = COALESCE(".$member_id.", member_id), date = COALESCE(".$date.",  date),
            category = COALESCE(".$category.", category), amount = COALESCE(".$amount.", amount), memo = COALESCE(".$memo.", memo) WHERE expense_id=".$expense_id."";
            $result = $conn->query($updateTimeTrial);
            
            //report data to user
            $updatedTrial = "SELECT expense_id as a, sponsor_id as a1, member_id as a2, date as a3, category as a4, amount as a5, memo as a6 FROM account WHERE expense_id=".$expense_id."";
            $result = $conn->query($updatedTrial);
            echo '<h3>Updated Account Details</h3><table>';
			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Expense Id</th><th>Sponsor ID</th><th>Member Id</th><th>date</th><th>category</th><th>amount</th><th>memo</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		 echo "<td>" . htmlentities($row['a5']) . "</td>";
         echo "<td>" . htmlentities($row['a6']) . "</td></tr>\n";
		 
     }
             echo '</table>';
			 mysqli_free_result($result);
        }
        
    ?>
</html>
