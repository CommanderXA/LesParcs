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
    $zone = (new ZoneMap())->findById($id);
    $header = (($id)?'Edit':'Add').' zone';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="list-zone.php">Zones</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-zone.php" method="POST">
        <div class="form-group">
            <label>Zone</label>
            <input type="text" class="form-control" name="name" required="required" value="<?=$zone->name;?>">
        </div>
        <div class="form-group">
            <label>Park</label>
            <select class="form-control" name="park_id">
                <?= Helper::printSelectOptions($zone->park_id, (new ParkMap())->arrParks());?>
            </select>
        </div>
        <div class="form-group">
            <label>Block</label>
            <div class="radio">
                <label>
                    <input type="radio" name="active" value="1" <?=($zone->active)?'checked':'';?>> No
                </label> &nbsp;
                <label>
                    <input type="radio" name="active" value="0" <?=(!$zone->active)?'checked':'';?>> Yes
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="saveZone" class="btn btn-primary">Save</button>
        </div>
        <input type="hidden" name="zone_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>