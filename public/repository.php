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

        <h1>Repository</h1>

        <dl>
            <dt>Name</dt>
            <dd><?= $repository['name'] ?></dd>
            <dt>Description</dt>
            <dd><?= htmlspecialchars($repository["description"]) ?></dd>
        </dl>
        <button  onclick="window.location.href='./update-repository.php'">
            Update repository
        </button>
        <button class="primmary-btn secondary" onclick="window.location.href='./repository-list.php'">
            Back to repositories
        </button>
    </main>

<?php include_once __DIR__ . "./layout/footer.php"; ?>