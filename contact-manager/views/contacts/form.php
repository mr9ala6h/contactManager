<h2><?= e($title) ?></h2>
<form method="post" action="index.php?r=<?= e($action) ?>">
  <?= csrf_field() ?>
  <?php foreach (['name' => 'Name', 'email' => 'Email', 'phone' => 'Phone'] as $f => $label): ?>
    <label><?= e($label) ?>
      <input name="<?= e($f) ?>" value="<?= e($contact[$f]) ?>" required>
    </label>
    <?php if (isset($errors[$f])): ?><span class="err"><?= e($errors[$f]) ?></span><?php endif; ?>
  <?php endforeach; ?>
  <p><button>Save</button> <a href="index.php">Cancel</a></p>
</form>
