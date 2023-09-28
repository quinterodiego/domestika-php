<?php 
require('init.php');

if(isset($_GET['delete-post'])) {
  $id = $_GET['delete-post'];
  if(!check_hash('delete-post-' . $id, $_GET['hash'])) {
    die('Hackeando, no?');
  }
  delete_post($id);
  redirect_to('index.php');
}

$all_posts = get_all_posts();

$post_found = false;

if(isset($_GET['view'])) {
  $post_found = get_post($_GET['view']);
  if($post_found) {
    $all_posts = [$post_found];
  }
}

require('templates/header.php');
if(isset($_GET['success'])) :
?>

<div class="success">
  El post ha sido creado
</div>
<?php endif; ?>
<div class="posts">
  <?php 
    foreach($all_posts as $post) {
  ?>
  <article class="post">
    <header>
      <h2 class="post-title">
        <a href="?view=<?php echo $post['id']?>"><?php echo $post['title'] ?></a>
      </h2>
    </header>
    <div class="post-content">
      <?php if($post_found) :
        echo $post['content'];
      else:
        echo $post['excerpt'];
      endif;
      ?>
    </div>
    <footer>
      <span class="post-date">Publicada en: <?php echo date('m-d-Y') ?></span></footer>
      <div class="delete-post">
        <a href="?delete-post=<?php echo $post['id']; ?>&hash=<?php echo generate_hash('delete-post-' . $post['id']); ?>">Eliminar post</a>
      </div>
  </article>
  <?php
    }
  ?>

<?php require('templates/footer.php') ?>