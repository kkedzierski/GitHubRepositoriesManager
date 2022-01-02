<?php
    session_start();

    if(!isset($_SESSION['apiToken'])){
        header("Location: ./index.php");
        exit();
    }
?>
<?php include_once __DIR__ . "./layout/header.php"; ?>

<main class="container">
    <h1> New repository </h1>

    <form method="post"  action="../src/GithubApiProvider.php" >

        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Description</label>
        <textarea type="text" name="description" id="description"></textarea>

        <button type="submit">Add repository</button>
    </form>
    <button class="primmary-btn secondary" onclick="window.location.href='./repository-list.php'">
        Back to repositories
    </button>

</main>
<?php include_once __DIR__ . "./layout/footer.php"; ?>