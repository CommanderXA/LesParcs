<?php
    class Species extends Table {

        public $species_id = 0;
        public $name = '';
        public $mode_id = 0;
        public $water_rate = 0;

        public function validate() {
            if(!empty($this->name) &&
                !empty($this->mode_id) &&
                !empty($this->water_rate)) {
                return true;
            }
            return false;
        }
    }
?>