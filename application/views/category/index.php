<h4><?= $title ?></h4>
<div class="form-group">
    <a class="btn btn-dark" href="<?= base_url() ?>category/create">Create Category</a>
</div>
<ul class="list-group">
    <?php foreach ($categories as $cat) : ?>
        <li class="list-group-item">
            <a href="<?= site_url('category/comments/' . $cat['id']) ?>"><?= $cat['category'] ?></a>
        </li>
    <?php endforeach ?>
</ul>