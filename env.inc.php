<?php
//TODO: include remote addr, and expire in signature
//find out more secure way of hashing
function env_verify($env_encoded, $env_sig) {
	return env_signature($env_encoded) == $env_sig;
}

function env_signature($env_encoded) {
	return md5($env_encoded . 'changeme');
}

function &env() {
	static $env = array();
	if(env_verify_cookie()) {
		//TODO: require php 5.2
		$env = (array) json_decode(base64_decode(($_COOKIE['__env'])));
	}
	return $env;
}
//expire etc?
function env_verify_cookie() {
	return isset($_COOKIE['__env']) && isset($_COOKIE['__env_sig']) && env_verify($_COOKIE['__env'], $_COOKIE['__env_sig']);
}
