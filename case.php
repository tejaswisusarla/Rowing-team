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
        <?php
        
        switch($page)
        {
            case "Races":
                include 'Races.php';
                break;
            case "sponsor":
                include 'sponsor.php';
                break;
            case "Inactive_sponsors":
                include 'inactive_sponsors.php';
                break;
            case "TimeTrials":
                include 'TimeTrials.php';
                break;
            case "Paddlers":
                include 'Paddlers.php';
                break;
            case "Attendance":
                include 'Attendance.php';
                break;
            case "NewMembers":
                include 'NewMembers.php';
                break;
            case "InactiveMembers":
                include 'Inactive_Members.php';
                break;
            case "Teams":
                include 'Teams.php';
                break;
            case "RSVP":
                include 'RSVP.php';
                break;
            case "Equipment":
                include 'Equipment.php';
                break;
            case "Budget":
                include 'Budget.php';
                break;
            case "Membership":
                include 'Membership.php';
                break;
            case "PaddlerRanking":
                include 'PaddlerRanking.php';
                break;
            case "Accounts":
                include 'Accounts.php';
                break;
            default :
                echo "<h2>Please select an option to the left to get started.</h2>";
                break;               
                
        }
        ?>
    </body>
</html>