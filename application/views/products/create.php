<section class="content">
	<div class="container-fluid">
		<h2>Add Product</h2>
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label>Price</label>
				<input type="number" step="0.01" name="price" class="form-control">
			</div>
			<div class="form-group">
				<label>Image</label>
				<input type="file" name="image" class="form-control">
			</div>
			<button class="btn btn-success">Save</button>
		</form>
	</div>
</section>