<?php
    class Zone extends Table {

        public $zone_id = 0;
        public $name = '';
        public $park_id = 0;
        public $active = 1;

        public function validate() {
            if(!empty($this->name) &&
                !empty($this->park_id) &&
                !empty($this->active)) {
                return true;
            }
            return false;
        }
    }
?>