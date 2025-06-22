<?php 

if(!defined('BASE_URL')) {
    define('BASE_URL', 'https://localhost/git-project/web-sekolah/'); // Sesuaikan dengan punya masing masing
}

function base_url($path = '') {
    return BASE_URL . ltrim($path, '/'); // Cara pakai : base_url('auth/login.php') 
}

?>