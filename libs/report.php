<?php

class Report extends Database {

    protected $database;

    function __construct($db) {
        if ($db == null) {
            $this->database = new Database();
        } else {
            $this->database = $db;
        }
        $this->user = new User($this->database);
    }

    public function getReportCount($state = 'pending') {
        $count = $this->database->getCount('g0g1_report_log', array('state' => "$state"));
        return $count;
    }

    public function getReportReasons($type = null) {
        if ($type != null) {
            $query = "SELECT * from g0g1_report_reason WHERE type_id='$type'";
        } else {
            $query = "SELECT * from g0g1_report_reason";
        }
        $row = $this->database->query($query);
        $result = $row->fetchAll();
        return $result;
    }

    //Stores report in database using data supplied within parameters
    //Parameters are $report, being an array containing logging information (userid etc)
    public function logReport($report) {
        $type = $report['type'];
        $content_id = $report['content_id'];
        $reporter = $report['reporter'];
        $reason = $report['reason'];
        $evidence = $report['evidence'];
        $comments = $report['comments'];
        $time = time();
        $query = "INSERT INTO g0g1_report_log (id, state, type, content_id, reporter, reason, evidence, comments, time) VALUES ('', 'pending', '$type', '$content_id', '$reporter', '$reason', '$evidence', '$comments', '$time')";
        $this->database->query($query);
    }

    //Returns name of type based on supplied ID
    public function typeIdToName($id) {
        $query = "SELECT name FROM g0g1_report WHERE type_id='$id'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        return $result[0];
    }

    public function reasonIdToName($id) {
        $query = "SELECT name FROM g0g1_report_reason WHERE id='$id'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        return $result[0];
    }

    /**
     * Gets reports based on variety of conditions.
     * @param $page the page in which is being viewed, each page may contain reports.
     * @param $count the maximum number of records to list per page
     * @param $state the review state of report, 1=reviewed, 0=needs moderation.
     * @param $type the type of reports to get. Such as image reports/writing/user/etc
     * @param $reason the reason content was reported. Makes it easier to locate urgent reports.
     * @return Associative array.
     */
    public function getReports($page = 1, $count = 10, $state = 'pending', $type, $reason) {
        $results = $this->database->getByPage('g0g1_report_log', array('id', 'state', 'type', 'content_id', 'reporter', 'reason', 'evidence', 'comments', 'time'), array('state' => $state, 'type' => $type, 'reason' => $reason), 'time', $page, $count);
        for ($c = 0; $c < sizeof($results); $c++) {
            $results[$c]['type'] = $this->typeIdToName($results[$c]['type']);
            $results[$c]['reporter'] = $this->user->getNameFromId($results[$c]['reporter']);
            $results[$c]['reason'] = $this->reasonIdToName($results[$c]['reason']);
        }
        return $results;
    }

    public function getReportDetail($id) {
        $result = $this->database->getRow('g0g1_report_log', array('id', 'state', 'type', 'content_id', 'reporter', 'reason', 'evidence', 'comments', 'time'), array('id' => $id));
        print_r($result);
        $result['type'] = $this->typeIdToName($result['type']);
        $result['reason'] = $this->reasonIdToName($result['reason']);
        $result['time'] = date('g:m M d Y', $result['time']);
        $result['reporter'] = $this->user->getNameFromId($result['reporter']);
        return $result;
    }

    public function setReportState($id, $state) {
        $query = "UPDATE g0g1_report_log SET state='$state' WHERE id='$id'";
        $this->database->query($query);
    }

}

?>
