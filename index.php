<?php

// catch any real error (not our own 404s) and show it as a meme instead of
// a raw PHP fatal-error dump
set_exception_handler(function (Throwable $exception) {
    http_response_code(500);
    require __DIR__ . '/views/errors/crash.php';
});

// core runner, pls do not remove it.
if (PHP_SAPI === 'cli-server') {
    $requestedFile = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($requestedFile)) {
        return false;
    }
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/core/Loader.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// parser URL, this line will divide the uri into several parts
$uri      = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base     = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
$path     = trim(substr($uri, strlen($base) + 1), '/');
$segments = explode('/', $path);

define('BASE_URL', $base === '' ? '' : '/' . $base);

// this is sample guys, when ure accessing the yourwebsite.com/account/id-account-1/edit
// base will contain yourwebsite.com
// path will contain /account/id-account-1/edit
// segment will contain  [0] -> account, [1] -> id-account-1, [2] -> edit,

$noIdActions = ['create', 'store', 'edit', 'update', 'login', 'logout'];
$page = $segments[0] ?: 'beranda'; // default controller

// Auth guard protect pages
$publicPages = ['login', 'logout'];
if (!in_array($page, $publicPages, true) && !isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . '/login');
    exit;
}

if (!isset($segments[1]) || $segments[1] === '') {
    $id     = null;
    $action = 'index';
} elseif (in_array($segments[1], $noIdActions, true)) {
    $id     = null;
    $action = $segments[1];
} else {
    $id     = $segments[1];
    $action = $segments[2] ?? 'detail';
}

$method = $_SERVER['REQUEST_METHOD'];

// actions that must come from a form submission (POST), not a plain link/URL (GET)
$postOnlyActions = ['store', 'update', 'delete', 'login'];
$expectsPost     = in_array($action, $postOnlyActions, true);

$controllerName = str_replace('-', '', ucwords($page, '-'));
$role = $_SESSION['user']['role'] ?? null;
$roleAccess = [
    'revisi' => ['mahasiswa'],
    'manajemen-jadwal' => ['admin'],
    'manajemen-akun-mahasiswa' => ['admin'],
    'manajemen-akun-dosen-pembimbing' => ['admin'],
    'manajemen-akun-dosen-penguji' => ['admin'],
    'rekapitulasi-dokumen-mahasiswa' => ['admin'],
    'daftar-mahasiswa-bimbingan' => ['dosen'],
    'hasil-penilaian' => ['dosen', 'mahasiswa'],
    'jadwal-sidang' => ['dosen', 'mahasiswa'],
];

if (isset($roleAccess[$page]) && $role !== null && !in_array($role, $roleAccess[$page], true)) {
    http_response_code(403);
    echo '403 - Forbidden';
    exit;
}

$controllerDirs = [
    __DIR__ . '/controllers/shared',
];

if ($role !== null) {
    array_unshift($controllerDirs, __DIR__ . '/controllers/' . $role);
}

foreach (['admin', 'dosen', 'mahasiswa'] as $roleDir) {
    $dir = __DIR__ . '/controllers/' . $roleDir;
    if (!in_array($dir, $controllerDirs, true)) {
        $controllerDirs[] = $dir;
    }
}

$controllerFile = null;
foreach ($controllerDirs as $dir) {
    $candidate = $dir . '/' . $controllerName . '.php';
    if (file_exists($candidate)) {
        $controllerFile = $candidate;
        break;
    }
}

if ($controllerFile === null) {
    http_response_code(404);
    echo '404 - Page not found';
    exit;
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    http_response_code(404);
    echo '404 - Page not found';
    exit;
}

if (($expectsPost && $method !== 'POST') || (!$expectsPost && $method !== 'GET')) {
    http_response_code(404);
    echo '404 - Action not found';
    exit;
}

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo '404 - Action not found';
    exit;
}

$reflection = new ReflectionMethod($controller, $action);
$argCount   = $id === null ? 0 : 1;

if (
    $reflection->getNumberOfRequiredParameters() > $argCount
    || $reflection->getNumberOfParameters() < $argCount
) {
    http_response_code(404);
    echo '404 - Action not found';
    exit;
}

if ($id === null) {
    $controller->$action();
} else {
    $controller->$action($id);
}
