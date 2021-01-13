<?php
    class Plant extends Table {

        public $species_id = 0;
        public $name = '';

        public function validate() {
            if(!empty($this->name)) {
                return true;
            }
            return false;
        }
    }
?>