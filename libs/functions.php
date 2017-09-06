<?php
function reArrayFiles(&$file_post) {
	if (count($file_post) === 0)
		return [];
	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for ($i=0; $i<$file_count; $i++) {
		foreach ($file_keys as $key) {
			$file_ary[$i][$key] = $file_post[$key][$i];
		}
	}

	return $file_ary;
}
function reArrayJson(&$json_data) {
	if (count($json_data) === 0)
		return [];
	$object_array = [];
	foreach ($json_data as $json) {
		array_push($object_array, json_decode($json));
	}
	return $object_array;
}