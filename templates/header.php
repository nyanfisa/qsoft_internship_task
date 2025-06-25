<?php
$isAuthorised = isAuthorised();
$menu = getMenuItems($isAuthorised);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../assets/bulma_075.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="page">
    <section class="section has-background-white-ter">
        <div class="container">
            <?php includeTemplate('menu.php', [
                'menu' => $menu,
                'isAuthorised' => $isAuthorised
                ]); ?>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h1 class="title"><?= htmlspecialchars($title) ?></h1>