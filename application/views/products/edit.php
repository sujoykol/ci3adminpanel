<section class="content">
	<div class="container-fluid">
		<h2><?= $title ?></h2>
		<form method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" value="<?= $product->name ?>" class="form-control">
			</div>
			<div class="form-group">
				<label>Category</label>
				<select name="category" class="form-control">
					<option value="">Select Category</option>
					<?php foreach ($all_category as $category): ?>
						<option value="<?= $category->id ?>" <?= $category->id == $product->catid ? 'selected' : '' ?>>
							<?= $category->name ?>
						</option>
					<?php endforeach; ?>
				</select>
			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control"><?= $product->description ?></textarea>
			</div>
			<div class="form-group">
				<label>Price</label>
				<input type="number" step="0.01" name="price" value="<?= $product->price ?>" class="form-control">
			</div>
			<div class="form-group">
				<label>Image</label><br>
				<?php if ($product->image): ?>
					<img src="<?= base_url('uploads/products/' . $product->image) ?>" width="80"><br><br>
				<?php endif; ?>
				<input type="file" name="image" class="form-control">
			</div>
			<button class="btn btn-primary">Update</button>
		</form>
	</div>
</section>
