<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> <h2> Teams Dashboard </h2>
        <main class="rightColumn">
            <form action='?page=Teams' method="POST">
            <br><strong> Update Team Details: </strong><br>
            <i>Must specify Team ID to update record</i>
            <table style="border:0; text-align: left">
			
			<tr>
                    <td>Team Id:</td>
                    <td><input name="team_id"></td>
		</tr>
                <tr>
                    <td>Team Name:</td>
                    <td><input name="team_name"></td>
		</tr>
                <tr>
                    <td>Team Member Cost:</td>
                    <td><input name="Team_mem_cost"></td>
		</tr>
                
            </table> <br>
            <input type="hidden" name="UpdateSet" value="true">
            <input type="submit" value="UpdateTeamDetails">
        </form>
        </main>
        <form action='?page=Teams' method="POST">
            <br>
            <strong> Add Team Details: </strong><br>
            <i>Please enter the below details: </i>
            <table style="border:0; text-align: left">
            <tr>
                    <td>Team id:</td>
                    <td><input name="team_id"></td>
		</tr>
                <tr>
                    <td>Description:</td>
                    <td><input name="team_name"></td>
		</tr>
                <tr>
                    <td>Purchase Price:</td>
                    <td><input name="team_mem_cost"></td>
		</tr>
                
                				
            </table> <br>
            <input type="hidden" name="AddRecord" value="true">
            <input type="submit" value="AddTeamDetails"><br><br>
        </form>
    </body>
    <?php
      
        
        if (isset($_POST['AddRecord'])) {
            addRecord();
        }
        else if (isset($_POST['UpdateSet']) or isset($_POST['UpdateTeamDetails'])) {
            updateRecord();
        } 
        
        function addRecord() {
            global $conn;
            if ($_POST['team_id']=="" ) {
                echo "You must enter the team ID and sponsor id to add accounts details";
                return false;
            }
            else {
                $team_id = "'".$_POST['team_id']."'";
                
            }
            
            if (($_POST['team_name']) != "") {
                $team_name = "'".$_POST['team_name']."'";
            } else {
                $team_name = "null";
            }
            
            if (($_POST['team_mem_cost']) != "") {
                $team_mem_cost = "'".$_POST['team_mem_cost']."'";
            } else {
                $team_mem_cost = "null";
            }
            
            
            
            
            
            //insert data
            $teamdata = "INSERT INTO team (team_id,team_name, team_mem_cost)
            VALUES (".$team_id.", ".$team_name.", ".$team_mem_cost.")";
            $result = $conn->query($teamdata);
            
            //report data to user
            $addedTrial = "SELECT team_id as a, team_name as a1, team_mem_cost as a2 from team WHERE team_id=".$team_id."";
            $result = $conn->query($addedTrial);
            echo '<h3>New Values</h3><table>';
   			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Team ID</th><th>Team Name</th><th>Team Member Cost</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		         
     }
	 mysqli_free_result($result);
             echo '</table>';
        }     
        function updateRecord() {
            global $conn;
            if ($_POST['team_id']=="" ) {
                echo "Must specify team_id  to update record!";
            }
            else {
                $team_id = "'".$_POST['team_id']."'";
                
            }
            
            if (($_POST['team_name']) != "") {
                $team_name = "'".$_POST['team_name']."'";
            } else {
                $team_name = "null";
            }
            
            if (($_POST['team_mem_cost']) != "") {
                $team_mem_cost = "'".$_POST['team_mem_cost']."'";
            } else {
                $team_mem_cost = "null";
            }
            
            
            
					
            $priorTrial = "SELECT team_id as a, team_name as a1, team_mem_cost as a2 from team WHERE team_id=".$team_id."";
            $result = $conn->query($priorTrial);
            echo '<h3>Old Values</h3><table>';
			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Team Id</th><th>Team Name</th><th>Team Member Cost</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		
		
     }
	              echo '</table>';
			 
            $updateTeam = "UPDATE team SET team_id = COALESCE(".$team_id.", team_id), team_name = COALESCE(".$team_name.", team_name), team_mem_cost = COALESCE(".$team_mem_cost.",  team_mem_cost)
             WHERE team_id=".$team_id."";
            $result = $conn->query($updateTeam);
            
            //report data to user
            $updatedTrial = "SELECT team_id as a6, team_name as a7, team_mem_cost as a8 from team WHERE team_id=".$team_id."";
            $result = $conn->query($updatedTrial);
            echo '<h3>New Values</h3><table>';
			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Team Id</th><th>Team name</th><th>Team Member Cost</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a6']) . "</td>";
         echo "<td>" . htmlentities($row['a7']) . "</td>";
         echo "<td>" . htmlentities($row['a8']) . "</td>";
		 
		
		 
     }
             echo '</table>';
			 mysqli_free_result($result);
        }
        
    ?>
</html>
