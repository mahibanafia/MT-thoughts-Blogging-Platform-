<?php
include("../path.php");
include(ROOT_PATH . "/app/controllers/posts.php");
userOnly();
$userId = $_SESSION['id'];
$posts = getPostsByUserId($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/font/bootstrap-icons.css">

	<!-- Custom Styling -->
	<link rel="stylesheet" href="../assets/css/style.css">
	<!-- Profile Styling -->
	<link rel="stylesheet" href="../assets/css/profile.css">

	<title>Profile- My Posts</title>

</head>

<body>

	<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
	<div class="profile-wrapper">
		<!--Left Sidebar-->
		<?php include(ROOT_PATH . "/app/includes/profileSidebar.php"); ?>
		<!--//Left Sidebar-->
		<div class="profile-content">
			<h3 class="page-title">Manage Your Posts</h3>
			<?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
			<table>
				<thead>
					<th>SN</th>
					<th>Title</th>
					<th colspan="3">Action</th>
				</thead>
				<tbody>
					<?php foreach ($posts as $key => $post): ?>
						<tr>
							<td>
								<?php echo $key + 1; ?>
							</td>
							<td>
								<?php echo $post['title']; ?>
							</td>
							<td><a href="edit_posts.php?id=<?php echo $post['id']; ?>" class="edit">edit</a></td>
							<td><a href="edit_posts.php?delete_id=<?php echo $post['id']; ?>" class="delete">delete</a></td>
							<td>
								<?php if ($post['published']): ?>
									<a href="edit_posts.php?published=0&p_id=<?php echo $post['id']; ?>"
										class="unpublish">unpublish</a>
								<?php else: ?>
									<a href="edit_posts.php?published=1&p_id=<?php echo $post['id']; ?>" class="publish">publish</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>


	</div>

	<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>