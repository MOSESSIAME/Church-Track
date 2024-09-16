<?php
// Path: inc/classes/FollowUp.php
class FollowUp {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Log a follow-up update
    public function logUpdate($member_id, $team_member_id, $follow_up_date, $status, $notes, $assignment_id) {
        $stmt = $this->pdo->prepare("INSERT INTO follow_up (member_id, team_member_id, follow_up_date, status, notes, assignment_id) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$member_id, $team_member_id, $follow_up_date, $status, $notes, $assignment_id]);
    }

    // Get follow-ups for a specific assignment
    public function getByAssignment($assignment_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM follow_up WHERE assignment_id = ?");
        $stmt->execute([$assignment_id]);
        return $stmt->fetchAll();
    }
}
?>
