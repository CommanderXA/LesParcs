<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new AttendantMap())->findById($id)) {
        $attendant = (new UserMap())->findProfileById($id);
    } else {
        header('Location: 404.php');
    }
    $header = "Attendant's plan: ".$attendant->full_name;
    $plans = (new PlanMap())->findByAttendantId($id);
    $i = 1;
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
        <section class="content-header">
            <h1><?=$header;?></h1>
            <ol class="breadcrumb">
                <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                <li><a href="list-attendant-schedule.php">Schedule</a></li>
                <li class="active"><?=$header;?></li>
            </ol>
        </section>
        <div class="box-body">
            <a class="btn btn-success" href="add-plan.php?id=<?=$id;?>">Add item of the plan</a>
        </div>
        <?php if (Helper::hasFlash()) :?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i>Error</h4>
                <?= Helper::getFlash();?>
            </div>
        <?php endif;?>
            <div class="box-body">
            <?php if ($plans) : ?>
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plant</th>
                        <th>Zone</th>
                        <th>Water Rate</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

            <?php foreach ($plans as $plan) : ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$plan->species;?></td>
                    <td><?=$plan->zone;?></td>
                    <td><?=$plan->water_rate;?> litres</td>
                    <td><a href="delete-plan.php?id=<?=$plan->plan_id;?>&idplan=<?=$id;?>"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php $i++; endforeach;?>
                    </tbody>
                </table>
            <?php else: ?>
            <p>Plan does not exist</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>