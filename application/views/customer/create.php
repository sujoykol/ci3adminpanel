<section class="content">
	<div class="container-fluid">
<h3><?=$title ?></h3>

<form method="post" enctype="multipart/form-data">
	<?= csrf_field(); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" >
    </div>
	 <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" >
    </div>
	 <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" class="form-control" >
    </div>
	<div class="form-group">
				<label>Image</label>
				<input type="file" name="image" class="form-control">
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
