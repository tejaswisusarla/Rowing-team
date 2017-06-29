<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> <h2> Races Dashboard</h2>
        <form action='?page=Races' method="POST">
            <main class="rightColumn">
        <strong> Display Race Results: </strong><br>
                        <input type="radio" name="race" value="all">All Results<br>
                        <input type="radio" name="race" value="currYear">Current Year Results<br><br>
		<strong> Display Race Metrics: </strong><br>
                        <input type="radio" name="race" value="DC">2016 Distance and Cost<br>
			<input type="radio" name="race" value="ADC">2016 Average Distance and Cost<br><br>
		<strong> Display Races by Category: </strong><br>
                        <div class="select-boxes"><select name="raceCat">
                            <option value=null></option>
                            <option value="250M">250 Meters</option>
                            <option value="500M">500 Meters</option>
                            <option value="2000M">2 Kilometers</option>
                            </select></div>
		<br><br>
       </main>
        <div>
        <strong> Update (or Add) a Race: </strong><br>
        <i>If no RaceID is specified, a new race will be added.<br>
        At minimum, a name is required to add a race.</i>
            <table style="border:0; text-align: left">
                <tr>
                    <td>Race ID:</td>
                    <td><input name="RaceID"></td>
                </tr>
			<tr>
				<td>Race Name:</td>
				<td><input name="RaceName"></td>
			</tr>
			<tr>
				<td>Cost:</td>
				<td><input name="Cost"></td>
			</tr>
			<tr>
				<td>Travel Distance:</td>
				<td><input name="Distance"></td>
			</tr>
			<tr>
				<td>Date:</td>
				<td><input name="Date"></td>
			</tr>
                        <tr>
				<td>Address:</td>
				<td><input name="Address"></td>
			</tr>
			<tr>
				<td>Race Placement:</td>
				<td><input name="Placement"></td>
			</tr>
		</table>
        <br>
        <input type="submit" value="Submit">
		<br>
            		
        </form>
        </div>
        
           
     </body>
     <body>
     </body>
    
      <?php
        if (isset($_POST['RaceID']))
        {
            if(($_POST['RaceID']) !="") {
            updateRace();
            } 
            else if(($_POST['RaceName']) !="") {
            addRace();
            } 
            else {
            pullReport();
            }
        } 
        
        function updateRace() {
            global $conn;
            $RaceID = $_POST['RaceID'];
            if (($_POST['Cost']) != "") {
                $Cost = $_POST['Cost'];
            } else {
                $Cost = "null";
            }
            
            if (($_POST['Distance']) != "") {
                $Distance = $_POST['Distance'];
            } else {
                $Distance = "null";
            }
            
            if (($_POST['Date']) != "") {
                $Date = '"'.$_POST['Date'].'"';
            } else {
                $Date = "null";
            }
            
            if (($_POST['Address']) != "") {
                $Address = '"'.$_POST['Address'].'"';
            } else {
                $Address = "null";
            }
            
            if (($_POST['RaceName']) != "") {
                $RaceName = '"'.$_POST['RaceName'].'"';
            } else {
                $RaceName = "null";
            }
            
            if (($_POST['Placement']) != "") {
                $Placement = $_POST['Placement'];
            } else {
                $Placement = "null";
            }
            
            //pull information from before update
            $updatedInfo = "SELECT * FROM Races WHERE Race_ID='".$RaceID."'";
            $result = $conn->query($updatedInfo);
            echo '<h3>Old Values</h3><table>';
            foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                foreach($row as $key => $value) {
                    echo '<th><tr><td><strong>' . $key . '</strong></td></tr></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                }
             }
            echo '</table>';
            
            //update values based on inputs
            $update = "UPDATE RACES SET Race_ID = COALESCE(null, Race_ID), Cost = COALESCE(".$Cost.", Cost), Travel_Distance = COALESCE(".$Distance.", Travel_Distance),
            Race_Date = COALESCE(".$Date.", Race_Date),
            Address = COALESCE(".$Address.", Address),
            Race_Name = COALESCE(".$RaceName.", Race_Name),
            Race_Placement = COALESCE(".$Placement.", Race_Placement)
            WHERE Race_ID='".$RaceID."'";
            $result = $conn->query($update);
            echo "<br><strong> You updated: </strong> Race ID ".$RaceID." in the database.";
            
            //display updated values to user
            $updatedInfo = "SELECT * FROM Races WHERE Race_ID='".$RaceID."'";
            $result = $conn->query($updatedInfo);
            echo '<h3>Updated Values</h3><table>';
            foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                foreach($row as $key => $value) {
                    echo '<th><tr><td><strong>' . $key . '</strong></td></tr></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                }
             }
             echo '</table>';
            
        }
        
        function addRace() {
            global $conn;
            $RaceID = "'R00033'";
            if (($_POST['Cost']) != "") {
                $Cost = $_POST['Cost'];
            } else {
                $Cost = "null";
            }
            
            if (($_POST['Distance']) != "") {
                $Distance = $_POST['Distance'];
            } else {
                $Distance = "null";
            }
            
            if (($_POST['Date']) != "") {
                $Date = "'".$_POST['Date']."'";
            } else {
                $Date = "null";
            }
            
            if (($_POST['Address']) != "") {
                $Address = '"'.$_POST['Address'].'"';
            } else {
                $Address = "null";
            }
            
            if (($_POST['RaceName']) != "") {
                $RaceName = '"'.$_POST['RaceName'].'"';
            } else {
                $RaceName = "null";
            }
            
            if (($_POST['Placement']) != "") {
                $Placement = $_POST['Placement'];
            } else {
                $Placement = "null";
            }
            
            $addRace = "INSERT INTO RACES(RACE_ID, Cost, Travel_Distance, Race_Date, Address, Race_Name, Race_Placement)
            VALUES (".$RaceID.",".$Cost.",".$Distance.",".$Date.",".$Address.",".$RaceName.",".$Placement.")";
            $result = $conn->query($addRace);
            
            //display added result
            $newRace = "SELECT * FROM Races WHERE Race_ID=".$RaceID;
            $result = $conn->query($newRace);
            echo '<h3>New Values</h3><table>';
            foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                foreach($row as $key => $value) {
                    echo '<th><tr><td><strong>' . $key . '</strong></td></tr></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                }
             }
             echo '</table>';
        }
       
        function pullReport()  {
        global $conn;
        
        if(isset($_POST['race']))
        {
            $race=$_POST['race'];
        } else {
            $race='';
        }
        
        if ($race==='all') {
            $query = "SELECT Race_Name as x, Race_Date as x1, Race_Placement as x2 FROM RACES ORDER BY Race_Date";
            $result = $conn->query($query);
            
            echo '<h3>Results</h3>';
            echo "<table> <colgroup>
                <col span='1' style='width: 45%'>
                <col span='1' style='width: 45%'>
                <col span='1' style='width: 10%'>
            </colgroup>
            <tr>
                <th>Race Name</th>
                <th>Race Date</th>
                <th>Place</th>
            </tr>";
          
         while($row = mysqli_fetch_array($result)) {
         echo "<tr class='tableBlocks'><td>" . htmlentities($row['x']) . "</td>";
         echo "<td>" . htmlentities($row['x1']) . "</td>";
         echo "<td>" . htmlentities($row['x2']) . "</td></tr>\n";
        }
        echo "</table><br><br>";
        }
        
        else if ($race==='currYear'){
            $query = "SELECT Race_Name as x, Race_Date as x1, Race_Placement as x2 FROM RACES WHERE (DATEDIFF(NOW(),RACE_DATE)<365)";
            $result = $conn->query($query);
            echo '<h3>Results</h3>';
            echo "<table> <colgroup>
                <col span='1' style='width: 45%'>
                <col span='1' style='width: 45%'>
                <col span='1' style='width: 10%'>
            </colgroup>
            <tr>
                <th>Race Name</th>
                <th>Race Date</th>
                <th>Place</th>
            </tr>";
          
         while($row = mysqli_fetch_array($result)) {
         echo "<tr class='tableBlocks'><td>" . htmlentities($row['x']) . "</td>";
         echo "<td>" . htmlentities($row['x1']) . "</td>";
         echo "<td>" . htmlentities($row['x2']) . "</td></tr>\n";
        }
             echo '</table><br><br>';
        }
        
        else if ($race==='DC'){
            $query = "SELECT Race_Name as x, Travel_Distance as x1, Cost as x2 FROM RACES WHERE (DATEDIFF(NOW(),RACE_DATE)<365)ORDER BY RACE_DATE";
            $result = $conn->query($query);
           echo '<h3>Results</h3>';
            echo "<table> <colgroup>
                <col span='1' style='width: 50%'>
                <col span='1' style='width: 25%'>
                <col span='1' style='width: 25%'>
            </colgroup>
            <tr>
                <th>Race Name</th>
                <th>Travel Distance</th>
                <th>Cost</th>
            </tr>";
           while($row = mysqli_fetch_array($result)) {
         echo "<tr class='tableBlocks'><td>" . htmlentities($row['x']) . "</td>";
         echo "<td>" . htmlentities($row['x1']) . "</td>";
         echo "<td>" . htmlentities($row['x2']) . "</td></tr>\n";
        }
             echo '</table><br><br>';
        }
        
        else if ($race==='ADC'){
            $query = "SELECT COUNT(Cost) as x1, AVG(Travel_Distance) as x2, AVG(Cost) as x3 FROM RACES WHERE (DATEDIFF(NOW(),RACE_DATE)<365)";
            $result = $conn->query($query);
            echo '<h3>Results</h3>';
            echo "<table> <colgroup>
                <col span='1' style='width: 30%'>
                <col span='1' style='width: 40%'>
                <col span='1' style='width: 30%'>
            </colgroup>
            <tr>
                <th>Total Races This Year</th>
                <th>Average Travel Distance</th>
                <th>Average Cost</th>
            </tr>";
           while($row = mysqli_fetch_array($result)) {
            echo "<tr class='tableBlocks'><td>" . htmlentities($row['x1']) . "</td>";
            echo "<td>" . htmlentities($row['x2']) . "</td>";
            echo "<td>" . htmlentities($row['x3']) . "</td></tr>\n";
        }
             echo '</table><br><br>';
        }     
        else if (isset($_POST['raceCat']) && ($_POST['raceCat'] != "null"))
        {   
            $raceCat = $_POST['raceCat'];
            $query = 'SELECT Race_Name as x, Race_Date as x1, Race_Placement as x2, Heat_Placement as x3, Distance as x4 FROM Races, HeatResults WHERE Distance="'.$raceCat.'" AND Races.RACE_ID = HeatResults.Race_ID';
            $result=$conn->query($query);
            echo '<h3>Results</h3>';
            echo "<table> <colgroup>
                <col span='1' style='width: 20%'>
                <col span='1' style='width: 10%'>
                <col span='1' style='width: 10%'>
                <col span='1' style='width: 10%'>
                <col span='1' style='width: 10%'>
            </colgroup>
            <tr>
                <th>Race Name</th>
                <th>Race Date</th>
                <th>Race Placement</th>
                <th>Heat Placement</th>
                <th>Distance (in meters)</th>
            </tr>";
           while($row = mysqli_fetch_array($result)) {
            echo "<tr class='tableBlocks'><td>" . htmlentities($row['x']) . "</td>";
            echo "<td>" . htmlentities($row['x1']) . "</td>";
            echo "<td>" . htmlentities($row['x2']) . "</td>";
            echo "<td>" . htmlentities($row['x3']) . "</td>";
            echo "<td>" . htmlentities($row['x4']) . "</td></tr>\n";
        }
             echo '</table><br><br>';
        } else {
            echo "<br><br>Please specify a query above.";
        }
    }
        ?>
</html>
