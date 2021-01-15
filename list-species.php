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
    $speciesMap = new SpeciesMap();
    $count = $speciesMap->count();
    $speciess = $speciesMap->findAll($page*$size-$size, $size);
    $header = 'Species list';
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
                <a class="btn btn-success" href="add-species.php">Add species</a>
            </div>
            <div class="box-body">
                <?php
                    if ($speciess) {
                ?>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Species Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($speciess as $species) {
                                echo '<tr>';
                                echo '<td><a href="view-species.php?id='.$species->species_id.'">'.$species->name.'</a> ' . '<a href="add-species.php?id='.$species->species_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td><a href="delete-species.php?id='.$species->species_id.'"><i class="fa fa-trash"></i> Delete</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } else {
                    echo 'No species found';
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