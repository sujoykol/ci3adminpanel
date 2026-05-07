<section class="content">
	<div class="container-fluid">
<h3><?=$title ?></h3>

<form method="post" enctype="multipart/form-data">
	<?= csrf_field(); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name"
               value="<?= $customer->name ?>"
               class="form-control" />
    </div>
	<div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?= $customer->email ?>" >
    </div>
	 <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="<?= $customer->address ?>">
    </div>
	
	<div class="form-group">
				<label>Image</label>
				<?php if ($customer->image): ?>
					<img src="<?= base_url('uploads/customers/' . $customer->image) ?>" width="80"><br><br>
				<?php endif; ?>
				<input type="file" name="image" class="form-control">
			</div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1" <?= $customer->status ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= !$customer->status ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
	</div></section>
