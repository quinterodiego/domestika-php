<?php

function redirect_to($path) {
  header(SITE_URL . $path);
  die();
}

function generate_hash($action) {
  return md5($action);
}

function check_hash($action, $hash) {
  if(generate_hash($action) == $hash) {
    return true;
  }

  return false;
}

function is_logged_in() {
  $is_user_logged_in = isset($_SESSION['user']) && $_SESSION['user'] === ADMIN_USER;
  return $is_user_logged_in;
}

function login($user, $password) {
  if($user === ADMIN_USER && $password === ADMIN_PASSWORD) {
    $_SESSION['user'] = ADMIN_USER;
    return true;
  }

  return false;
}

function logout() {
  unset($_SESSION['user']);
  redirect_to('index.php');
  session_destroy();
}