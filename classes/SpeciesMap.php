<?php
    class SpeciesMap extends BaseMap {
        public function arrSpecies() {
            $res = $this->db->query("SELECT species_id AS id, name AS value FROM species");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function arrModes() {
            $res = $this->db->query("SELECT mode_id AS id, name AS value FROM mode");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT species_id, water_rate, name, mode_id FROM species WHERE species_id = $id");
                return $res->fetchObject("Species");
            }
            return new Species();
        }

        public function save(Species $species) {
            if ($species->validate()) {
                if ($species->species_id == 0) {
                    return $this->insert($species);
                } else {
                    return $this->update($species);
                }
            }
            return false;
        }

        private function insert(Species $species) {
            $name = $this->db->quote($species->name);
            if ($this->db->exec("INSERT INTO species(name, mode_id, water_rate) VALUES($name, $species->mode_id, $species->water_rate)") == 1) {
                $species->species_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Species $species) {
            $name = $this->db->quote($species->name);
            if ( $this->db->exec("UPDATE species SET name = $name, mode_id = $species->mode_id, water_rate = $species->water_rate WHERE species_id = ".$species->species_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM species WHERE species_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT species.species_id, species.name, species.water_rate, mode.name AS mode FROM species INNER JOIN mode ON species.mode_id=mode.mode_id ORDER BY name LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findInstances($id) {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM plant INNER JOIN species ON plant.species_id=species.species_id WHERE species.species_id=$id");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM species");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT species.species_id, species.name, species.water_rate, mode.name AS mode FROM species INNER JOIN mode ON species.mode_id=mode.mode_id WHERE species_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsSpeciesById($id) {
            $res = $this->db->query("SELECT species_id FROM species WHERE species_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>