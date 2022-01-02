<?php

namespace GithubApiManager;

use GithubApiManager\GithubApiManager;
use GithubApiManager\helpers\Helpers;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$errorCodes = [];

if(isset($_GET["full_name"])){
    $apiManager = new GithubApiManager($_SESSION["apiToken"]);
    $apiManager->getRepositoryPage($_GET["full_name"]);
}
if(isset($_POST['delete'])){
    $apiManager = new GithubApiManager($_SESSION["apiToken"]);
    $apiManager->deleteRepository($_POST['full_name']); 
}
if(isset($_POST['full_name'])){
    $apiManager = new GithubApiManager($_SESSION["apiToken"]);
    $apiManager->updateRepository($_POST['full_name'], $_POST); 
}

if(isset($_POST["name"])){
    $apiManager = new GithubApiManager($_SESSION["apiToken"]);
    $apiManager->addRepository($_POST); 
}

if(isset($_SESSION['rebulidRepositoryList'])){
    unset($_SESSION['rebulidRepositoryList']);
    if(isset($_SESSION['repositoryUpdated'])){
        unset($_SESSION['repositoryUpdated']);
    }
    if(isset($_SESSION['repositoryDeleted'])){
        unset($_SESSION['repositoryDeleted']);
    }
    $apiManager = new GithubApiManager($_SESSION["apiToken"]);
    $apiManager->getRepositoriesPage(); 
}

if(!empty($_POST['api-token-key'])){
    $apiManager = new GithubApiManager($_POST['api-token-key']);
    $apiManager->getRepositoriesPage(); 
}else{
    $errorCodes[] = 0;
    Helpers::addSession("errorCodes", $errorCodes);
    header("Location: ../public/index.php");
    exit();
}
