<?php
session_start();
include('inc/config.php');
include('inc/classes/Assignment.php');
include('inc/classes/User.php');
include('inc/navbar.php');


// Initialize the Assignment class
$assignment = new Assignment($pdo);
$user = new User($pdo);

// Handle form submission to assign a team member to a visitor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team_member_id = $_POST['team_member_id'];
    $member_id = $_POST['member_id'];
    
    if ($assignment->assign($team_member_id, $member_id)) {
        echo "Member assigned successfully!";
    } else {
        echo "Failed to assign member.";
    }
}

// Fetch all users and members
$users = $user->findAll(); // Get all users
$members = $user->getAllMembers(); // Get all members
?>

<h2 class="section-title">Assign Team Members</h2>
<form class="assign-team-form" method="post" action="">
    <div class="form-group">
        <label for="team_member_id" class="form-label">Team Member ID:</label>
        <select name="team_member_id" class="form-select">
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="member_id" class="form-label">Visitor ID:</label>
        <select name="member_id" class="form-select">
            <?php foreach ($members as $member): ?>
                <option value="<?php echo $member['id']; ?>"><?php echo htmlspecialchars($member['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" class="submit-btn" value="Assign">
</form>
