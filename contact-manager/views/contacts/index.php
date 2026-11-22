<h2>Contacts</h2>
<?php if (is_logged_in()): ?><p><a class="btn" href="index.php?r=contacts/create">+ Add contact</a></p><?php endif; ?>
<table>
<tr><th>Name</th><th>Email</th><th>Phone</th><th>Created</th><?php if (is_logged_in()): ?><th>Actions</th><?php endif; ?></tr>
<?php foreach ($contacts as $c): ?>
<tr>
  <td><?= e($c['name']) ?></td>
  <td><?= e($c['email']) ?></td>
  <td><?= e($c['phone']) ?></td>
  <td><?= e($c['created_at']) ?></td>
  <?php if (is_logged_in()): ?>
  <td>
    <a href="index.php?r=contacts/edit&id=<?= (int) $c['id'] ?>">Edit</a>
    <form class="inline" method="post" action="index.php?r=contacts/delete&id=<?= (int) $c['id'] ?>"
          onsubmit="return confirm('Delete this contact?');">
      <?= csrf_field() ?><button>Delete</button>
    </form>
  </td>
  <?php endif; ?>
</tr>
<?php endforeach; ?>
<?php if (!$contacts): ?><tr><td colspan="5">No contacts yet.</td></tr><?php endif; ?>
</table>
