<?php
    class Plant extends Table {

        public $plant_id = 0;
        public $plant_age = 0;
        public $date_planted = null;
        public $zone_id = 0;
        public $species_id = 0;
        public $active = 1;

        public function validate() {
            if(!empty($this->name) &&
                !empty($this->plant_age) &&
                !empty($this->date_planted) &&
                !empty($this->zone_id) &&
                !empty($this->species_id) &&
                !empty($this->active)) {
                return true;
            }
            return false;
        }
    }
?>