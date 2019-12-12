<?php
include 'menu.php';

$blogPost = $_POST['blog_post'];
$nick = $_POST['nick'];
$comment = $_POST['comment'];
$type = $_POST['type'];

$blogsDir = "./Blogi/" . $blogPost;

if (file_exists($blogsDir)) {
    makeBlogsDirIfNotPresent($blogsDir);
    $commentsDir = $blogsDir . ".k/";

    $fi = new FilesystemIterator($commentsDir, FilesystemIterator::SKIP_DOTS);
    $commentId = iterator_count($fi);

    $pc = $commentsDir . "/" . $commentId;
    $commentFile = fopen($pc, "w");

    if (flock($commentFile, LOCK_EX)) { //SEKCJA KRYTYCZNY, używamy exclusive Locka
        $createdDate = date("Y-m-d H:i:s");

        fputs($commentFile, $type . "\n");
        fputs($commentFile, $createdDate . "\n");
        fputs($commentFile, $nick . "\n");
        fputs($commentFile, $comment);
        flock($commentFile, LOCK_UN); //zwalniamy locka bo zakonczonej operacji
    }
    echo "<h1>Komentarz dodany</h1> <br />";

    fclose($commentFile);
} else {
    echo "<h1>Wpis nie istnieje!</h1><br/>";
}
?>
<?php
/**
 * @param string $blogsDir
 */
function makeBlogsDirIfNotPresent(string $blogsDir): void
{
    if (!file_exists($blogsDir . ".k")) {
        mkdir($blogsDir . ".k", 0755, true);
    }
}

