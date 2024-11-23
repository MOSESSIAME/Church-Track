<?php
session_start();
include('inc/config.php');
include('inc/classes/FollowUp.php');
include('inc/classes/User.php');
include('inc/navbar.php');

if ($_SESSION['role'] != 'team_member') {
    header("Location: unauthorized.php");
    exit();
}

// Initialize classes
$followUp = new FollowUp($pdo);
$user = new User($pdo);

// Handle form submission to log a follow-up
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    $team_member_id = $_POST['team_member_id'];
    $follow_up_date = $_POST['follow_up_date'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];
    $assignment_id = $_POST['assignment_id'];

    if ($followUp->logUpdate($member_id, $team_member_id, $follow_up_date, $status, $notes, $assignment_id)) {
        echo "Follow-up logged successfully!";
    } else {
        echo "Failed to log follow-up.";
    }
}

// Fetch all assignments, members, and users (for selecting in the form)
$assignments = $pdo->query("SELECT * FROM assignments")->fetchAll();
$members = $user->getAllMembers(); // Get all members
$team_members = $user->getAllTeamMembers(); // Add method to get team members if needed
?>

<h2>Log Follow-Up</h2>
<form method="post" action="">
    <label for="assignment_id">Assignment ID:</label>
    <select name="assignment_id">
        <?php foreach ($assignments as $assignment): ?>
            <option value="<?php echo $assignment['id']; ?>"><?php echo htmlspecialchars($assignment['id']); ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="member_id">Member ID:</label>
    <select name="member_id">
        <?php foreach ($members as $member): ?>
            <option value="<?php echo $member['id']; ?>"><?php echo htmlspecialchars($member['name']); ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="team_member_id">Team Member ID:</label>
    <select name="team_member_id">
        <?php foreach ($team_members as $team_member): ?>
            <option value="<?php echo $team_member['id']; ?>"><?php echo htmlspecialchars($team_member['name']); ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="follow_up_date">Follow-Up Date:</label>
    <input type="date" name="follow_up_date" required><br>

    <label for="status">Status:</label>
    <select name="status">
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
    </select><br>

    <label for="notes">Notes:</label>
    <textarea name="notes" required></textarea><br>

    <input type="submit" value="Log Follow-Up">
</form>
<?php include('inc/footer.php'); ?>