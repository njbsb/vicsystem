<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Images</li>
</ol>
<hr>
<div class="card">
    <div class="card-body">
        <button data-toggle="modal" data-target="#createlink" class="btn btn-info"><i class='fab fa-edge'></i> New</button>
        <br>
        <br>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <td>No</td>
                    <td></td>
                    <td>File Name</td>
                    <td>Edit</td>
                </tr>
            </thead>
            <tbody class="table-active">
                <?php foreach ($images as $i => $image) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><img src="<?= $image['photo'] ?>" alt="" width="40" height="40"></td>
                    <td>
                        <?= $image['title'] ?>
                    </td>
                    <td><a href="<?= $image['photo'] ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class='fas fa-search'></i></a> <button data-toggle="modal"
                            data-id="<?= $image['id'] ?>" data-target="#editlink" data-name="<?= $image['title'] ?>" data-path="" class="btn btn-sm btn-outline-primary"><i
                                class='fas fa-pen'></i></button> <a data-toggle="modal" data-target="#deletelink" data-name="<?= $image['title'] ?>" data-id="<?= $image['id'] ?>" href=""
                            class="btn btn-sm btn-outline-primary"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>