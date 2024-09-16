<?php
// Path: inc/classes/Assignment.php
class Assignment {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Assign a team member to a visitor
    public function assign($team_member_id, $member_id) {
        $stmt = $this->pdo->prepare("INSERT INTO assignments (team_member_id, member_id) VALUES (?, ?)");
        return $stmt->execute([$team_member_id, $member_id]);
    }

    // Get all assignments for a specific team member
    public function getByTeamMember($team_member_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM assignments WHERE team_member_id = ?");
        $stmt->execute([$team_member_id]);
        return $stmt->fetchAll();
    }
}
?>
