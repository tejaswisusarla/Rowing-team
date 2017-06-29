<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
   <head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="style.css" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head> 
    <body>
        <body>

                            
                           <?php
        
      

if (isset($_POST['submit_button']))
{
    updateFields();
    if ($Member_ID == "" or 'paddler_radio' == "" )
    {
        select_member();
    }
    else
    {
        if(($_POST['paddler_radio'])=="insert") {
        insert_member();
        } 
        else if(($_POST['paddler_radio']) =="update") {
        update_member();
        } 
        else if(($_POST['paddler_radio']) =="attendance") {
        display_attendance();
        } 
    }
    display_table();
}


// $Member_ID = mysqli_real_escape_string($conn, htmlentities($_GET["F_MEMBER_ID"]));

function updateFields() {
	$Member_ID = mysqli_real_escape_string($conn, htmlentities($_GET["F_MEMBER_ID"]));
	$Name = mysqli_real_escape_string($conn, htmlentities($_GET["F_Name"]));
	$Email = mysqli_real_escape_string($conn, htmlentities($_GET["F_Email"]));
	$Phone_No = mysqli_real_escape_string($conn, htmlentities($_GET["F_Phone_No"]));
	$Season_Attendance = mysqli_real_escape_string($conn, htmlentities($_GET["F_Season_Attendance"]));
	$Total_Attendance = mysqli_real_escape_string($conn, htmlentities($_GET["F_Total_Attendance"]));
	$Primary_Side = mysqli_real_escape_string($conn, htmlentities($_GET["F_Primary_Side"]));
	$Off_Side_Flag = mysqli_real_escape_string($conn, htmlentities($_GET["F_Off_Side_Flag"]));
	$Stroke_Flag = mysqli_real_escape_string($conn, htmlentities($_GET["F_Stroke_Flag"]));
	$Steersperson_Flag = mysqli_real_escape_string($conn, htmlentities($_GET["F_Steersperson_Flag"]));
	$Coach_Flag = mysqli_real_escape_string($conn, htmlentities($_GET["F_Coach_Flag"]));
};

function select_member () {
    if ($Member_ID == "") {
        $sql = "SELECT *
        FROM paddler_info;";
    } else {
     $sql = "select * from paddler_info where member_id ='$Member_ID';";
    }
    $result = $conn->query($sql);
} ;

function insert_member () {
//Business Function 1a: Insert a new paddler

    $sql = "
    INSERT INTO Paddler_Info(
    Member_ID, Name, Email, Phone_No, Season_Attendance, Total_Attendance, Primary_Side, Off_Side_Flag, Stroke_Flag, Steersperson_Flag, Coach_Flag)
    VALUES ($Member_ID,$Name, $Email, $Phone_No,$Season_Attendance, $Total_Attendance, $Primary_Side, $Off_Side_Flag, $Stroke_Flag, $Steersperson_Flag, $Coach_Flag)
    ;";

} ;

function update_member () {
//Business Function 1b: Update a paddler |  Update information about a paddler, receive member_id and updated fields from input. The updated values are listed first and are null if they are not being changed

    $sql = "UPDATE Paddler_Info
    SET
    Name = COALESCE($Name,name),
    Email = COALESCE($Email,Email),
    Phone_No = COALESCE($Phone_No,Phone_No),
    Season_Attendance = COALESCE($Season_Attendance,Season_Attendance),
    Total_Attendance = COALESCE($Total_Attendance,Total_Attendance),
    Primary_Side = COALESCE($Primary_Side,Primary_Side),
    Off_Side_Flag = COALESCE($Off_Side_Flag,Off_Side_Flag),
    Stroke_Flag = COALESCE($Stroke_Flag,Stroke_Flag),
    Steersperson_Flag = COALESCE($Steersperson_Flag,Steersperson_Flag),
    Coach_Flag = COALESCE($Coach_Flag,Coach_Flag)
    WHERE member_id = $Member_ID 
    ;";

} ;

function display_attendance () {
//Business Function 2: Review seasonal and historical attendance for a paddler
//Member_ID is taken from front_end input

$sql = "SELECT
Member_ID,
Name,
Season_Attendance,
Total_Attendance,
season_attendance / max(highest_season_attendance) as season_attendance_pct
/* (season_attendance / max_att) as season_attendance_pct*/
FROM
(
SELECT
Member_ID,
Name,
Season_Attendance,
Total_Attendance,
NULL AS highest_season_attendance
FROM paddler_info
WHERE member_id = $Member_ID

UNION 

SELECT null,null,null,null,max(season_attendance) AS highest_season_attendance
FROM paddler_info
) subt_1
;";

};


function display_table () {
$result = $conn->query($sql);
if ($result->num_rows > 0) 
    
    {
       
         echo "<table style='border: solid 3px black;'>";
        // output data of each row echo "<table style='border: solid 3px black;'>";
        echo "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Member_ID</th>"
        ."<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Name</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Email"."</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Phone_No</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Season_Attendance</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Total_Attendance</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Primary_Side</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Off_Side_Flag</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Stroke_Flag</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Steersperson_Flag</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Coach_Flag</th>"                
        ;

       // echo "<tr border=\"1\"><th>Equipment_id</th><th>Description</th><th>Date_Bought</th><th>Purchase_price</th><th>conditions</th></tr>";
        while($row = $result->fetch_assoc()) 
                 {

            //echo "<tr class = 'row;'><td>".$row["Equipment_id"]."</td><td>".$row["Description"]."</td><td>".$row["Date_Bought"]."</td><td>".$row["Purchase_price"]."</td></tr>";
            echo "<tr style=\"border:1px solid gray\" bgcolor=\"gray\"><td>".$row["Member_ID"]."</td><td>".$row["Name"]."</td><td>".$row["Email"]."</td><td>".$row["Phone_No"]."</td><td>".$row["Season_Attendance"].$row["Total_Attendance"]."</td><td>".$row["Primary_Side"]."</td><td>".$row["Off_Side_Flag"]."</td><td>".$row["Stroke_Flag"]."</td><td>".$row["Steersperson_Flag"]."</td><td>".$row["Coach_Flag"]."</td></tr>";
             }
    }
};

echo "</table>"; 
?>
        
  <!-- .left-sidebar -->

        
  <div>
            <br>
            
            <h1 class="strongest"> Display Member Information: </h1>
            
            </br>        
            <h2 class="strongest"><i>If a Member ID isn't specified then all will be shown.</i> </h2>
            
<form name="F_MEMBER_ID" action="Paddlers.php" method="GET" class='active'>
<h3 class="strongest"> Enter Member ID  <input type="text" name="F_MEMBER_ID" value="" /> 

                        

<form name="F_Name" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Name  <input type="text" name="F_Name" value="" /> 
<form name="F_Email" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Email  <input type="text" name="F_Email" value="" /> 
<form name="F_Phone_No" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Phone Number  <input type="text" name="F_Phone_No" value="" /> 
<form name="F_Season_Attendance" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Season Attendance  <input type="text" name="F_Season_Attendance" value="" /> 
<form name="F_Total_Attendance" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Total Attendance  <input type="text" name="F_Total_Attendance" value="" />                     
<form name="F_Primary_Side" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Primary Side  <input type="text" name="F_Primary_Side" value="" /> 
<form name="F_Off_Side_Flag" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Can this member paddle on both sides?  <input type="text" name="F_Off_Side_Flag" value="" />    
<form name="F_Stroke_Flag" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Can this member paddle as the stroke?  <input type="text" name="F_Stroke_Flag" value="" />    
<form name="F_Steersperson_Flag" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Can this member steer?  <input type="text" name="F_Steersperson_Flag" value="" />    
<form name="F_Coach_Flag" action="Paddlers.php" method="GET" class='active'>
    <h3 class="strongest"> Can this member coach?  <input type="text" name="F_Coach_Flag" value="" />                       

<br>
        

        
<strong> Update or Insert Paddlers </strong><br>
        <input type="radio" name="radio_paddler" value="update">Update Paddler<br>
        <input type="radio" name="radio_paddler" value="insert" value ="insert"> Insert New Paddler<br><br>

<strong> Display Seasonal or Historical Attendance </strong><br>        
        <input type="radio" name="radio_paddler" value="attendance">Display Member Attendance<br><br>

<input type="submit" name = "submit_button" value="Enter" /> <br>
        </h3>
                </form>
        
        
	<!-- .middle-->
        
         
        
</div><!-- .wrapper -->
        
</body>
        
        
  
   
</html>