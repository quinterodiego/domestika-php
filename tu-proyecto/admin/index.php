<?php

require '../init.php';
if(!is_logged_in()) {
  redirect_to('index.php');
}

$action = '';

if(isset($_GET['action'])) {
  $action = $_GET['action'];
}

switch ($action) {
  case 'new-post':
    # code...
    break;
  
  case 'list-posts':
    $all_posts = get_all_posts();
    ?>
    <?php require __DIR__ . '/../templates/header.php'; ?>

    <?php if(isset($_GET['success'])) : ?>
      <div class="success">
        El post ha sido creado
      </div>
    <?php endif; ?>
    <table>
      <?php foreach($all_posts as $post) : ?>
        <tr>
          <td><?php echo $post['title']; ?></td>
          <td><a href="<?php echo SITE_URL . '/admin?action=list-posts&delete-post=' . $post['id'] ?>&hash=<?php echo generate_hash('delete-post-' . $post['id']); ?>">Eliminar post</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php require __DIR__ . '../../templates/footer.php'; ?>
    <?php
    break;
  
  default: 
    require 'templates/admin.php';
  
}

?>