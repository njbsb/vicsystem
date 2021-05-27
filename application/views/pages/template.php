<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active"><?= $title ?></li>
</ol>

<h4><?= $title ?></h4>

<?php foreach ($templates as $template) : ?>
<li><a href=""><?= $template['name'] ?></a></li>
<?php endforeach ?>