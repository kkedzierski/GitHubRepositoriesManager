<?php
    session_start();
    if(!isset($_SESSION['apiToken'])){
        header("Location: ./index.php");
        exit();
    }
    if($_SESSION['repository']){
        $repository = $_SESSION['repository'];
    }
?>

<?php include_once __DIR__ . "./layout/header.php"; ?>

    <main class="container">

        <h1>Edit repository</h1>

        <form method="post" action="../src/GithubApiProvider.php" >

            <label for="name">Name</label>
            <input type="hidden" name="full_name" value="<?= $repository['full_name'] ?>"/>
            <input type="text" name="name" id="name" value="<?= $repository['name'] ?>" required>

            <label for="description">Description</label>
            <textarea type="text" name="description" id="description"><?= htmlspecialchars($repository["description"]) ?></textarea>

            <button type="submit">Update repository</button>
        </form>
        <form 
            method="post" 
            action="../src/GithubApiProvider.php"
            onsubmit="return confirm('Do you really want delete this repository?');">
            <input type="hidden" name="full_name" value="<?= $repository['full_name'] ?>"/>
            <input type="hidden" name="delete" value="true"/>
            <button id="delete_btn" class="primmary-btn secondary outline" type="submit">Delete repository</button>
        </form>
        <button class="primmary-btn secondary" onclick="window.location.href='./repository.php'">
            Back to repository
        </button>

    </main>

<?php include_once __DIR__ . "./layout/footer.php"; ?>