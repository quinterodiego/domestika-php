<?php

function redirect_to($path) {
  header(SITE_URL . $path);
  die();
}