<section class="content">
	<div class="container-fluid">
<h3>Add Category</h3>

<form method="post">
	<?= csrf_field(); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" >
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <button class="btn btn-success">Save</button>
</form>
	</div></section>
