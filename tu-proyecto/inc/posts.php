<?php 

function get_all_posts() {
  global $app_db;
  $result = mysqli_query( $app_db, "SELECT * FROM posts");

  if(!$result) {
    die(mysqli_error($app_db));
  }

  return  mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function insert_post($title, $excerpt, $content) {
  global $app_db;
  $published_on = date('Y-m-d H:i:s');
  $query = "INSERT INTO posts 
    (title, excerpt, content, published_on)
    VALUES ('$title', '$excerpt', '$content', '$published_on')";
  $result = mysqli_query($app_db, $query);
  if(!$result) {
    die(mysqli_error($app_db));
  }
}

function get_post($post_id) {
  global $app_db;
  $post_id = intval($post_id);
  $query = "SELECT * FROM posts WHERE id = " . $post_id;
  $result = mysqli_query($app_db, $query);

  if(!$result) {
    die(mysqli_error($app_db));
  }

  return mysqli_fetch_assoc($result);
}

function delete_post($id) {
  global $app_db;
  $id = intval($id);
  $result = mysqli_query($app_db, "DELETE FROM posts WHERE id= $id");
  if(!$result) {
    die(mysqli_error($app_db));
  }
}

function filter_string_polyfill(string $string): string
{
    $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
    return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
}