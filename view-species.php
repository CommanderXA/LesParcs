<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
        $species = (new SpeciesMap())->findViewById($id);
        $header = 'Species View';
        require_once 'template/header.php';
?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <section class="content-header">
                        <h1><?=$header;?></h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                            <li><a href="list-species.php">Species</a></li>
                            <li class="active"><?=$header;?></li>
                        </ol>
                    </section>
                    <div class="box-body">
                        <a class="btn btn-success" href="add-species.php?id=<?=$id;?>">Change</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Species Name</th>
                                <td><?=$species->name;?></td>
                            </tr>
                            <tr>
                                <th>Watering mode</th>
                                <td><?=$species->mode;?></td>
                            </tr>
                            <tr>
                                <th>Water rate</th>
                                <td><?=$species->water_rate;?> liters</td>
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