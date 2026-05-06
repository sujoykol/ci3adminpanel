<section class="content">
	<div class="container-fluid">
<h3>Edit Category</h3>

<form method="post">
	<?= csrf_field(); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name"
               value="<?= $category->name ?>"
               class="form-control" />
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1" <?= $category->status ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= !$category->status ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
	</div></section>
