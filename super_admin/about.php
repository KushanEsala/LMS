<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>LMS</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<style type="text/css">
	#main_content {
		padding: 50px;
		background-color: whitesmoke;
	}

	#side_bar {
		background-color: whitesmoke;
		padding: 50px;
		width: 300px;
		height: 450px;
	}

	.social-icons3 li {
		display: inline;
		margin: 0 5px;
	}

	.social-icons3 a {
		color: #fff;
		font-size: 24px;
	}

	.social-icons3 li a.fab.fa-facebook.icon-border.facebook {
		background: #4D669C;
	}

	.social-icons3 li a.fab.fa-whatsapp.icon-border.whatsapp {
		background: #48f21d;
	}

	.social-icons3 li a.fab.fa-google-plus.icon-border.googleplus {
		background: #d34836;
	}

	.social-icons3 li a.fas.fa-map-marker-alt.icon-border.map-marker-alt {
		background: black;
	}
</style>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php" style=color:yellow;>Library Management System (LMS)</style></a>
			</div>
		</div>
	</nav>
	<br>
	<span>
		<marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee>
	</span><br><br>
	<div class="row">
		<div class="col-md-4" id="side_bar">
			<h5>Library Timing</h5>
			<ul>
				<li>Opening: 8:00 AM</li>
				<li>Closing: 5:00 PM</li>
				<li>(Sunday Off)</li>
			</ul>
			<h5>What We provide ?</h5>
			<ul>
				<li>Free Wi-fi</li>
				<li>News Papers</li>
				<li>Discussion Room</li>
				<li>Peacefull Environment</li>
			</ul>
			<ul class="social-icons3">
				<li><a href="https://www.facebook.com/" class="fab fa-facebook icon-border facebook"></a></li>
				<li><a href="https://web.whatsapp.com/" class="fab fa-whatsapp icon-border whatsapp"></a></li>
				<li><a href="https://plus.google.com/u/0/" class="fab fa-google-plus icon-border googleplus"></a></li>
				<li><a href="https://maps.app.goo.gl/9iLd8p8gGq3mbjNj7" class="fas fa-map-marker-alt icon-border map-marker-alt" style=color:yellow;>

					</a></li>
			</ul>
		</div>
		<div class="col-md-8" id="main_content">
			<center>
				<h3 style=color:blue;><u>About US</u>

				</h3>
			</center>
			<form action="" method="post">
				<p>Welcome to <strong> LibraLink Library</strong> where the pages come alive and knowledge knows no bounds. Nestled at the heart of Kandy LibraLink Library stands as a cornerstone of learning, discovery, and community connection.
					<br>Since our inception, we've been dedicated to cultivating a haven for readers, learners, and dreamers of all ages. Our shelves are adorned with a rich tapestry of literature, from classic masterpieces to contemporary treasures, catering to diverse interests and curiosities.
					<br>But LibraLink Library is more than just a repository of books. We're a dynamic center for exploration and growth, offering state-of-the-art resources, technology, and innovative programs that empower individuals to thrive in an ever-evolving world.
				</p>

				<center>
					<h3 style=color:blue;><u>Our Mission</u></style>
					</h3><br>
				</center>
				<form action="" method="post">
					<p>At <strong>LibraLink Library</strong>,our mission is to spark curiosity, ignite imaginations, and foster lifelong learning within our community. We are committed to:<br>
						<b>Access:</b> Providing equitable access to a wealth of information, resources, and opportunities for all members of our community.<br>
						<b>Education:</b> Supporting educational initiatives and lifelong learning endeavors through diverse collections, programs, and services.<br>
						<b>Innovation:</b> Embracing innovation and technology to enhance the library experience and meet the evolving needs of our patrons.<br>
						<b>Empowerment:</b> Empowering individuals to explore, create, and succeed by fostering a culture of curiosity and exploration.<br><br>
					</p>
				</form>
		</div>
	</div>
</body>

</html>