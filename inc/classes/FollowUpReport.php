<?php
class FollowUpReport {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get filtered follow-up records
    public function getFilteredFollowUps($team_member_id = null, $status = null, $date_from = null, $date_to = null) {
        $query = "SELECT f.*, 
                         m.name AS member_name, 
                         u.name AS team_member_name 
                  FROM follow_up f
                  JOIN members m ON f.member_id = m.id
                  JOIN users u ON f.team_member_id = u.id
                  WHERE 1";

        $params = [];

        if ($team_member_id) {
            $query .= " AND f.team_member_id = ?";
            $params[] = $team_member_id;
        }

        if ($status) {
            $query .= " AND f.status = ?";
            $params[] = $status;
        }

        if ($date_from) {
            $query .= " AND f.follow_up_date >= ?";
            $params[] = $date_from;
        }

        if ($date_to) {
            $query .= " AND f.follow_up_date <= ?";
            $params[] = $date_to;
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
