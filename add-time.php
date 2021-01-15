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
    $time = (new TimeMap())->findById($id);
    $header = (($id)?'Edit':'Add').' time';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="list-time.php">Watering Time List</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-time.php" method="POST">
        <div class="form-group">
            <label>Time</label>
            <input type="time" class="form-control" name="watering_time" required="required" value="<?=$time->watering_time;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="saveTime" class="btn btn-primary">Save</button>
        </div>
        <input type="hidden" name="watering_time_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>