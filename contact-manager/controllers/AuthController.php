<?php
class AuthController
{
    public function loginForm(): void
    {
        render('auth/login', ['error' => null]);
    }

    public function login(): void
    {
        csrf_check();
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = ($username !== '' && strlen($username) <= 50) ? User::findByUsername($username) : null;

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int) $user['id'];
            $_SESSION['flash'] = 'Logged in.';
            redirect('contacts/index');
        }
        // same message for unknown user / wrong password (no user enumeration)
        render('auth/login', ['error' => 'Invalid username or password.']);
    }

    public function logout(): void
    {
        csrf_check();
        $_SESSION = [];
        session_destroy();
        session_start();
        $_SESSION['flash'] = 'Logged out.';
        redirect('contacts/index');
    }
}
