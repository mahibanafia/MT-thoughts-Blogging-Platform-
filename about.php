<?php include("path.php") ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/font/bootstrap-icons.css">

	<!-- Custom Styling -->
	<link rel="stylesheet" href="assets/css/style.css">
	<style>
		.post-title {
			margin-top: 50px;
			color: blue;
			text-align: center;
			margin-bottom: 30px;
		}
		h3{
			text-align: center;
			color: green; 
			margin-bottom: 30px;
		}
		.main-content-wrapper{
			padding-left: 30px;
			padding-right: 30px;
			padding-bottom: 50px;
		}
		h4{
			color:#C96C00;
			margin-bottom: 30px;
		}
	</style>

	<title>About</title>

</head>

<body>

	<?php include(ROOT_PATH . "/app/includes/header.php"); ?>

	<div class="main-content-wrapper">
		<div class="main-content single">
			<h1 class="post-title">Welcome To Our Blogging Haven!</h1>
			<div class="post-content">
				<p>
				<h4>
					Hey there! Thanks for stumbling upon this little corner!
					We're Mahiba Nafia and Saif Saruwar Turjoy,
					the minds behind this web adventure which was born out of a mix of meeting deadlines, caffeine crashes, and
					a whole lot of sleep deprivation (don't worry, we're fine, thanks for asking).

				</h4>
				</p>
				<p>
				<h3>
					What Do We Offer, You Ask?
				</h3>
				<h4>
					Blogs that entertain, enlighten, and sometimes make you snort your morning coffee (we're sorry/not
					sorry about that); a cozy space for words to dance in poetic harmony; and a gallery of thoughts that
					dared to escape our minds and pirouette on the screen.
				</h4>
				</p>
				<p>
				<h3>
					Our Epic Journey... Kind of
				</h3>
				<h4>
					Our grand masterpiece was born during the tumultuous days of our 5th semester at Aust Cse Dept.
					Armed with a keyboard, copious amounts of coffee, and a well-worn Ctrl+Z shortcut, we embarked on
					this quest to create a digital utopia. We laughed, we coded, we tamed wild lines of CSS, and
					sometimes we just gave in and let the divs do their thing.

					We're not gonna lie - deadlines played their little symphony in the background, and there might be a
					few features we couldn't squeeze in (yet!). But hey, life's a journey, and sometimes the coolest
					detours happen when you're chasing after a semicolon.</h4>
				</p>
				<p>
				<h3>
					So, Take a Stroll and Stay Awhile!
				</h3>
				<h4>
					We hope you'll find a virtual nook that resonates with your curious soul. Sit back, relax, and let
					your
					cursor meander through our musings. Feel free to drop us a line, share a laugh, or just marvel at
					our
					slightly chaotic creation.

					Cheers,
					Mahiba Nafia and Saif Saruwar Turjoy

				</h4>
				</p>

			</div>
		</div>
	</div>
	<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>