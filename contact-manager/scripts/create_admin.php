<?php
// CLI only: php scripts/create_admin.php
if (PHP_SAPI !== 'cli') { exit('CLI only.'); }
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../models/User.php';

$username = trim(readline('Admin username: '));
$password = readline('Admin password (min 8 chars): ');
if ($username === '' || strlen($password) < 8) { exit("Invalid input.\n"); }

User::create($username, $password);
echo "Admin created (password stored as a bcrypt hash).\n";
