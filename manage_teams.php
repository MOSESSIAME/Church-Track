<?php
session_start();
include('inc/config.php');
include('inc/classes/Team.php');
include('inc/navbar.php');

// Initialize the Team class
$team = new Team($pdo);

// Handle form submission to create a new team
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $team_leader_id = $_POST['team_leader_id'];
    
    if ($team->create($name, $team_leader_id)) {
        echo "Team created successfully!";
    } else {
        echo "Failed to create team.";
    }
}

// Display all teams
$teams = $team->getAll();
?>

<section class="team_page">
    <div class="team_form">
        <h2 class="section-title">Manage Teams</h2>
    
        <form method="post" action="" class="team-form">
            <div class="form-group">
                <label for="name" class="form-label">Team Name:</label>
                <input type="text" name="name" class="form-input" required>
            </div>
    
            <div class="form-group">
                <label for="team_leader_id" class="form-label">Team Leader ID:</label>
                <input type="number" name="team_leader_id" class="form-input" required>
            </div>
    
            <input type="submit" value="Create Team" class="submit-btn">
        </form>
    </div>

    <div class="existing_team">
        <h3 class="section-subtitle">Existing Teams</h3>
        <ul class="team-list">
            <?php foreach ($teams as $team): ?>
                <li class="team-item"><?php echo htmlspecialchars($team['name']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>


<?php include('inc/footer.php'); ?>