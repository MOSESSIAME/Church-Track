<?php
// Path: inc/classes/Team.php
class Team {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new team
    public function create($name, $team_leader_id) {
        $stmt = $this->pdo->prepare("INSERT INTO teams (name, team_leader_id) VALUES (?, ?)");
        return $stmt->execute([$name, $team_leader_id]);
    }

    // Get all teams
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM teams");
        return $stmt->fetchAll();
    }

    // Get a specific team by ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM teams WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>
