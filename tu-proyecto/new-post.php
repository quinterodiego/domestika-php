<?php
require('init.php');

$error = false;
$title = '';
$excerpt = '';
$content = '';

if(isset($_POST['submit-new-post'])) {
  $title = filter_string_polyfill($_POST['title']);
  $excerpt = filter_string_polyfill($_POST['excerpt']);
  $content = $_POST['content'];
  
  if(empty($title) || empty($content)){
    $error = true;
  }else{
    insert_post($title, $excerpt, $content);
    redirect_to('index.php?success=true');
  }
}

require('templates/header.php'); 
?>

<h2>Crear nuevo post</h2>

<?php 
  if($error):
?>
<div class="error">
  Error en el formulario
</div>
<?php
  endif;
?>
<form action="" method="post">
  <label for="title">Título (requerido)</label>
  <input type="text" name="title" id="title" value="<?php echo $title ?>">

  <label for="excerpt">Extracto</label>
  <input type="text" name="excerpt" id="excerpt" value="<?php echo $excerpt ?>">

  <label for="content">Contenido (requerido)</label>
  <textarea name="content" id="content" cols="30" rows="30"><?php echo $content ?></textarea>

  <p>
    <input type="submit" name="submit-new-post" value="Nuevo post">
  </p>
</form>

<?php require('templates/footer.php'); ?>