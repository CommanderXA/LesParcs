<?php
    class Park extends Table {

        public $park_id = 0;
        public $name = '';
        public $active = 1;

        public function validate() {
            if(!empty($this->name)) {
                return true;
            }
            return false;
        }
    }
?>