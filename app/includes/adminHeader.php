<header class="fixed-top">
    <a class="logo" href="<?php echo BASE_URL . '/index.php'; ?>">
        <div class="logo-container">
            <h1 class="logo-text"><span>MT</span>thoughts</h1>
            <i class="bi bi-pencil-square pencil-icon"></i>
        </div>
    </a>
    <input type="checkbox" id="menu-toggle-checkbox" class="menu-toggle-checkbox">
    <label for="menu-toggle-checkbox" class="menu-toggle">
    </label>
    <ul class="nav">
        <?php if (isset($_SESSION['username'])): ?>
            <li>
                <a href="#">
                    <i class="bi bi-person-fill"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="bi bi-chevron-down" style="font size: .8em;"></i>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL . '/admin/dashboard.php'; ?>">Dashboard</a></li>
                    <li><a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout">Logout</a></li>
                </ul>

            </li>
        <?php endif; ?>

    </ul>



</header>