<?php
function e(?string $v): string
{
    return htmlspecialchars($v ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $route): void
{
    header('Location: index.php?r=' . $route);
    exit;
}

function render(string $view, array $vars = []): void
{
    extract($vars);
    ob_start();
    require __DIR__ . "/../views/$view.php";
    $content = ob_get_clean();
    require __DIR__ . '/../views/layout.php';
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_check(): void
{
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419);
        exit('Invalid CSRF token.');
    }
}

function is_logged_in(): bool
{
    return !empty($_SESSION['user_id']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        $_SESSION['flash'] = 'Please log in first.';
        redirect('auth/login');
    }
}

function flash(): ?string
{
    $m = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $m;
}
