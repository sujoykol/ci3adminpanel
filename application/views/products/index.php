<section class="content">
	<div class="container-fluid">
		<h2><?= $title ?></h2>
		<a href="<?= site_url('product-create') ?>" class="btn btn-primary mb-3">Add Product</a>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Category</th>
					<th>Price</th>
					<th>Detail</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($products as $p): ?>
					<tr>
						<td><?= $p->id ?></td>
						<td><?= $p->product_name ?></td>
						<td><?= $p->category_name ?></td>
						<td><?= $p->price ?></td>
						<td><?= $p->description ?></td>
						<td>
							<?php if ($p->image): ?>
								<img src="<?= base_url('uploads/products/thumbs/'.
     pathinfo($p->image, PATHINFO_FILENAME).
     '_thumb.'.
     pathinfo($p->image, PATHINFO_EXTENSION)); ?>"/>

							<?php endif; ?>
						</td>
						<td>
							<a href="<?= site_url('product/edit/' . $p->id) ?>" class="btn btn-sm btn-warning">Edit</a>
							<a href="<?= site_url('product/delete/' . $p->id) ?>" class="btn btn-sm btn-danger"
								onclick="return confirm('Are you sure?')">Delete</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?= $pagination ?>
	</div>
</section>
