<?php
include 'menu.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_POST['username'];
$password = $_POST['password'];
$date = $_POST['date'];
$date = str_replace("-", "", $date);
$hour = $_POST['hour'];
$hour = str_replace(":", "", $hour);
$post_text = $_POST['post'];


$blogDir = "Blogi";
$filesystemIterator = new FilesystemIterator($blogDir, FilesystemIterator::SKIP_DOTS);

foreach ($filesystemIterator as $file) {
    $fileInfo = fopen("Blogi/" . $file->getFileName() . "/info", "r");

    $fileUserName = fgets($fileInfo);
    $filePassword = fgets($fileInfo);
    if (checkCredentials($fileUserName, $username, $filePassword, $password)) {
        fclose($fileInfo);

        $id = getFileUID($file, $date, $hour);

        $blogPostFileName = "Blogi/" . $file->getFileName() . "/" . $date . $hour . date("s") . $id;
        $blogPost = fopen($blogPostFileName, "w");

        fwrite($blogPost, $post_text . "\n");

        fclose($blogPost);
        for ($i = 1; $i <= sizeof($_FILES); $i++) {
            $attachmentName = 'file' . $i;
            $attachmentFile = $_FILES[$attachmentName];
            $attachmentExtension = pathinfo($attachmentFile['name'], PATHINFO_EXTENSION);

            move_uploaded_file($attachmentFile["tmp_name"], $blogPostFileName . $i . "." . $attachmentExtension);
        }

        echo '<h1>Wpis został dodany</h1>';

    }
}

?>

<?php
/**
 * @param string $fileUserName
 * @param string $username
 * @param string $filePassword
 * @param string $password
 * @return bool
 */
function checkCredentials(string $fileUserName, string $username, string $filePassword, string $password): bool
{
    return rtrim($fileUserName, "\r\n") == $username && rtrim($filePassword, "\r\n") == md5($password);
}

/**
 * @param $file
 * @param $date
 * @param $hour
 * @return string
 */
function getFileUID(SplFileInfo $file, string $date, string $hour): string
{
    $id = 0;
    $id = str_pad($id, 2, '0', STR_PAD_LEFT);
    do {
        ++$id;
        $id = str_pad($id, 2, '0', STR_PAD_LEFT);
    } while (file_exists("Blogi/" . $file->getFileName() . "/" . $date . $hour . date("s") . $id));
    return $id;
}
