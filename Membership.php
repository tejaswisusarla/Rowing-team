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
        
         <form name = "myform" method ="POST" action = " ">
             <br><br><Strong><big> PADDLER MEMBERSHIP DATA </big></strong><br>
             <select name="formSelect" id = "formSelect" class="formSelect">
                <option value ="3">Select..</option>  
                <option value= "1">Display all active unpaid members</option>
                <option value= "2">Display Paddlers who paid lifetime Membership fee</option>
            </select>
             <button name="submit" class="submit">Display</button>
    <p>
        <?php

$db_select = mysqli_select_db($conn, "organized_chaos");
if (!$db_select) 
    {
        die ('Could not select ' . mysql_error()); 
    }
/*Echo "database selected";*/
/*switch(filter_input(INPUT_GET,'formSelect'))*/
#$form = (filter_input(INPUT_POST, 'formSelect', FILTER_SANITIZE_STRING));
$val=filter_input(INPUT_POST,'formSelect');
switch($val)
{
    case "1":   

/* Business Function 11a: Report on active unpaid members */

echo "<i><b>Active unpaid members</b></i>";
$sql1 = "SELECT Paddler_Info.Name, Last_Attended
FROM Paddler_Info
WHERE (DATEDIFF(NOW(),Last_Attended)>60) AND Paddler_Info.Member_ID NOT IN (SELECT Paddler_Info.Member_ID
	FROM Paddler_Info, Account
    WHERE Account.Member_ID=Paddler_Info.Member_ID AND Category='Membershipfee')";
$result1 = $conn->query($sql1);
if ($result1 ->num_rows > 0) 
    {
        // output data of each row
      echo "<table name = one style='border: solid 3px black;'>";
        echo "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Name</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Last_Attended"."</th>"
               ;
        while($row = $result1->fetch_assoc()) 
                 {
                  
                
            echo "<tr style=\"border:1px solid gray\" bgcolor=\"gray\"><td>".$row["Name"]."</td><td>".$row["Last_Attended"]."</td></tr>";
              
            
                 }
   
    }
    echo "</table>";
    echo "<br></br>";   
    break;
    
    case '2':
    
    /* Business Function 11b: Report Lifetime Membership Fees paid by a given member */
        echo "<i><b>Paddlers who paid Lifetime Membership Fees</i></b>";
$sql2 = "SELECT Paddler_Info.Name, SUM(account.amount) AS Amount
FROM Paddler_Info, account
WHERE Category='Membershipfee' AND Paddler_Info.Member_ID=Account.Member_ID
;";
$result2 = $conn->query($sql2);
#echo "/*Business Function 11b: Report Lifetime Membership Fees paid by a given member */";
if ($result2->num_rows > 0) 
    {
        // output data of each row
        echo "<table style='border: solid 3px black;'>";
        echo "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">Name</th>"
        . "<th style=\"border:1px solid gray\" bgcolor=\"solid gray\">LifeTime Membership Fee</th>";
        while($row = $result2->fetch_assoc()) 
                 {
                     echo "<tr style=\"border:1px solid gray\" bgcolor=\"gray\"><td>".$row["Name"]."</td><td>".$row["Amount"]."</td></tr>";
                 }
    }
echo "</table>"; 
break;
}
?>
             </P>
         </form> 
  
    </body>
</html>
