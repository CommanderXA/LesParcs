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
    $plantMap = new PlantMap();
    $count = $plantMap->count();
    $plants = $plantMap->findAll($page*$size-$size, $size);
    $header = 'Plants of the Parks';
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
                <a class="btn btn-success" href="add-plant.php">Add plant</a>
            </div>
            <?php if (Helper::hasFlash()) :?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Error</h4>
                <?= Helper::getFlash();?>
            </div>
            <?php endif;?>
            <div class="box-body">
                <?php
                    if ($plants) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Plant's Species</th>
                            <th>Plant's Age</th>
                            <th>Date Planted</th>
                            <th>Associated Zone</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($plants as $plant) {
                                echo '<tr>';
                                echo '<td><a href="view-plant.php?id='.$plant->plant_id.'">'.$plant->species.'</a> ' . '<a href="add-plant.php?id='.$plant->plant_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$plant->plant_age.' years</td>';
                                echo '<td>'.$plant->date_planted.'</td>';
                                echo '<td>'.$plant->zone.'</td>';
                                echo '<td><a href="delete-plant.php?id='.$plant->plant_id.'"><i class="fa fa-trash"></i> Delete</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'No plants found';
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