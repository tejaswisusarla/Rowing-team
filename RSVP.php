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
    <body>
        <br><br> <strong><big>MANAGE RACE RSVP STATUS</big></strong><br>
        <br>
                <div class = "rightColumn" name = "rightColumn">
                    
                    <form name = "myform1" method ="POST" action = " "><br><br>
                    <strong> Please enter a RaceID to see RSVP status of paddlers: </strong><br>
                    <table style="border:0; text-align: left">
                	<tr>
                            <td><b>Race ID:</b></td>
                                <td><input type="text" name="Race_ID" class="formSelect"></td>
			</tr>   
                    </table><br>
                    <input type ="Submit" name = "Submit" value = "RSVP Display" class="submit"/><br>
        </div>
        <div name ="leftColumn">
                <strong> For paddlers who have not yet RSVP'ed,</strong><br>
                <i><b>Use this form to record your response:</b></i><br><br>
                <form method="post" id="addRace" action=" " >
		<table style="border:0; text-align: left">
                	<tr>
                            <td><b>Race ID:</b></td>
                                <td><input type="text" name="RaceID" class="formSelect"></td>
			</tr>
			<tr>
                            <td><b>Member ID:</b></td>
                            <td><input type="text" name="Member_ID" class="formSelect"></td>
			</tr>
                </table><br>
                        <table style="border:0">
                            <colgroup>
                                <col span='1' style='width: 33%'>
                                <col span='1' style='width: 33%'>
                                <col span='1' style='width: 33%'>
                            </colgroup>
			<tr>
                            <td><b><input type="radio" name="RSVP" value="Yes">RSVP_yes<br><b></td>
                        <td> <b><input type="radio" name="RSVP" value="No">RSVP_No<br></b></td>
                        <td> <b><input type="radio" name="RSVP" value="Maybe">RSVP_Maybe</b></td>
                        </tr>
                        </table>
                
       		<br>
                <input type ="Submit" name= "Submit" value = "RSVP" class="submit"/>
                </form>
        </div>

<p> 
 
  <?php
        

  

    if(isset($_POST['RaceID'])&&isset($_POST['Member_ID'])&&isset($_POST['RSVP']))
        {
            $a = $_POST['RaceID'];
            $b = $_POST['Member_ID'];
            $c = $_POST['RSVP'];

//echo "INSERT INTO Participates (Race_ID,Member_ID, RSVP_Status) VALUES('$a', '$b', '$c')";
    
    $result = "INSERT INTO Participates (Race_ID,Member_ID, RSVP_Status) VALUES('$a', '$b', '$c')";
#echo $result2 = mysql_query("select * from Participates");
    if ($conn->query($result) === TRUE) 
        {
    echo "<i><b>RSVPed successfully. Thank You.</b></i>";
        } 
        else 
        {
    echo "Error: " . $result . "<br>" . $conn->error;
        }

        }
   
/*Echo "database selected";*/
#$val = filter_input(INPUT_POST,'displaypaddlers');
#switch($val)
#{
    
#case "1":
    if(isset($_POST['Race_ID'])&&isset($_POST['Submit']))
        {
            $d = $_POST['Race_ID'];
            $sql = "SELECT Paddler_Info.Name, Participates.RSVP_Status, Participates.Race_ID 
                    FROM Paddler_Info, Participates
                    WHERE Participates.Member_ID = Paddler_Info.Member_ID
                    AND Race_ID = '$d'
                    ORDER BY RSVP_Status;";
/* Business Function 5b: Retrieve reports of paddlers RSVP’ed yes, no, interested, and response to a given race.*/
    
    echo "<b><i>Paddlers RSVP’ed for a given race $d.</b></i>";
    $result1 = $conn->query($sql);
    if ($result1->num_rows > 0) 
    {
        // output data of each row
        echo "<table style='border: solid 3px black;'>";
        echo "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Name</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">RSVP_Status"."</th>"
                . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Race_ID</th>";
        while($row = $result1->fetch_assoc()) 
                 {
                       
                       echo "<tr style=\"border:1px solid gray\" bgcolor=\"gray\"><td>".$row["Name"]."</td><td>".$row["RSVP_Status"]."</td><td>".$row["Race_ID"]."</td></tr>";
                         
                 }
     }
    
    echo "</table>"; 

        }
     

?>
 </p>
                </form>
    </body>
</html>
