<?php
    class PlanMap extends BaseMap {

        public function existsPlan(Plan $plan) {
            $res = $this->db->query("SELECT plan_id FROM plan WHERE plant_id = $plan->plant_id AND user_id = $plan->user_id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function save(Plan $plan) {
            if ($this->db->exec("INSERT INTO plan(plant_id, user_id)"
                                . " VALUES($plan->plant_id,$plan->user_id)") == 1) {
                return true;
            }
            return false;
        }

        public function findByAttendantId($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT plan.plan_id, species.name AS species, zone.name AS zone "
                                        . "FROM plan INNER JOIN plant ON plan.plant_id=plant.plant_id "
                                        . "INNER JOIN species ON plant.species_id=species.species_id "
                                        . "INNER JOIN zone ON plant.zone_id=zone.zone_id WHERE plan.user_id=$id");
                return $res->fetchAll(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM plan WHERE plan_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAttendants($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.firstname,' ', user.lastname) AS full_name,"
                                    . " COUNT(plan.plant_id) AS count_plan "
                                    . "FROM user INNER JOIN attendant ON user.user_id=attendant.user_id "
                                    . "LEFT OUTER JOIN plan ON attendant.user_id=plan.user_id "
                                    . "LEFT OUTER JOIN plant ON plan.plant_id=plant.plant_id GROUP BY user.user_id "
                                    . "LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function arrPlanByAttendantId($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT plan.plan_id AS id, CONCAT(gruppa.name,' -> ',subject.name) AS value"
                . " FROM plan INNER JOIN gruppa ON plan.gruppa_id=gruppa.gruppa_id "
                . "INNER JOIN subject ON plan.subject_id=subject.subject_id "
                . "WHERE plan.user_id=$id ORDER BY gruppa.name, subject.name");
                return $res->fetchAll(PDO::FETCH_ASSOC);
            }
            return [];
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT plan_id, plant_id, user_id FROM plan WHERE plan_id=$id");
                return $res->fetchObject('Plan');
            }
            return false;
        }

        public function existsPlanByPlantId($id) {
            $res = $this->db->query("SELECT plan_id FROM plan WHERE plant_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>