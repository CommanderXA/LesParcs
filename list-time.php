<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $size = 10;
    if (isset($_GET['page'])) {
        $page = Helper::clearInt($_GET['page']);
    } else {
        $page = 1;
    }
    $timeMap = new TimeMap();
    $count = $timeMap->count();
    $times = $timeMap->findAll($page*$size-$size, $size);
    $header = 'Watering time list';
    require_once 'template/header.php';
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
            <div class="box-body">
                <a class="btn btn-success" href="add-time.php">Add a watering time</a>
            </div>
            <div class="box-body">
                <?php
                    if ($times) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($times as $time) {
                                echo '<tr>';
                                echo '<td><a href="view-time.php?id='.$time->watering_time_id.'">'.$time->watering_time.'</a> ' . '<a href="add-time.php?id='.$time->watering_time_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td><a href="delete-time.php?id='.$time->watering_time_id.'"><i class="fa fa-trash"></i> Delete</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'No watering time found';
                } ?>
            </div>
            <div class="box-body">
                <?php Helper::paginator($count, $page, $size); ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>