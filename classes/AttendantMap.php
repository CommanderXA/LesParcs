<?php
    class AttendantMap extends BaseMap {
        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT user_id FROM attendant WHERE user_id = $id");
                $attendant = $res->fetchObject("Attendant");
                if ($attendant) {
                    return $attendant;
                }
            }
            return new Attendant();
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT attendant.user_id, user.username, user.firstname, user.patronymic, user.lastname, user.phone, "
                                    . " role.name AS role FROM attendant INNER JOIN user on attendant.user_id=user.user_id"
                                    . " INNER JOIN role ON user.role_id=role.role_id LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM attendant");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function save(User $user, Attendant $attendant) {
            if ($user->validate() && $attendant->validate() && (new UserMap())->save($user)) {
                if ($attendant->user_id == 0) {
                    $attendant->user_id = $user->user_id;
                    return $this->insert($attendant);
                } else {
                    return $this->update($attendant);
                }
            }
            return false;
        }

        private function insert(Attendant $attendant) {
            if ($this->db->exec("INSERT INTO attendant(user_id) VALUES($attendant->user_id)") == 1) {
                return true;
            }
            return false;
        }

        private function update(Attendant $attendant) {
            return true;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM attendant WHERE user_id=$id") == 1 && (new UserMap())->delete($id) == 1) {
                return true;
            }
            return false;
        }

        public function findProfileById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT attendant.user_id, user.username, user.firstname, user.patronymic, user.lastname, user.phone, user.address, role.name AS role FROM attendant INNER JOIN user on attendant.user_id=user.user_id INNER JOIN role on user.role_id=role.role_id WHERE attendant.user_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }
    }
?>