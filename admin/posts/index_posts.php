<?php
include("../../path.php");
?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../bootstrap/css/font/bootstrap-icons.css">

	<!-- Custom Styling -->
	<link rel="stylesheet" href="../../assets/css/style.css">
	<!-- Admin Styling -->
	<link rel="stylesheet" href="../../assets/css/admin.css">

	<title>Admin Section - Manage Posts</title>

</head>

<body>

	<?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

	<!--Admin Page Wrapper-->

	<div class="admin-wrapper">
		<!--Left Sidebar-->
		<?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
		<!--//Left Sidebar-->
		<!--Admin Content-->
		<div class="admin-content">
			<div class="button-group">
				<a href="create_posts.php" class="btn btn-big">Add Post</a>
				<a href="index_posts.php" class="btn btn-big">Manage Posts</a>
			</div>
			<div class="content">
				<h3 class="page-title">Manage Posts</h3>
				<?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
				<table>
					<thead>
						<th>SN</th>
						<th>Title</th>
						<th>Author</th>
						<th>Role</th>
						<th colspan="3">Action</th>
					</thead>
					<tbody>
						<?php foreach ($posts as $key => $post): ?>
							<tr>
								<td>
									<?php echo $key + 1; ?>
								</td>
								<td>
									<?php echo $post['title'] ?>
								</td>
								<td>
									<?php
									$user = selectOne('users', ['id' => $post['user_id']]);
									echo $user['username'];
									?>
								</td>
								<td>
									<?php
									if ($user['admin'] == 1) {
										echo 'Admin';
									} else {
										echo 'User';
									}
									?>
								</td>
								<td><a href="edit.php?id=<?php echo $post['id']; ?>" class="edit">edit</a></td>
								<td><a href="edit.php?delete_id=<?php echo $post['id']; ?>" class="delete">delete</a></td>
								<?php if ($post['published']): ?>
									<td><a href="edit.php?published=0&p_id=<?php echo $post['id'] ?>"
											class="unpublish">unpublish</a></td>
								<?php else: ?>
									<td><a href="edit.php?published=1&p_id=<?php echo $post['id'] ?>"
											class="publish">publish</a>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>


					</tbody>
				</table>
			</div>

		</div>
		<!--//Admin Content-->
	</div>
	<!--//Admin Page Wrapper-->

	<script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>