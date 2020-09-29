<h4><?= $title ?></h4>
<div class="form-group">
    <a class="btn btn-primary" href="<?= base_url() ?>category/create">Create Category</a>
</div>
<ul class="list-group">
    <?php foreach ($categories as $cat) : ?>
        <li class="list-group-item">
            <a href="<?php echo site_url('category/post') ?>"><?= $cat['category'] ?></a>
        </li>
    <?php endforeach ?>
</ul>