<?php
    require_once('Base.php');

    class Schedule extends Base {
        public function __construct()
        {
            parent::__construct();
        } 

        /**
         * 全スケジュール取得メソッド
         *
         * @param [type] $date
         * @return array
         */
        public function getScheduleAll($date)
        {
            $sql = '';
            $sql .= 'SELECT id, ';
            $sql .= 'schedule, ';
            $sql .= 'date, ';
            $sql .= 'is_deleted ';
            $sql .= 'FROM schedules ';
            $sql .= 'WHERE date=:date ';
            $sql .= 'AND is_deleted=0 ';

            $stmt = $this ->dbh ->prepare($sql);
            $stmt ->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt ->execute();
            $rec = $stmt ->fetchAll(PDO::FETCH_ASSOC);
            return $rec;
        } 

        /**
         * スケジュール取得メソッド
         *
         * @param [type] $id
         * @return array
         */
        public function getSchedule($id) {
            $sql = '';
            $sql .= 'SELECT id, ';
            $sql .= 'schedule, ';
            $sql .= 'date, ';
            $sql .= 'map ';
            $sql .= 'FROM schedules ';
            $sql .= 'WHERE id=:id ';

            $stmt = $this ->dbh ->prepare($sql);
            $stmt ->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt ->execute();
            $rec = $stmt ->fetch(PDO::FETCH_ASSOC);
            return $rec;
        }

        /**
         * スケジュール追加メソッド
         *
         * @param [type] $date
         * @param [type] $schedule
         * @return void
         */
        public function addSchedule($date, $schedule) {
            $sql = '';
            $sql .= 'INSERT INTO schedules ';
            $sql .= '( ';
            $sql .= 'schedule, ';
            $sql .= 'date ';
            $sql .= ') ';
            $sql .= 'VALUES ( ';
            $sql .= ':schedule, ';
            $sql .= ':date ';
            $sql .= ')';

            $stmt = $this ->dbh ->prepare($sql);
            $stmt ->bindValue(':schedule', $schedule, PDO::PARAM_STR);
            $stmt ->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt ->execute();
        }

        /**
         * スケジュール削除メソッド
         *
         * @param int $id
         * @return void
         */
        public function deleteSchedule($id) {
            $sql = '';
            $sql .= 'UPDATE schedules ';
            $sql .= 'SET is_deleted=1 ';
            $sql .= 'WHERE id=:id ';

            $stmt = $this ->dbh ->prepare($sql);
            $stmt ->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt ->execute();
        }


    }
?>