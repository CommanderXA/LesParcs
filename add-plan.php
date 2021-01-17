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
    if ((new AttendantMap())->findById($id)) {
        $plan = (new UserMap())->findProfileById($id);
    } else {
        header('Location: 404.php');
    }
    $header = 'Add item to plan : '.$plan->full_name;
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="list-attendant-schedule.php">Schedule</a></li>
        <li><a href="list-plan.php?id=<?=$id;?>">Attendant's Plan</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
<?php if (Helper::hasFlash()) :?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Error</h4>
        <?= Helper::getFlash();?>
    </div>
<?php endif;?>
    <form action="save-plan.php" method="POST">
        <div class="form-group">
            <label>Plant</label>
            <select class="form-control" name="plant_id">
                <?= Helper::printSelectOptions($plan->plant_id, (new PlantMap())->arrPlants());?>
            </select>
        </div>
        <input type="hidden" name="user_id" value="<?=$id;?>" />
        <div class="form-group">
            <button type="submit" name="savePlan" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>