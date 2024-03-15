<?php
function validateUser($user)
{
	$errors = array();
	if (empty($user['username'])) {
		array_push($errors, 'Username is required');
	}
	if (empty($user['email'])) {
		array_push($errors, 'Email is required');
	}
	if (empty($user['password'])) {
		array_push($errors, 'Password is required');
	}
	if (empty($user['passwordConf'])) {
		array_push($errors, 'Password Confirmation is required');
	}
	if ($user['passwordConf'] !== $user['password']) {
		array_push($errors, 'Passwords do not match');
	}

	$existingUser1 = selectOne('users', ['username' => $user['username']]);
	if ($existingUser1) {
		if (isset($user['update-user']) && $existingUser1['id'] != $user['id']) {
			array_push($errors, 'Username already exists');

		}
		else if (isset($post['create-admin'])){
			array_push($errors, 'Username already exists');
	
		}
	}

	$existingUser = selectOne('users', ['email' => $user['email']]);
	if ($existingUser) {
		if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {
			array_push($errors, 'Email already exists');

		}
		else if (isset($post['create-admin'])){
			array_push($errors, 'Email already exists');
	
		}
	}
	return $errors;

}
//for login
function validateLogin($user)
{
	$errors = array();
	if (empty($user['username'])) {
		array_push($errors, 'Username is required');
	}
	if (empty($user['password'])) {
		array_push($errors, 'Password is required');
	}
	return $errors;

}

