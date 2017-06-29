<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <main class="rightColumn">
            <form action='?page=TimeTrials' method="POST">
            <br><strong> Update Time Trial Results: </strong><br>
            <i>Must specify name and test name to update record</i>
            <table style="border:0; text-align: left">
                <tr>
                    <td>Member ID:</td>
                    <td><input name="MemberID"></td>
		</tr>
                <tr>
                    <td>Test Name:</td>
                    <td><input name="TestName"></td>
		</tr>
                <tr>
                    <td>Weight:</td>
                    <td><input name="Weight"></td>
                </tr>
		<tr>
                    <td>Low Speed:</td>
                    <td><input name="LSpeed"></td>
		</tr>
		<tr>
                    <td>Age:</td>
                    <td><input name="Age"></td>
		</tr>
		<tr>
                    <td>Date of the Time Trial:</td>
                    <td><input name="Date"></td>
		</tr>
		<tr>
                    <td>Test Time:</td>
                    <td><input name="Time"></td>
		</tr>
                <tr>
                    <td>Test Length:</td>
                    <td><input name="Length"></td>
		</tr>
		<tr>
                    <td>Mid Speed:</td>
                    <td><input name="MSpeed"></td>
                </tr>
            </table> <br>
            <input type="hidden" name="UpdateSet" value="true">
            <input type="submit" value="Update Time Trial Result">
        </form>
        </main>
        <form action='?page=TimeTrials' method="POST">
            <br>
            <strong> Add Time Trial Results: </strong><br>
            <i>Some explanatory text</i>
            <table style="border:0; text-align: left">
                <tr>
                    <td>Member ID:</td>
                    <td><input name="MemberID"></td>
		</tr>
                <tr>
                    <td>Test Name:</td>
                    <td><input name="TestName"></td>
		</tr>
                <tr>
                    <td>Weight:</td>
                    <td><input name="Weight"></td>
                </tr>
		<tr>
                    <td>Low Speed:</td>
                    <td><input name="LSpeed"></td>
		</tr>
		<tr>
                    <td>Age:</td>
                    <td><input name="Age"></td>
		</tr>
		<tr>
                    <td>Date (YYYY-MM-DD):</td>
                    <td><input name="Date"></td>
		</tr>
		<tr>
                    <td>Test Time (HH:MM:SS):</td>
                    <td><input name="Time"></td>
		</tr>
                <tr>
                    <td>Test Length:</td>
                    <td><input name="Length"></td>
		</tr>
		<tr>
                    <td>Mid Speed:</td>
                    <td><input name="MSpeed"></td>
                </tr>
            </table> <br>
            <input type="hidden" name="AddRecord" value="true">
            <input type="submit" value="Add Time Trial Result"><br><br>
        </form>
        <form action='?page=TimeTrials' method="POST">
            
            <strong> Pull Records for Single Member: </strong><br>
            <i>Specify a Member ID to find all Time Trial Records for that member.<br>
                If no Member ID is specified, all time trial results will be posted.<br></i><br>
            <strong>Member ID:  </strong>
            <input name="MemberID"><br><br>
            <input type="hidden" name="PullRecord" value="true">
            <input type="submit" value="Pull Time Trial Results"><br><br>
            
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
        function addRecord() {
            echo ("A");
            global $conn;
            if ($_POST['MemberID']=="" || $_POST['TestName']=="") {
                echo "You must enter the member ID and test name to add a time trial record.";
                return false;
            }
            else {
                $MemberID = "'".$_POST['MemberID']."'";
                $TestName = "'".$_POST['TestName']."'";
            }
            
            if (($_POST['Weight']) != "") {
                $Weight = $_POST['Weight'];
            } else {
                $Weight = "null";
            }
            
            if (($_POST['LSpeed']) != "") {
                $LSpeed = $_POST['LSpeed'];
            } else {
                $LSpeed = "null";
            }
            
            if (($_POST['Age']) != "") {
                $Age = $_POST['Age'];
            } else {
                $Age = "null";
            }
            
            if (($_POST['Date']) != "") {
                $Date = "'".$_POST['Date']."'";
            } else {
                $Date = "null";
            }
            
            if (($_POST['Time']) != "") {
                $Time = "'".$_POST['Time']."'";
            } else {
                $Time = "null";
            }
            
            if (($_POST['Length']) != "") {
                $Length = $_POST['Length'];
            } else {
                $Length = "null";
            }
            
            if (($_POST['MSpeed']) != "") {
                $MSpeed = $_POST['MSpeed'];
            } else {
                $MSpeed = "null";
            }
            //insert data
            $addTimeTrial = "INSERT INTO Time_Trial (Member_ID, TestName, Weight, Low_speed, Age, Time_Trial_Date, Test_time, Test_length, Mid_speed)
            VALUES (".$MemberID.", ".$TestName.", ".$Weight.", ".$LSpeed.", ".$Age.", ".$Date.", ".$Time.", ".$Length.", ".$MSpeed.")";
            $result = $conn->query($addTimeTrial);
            
            //report data to user
            $addedTrial = "SELECT * FROM Time_Trial WHERE Member_ID=".$MemberID." AND TestName=".$TestName;
            $result = $conn->query($addedTrial);
            echo '<h3>New Values</h3><table>';
            foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                foreach($row as $key => $value) {
                    echo '<th><tr><td><strong>' . $key . '</strong></td></tr></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                }
             }
             echo '</table>';
        }     
        function updateRecord() {
            echo ("B");
            global $conn;
            if ($_POST['MemberID']=="" || $_POST['TestName']=="") {
                echo "Must specify Member ID and Test Name to update record!";
            }
            else {
                $MemberID = "'".$_POST['MemberID']."'";
                $TestName = "'".$_POST['TestName']."'";
            }
            
            if (($_POST['Weight']) != "") {
                $Weight = $_POST['Weight'];
            } else {
                $Weight = "null";
            }
            
            if (($_POST['LSpeed']) != "") {
                $LSpeed = $_POST['LSpeed'];
            } else {
                $LSpeed = "null";
            }
            
            if (($_POST['Age']) != "") {
                $Age = $_POST['Age'];
            } else {
                $Age = "null";
            }
            
            if (($_POST['Date']) != "") {
                $Date = $_POST['Date'];
            } else {
                $Date = "null";
            }
            
            if (($_POST['Time']) != "") {
                $Time = $_POST['Time'];
            } else {
                $Time = "null";
            }
            
            if (($_POST['Length']) != "") {
                $Length = $_POST['Length'];
            } else {
                $Length = "null";
            }
            
            if (($_POST['MSpeed']) != "") {
                $MSpeed = $_POST['MSpeed'];
            } else {
                $MSpeed = "null";
            }
            
            $priorTrial = "SELECT * FROM Time_Trial WHERE Member_ID=".$MemberID." AND TestName=".$TestName;
            $result = $conn->query($priorTrial);
            echo '<h3>Old Values</h3><table>';
            foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                foreach($row as $key => $value) {
                    echo '<th><tr><td><strong>' . $key . '</strong></td></tr></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                }
             }
             echo '</table>';
            
            $updateTimeTrial = "UPDATE Time_Trial SET Weight = COALESCE(".$Weight.", weight), Low_speed = COALESCE(".$LSpeed.", Low_Speed), Age = COALESCE(".$Age.",  Age),
            Time_Trial_Date = COALESCE(".$Date.", Time_Trial_Date), Test_time = COALESCE(".$Time.", Test_Time), Test_length = COALESCE(".$Length.", Test_length), Mid_speed =    
            COALESCE(".$MSpeed.", Mid_Speed) WHERE Member_ID=".$MemberID." AND TestName=".$TestName;
            $result = $conn->query($updateTimeTrial);
            
            //report data to user
            $updatedTrial = "SELECT * FROM Time_Trial WHERE Member_ID=".$MemberID." AND TestName=".$TestName;
            $result = $conn->query($updatedTrial);
            echo '<h3>New Values</h3><table>';
            foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                foreach($row as $key => $value) {
                    echo '<th><tr><td><strong>' . $key . '</strong></td></tr></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                }
             }
             echo '</table>';
        }
        function pullRecords() {
            echo ("C");
            global $conn;
            if (($_POST['MemberID']) === "") {
                $timeTrials = "SELECT * FROM Time_Trial ORDER BY Member_ID";
                $result = $conn->query($timeTrials);
                
                echo '<h3>All Time Trial Values</h3><table>';
                foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                
                foreach($row as $key => $value) {
                    echo '<th><strong>' . $key . '</strong></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                 
                }
          
                }
                echo '</table>';
            } else {
                $MemberID = "'".$_POST['MemberID']."'";
                $memberTrials = "SELECT * FROM Time_Trial WHERE Member_ID=".$MemberID." GROUP BY TestName";
                $result = $conn->query($memberTrials);
                
                echo '<h3>Time Trial Results </h3><table>';
                foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
                foreach($row as $key => $value) {
                    echo '<th><tr><td><strong>' . $key . '</strong></td></tr></th>';
                    echo '<tr><td>' . $value . '</td></tr>';
                }
                }
                echo '</table>';
            }
                
        }
    ?>
</html>
