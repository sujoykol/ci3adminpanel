<section class="content">
	<div class="container-fluid">
	<h3><?php echo $title; ?></h3>

<a href="<?= base_url('index.php/sub-category/create') ?>" class="btn btn-primary">Add Sub Category</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($subcategories as $key => $row): ?>
        <tr>
            <td><?= ++$key ?></td>
            <td><?= $row->category_name ?></td>
            <td><?= $row->name ?></td>
            <td>
                <?php if ($row->status == 1): ?>
                    <a href="<?= base_url('subcategory/status/'.$row->id.'/0') ?>"
                       class="badge bg-success">Active</a>
                <?php else: ?>
                    <a href="<?= base_url('subcategory/status/'.$row->id.'/1') ?>"
                       class="badge bg-danger">Inactive</a>
                <?php endif; ?>
            </td>
            <td>
				 <a href="<?= base_url('index.php/sub-category/edit/'.$row->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="<?= base_url('index.php/sub-category/delete/'.$row->id) ?>"
                   onclick="return confirm('Delete?')"
                   class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
	</div>
</section>	
