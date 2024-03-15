<?php
include("../../path.php");
?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
adminOnly(); ?>
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

	<title>Admin Section - Manage Users</title>

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
				<a href="create_users.php" class="btn btn-big">Add User</a>
				<a href="index_users.php" class="btn btn-big">Manage Users</a>
			</div>
			<div class="content">
				<h3 class="page-title">Manage Users</h3>
				<?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
				<table>
					<thead>
						<th>SN</th>
						<th>Username</th>
						<th>Email</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
						
						<?php foreach ($admin_users as $key => $user): ?>
							<tr>
								<td>
									<?php echo $key + 1; ?>
								</td>
								<td>
									<?php echo $user['username']; ?>
								</td>
								<td>
									<?php echo $user['email']; ?>
								</td>
								<td><a href="edit.php?id=<?php echo $user['id'] ?>" class="edit">edit</a></td>
								<td><a href="index_users.php?delete_id=<?php echo $user['id'] ?>" class="delete">delete</a></td>
								
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