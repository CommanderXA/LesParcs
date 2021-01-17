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
    $plant = (new PlantMap())->findById($id);
    $header = (($id)?'Edit':'Add').' plant';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="list-plant.php">Plants</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-plant.php" method="POST">
        <div class="form-group">
            <label>Plant's Species</label>
            <select class="form-control" name="species_id">
                <?= Helper::printSelectOptions($plant->species_id, (new SpeciesMap())->arrSpecies());?>
            </select>
        </div>
        <div class="form-group">
            <label>Plant Age</label>
            <input type="number" class="form-control" name="plant_age" required="required" value="<?=$plant->plant_age;?>">
        </div>
        <div class="form-group">
            <label>Date Planted</label>
            <input type="date" class="form-control" name="date_planted" required="required" value="<?=$plant->date_planted;?>">
        </div>
        <div class="form-group">
            <label>Associated Zone</label>
            <select class="form-control" name="zone_id">
                <?= Helper::printSelectOptions($plant->zone_id, (new ZoneMap())->arrZones());?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="savePlant" class="btn btn-primary">Save</button>
        </div>
        <input type="hidden" name="plant_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>