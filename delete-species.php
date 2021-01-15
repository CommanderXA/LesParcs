<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    (new SpeciesMap())->delete($id);
    if ((new SpeciesMap())->existsSpeciesById($id) || !(new SpeciesMap())->delete($id)) {
        Helper::setFlash('Could not delete the species (An error occured).');
    }
    header('Location: list-species.php');
?>