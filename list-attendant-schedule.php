<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $header = 'Schedules and Plans of Attendants';
    require_once 'template/header.php';
    $size = 5;
    if (isset($_GET['page'])) {
        $page = Helper::clearInt($_GET['page']);
    } else {
        $page = 1;
    }
    $count = (new AttendantMap())->count();
    $attendants = (new PlanMap())->findAttendants($page*$size-$size, $size);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1><?=$header;?></h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                    <li class="active"><?=$header;?></li>
                </ol>
            </section>
        <?php if ($attendants) : ?>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Number of points in the plan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($attendants as $attendant) : ?>
                    <tr>
                        <td><?=$attendant->full_name;?></td>
                        <td><?=$attendant->count_plan;?></td>
                        <td>
                            <a href="list-plan.php?id=<?=$attendant->user_id;?>" title="Attendant's plan"><i class="fa fa-table"></i></a>&nbsp;
                            <a href="list-schedule.php?id=<?=$attendant->user_id;?>" title="Attendant's schedule"><i class="fa fa-calendar-plus-o"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <div class="box-body">
            <?php Helper::paginator($count, $page, $size); ?>
        </div>
        <?php else: ?>
        <div class="box-body">
            <p>Attendants not found</p>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>