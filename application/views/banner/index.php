<section class="content">
	<div class="container-fluid">
	<h3><?php echo $title; ?></h3>

<a href="<?= base_url('index.php/banner/create') ?>" class="btn btn-primary">Add Banner</a>

<table class="table mt-3">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
		<th>Image</th>
        <th>Action</th>
    </tr>

    <?php foreach ($banners as $banner): ?>
    <tr>
        <td><?= $banner->id ?></td>
        <td><?= $banner->name ?></td>
        <td><?= $banner->status ? 'Active' : 'Inactive' ?></td>
		<td>
							<?php if ($banner->image): ?>
								<img src="<?= base_url('uploads/banners/'.
     pathinfo($banner->image, PATHINFO_FILENAME).
     '.'.
     pathinfo($banner->image, PATHINFO_EXTENSION)); ?>" width="100px"/>

							<?php endif; ?>
						</td>
        <td>
            <a href="<?= base_url('index.php/banner/edit/'.$banner->id) ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="<?= base_url('index.php/banner/delete/'.$banner->id) ?>"
               onclick="return confirm('Delete?')"
               class="btn btn-sm btn-danger">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

	</div>
</section>
