<head>
    <meta charset="UTF-8">
    <title>Polovni Automobili</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <?php
        if (isset($css_file_name)) {
            echo "<link rel='stylesheet' href='/css/{$css_file_name}'>";
        }
    ?>

    <script src="/js/main.js" defer></script>
</head>
