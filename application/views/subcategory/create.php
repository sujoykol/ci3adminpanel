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
        <label>Category</label>
        <select name="category_id" class="form-control">
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
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
