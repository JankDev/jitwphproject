<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      lang="pl">
<head>
    <meta charset="UTF-8"/>
    <title>Blog dot org</title>
    <link rel="stylesheet" type="text/css" href="forms.css"/>
    <link rel="stylesheet" type="text/css" href="menu.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<?php include 'menu.php'; ?>
<h1>Dodaj komentarz</h1>

<form method="post" action="koment.php">
    <label for="nick">Pseudonim: </label>
    <input id="nick" name="nick" type="text"/>

    <select name="blog_post">
        <?php
        $nazwa = "";
        if (isset($_GET['nazwa'])) {
            $nazwa =$_GET['nazwa'];
        }
        if ($nazwa == "") {
            foreach (new DirectoryIterator("Blogi/") as $directoryIterator) {
                if ($directoryIterator->isDir() && !$directoryIterator->isDot()) {
                    foreach (new DirectoryIterator($directoryIterator->getPathName()) as $plik) {
                        if (strpos($plik, ".") === false && $plik != "info") {
                            echo "<option>" . $directoryIterator."/". basename($plik) . "</option>";
                        }
                    }
                }
            }
        }
        else{
            echo "<option>" . $nazwa . "</option>";

        }
        ?>
    </select>

    <label for="type">Ocena: </label>
    <select id="type" name="type">
        <option>Pozytywny</option>
        <option>Neutralny</option>
        <option>Negatywny</option>
    </select>

    <label for="comment">Komentarz: </label>
    <textarea id="comment" name="comment"></textarea>

    <button type="submit">Wyślij</button>
    <button type="reset">Wyczyść</button>
</form>
</body>
</html>