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
<h1>Załóż bloga</h1>

<form method="post" action="nowy.php">
    <label for="blogname">Nazwa bloga: </label>
    <input id="blogname" name="blogname" type="text"/>

    <label for="username">Twoja nazwa użytkownika: </label>
    <input id="username" name="username" type="text"/>

    <label for="password">Podaj hasło: </label>
    <input id="password" name="password" type="password"/>

    <label for="description">Opis blogu: </label>
    <textarea id="description" name="description"></textarea>

    <button type="submit">Wyślij</button>
    <button type="reset">Wyczyść</button>
</form>
</body>
</html>