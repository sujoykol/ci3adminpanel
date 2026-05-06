<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title"><?= $title ?></h3>
	</div>
	<div class="card-body">
		<form method="post">
			<?= csrf_field(); ?>
			<input type="password" class="form-control" name="current_password" placeholder="Current Password" required><br>
			<input type="password" class="form-control" name="new_password" placeholder="New Password" required><br>
			<input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password" required><br>
			<button type="submit" class="btn btn-primary btn-block">Change</button>
		</form>
	</div>
</div>
