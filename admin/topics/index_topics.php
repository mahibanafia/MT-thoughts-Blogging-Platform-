<?php
include("../../path.php");
?>
<?php include(ROOT_PATH . "/app/controllers/topics.php");
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

	<title>Admin Section - Manage Categories</title>

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
				<a href="create_topics.php" class="btn btn-big">Add Category</a>
				<a href="index_topics.php" class="btn btn-big">Manage Categories</a>
			</div>
			<div class="content">
				<h3 class="page-title">Manage Categories</h3>

				<?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
				<table>
					<thead>
						<th>SN</th>
						<th>Name</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
						<?php foreach ($topics as $key => $topic): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $topic['name']; ?></td>
								<td><a href="edit.php?id=<?php echo $topic['id']; ?>" class="edit">edit</a></td>
								<td><a href="index_topics.php ?del_id=<?php echo $topic['id'];?>" class="delete">delete</a></td>
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