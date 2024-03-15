<?php
function validateTopic($topic)
{
	$errors = array();
	if (empty($topic['name'])) {
		array_push($errors, 'Category Name is required');
	}

	$existingTopic = selectOne('topics', ['name' => $topic['name']]);
	if ($existingTopic) {
		if (isset($post['update-topic']) && $existingTopic['id'] != $topic['id']) {
			array_push($errors, 'Name already exists');

		}
		if (isset($post['add-topic'])){
			array_push($errors, 'Name already exists');
	
		}
	}
	return $errors;

}

