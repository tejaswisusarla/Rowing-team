<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> <h2> Equipments Dashboard </h2>
        <main class="rightColumn">
            <form action='?page=Equipment' method="POST">
            <br><strong> Update Equipment Details: </strong><br>
            <i>Must specify Equipment ID to update record</i>
            <table style="border:0; text-align: left">
			
			<tr>
                    <td>Equipment Id:</td>
                    <td><input name="equipment_id"></td>
		</tr>
                <tr>
                    <td>Description:</td>
                    <td><input name="description"></td>
		</tr>
                <tr>
                    <td>PurchasePrice:</td>
                    <td><input name="purchase_price"></td>
		</tr>
                <tr>
                    <td>DateBought:</td>
                    <td><input name="date_bought"></td>
                </tr>
		<tr>
                    <td>conditions :</td>
                    <td><input name="conditions"></td>
		</tr>
		
            </table> <br>
            <input type="hidden" name="UpdateSet" value="true">
            <input type="submit" value="UpdateEquipmentDetails">
        </form>
        </main>
        <form action='?page=Equipment' method="POST">
            <br>
            <strong> Add Equipment Details: </strong><br>
            <i>Please enter the below details: </i>
            <table style="border:0; text-align: left">
            <tr>
                    <td>Equipment id:</td>
                    <td><input name="equipment_id"></td>
		</tr>
                <tr>
                    <td>Description:</td>
                    <td><input name="description"></td>
		</tr>
                <tr>
                    <td>Purchase Price:</td>
                    <td><input name="purchase_price"></td>
		</tr>
                <tr>
                    <td>Date Bought:</td>
                    <td><input name="date_bought"></td>
                </tr>
		<tr>
                    <td>Conditions :</td>
                    <td><input name="conditions"></td>
		</tr>
		<tr>
                				
            </table> <br>
            <input type="hidden" name="AddRecord" value="true">
            <input type="submit" value="AddEquipmentDetails"><br><br>
        </form>
    </body>
    <?php
        
        if (isset($_POST['AddRecord'])) {
            addRecord();
        }
        else if (isset($_POST['UpdateSet']) or isset($_POST['UpdateEquipmentDetails'])) {
            updateRecord();
        } 
        
        function addRecord() {
            global $conn;
            if ($_POST['equipment_id']=="" ) {
                echo "You must enter the equipment ID and sponsor id to add accounts details";
                return false;
            }
            else {
                $equipment_id = "'".$_POST['equipment_id']."'";
                
            }
            
            if (($_POST['description']) != "") {
                $description = "'".$_POST['description']."'";
            } else {
                $description = "null";
            }
            
            if (($_POST['date_bought']) != "") {
                $date_bought = "'".$_POST['date_bought']."'";
            } else {
                $date_bought = "null";
            }
            
            if (($_POST['purchase_price']) != "") {
                $purchase_price = "'".$_POST['purchase_price']."'";
            } else {
                $purchase_price = "null";
            }
            
            if (($_POST['conditions']) != "") {
                $conditions = "'".$_POST['conditions']."'";
            } else {
                $conditions = "null";
            }
            
            
            
            
            //insert data
            $equipmentdata = "INSERT INTO equipment (equipment_id, description, purchase_price, date_bought, conditions)
            VALUES (".$equipment_id.", ".$description.", ".$purchase_price.", ".$date_bought.", ".$conditions.")";
            $result = $conn->query($equipmentdata);
            
            //report data to user
            $addedTrial = "SELECT equipment_id as a, description as a1, purchase_price as a2, date_bought as a3, conditions as a4 from equipment WHERE equipment_id=".$equipment_id."";
            $result = $conn->query($addedTrial);
            echo '<h3>New Values</h3><table>';
   			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Equipment ID</th><th>Description</th><th>Purchase price</th><th>Date Bought</th><th>Conditions</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		 
         
     }
	 mysqli_free_result($result);
             echo '</table>';
        }     
        function updateRecord() {
            global $conn;
            if ($_POST['equipment_id']=="" ) {
                echo "Must specify equipment_id  to update record!";
            }
            else {
                $equipment_id = "'".$_POST['equipment_id']."'";
                
            }
            
            if (($_POST['description']) != "") {
                $description = "'".$_POST['description']."'";
            } else {
                $description = "null";
            }
            
            if (($_POST['purchase_price']) != "") {
                $purchase_price = "'".$_POST['purchase_price']."'";
            } else {
                $purchase_price = "null";
            }
            
            if (($_POST['date_bought']) != "") {
                $date_bought = "'".$_POST['date_bought']."'";
            } else {
                $date_bought = "null";
            }
            
            if (($_POST['conditions']) != "") {
                $conditions = "'".$_POST['conditions']."'";
            } else {
                $conditions = "null";
            }
            
            
					
            $priorTrial = "SELECT equipment_id as a, description as a1, purchase_price as a2, date_bought as a3, conditions as a4 from equipment WHERE equipment_id=".$equipment_id."";
            $result = $conn->query($priorTrial);
            echo '<h3>Old Values</h3><table>';
			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Equipment Id</th><th>Description</th><th>Purchase Price</th><th>Date Bought</th><th>Conditions</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a']) . "</td>";
         echo "<td>" . htmlentities($row['a1']) . "</td>";
         echo "<td>" . htmlentities($row['a2']) . "</td>";
		 echo "<td>" . htmlentities($row['a3']) . "</td>";
         echo "<td>" . htmlentities($row['a4']) . "</td>";
		
     }
	              echo '</table>';
			 
            $updateEquipment = "UPDATE equipment SET equipment_id = COALESCE(".$equipment_id.", equipment_id), description = COALESCE(".$description.", description), date_bought = COALESCE(".$date_bought.",  date_bought),
            purchase_price = COALESCE(".$purchase_price.", purchase_price), conditions = COALESCE(".$conditions.", conditions) WHERE equipment_id=".$equipment_id."";
            $result = $conn->query($updateEquipment);
            
            //report data to user
            $updatedTrial = "SELECT equipment_id as a6, description as a7, purchase_price as a8, date_bought as a9, conditions as a10 from equipment WHERE equipment_id=".$equipment_id."";
            $result = $conn->query($updatedTrial);
            echo '<h3>New Values</h3><table>';
			echo '</table><table border="black">';
				echo '<colgroup><col span="1" style="width: 15%"><col span="1" style="width: 15%">';
				echo '<th>Equipment Id</th><th>Description</th><th>Purchase Price</th><th>Date Bought</th><th>Conditions</th>';
            while($row = mysqli_fetch_array($result)) {
         echo "<tr><td>" . htmlentities($row['a6']) . "</td>";
         echo "<td>" . htmlentities($row['a7']) . "</td>";
         echo "<td>" . htmlentities($row['a8']) . "</td>";
		 echo "<td>" . htmlentities($row['a9']) . "</td>";
         echo "<td>" . htmlentities($row['a10']) . "</td>";
		
		 
     }
             echo '</table>';
			 mysqli_free_result($result);
        }
        
    ?>
</html>
