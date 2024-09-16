<?php
session_start();
include('inc/config.php');
include('inc/classes/User.php');
include('inc/navbar.php');

// Initialize the User class
$user = new User($pdo);

// Handle form submission to update member status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    
    if ($user->confirmMember($member_id)) {
        echo "Member status updated to confirmed!";
    } else {
        echo "Failed to update member status.";
    }
}

// Fetch all members
$members = $user->getAllMembers();
?>

<h2 class="section-title">Update Member Status</h2>
<form class="update-status-form" method="post" action="">
    <div class="form-group">
        <label for="member_id" class="form-label">Member Name:</label>
        <select name="member_id" class="form-select">
            <?php foreach ($members as $member): ?>
                <option value="<?php echo $member['id']; ?>"><?php echo htmlspecialchars($member['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" class="submit-btn" value="Update Status">
</form>
