<section class="content">
	<div class="container-fluid">
<h3><?php echo $title; ?></h3>

<form method="post">
	<?= csrf_field(); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name"
               value="<?= $subcategory->name ?>"
               class="form-control" />
    </div>
	
	<div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
				<?php
				if($category->id == $subcategory->category_id) {
					$selected = 'selected';
				} else {
					$selected = '';
				}
				?>
                <option value="<?= $category->id ?>" <?= $selected ?>><?= $category->name ?></option>

            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1" <?= $subcategory->status ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= !$subcategory->status ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
	</div></section>
