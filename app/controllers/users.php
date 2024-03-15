<?php
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'users';
$admin_users = selectAll($table);

$id = '';
$username = '';
$admin = '';
$email = '';
$password = '';
$passwordConf = '';

$errors = array();


function loginUser($user)
{
	$_SESSION['id'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['admin'] = $user['admin'];
	$_SESSION['message'] = 'You are now logged in';
	$_SESSION['type'] = 'success';

	if ($_SESSION['admin']) {
		header('location:' . BASE_URL . '/admin/dashboard.php');
	} else {
		header('location: ' . BASE_URL . '/index.php');
	}


	exit();
}

if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {

	$errors = validateUser($_POST);
	if (count($errors) === 0) {
		unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		if (isset($_POST['admin'])) {
			$_POST['admin'] = 1;
			$user_id = create($table, $_POST);
			$_SESSION['message'] = 'Admin user created successfully';
			$_SESSION['type'] = 'success';
			header('location:' . BASE_URL . '/admin/users/index_users.php');
			exit();
		} else {
			$_POST['admin'] = 0;
			$user_id = create($table, $_POST);
			$user = selectOne($table, ['id' => $user_id]);

			//log user in
			loginUser($user);

		}

	} else {
		$username = $_POST['username'];
		$admin = isset($_POST['admin']) ? 1 : 0;
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
	}


}

if (isset($_GET['id'])) {
	$user = selectOne($table, ['id' => $_GET['id']]);
	$id = $user['id'];
	$username = $user['username'];
	$admin = $user['admin'] == 1 ? 1 : 0;
	$email = $user['email'];
}

if (isset($_POST['login-btn'])) {
	$errors = validateLogin($_POST);

	if (count($errors) === 0) {
		$user = selectOne($table, ['username' => $_POST['username']]);
		if ($user && password_verify($_POST['password'], $user['password'])) {
			loginUser($user);
		} else {
			array_push($errors, 'Wrong credentials');
		}
	}
	$username = $_POST['username'];
	$password = $_POST['password'];

}

if (isset($_GET['delete_id'])) {
	$count = deleteT($table, $_GET['delete_id']);
	$_SESSION['message'] = 'Admin user deleted';
	$_SESSION['type'] = 'success';
	header('location:' . BASE_URL . '/admin/users/index_users.php');
	exit();
}

if (isset($_POST['update-user'])) {
	adminOnly();
	$errors = validateUser($_POST);
	if (count($errors) === 0) {
		$id= $_POST['id'];
		unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

		$_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
		$count = update($table, $id, $_POST);
		$_SESSION['message'] = 'Admin user updated';
		$_SESSION['type'] = 'success';
		header('location:' . BASE_URL . '/admin/users/index_users.php');
		exit();

	} else {
		$username = $_POST['username'];
		$admin = isset($_POST['admin']) ? 1 : 0;
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
	}
}

// Update Profile information
function updateP($table, $id, $data)
{
	global $conn;

	$columns = array_keys($data);
	$values = array_map(function ($value) use ($conn) {
		if ($value === null) {
			return "NULL";
		}
		return "'" . mysqli_real_escape_string($conn, $value) . "'";
	}, array_values($data));

	$sql = "UPDATE $table SET ";
	for ($i = 0; $i < count($columns); $i++) {
		$sql .= "$columns[$i] = $values[$i]";
		if ($i !== count($columns) - 1) {
			$sql .= ", ";
		}
	}
	$sql .= " WHERE id=$id";

	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
		echo "Error updating record: " . mysqli_error($conn);
		return false;
	}
}
//checking updated profile info

if (isset($_POST['update-profile'])) {
	$user = selectOne($table, ['username' => $_SESSION['username']]);

	// Check if user wants to update username
	if (isset($_POST['update-username']) && !empty($_POST['new-username'])) {
		$newUsername = $_POST['new-username'];
		if ($newUsername !== $user['username']) {
			$existingUser = selectOne('users', ['username' => $newUsername]);
			if ($existingUser) {
				array_push($errors, 'Username already exists. Choose another one.');
			}
			// Update username
			else {
				updateP($table, $user['id'], ['username' => $newUsername]);
				$_SESSION['username'] = $newUsername;

			}

		}


	}

	// Check if user wants to update password
	if (isset($_POST['update-password']) && !empty($_POST['old-password']) && !empty($_POST['new-password'])) {
		$oldPassword = $_POST['old-password'];
		$newPassword = password_hash($_POST['new-password'], PASSWORD_DEFAULT);

		// Verify old password
		if (password_verify($oldPassword, $user['password'])) {
			// Update password
			updateP($table, $user['id'], ['password' => $newPassword]);
		} else {
			array_push($errors, 'Old password is incorrect');
		}
	}

	if (!empty($errors)) {
		$_SESSION['errors'] = $errors;
	} else {
		$_SESSION['message'] = 'Profile updated successfully';
		$_SESSION['type'] = 'success';
		header('location: ' . BASE_URL . '/profile/profile_info.php');
	}

	// Redirect back to edit profile page

}