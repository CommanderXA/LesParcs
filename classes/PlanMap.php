<?php
    class PlanMap extends BaseMap {

        public function existsPlanByPlantId($id) {
            $res = $this->db->query("SELECT plan_id FROM plan WHERE plant_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>