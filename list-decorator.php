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
    $decoratorMap = new DecoratorMap();
    $count = $decoratorMap->count();
    $decorators = $decoratorMap->findAll($page*$size-$size, $size);
    $header = 'Park Decorators';
    require_once 'template/header.php';
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <section class="content-header">
                <h1>Park Decorators</h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                    <li class="active">List of Decorators</li>
                </ol>
            </section>
            <div class="box-body">
                <a class="btn btn-success" href="add-decorator.php">Add Decorator</a>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
                <?php
                    if ($decorators) {
                ?>

                <table id="example2" class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Graduation</th>
                            <th>Category</th>
                            <th>Role</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php
                            foreach ($decorators as $decorator) {
                                echo '<tr>';
                                echo '<td><a href="profile-decorator.php?id='.$decorator->user_id.'">'.$decorator->username.'</a> ' . '<a href="add-decorator.php?id='.$decorator->user_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$decorator->firstname.'</td>';
                                echo '<td>'.$decorator->lastname.'</td>';
                                echo '<td>'.$decorator->graduation.'</td>';
                                echo '<td>'.$decorator->category.'</td>';
                                echo '<td>'.$decorator->role.'</td>';
                                echo '<td><a href="delete-user.php?id='.$decorator->user_id.'&role='.$decorator->role.'"><i class="fa fa-trash"></i> Delete</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php 
                    } else {
                        echo 'No decorators found';
                    } 
                ?>
                </div>
                <div class="box-body">
                    <?php Helper::paginator($count, $page, $size); ?>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
    </div>
<?php
    require_once 'template/footer.php';
?>