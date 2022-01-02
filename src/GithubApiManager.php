<?php

namespace GithubApiManager;

use RestApiClient\RestApiClient;
use RestApiClient\RestApiResponse;
use GithubApiManager\helpers\Helpers;

require_once __DIR__ . '/../vendor/autoload.php';

class GithubApiManager{

    private RestApiClient $rac;
    private string $token;

    public function __construct(string $apiTokenKey)
    {
        $this->token = $apiTokenKey;
        $this->initializeApiClient($apiTokenKey); 
    }

    private function initializeApiClient(string $apiTokenKey){
        $rac = new RestApiClient("https://api.github.com");
        $rac->addToHeader("User-Agent", "Repositories");
        $rac->addToHeader("Authorization", "token " . $apiTokenKey);
        $this->rac = $rac;
    }

    private function setApiTokenToSession(string $apiTokenKey){
        Helpers::addSession("apiToken", $apiTokenKey);
    }

    private function validateStatusCodeAndRedirect(
        RestApiResponse $response, 
        string $locationValid, 
        string $locationInvalid,
        string $sessionObjectName=""){

        if(!in_array($response->getStatusCode(), [200, 201, 204])){
            $errorCodes[] = $response->getStatusCode();
            Helpers::addSession("errorCodes", $errorCodes);
            header("Location: $locationInvalid");
            exit();
        }

        if($response->getStatusCode() === 200 && $sessionObjectName === 'rebulidRepositoryList'){
            Helpers::addSession("repositoryUpdated", true);
        }

        if($response->getStatusCode() === 201){
            Helpers::addSession("repositoryCreated", true);
        }

        if($response->getStatusCode() === 204){
            Helpers::addSession("repositoryDeleted", true);
        }

        if($sessionObjectName){
            $repositories = json_decode($response->getBody(), true);
            Helpers::addSession($sessionObjectName, $repositories);
        }
        $this->setApiTokenToSession($this->token);
        header("Location: $locationValid");
        exit();
    }

    public function getRepositoriesPage(): void{
        $response = $this->rac->get('/user/repos');
        $this->validateStatusCodeAndRedirect($response, "../public/repository-list.php", "../public/index.php", "repositories");    
    }

    public function getRepositoryPage(string $respoitoryFullName){
        $response = $this->rac->get('/repos/:full_name', $respoitoryFullName);
        $this->validateStatusCodeAndRedirect($response, "../public/repository.php", "../public/repository-list.php", "repository");
    }

    public function addRepository(array $data){
        $response = $this->rac->post('/user/repos', $data);
        $this->validateStatusCodeAndRedirect($response, "../public/repository-list.php", "../public/create-repository.php", 'rebulidRepositoryList');
    }

    public function updateRepository(string $respoitoryFullName, array $data){
        unset($_POST['full_name']);
        $response = $this->rac->patch('/repos/:full_name', $respoitoryFullName, $data);
        $this->validateStatusCodeAndRedirect($response, "../public/repository-list.php", "../public/update-repository.php", 'rebulidRepositoryList');
    }

    public function deleteRepository(string $respoitoryFullName){
        $response = $this->rac->delete('/repos/:full_name', $respoitoryFullName);
        $this->validateStatusCodeAndRedirect($response, "../public/repository-list.php", "../public/update-repository.php", 'rebulidRepositoryList');
    }
}