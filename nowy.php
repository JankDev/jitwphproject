<?php
include 'menu.php';

$user_name = $_POST['username'];
$password = $_POST['password'];
$blog_name = $_POST['blogname'];
$blog_description = $_POST['description'];

if (is_dir("Blogi/" . $blog_name)) {
    echo "Blog o podanej nazwie istnieje !!!";
}

$isEmptyField = empty($user_name) || empty($password) || empty($blog_name);

if ($isEmptyField) {
    echo "Pola nazwa bloga, nazwa użytkownika i hasło nie mogą być puste !!!";
} else {
    $oldmask = umask(0);
    mkdir("Blogi/" . $blog_name, 0777);
    umask($oldmask); //ustawiamy umask na 0 by móc tworzyć pliki

    $file = fopen("Blogi/" . $blog_name . "/info", "w");
    saveToFile($file, $user_name, $password, $blog_description);
    fclose($file);

    echo '<h1>Pomyślnie założono bloga '.$blog_name.'</h1>';
}
?>
<?php
/**
 * @param $file
 * @param $user_name
 * @param $password
 * @param $blog_description
 */
function saveToFile($file, $user_name, $password, $blog_description): void
{
    saveToFile($file, $user_name, $password, $blog_description);
}

