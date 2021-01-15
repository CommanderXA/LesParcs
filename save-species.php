<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['species_id'])) {
        $species = new Species();
        $species->species_id = Helper::clearInt($_POST['species_id']);
        $species->name = Helper::clearString($_POST['name']);
        if ((new SpeciesMap())->save($species)) {
            header('Location: view-species.php?id='.$species->species_id);
        } else {
            if ($species->species_id) {
                header('Location: add-species.php?id='.$species->species_id);
            } else {
                header('Location: add-species.php');
            }
        }
    }
?>