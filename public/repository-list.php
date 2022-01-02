<?php
    session_start();
    if(isset($_SESSION['errorCodes'])){
        $errorCodes = $_SESSION['errorCodes'];
    }
    if(isset($_SESSION['repositories'])){
        $repositories = $_SESSION['repositories'];
    }

    if(!isset($_SESSION['apiToken']) && !$_SESSION['apiToken']){
        header("Location: ./index.php");
        exit();
    }
    if(isset($_SESSION['rebulidRepositoryList'])){
        header("Location: ../src/GithubApiProvider.php");
        exit();
    }
?>

<?php include_once __DIR__ . "./layout/header.php"; ?>

    <main class="container">

        <h1>Repositories</h1>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($repositories as $respository): ?>
                    <tr>
                        <td>
                            <form action="../src/GithubApiProvider.php" method="get" autocomplete="off">
                                <input 
                                    type="hidden" 
                                    name="full_name" 
                                    value="<?= $respository['full_name'] ?>">
                                 <button 
                                    type="submit" 
                                    class="repository-name-btn"
                                 >
                                    <?= $respository['name'] ?>
                                </button>
                            </form>
                        </td>
                        <td><?= htmlspecialchars($respository["description"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <button class="primmary-btn" onclick="window.location.href='./create-repository.php'">
            Add new repository
        </button>
        <button class="primmary-btn secondary" onclick="window.location.href='./logout.php'">
            logout
        </button>

    </main>

    <?php include_once __DIR__ . "./layout/footer.php"; ?>