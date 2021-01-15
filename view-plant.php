<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
        $plant = (new PlantMap())->findViewById($id);
        $header = 'plants';
        require_once 'template/header.php';
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <section class="content-header">
                        <h1><?=$header;?></h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                            <li><a href="list-plant.php">Plants</a></li>
                            <li class="active"><?=$header;?></li>
                        </ol>
                    </section>
                    <div class="box-body">
                        <a class="btn btn-success" href="add-plant.php?id=<?=$id;?>">Change</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Plant's Species</th>
                                <td><?=$plant->species;?></td>
                            </tr>
                            <tr>
                                <th>Plant's Age</th>
                                <td><?=$plant->plant_age;?> years</td>
                            </tr>
                            <tr>
                                <th>Date Planted</th>
                                <td><?=$plant->date_planted;?></td>
                            </tr>
                            <tr>
                                <th>Zone Associated</th>
                                <td><?=$plant->zone;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    require_once 'template/footer.php';
?>