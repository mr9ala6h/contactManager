<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Manager</title>
<style>
body{font-family:system-ui,sans-serif;max-width:760px;margin:2rem auto;padding:0 1rem}
nav{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem}
table{width:100%;border-collapse:collapse}th,td{padding:.5rem;border-bottom:1px solid #ddd;text-align:left}
.flash{background:#e8f5e9;color:#111;padding:.6rem;margin-bottom:1rem}.err{color:#b00020;font-size:.9rem}
label{display:block;margin-top:.8rem}input{width:100%;padding:.4rem;box-sizing:border-box}
form.inline{display:inline}button,.btn{padding:.35rem .7rem;cursor:pointer}
</style>
</head>
<body>
<nav>
  <a href="index.php"><strong>Contact Manager</strong></a>
  <div>
  <?php if (is_logged_in()): ?>
    <form class="inline" method="post" action="index.php?r=auth/logout"><?= csrf_field() ?><button>Logout</button></form>
  <?php else: ?>
    <a href="index.php?r=auth/login">Admin login</a>
  <?php endif; ?>
  </div>
</nav>
<?php if ($m = flash()): ?><div class="flash"><?= e($m) ?></div><?php endif; ?>
<?= $content ?>
</body>
</html>
