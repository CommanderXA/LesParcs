<?php
    class PlantMap extends BaseMap {
        public function arrPlants() {
            $res = $this->db->query("SELECT plant_id AS id, species AS value FROM plant INNER JOIN species ON plant.species_id=species.species_id");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT plant_id AS id, plant_age, date_planted, species.name AS species FROM plant INNER JOIN species ON plant.species_id=species.species_id WHERE plant_id = $id");
                return $res->fetchObject("Plant");
            }
            return new Plant();
        }

        public function save(Plant $plant) {
            if ($plant->validate()) {
                if ($plant->plant_id == 0) {
                    return $this->insert($plant);
                } else {
                    return $this->update($plant);
                }
            }
            return false;
        }

        private function insert(Plant $plant) {
            $date_planted = $this->db->quote($plant->date_planted);
            if ($this->db->exec("INSERT INTO plant(species_id, zone_id, plant_age, date_planted)" . " VALUES($plant->species_id, $plant->zone_id, $plant->plant_age, $date_planted)") == 1) {
                $plant->plant_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Plant $plant) {
            $date_planted = $this->db->quote($plant->date_planted);
            if ( $this->db->exec("UPDATE plant SET species_id = $plant->species_id, zone_id = $plant->zone_id, plant_age = $plant->plant_age, date_planted = $date_planted WHERE plant_id = ".$plant->plant_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM plant WHERE plant_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT plant.plant_id, plant.plant_age, plant.date_planted, species.name AS species, zone.name AS zone FROM plant INNER JOIN species ON plant.species_id=species.species_id INNER JOIN zone ON plant.zone_id=zone.zone_id LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM plant");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT plant.plant_id, plant.plant_age, plant.date_planted, species.name AS species, zone.name AS zone FROM plant INNER JOIN species ON plant.species_id=species.species_id INNER JOIN zone ON plant.zone_id=zone.zone_id WHERE plant_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsPlantByZoneId($id) {
            $res = $this->db->query("SELECT plant_id FROM plant WHERE zone_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsPlantById($id) {
            $res = $this->db->query("SELECT plant_id FROM plant WHERE plant_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>