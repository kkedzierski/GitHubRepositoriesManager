<?php
    session_start();
    if(isset($_SESSION['errorCodes'])){
        $errorCodes = $_SESSION['errorCodes'];
    }
    if(isset($_SESSION['apiToken']) && $_SESSION['apiToken']){
        header("Location: ./repository-list.php");
        exit();
    }
?>
<?php include_once __DIR__ . "./layout/header.php"; ?>

<main id="box">
        <img src="./static/images/GitHub_Logo.png" alt="GitHub logo" class="github-logo" />
        <div class="github-repository-manager-title">
            Github repository manager
            <span>Enter API token key to manage</span>
        </div>
        <form id="api-token-registration-form" action="../src/GithubApiProvider.php" method="post" autocomplete="off">
            <p>
                <input type="password" name="api-token-key" value="" placeholder="Enter API token key" id="p" class="api-key-input">
                <img src="./static/images/padlock.jpg" class="padlock" alt="padlock">
            </p>
            <button class="enter-api-token-btn" type="submit">Enter Api Token</button>
            <p>     
                <small class="github-documentation-redirection">
                    You do not know how to generate token check 
                    <a 
                        href="https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token"
                        target="_blank"
                    >
                        this documentation
                    </a>
                </small>
            </p>
        </form>
</main>

<?php include_once __DIR__ . "./layout/footer.php"; ?>