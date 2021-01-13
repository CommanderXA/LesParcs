<?php
    class WateringMode extends Table {

        public $watering_mode_id = 0;
        public $name = '';
        public $species_id = 0;

        public function validate() {
            if(!empty($this->name) &&
                !empty($this->species_id)) {
                return true;
            }
            return false;
        }
    }
?>