<?php
session_start();
include('inc/config.php');
include('inc/classes/FollowUpReport.php');
include('inc/classes/User.php');
include('inc/navbar.php');


// Initialize the FollowUpReport and User classes
$followUpReport = new FollowUpReport($pdo);
$user = new User($pdo);

// Fetch filters if applied
$team_member_id = isset($_GET['team_member_id']) ? $_GET['team_member_id'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : null;
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : null;

// Fetch all team members for the filter dropdown
$team_members = $user->getAllTeamMembers();

// Fetch follow-up data with optional filters
$followUps = $followUpReport->getFilteredFollowUps($team_member_id, $status, $date_from, $date_to);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Follow-Up Report</title>
</head>
<body>
    <h1>Follow-Up Report</h1>

    <!-- Filter Form -->
    <form method="get" action="follow_up_report.php">
        <label for="team_member_id">Team Member:</label>
        <select name="team_member_id">
            <option value="">-- All --</option>
            <?php foreach ($team_members as $team_member): ?>
                <option value="<?php echo $team_member['id']; ?>" 
                    <?php echo $team_member['id'] == $team_member_id ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($team_member['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="status">Status:</label>
        <select name="status">
            <option value="">-- All --</option>
            <option value="pending" <?php echo $status == 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="completed" <?php echo $status == 'completed' ? 'selected' : ''; ?>>Completed</option>
        </select>

        <label for="date_from">Date From:</label>
        <input type="date" name="date_from" value="<?php echo htmlspecialchars($date_from); ?>">

        <label for="date_to">Date To:</label>
        <input type="date" name="date_to" value="<?php echo htmlspecialchars($date_to); ?>">

        <button type="submit">Filter</button>
    </form>

    <!-- Follow-Up Table -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Member Name</th>
                <th>Team Member</th>
                <th>Follow-Up Date</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($followUps) > 0): ?>
                <?php foreach ($followUps as $followUp): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($followUp['id']); ?></td>
                        <td><?php echo htmlspecialchars($followUp['member_name']); ?></td>
                        <td><?php echo htmlspecialchars($followUp['team_member_name']); ?></td>
                        <td><?php echo htmlspecialchars($followUp['follow_up_date']); ?></td>
                        <td><?php echo htmlspecialchars($followUp['status']); ?></td>
                        <td><?php echo htmlspecialchars($followUp['notes']); ?></td>
                        <td><?php echo htmlspecialchars($followUp['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No follow-up records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php include('inc/footer.php'); ?>
</body>
</html>
