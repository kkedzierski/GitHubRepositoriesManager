<?php

namespace GithubApiManager\helpers;

class Helpers{
    /**
     * Add session with given name 
     *
     * @param string  $sessionName 
     * @param mixed $sessionValue 
     * 
     * @return void
     */ 
    public static function addSession(string $sessionName, mixed $sessionValue): void{
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$sessionName] = $sessionValue;
    }
}
