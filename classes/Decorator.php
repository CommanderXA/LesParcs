<?php
    class Decorator extends Table {

        public $user_id = 0;
        public $graduation_id = 0;
        public $category_id = 0;
        public $educational_institution = '';

        public function validate() {
            if(!empty($this->graduation_id) &&
                !empty($this->category_id) &&
                !empty($this->educational_institution)) {
                return true;
            }
            return false;
        }
    }
?>