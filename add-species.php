<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $species = (new speciesMap())->findById($id);
    $header = (($id)?'Edit':'Add').' species';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="list-species.php">Species</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-species.php" method="POST">
        <div class="form-group">
            <label>Species Name</label>
            <input type="text" class="form-control" name="name" required="required" value="<?=$species->name;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="saveSpecies" class="btn btn-primary">Save</button>
        </div>
        <input type="hidden" name="species_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>