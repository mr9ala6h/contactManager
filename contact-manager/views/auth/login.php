<h2>Admin login</h2>
<?php if ($error): ?><p class="err"><?= e($error) ?></p><?php endif; ?>
<form method="post" action="index.php?r=auth/login">
  <?= csrf_field() ?>
  <label>Username <input name="username" maxlength="50" required></label>
  <label>Password <input type="password" name="password" required></label>
  <p><button>Log in</button></p>
</form>
