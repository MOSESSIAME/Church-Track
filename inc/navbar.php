<!-- navbar.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css"> <!-- Link to external CSS -->
    <title>Church Track</title>
</head>
<body>
    <div class="navbar">
        <!-- <div class="navbar-left"> -->
            <div class="logo">
                <img src="css/Image1.png" alt="Logo">
                <h2>Church Track</h2>
            </div>
            <ul class="navbar-menu">
                <?php
                    if ($_SESSION['role'] == 'team_member') {
                        echo '
                            <li><a href="/church/dashboard.php">Dashboard</a></li>
                            <li><a href="/church/log_followup.php">Follow-up</a></li>
                            <li><a href="/church/update_status.php">Status</a></li>
                            <li><a href="/church/follow_up_report.php">Follow-Up Report</a></li>
                        ';
                    } else if ($_SESSION['role'] == 'team_leader') {
                        echo '
                            <li><a href="/church/dashboard.php">Dashboard</a></li>
                            <li><a href="/church/assign_members.php">Assignment</a></li>
                            <li><a href="/church/add_visitor.php">Add Visitor</a></li>
                            <li><a href="/church/follow_up_report.php">Follow-Up Report</a></li>
                        ';
                    } else {
                        echo '
                            <li><a href="/church/dashboard.php">Dashboard</a></li>
                            <li><a href="/church/register.php">Registration</a></li>
                            <li><a href="/church/manage_teams.php">Teams</a></li>
                            <li><a href="/church/request.php">Requests</a></li>
                        ';
                    }
                ?>
                <li><a href="/church/logout.php">Logout</a></li>
            </ul>
        <!-- </div> -->
        <!-- <div class="navbar-right"> -->
            <div class="user-profile">
                <!-- <img src="images/profile-pic.png" alt="Profile Picture"> -->
                <span class="username"><?php echo $_SESSION['name']; ?></span>
            </div>
        <!-- </div> -->
    </div>
</body>
</html>
