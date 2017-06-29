<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> <h2> Sponsors Dashboard </h2>
        <main class="rightColumn">
            <form action='?page=sponsor' method="POST">
            <br><strong> Update Sponsors Details: </strong><br>
            <i>Must specify sponsor ID to update record</i>
            <table style="border:0; text-align: left">
                <tr>
                    <td>Sponsor ID:</td>
                    <td><input name="sponsor_id"></td>
				</tr>
				
				<tr>
                    <td>Contact Phone:</td>
                    <td><input name="contact_phone"></td>
				</tr>
				<tr>
                    <td>Contact Role:</td>
                    <td><input name="contact_role"></td>
		</tr>
		<tr>
                    <td>Contact Mail:</td>
                    <td><input name="contact_mail"></td>
		</tr>
		<tr>
                    <td>Notes:</td>
                    <td><input name="Notes"></td>
        </tr>
		<tr>
                    <td>Category:</td>
                    <td><input name="category"></td>
        </tr>
				<tr>
                    <td>Contact Name:</td>
                    <td><input name="contact_name"></td>
		</tr>
				<tr>
                    <td>Relationship Owner:</td>
                    <td><input name="oc_relationship_owner"></td>
		</tr>
				<tr>
                    <td>Last Contact Date (YYYY-MM-DD):</td>
                    <td><input name="last_contact_date"></td>
		</tr>
				
				<tr>
                    <td>Organization Name:</td>
                    <td><input name="organization_name"></td>
		</tr>
                
				<tr>
                    <td>Importance:</td>
                    <td><input name="Importance"></td>
        </tr>
				
            </table> <br>
            <input type="hidden" name="UpdateSet" value="true">
            <input type="submit" value="Update Sponsors details">
        </form>
        </main>
        <main class="leftColumn">
        <form action='?page=sponsor' method="POST">
            <br>
            <strong> Add Sponsors Details: </strong><br>
            <i>Please fill out the below entries </i>
            <table style="border:0; text-align: left">
                <tr>
                    <td>Sponsor ID:</td>
                    <td><input name="sponsor_id"></td>
				</tr>
				
				<tr>
                    <td>Contact Phone:</td>
                    <td><input name="contact_phone"></td>
				</tr>
				<tr>
                    <td>Contact Role:</td>
                    <td><input name="contact_role"></td>
		</tr>
		<tr>
                    <td>Contact Mail:</td>
                    <td><input name="contact_mail"></td>
		</tr>
		<tr>
                    <td>Notes:</td>
                    <td><input name="Notes"></td>
        </tr>
		<tr>
                    <td>Category:</td>
                    <td><input name="category"></td>
        </tr>
				<tr>
                    <td>Contact Name:</td>
                    <td><input name="contact_name"></td>
		</tr>
				<tr>
                    <td>Relationship Owner:</td>
                    <td><input name="oc_relationship_owner"></td>
		</tr>
				<tr>
                    <td>Last Contact Date (YYYY-MM-DD):</td>
                    <td><input name="last_contact_date"></td>
		</tr>
				
				<tr>
                    <td>Organization Name:</td>
                    <td><input name="organization_name"></td>
		</tr>
                
				<tr>
                    <td>Importance:</td>
                    <td><input name="Importance"></td>
        </tr>
            </table> <br>
            <input type="hidden" name="AddRecord" value="true">
            <input type="submit" value="Add Sponsors Details"><br><br>
        </form>
        		 
        <form action='?page=sponsor' method="POST">
            
            <strong> Pull Records for Single Sponsor: </strong><br>
            <i>Specify a sponsor ID to find the lifetime giving for a particular sponsor.<br>
                If no Sponsor ID is specified, lifetime giving of all sponsors will be posted.<br></i><br>
            <strong>Member ID:  </strong>
            <input name="sponsor_id"><br><br>
            <input type="hidden" name="PullRecord" value="true">
            <input type="submit" value="Pull Lifetime Results"><br><br>
            
        </form>
            
    </body>
    <?php

        
        if (isset($_POST['AddRecord'])) {
            addRecord();
        }
        else if (isset($_POST['UpdateSet'])) {
            updateRecord();
        } 
        else if (isset($_POST['PullRecord'])){
            pullRecords();
        }
		echo '</main>';
		
        function addRecord() {
            global $conn;
            if ($_POST['sponsor_id']=="") {
                echo "You must enter the Sponsor ID to add sponsor details";
                return false;
            }
            else {
                $sponsor_id = "'".$_POST['sponsor_id']."'";
            }
            
              if (($_POST['contact_phone']) != "") {
                $contact_phone = "'".$_POST['contact_phone']."'";
            } else {
                $contact_phone = "null";
            }            
            
            if (($_POST['contact_role']) != "") {
                $contact_role = "'".$_POST['contact_role']."'";
            } else {
                $contact_role = "null";
            }
            if (($_POST['contact_mail']) != "") {
                $contact_mail = "'".$_POST['contact_mail']."'";
            } else {
                $contact_mail = "null";
            }
			if (($_POST['Notes']) != "") {
                $Notes = "'".$_POST['Notes']."'";
            } else {
                $Notes = "null";
            }            
			if (($_POST['category']) != "") {
                $category = "'".$_POST['category']."'";
            } else {
                $category = "null";
            }
			if (($_POST['contact_name']) != "") {
                $contact_name = "'".$_POST['contact_name']."'";
            } else {
                $contact_name = "null";
			}
            
            if (($_POST['oc_relationship_owner']) != "") {
                $oc_relationship_owner = "'".$_POST['oc_relationship_owner']."'";
            } else {
                $oc_relationship_owner = "null";
            }
            
             if (($_POST['last_contact_date']) != "") {
                $last_contact_date = "'".$_POST['last_contact_date']."'";
            } else {
                $last_contact_date = "null";
            }
            if (($_POST['organization_name']) != "") {
                $organization_name = "'".$_POST['organization_name']."'";
            } else {
                $organization_name = "null";
            }
            
            if (($_POST['Importance']) != "") {
                $Importance = "'".$_POST['Importance']."'";
            } else {
                $Importance = "null";
            }            


            //insert data
            $addTimeTrial = "INSERT INTO sponsors (sponsor_id, contact_phone, contact_role, contact_mail, Notes, category, contact_name, oc_relationship_owner, last_contact_date, organization_name, Importance)
            VALUES (".$sponsor_id.", ".$contact_phone.", ".$contact_role.", ".$contact_mail.", ".$Notes.", ".$category.", ".$contact_name.", ".$oc_relationship_owner.", ".$last_contact_date.", ".$organization_name.", ".$Importance." )";
			$result = $conn->query($addTimeTrial);
            
						
			$updatedTrial = "SELECT sponsor_id as a,contact_phone as a1,contact_role as a2,contact_mail as a3,Notes as a4,category as a5,contact_name as a6,oc_relationship_owner as a7,last_contact_date as a8,organization_name as a9,Importance as a10
			FROM sponsors WHERE sponsor_id=".$sponsor_id."";
            $result = $conn->query($updatedTrial);
			echo '<h3>New Sponsor Details</h3><table>';
            echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 30%">';
				echo '<th>Sponsor Id</th><th>Phone</th><th>Role</th><th>Mail</th><th>Notes</th><th>Category</th><th>Contact Name</th><th>Relationship owner</th><th>Contact Date</th><th>organization Name</th><th>Importance</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		 echo "<td>" . htmlentities($row['a5']) . "</td>";
		 echo "<td>" . htmlentities($row['a6']) . "</td>";
		 echo "<td>" . htmlentities($row['a7']) . "</td>";
         echo "<td>" . htmlentities($row['a8']) . "</td>";
		 echo "<td>" . htmlentities($row['a9']) . "</td>";
         echo "<td>" . htmlentities($row['a10']) . "</td></tr>\n";
     }
				  echo '</colgroup>';
	              echo '</table>';

             
        }     
		
        function updateRecord() {
            global $conn;
            if ($_POST['sponsor_id']=="") {
                echo "Must specify Sponsor ID to update record!";
            }
            else {
                $sponsor_id = "'".$_POST['sponsor_id']."'";
            }
            
             if (($_POST['contact_phone']) != "") {
                $contact_phone = "'".$_POST['contact_phone']."'";
            } else {
                $contact_phone = "null";
            }            
            
            if (($_POST['contact_role']) != "") {
                $contact_role = "'".$_POST['contact_role']."'";
            } else {
                $contact_role = "null";
            }
            if (($_POST['contact_mail']) != "") {
                $contact_mail = "'".$_POST['contact_mail']."'";
            } else {
                $contact_mail = "null";
            }
			if (($_POST['Notes']) != "") {
                $Notes = "'".$_POST['Notes']."'";
            } else {
                $Notes = "null";
            }            
			if (($_POST['category']) != "") {
                $category = "'".$_POST['category']."'";
            } else {
                $category = "null";
            }
			if (($_POST['contact_name']) != "") {
                $contact_name = "'".$_POST['contact_name']."'";
            } else {
                $contact_name = "null";
			}
            
            if (($_POST['oc_relationship_owner']) != "") {
                $oc_relationship_owner = "'".$_POST['oc_relationship_owner']."'";
            } else {
                $oc_relationship_owner = "null";
            }
            
             if (($_POST['last_contact_date']) != "") {
                $last_contact_date = "'".$_POST['last_contact_date']."'";
            } else {
                $last_contact_date = "null";
            }
            if (($_POST['organization_name']) != "") {
                $organization_name = "'".$_POST['organization_name']."'";
            } else {
                $organization_name = "null";
            }
            
            if (($_POST['Importance']) != "") {
                $Importance = "'".$_POST['Importance']."'";
            } else {
                $Importance = "null";
            }            

                     
            $updatedrecord = "SELECT sponsor_id as a,contact_phone as a1,contact_role as a2,contact_mail as a3,Notes as a4,category as a5,contact_name as a6,oc_relationship_owner as a7,last_contact_date as a8,organization_name as a9,Importance as a10
			FROM sponsors WHERE sponsor_id=".$sponsor_id."";
            $result = $conn->query($updatedrecord);
            echo '<h3>Previous Sponsor Details</h3><table>';
			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 10%">';
				echo '<th>Sponsor Id</th><th>Phone</th><th>Role</th><th>Mail</th><th>Notes</th><th>Category</th><th>Contact Name</th><th>Relationship owner</th><th>Contact Date</th><th>organization Name</th><th>Importance</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		 echo "<td>" . htmlentities($row['a5']) . "</td>";
		 echo "<td>" . htmlentities($row['a6']) . "</td>";
		 echo "<td>" . htmlentities($row['a7']) . "</td>";
         echo "<td>" . htmlentities($row['a8']) . "</td>";
		 echo "<td>" . htmlentities($row['a9']) . "</td>";
         echo "<td>" . htmlentities($row['a10']) . "</td></tr>\n";
     }
	              echo '</colgroup>';
				  
				  echo '</table>';
            
            $updateTimeTrial = "UPDATE sponsors SET 
			contact_phone = COALESCE(".$contact_phone.", contact_phone), 
			contact_role = COALESCE(".$contact_role.", contact_role), 
			contact_mail = COALESCE(".$contact_mail.", contact_mail),
            Notes = COALESCE(".$Notes.", Notes), 
			category = COALESCE(".$category.", category), 
			contact_name = COALESCE(".$contact_name.", contact_name), 
			oc_relationship_owner = COALESCE(".$oc_relationship_owner.", oc_relationship_owner), 
			last_contact_date = COALESCE(".$last_contact_date.", last_contact_date), 
			organization_name = COALESCE(".$organization_name.", organization_name), 
			Importance = COALESCE(".$Importance.", Importance) 
			WHERE sponsor_id=".$sponsor_id;
			
            $result = $conn->query($updateTimeTrial);
            
            //report data to user
            $updatedTrial = "SELECT sponsor_id as a,contact_phone as a1,contact_role as a2,contact_mail as a3,Notes as a4,category as a5,contact_name as a6,oc_relationship_owner as a7,last_contact_date as a8,organization_name as a9,Importance as a10
			FROM sponsors WHERE sponsor_id=".$sponsor_id."";
            $result = $conn->query($updatedTrial);
			echo '<h3>Updated Sponsor Details</h3><table>';
            echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 30%">';
				echo '<th>Sponsor Id</th><th>Phone</th><th>Role</th><th>Mail</th><th>Notes</th><th>Category</th><th>Contact Name</th><th>Relationship owner</th><th>Contact Date</th><th>organization Name</th><th>Importance</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		 echo "<td>" . htmlentities($row['a5']) . "</td>";
		 echo "<td>" . htmlentities($row['a6']) . "</td>";
		 echo "<td>" . htmlentities($row['a7']) . "</td>";
         echo "<td>" . htmlentities($row['a8']) . "</td>";
		 echo "<td>" . htmlentities($row['a9']) . "</td>";
         echo "<td>" . htmlentities($row['a10']) . "</td></tr>\n";
     }
				  echo '</colgroup>';
				  mysqli_free_result($result);
	              echo '</table>';
			 
        }
        
		function pullRecords() {
            global $conn;

            if (($_POST['sponsor_id']) === "") {
				
                $lifetime = "SELECT sponsor_id as x,sum(amount) as x1 FROM account group by sponsor_id";
                $result = $conn->query($lifetime);
                
                echo '<h3>All Lifetime Values</h3><table>';
				
				echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 25%"><col span="1" style="width: 25%">';
				echo '<th>Sponsor Id</th><th>Lifetime</th>';
				while($row = mysqli_fetch_array($result)) {
				echo "<tr><td>" . htmlentities($row['x']) . "</td>";
				echo "<td>" . htmlentities($row['x1']) . "</td></tr>\n";
			}
			echo '</colgroup>';
			                
            } else {
				$sponsor_id = "'".$_POST['sponsor_id']."'";
				$lifetime1 = "SELECT sponsor_id as x,sum(amount) as x1 FROM account where sponsor_id=".$sponsor_id."";
                $result1 = $conn->query($lifetime1);
                
                echo '<h3>All Lifetime Values</h3><table>';
				
				echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 25%"><col span="1" style="width: 25%">';
				echo '<th>Sponsor Id</th><th>Lifetime</th>';
				if ($result1->num_rows >0) {
					while ($row = $result1->fetch_assoc()) {
						echo "<tr><td>" . htmlentities($row['x']) . "</td>";
						echo "<td>" . htmlentities($row['x1']) . "</td></tr>\n";
					}
				}
            }
			}     
    ?>
</html>
