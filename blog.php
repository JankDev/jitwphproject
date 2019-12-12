<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="menu.css">
</head>
<body style="background-color: white;">
<?php
include 'menu.php';

if (isset($_GET['nazwa'])) {
    $urlParam = $_GET['nazwa'];
    $blogPost = "Blogi/" . $urlParam;

    $blogExists = false;

    $blogDir = "./" . $blogPost . "/";
    if (file_exists($blogDir)) {
        $blogExists = true;

        $fileInfo = fopen($blogDir . "info", 'r');
        $lineNumber = 1;
        echo '<div class="info">';
        while (($line = fgets($fileInfo)) !== false) {
            if ($lineNumber == 1) {
                echo "<h1>Blog użytkownika: " . $line . "</h1><h2>Opis bloga:</h2><p style='font-size: 1.4rem;'>";
            } else if ($lineNumber > 2) {
                echo $line ;
            }
            $lineNumber++;
        }
        echo '</p></div>';
        fclose($fileInfo);


        $pat = '^[^.]*$';//pattern
        foreach (new DirectoryIterator($blogDir) as $directoryStream) {
            if (!$directoryStream->isDir() && strpos($directoryStream, ".") === false && $directoryStream != "info") {
                $file_contents = file_get_contents($directoryStream->getPathName());
                echo "<h1>Wpis: " . $directoryStream . "</h1>";
                echo $file_contents . "<br />";


                $pattern = '/' . $directoryStream . '[1-3]/';
                foreach (new DirectoryIterator($blogDir) as $fia) {
                    if (preg_match($pattern, $fia)) {
                        echo sprintf('Dołączony plik: <a href="./%s/%s">%s</a><br />', $blogPost, $fia, $fia);
                    }
                }
                echo "<br />";
                echo "<div class='comment'>";
                if (file_exists($blogDir . $directoryStream . ".k")) {
                    foreach (new DirectoryIterator($blogDir . $directoryStream . ".k") as $commentsDirectoryStream) {
                        if (!$commentsDirectoryStream->isDot() && !$commentsDirectoryStream->isDir()) {
                            $fic = fopen($commentsDirectoryStream->getPathName(), 'r');

                            $lineNumber = 1;

                            while (($line = fgets($fic)) !== false) {
                                switch ($lineNumber) {
                                    case 1:
                                        echo "<b>Ocena: </b>" . $line . "<br />";
                                        break;
                                    case 2:
                                        echo "<b>Data: </b>" . $line . "<br />";
                                        break;
                                    case 3:
                                        echo "<b>Autor: </b>" . $line . "<br /><p>";
                                        break;
                                    default:
                                        echo $line . "<br />";
                                }
                                $lineNumber = $lineNumber + 1;
                            }
                            fclose($fic);
                            echo "</p><br />";


                        }
                    }
                }
                echo sprintf('<a href="./create-comment.php?nazwa=%s/%s" class="comment-post">Skomentuj wpis</a><br />', $urlParam, $directoryStream);
                echo "</div>";
            }
        }
    }

    if (!$blogExists) {
        echo "<h1>Nie znaleziono blogu !</h1>";
    }
} else {
    foreach (new DirectoryIterator("./Blogi/") as $blogDir) {
        if ($blogDir->isDir() && !$blogDir->isDot()) {
            $blog = $blogDir->getFilename();
            echo sprintf("<a href=\"blog.php?nazwa=%s\" style='color: #111111'><h1>%s</h1></a><br />", $blog, $blog);
        }
    }

}
?>
</body>
</html>