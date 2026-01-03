<?php
function getCSSHref()
{
    $path = getPath();

    // TODO: Check how to deal with 404 page
    $file_name = $path === '/' ? 'home' : $path;

    return "/css/$file_name.css";
}

?>

<head>
    <meta charset="UTF-8">
    <title>Polovni Automobili</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="<?= getCSSHref() ?>">

    <script src="/js/main.js"></script>
</head>
