<?php
//contect us form
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if (isset($_POST['send'])) {
	$email = htmlentities($_POST['email']);
	$subject = htmlentities($_POST['subject']);
	$mail = new PHPMailer(true);

	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->Username = 'project.aust.96@gmail.com';
	$mail->Password = 'sdbafdibwwrgpgjm';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;

	$mail->isHTML(true);
	$mail->setFrom($email);
	$mail->addAddress('project.aust.96@gmail.com');

	$mail->Subject = ("$email ($subject)");
	$mail->Body = $_POST['message'];
	try {
		$mail->send();
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

}


include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$topLikedPosts = getTopLikedPosts(4);
$recentPosts = getRecentPosts();
if (isset($_GET['t_id'])) {
	$posts = getPostsByTopic($_GET['t_id']);
} else if (isset($_POST['search-term'])) {
	$posts = searchPosts($_POST['search-term']);
} else {
	$posts = getPublishedPosts();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/font/bootstrap-icons.css">

	<!-- Custom Styling -->
	<link rel="stylesheet" href="assets/css/style.css">

	<title>MT THOUGHTS</title>

</head>

<body>

	<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
	<?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

	<!--Page Wrapper-->

	<div class="page-wrapper">
		<!--Carousel-->
		<?php if (!isset($_POST['search-term']) && !isset($_GET['t_id'])): ?>
			<div class="post-slider">
				<h1 class="slider-title">Popular Posts</h1>
				<div class="post-wrapper">
					<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner">
							<?php foreach ($topLikedPosts as $key => $post): ?>
								<div class="carousel-item <?php echo ($key === 0) ? 'active' : ''; ?>">
									<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>"
										class="slider-image d-block w-100" alt="...">
									<div class="post-info">
										<h4><a href="single.php?id=<?php echo $post['id'] ?>">
												<?php echo $post['title'] ?>
											</a></h4>
										<span class="text-muted">
											<i class="bi bi-person"></i>
											<?php echo $post['username'] ?>
										</span>
										&nbsp;
										<span class="text-muted">
											<i class="bi bi-calendar">
												<?php echo date('F j, Y', strtotime($post['created_at'])) ?>
											</i>
										</span>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
							data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
							data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>

				</div>
			</div>
		<?php endif; ?>
		<!--//Carousel-->

		<!--Content--->
		<div class="content clearfix">
			<!--Main Content-->
			<div class="main-content">
				<?php if (isset($_POST['search-term'])): ?>
					<h2 class="recent-posts-title"> Searched Results for '
						<?php echo $_POST['search-term'] ?>'
					</h2>
					<?php foreach ($posts as $post): ?>
						<div class="post clearfix">
							<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="..."
								class="post-image">
							<div class="post-preview">
								<h4><a href="single.php?id=<?php echo $post['id'] ?>">
										<?php echo $post['title'] ?>
									</a></h4>
								<span class="text-muted">
									<i class="bi bi-person"></i>
									<?php echo $post['username'] ?>
								</span>
								&nbsp;
								<span class="text-muted">
									<i class="bi bi-calendar"></i>
									<?php echo date('F j, Y', strtotime($post['created_at'])) ?>
								</span>
								<p class="preview-text">
									<?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
								</p>
								<a href="single.php?id=<?php echo $post['id'] ?>" class="btn read-more">Read More</a>
							</div>
						</div>
					<?php endforeach; ?>

				<?php elseif ((isset($_GET['t_id']))): ?>
					<h2 class="recent-posts-title"> Results for Topic - '
						<?php echo $_GET['name'] ?>'
					</h2>
					<?php foreach ($posts as $post): ?>
						<div class="post clearfix">
							<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="..."
								class="post-image">
							<div class="post-preview">
								<h4><a href="single.php?id=<?php echo $post['id'] ?>">
										<?php echo $post['title'] ?>
									</a></h4>
								<span class="text-muted">
									<i class="bi bi-person"></i>
									<?php echo $post['username'] ?>
								</span>
								&nbsp;
								<span class="text-muted">
									<i class="bi bi-calendar"></i>
									<?php echo date('F j, Y', strtotime($post['created_at'])) ?>
								</span>
								<p class="preview-text">
									<?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
								</p>
								<a href="single.php?id=<?php echo $post['id'] ?>" class="btn read-more">Read More</a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<h2 class="recent-posts-title">Recent Posts</h2>
					<?php foreach ($recentPosts as $post): ?>
						<div class="post clearfix">
							<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="..."
								class="post-image">
							<div class="post-preview">
								<h4><a href="single.php?id=<?php echo $post['id'] ?>">
										<?php echo $post['title'] ?>
									</a></h4>
								<span class="text-muted">
									<i class="bi bi-person"></i>
									<?php echo $post['username'] ?>
								</span>
								&nbsp;
								<span class="text-muted">
									<i class="bi bi-calendar"></i>
									<?php echo date('F j, Y', strtotime($post['created_at'])) ?>
								</span>
								<p class="preview-text">
									<?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
								</p>
								<a href="single.php?id=<?php echo $post['id'] ?>" class="btn read-more">Read More</a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>







			</div>
			<!--//Main Content-->
			<div class="sidebar">
				<div class="section search">
					<h3 class="section-title">Search</h3>
					<form action="index.php" method="post">
						<input type="text" name="search-term" class="text-input" placeholder="Search...">
					</form>
				</div>

				<div class="section topics">
					<h3 class="section-title">Categories</h3>
					<ul>
						<?php foreach ($topics as $key => $topic): ?>
							<li><a
									href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>">
									<?php echo $topic['name']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<!--//Content--->
	</div>
	<!--//Page Wrapper-->



	<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
	<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>