<section class="content">
	<div class="container-fluid">
	<h3><?php echo $title; ?></h3>

<a href="<?= base_url('index.php/customer/create') ?>" class="btn btn-primary">Add Customer</a>

<table class="table mt-3">
    <tr>
        <th>ID</th>
        <th>Name</th>
		<th>Email</th>
        <th>Status</th>
		<th>Image</th>
        <th>Action</th>
    </tr>

    <?php foreach ($customers as $customer): ?>
    <tr>
        <td><?= $customer->id ?></td>
        <td><?= $customer->name ?></td>
		<td><?= $customer->email ?></td>
        <td><?= $customer->status ? 'Active' : 'Inactive' ?></td>
		<td>
							<?php if ($customer->image): ?>
								<img src="<?= base_url('uploads/customers/'.$customer->image); ?>" width="100px"/>

							<?php endif; ?>
						</td>
        <td>
            <a href="<?= base_url('index.php/customer/edit/'.$customer->id) ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="<?= base_url('index.php/customer/delete/'.$customer->id) ?>"
               onclick="return confirm('Delete?')"
               class="btn btn-sm btn-danger">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

	</div>
</section>
