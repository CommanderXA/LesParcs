<?php
    class ParkMap extends BaseMap {
        public function arrParks() {
            $res = $this->db->query("SELECT park_id AS id, name
                                    AS value FROM park");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT park_id, name FROM park WHERE park_id = $id");
                return $res->fetchObject("Park");
            }
            return new Park();
        }

        public function save(Park $park) {
            if ($park->validate()) {
                if ($park->park_id == 0) {
                    return $this->insert($park);
                } else {
                    return $this->update($park);
                }
            }
            return false;
        }

        private function insert(Park $park) {
            $name = $this->db->quote($park->name);
            if ($this->db->exec("INSERT INTO park(name, active)" . " VALUES($name, $park->active)") == 1) {
                $park->park_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Park $park) {
            $name = $this->db->quote($park->name);
            if ( $this->db->exec("UPDATE park SET name = $name, active = $park->active WHERE park_id = ".$park->park_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM park WHERE park_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT park.park_id, park.name" . " FROM park LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM park");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT park.park_id, park.name" . " FROM park WHERE park_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }
    }
?>