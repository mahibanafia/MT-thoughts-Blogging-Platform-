<header class="fixed-top">
	<a href="<?php echo BASE_URL . '/index.php'; ?>" class="logo">
		<div class="logo-container">
			<h1 class="logo-text"><span>MT</span>thoughts</h1>
			<i class="bi bi-pencil-square pencil-icon"></i>
		</div>
	</a>
	<input type="checkbox" id="menu-toggle-checkbox" class="menu-toggle-checkbox">
	<label for="menu-toggle-checkbox" class="menu-toggle">
	</label>
	<ul class="nav">
		<li><a href="<?php echo BASE_URL . '/index.php'; ?>">Home</a></li>
		<li><a href="<?php echo BASE_URL . '/about.php'; ?>">About</a></li>
		<?php if (isset($_SESSION['id'])): ?>
			<li>
				<a href="#">
					<i class="bi bi-person-fill"></i>
					<?php echo $_SESSION['username']; ?>
					<i class="bi bi-chevron-down" style="font size: .8em;"></i>
				</a>
				<ul>
					<?php if ($_SESSION['admin']): ?>
						<li><a href="<?php echo BASE_URL . '/admin/dashboard.php' ?>">Dashboard</a></li>
						<li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Logout</a></li>
					<?php else: ?>
						<li><a href="<?php echo BASE_URL . '/profile/profile_info.php'; ?>">Profile</a></li>
						<li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Logout</a></li>
					<?php endif; ?>
				</ul>
			</li>
		<?php else: ?>
			<li><a href="<?php echo BASE_URL . '/register.php' ?>">Sign Up</a></li>
			<li><a href="<?php echo BASE_URL . '/login.php' ?>">Login</a></li>

		<?php endif; ?>



	</ul>



</header>