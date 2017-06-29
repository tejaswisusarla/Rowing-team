<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="style.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=BenchNine:400,700' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper">
	
	<header class="header">
            <a href="index.php" id="headerImg"><img src="http://i.imgur.com/BRww77B.png?2" alt="OC Logo" height=100px></img></a>
	</header><!-- .header-->
	
	<div class="middle">
            <div id="OuterContainer">
		<main class="content">
                    <?php
                    include 'connection.php';
                    if(isset($_GET['page'])) {
                    $page=$_GET['page'];
                    }
                    else{
                    $page='';
                    }
                    include 'case.php';
                     ?>
                           
                </main><!-- .content -->
            </div><!-- .container-->
		

		<aside class="left-sidebar">
			<h3>Captains</h3>
			<ol class="center">
                        <li><strong><a href='?page=Paddlers'>Paddler Info</a></strong></li>
			<li><a href='?page=Attendance'>Review Attendance</a></li>
			<li><a href='?page=NewMembers'>New Members</a></li>
			<li><a href='?page=InactiveMembers'>Inactive Members</a></li>
			<li><a href='?page=Teams'>Teams</a></li>
			<li><a href='?page=RSVP'>RSVP Paddlers for a Race</a></li>
			<li><a href='?page=Races'>Races</a></li>
			</ol>
			<h3>Administrative</h3>
			<ol class="center">
			<li><a href='?page=Equipment'>Equipment</a></li>
			<li><a href='?page=Budget'>Budget</a></li>
			<li><a href='?page=Membership'>Paddler Membership</a></li>
			<li><a href='?page=Accounts'>Accounts</a></li>
			</ol>
			<h3>Sponsorship</h3>
			<ol class="center">
			<li><a href='?page=sponsor'>Sponsor Info</a></li>
			<li><a href='?page=Inactive_sponsors'>Inactive Sponsors</a></li>
			</ol>
			<h3>Coaches</h3>
			<ol class="center">
			<li><a href='?page=TimeTrials'>Time Trials</a></li>
			<li><a href='?page=PaddlerRanking'>Paddler Ranking</a></li>
		</aside><!-- .left-sidebar -->
	</div><!-- .middle-->
</div><!-- .wrapper -->
</body>
</html>
