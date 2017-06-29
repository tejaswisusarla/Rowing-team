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
    <body> <br><br><strong><big>INACTIVE SPONSORS REPORT</big></strong><br><br>
        
      
        <table border="black">
            <colgroup>
                <col span="1" style="width: 25%">
                <col span="1" style="width: 25%">
                <col span="1" style="width: 25%">
                <col span="1" style="width: 25%">
            </colgroup>
    <tr>
        <th>Sponsor Id</th>
        <th>Relationship Owner</th>
        <th>Organization Name</th>
        <th>Contact Date</th>
    </tr>
<?php

$result1 = mysqli_query($conn, "SELECT DISTINCT sponsors.sponsor_id as x, sponsors.oc_relationship_owner as x1, organization_name as x2, sponsors.last_contact_date as x3
FROM organized_chaos.sponsors, organized_chaos.account 
WHERE ((DATEDIFF(NOW(),sponsors.last_contact_date) > 60) and (DATEDIFF(NOW(),account.date) > 60))
");

//Business Function 9b: Report inactive members and their Organized Chaos relationship owner

     while($row = mysqli_fetch_array($result1)) {
         echo "<tr><td>" . htmlentities($row['x']) . "</td>";
         echo "<td>" . htmlentities($row['x1']) . "</td>";
         echo "<td>" . htmlentities($row['x2']) . "</td>";
         echo "<td>" . htmlentities($row['x3']) . "</td></tr>\n";
     }
mysqli_free_result($result1);
mysqli_close($conn);
?>  
</table>
    </body>
</html>

