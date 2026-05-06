<section class="content">
	<div class="container-fluid">
	<h3><?php echo $title; ?></h3>

<a href="<?= base_url('index.php/category/create') ?>" class="btn btn-primary">Add Category</a>

<table class="table mt-3">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($categories as $cat): ?>
    <tr>
        <td><?= $cat->id ?></td>
        <td><?= $cat->name ?></td>
        <td><?= $cat->status ? 'Active' : 'Inactive' ?></td>
        <td>
            <a href="<?= base_url('index.php/category/edit/'.$cat->id) ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="<?= base_url('index.php/category/delete/'.$cat->id) ?>"
               onclick="return confirm('Delete?')"
               class="btn btn-sm btn-danger">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

	</div>
</section>
