<?php
// inc/User.php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new user (admin, team leader, or team member)
    public function create($name, $email, $password, $role) {
        $hashedPassword = password_hash(trim($password), PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hashedPassword, $role]);
    }

    // Check if user exists by email
    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
    
        // Debugging output
        if (!$user) {
            echo "No user found with email: $email";
        }
    
        return $user;
    }    

    // Validate user login
    public function login($email, $password) {
        $user = $this->findByEmail($email);

        // Check if the user was found
        if (!$user) {
            echo "User not found!";
            return false;
        }
    
        // Debugging output for password comparison
        $harsh = $user['password'];
        
        if (password_verify($password, $harsh)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            return true;
        } else {
            echo "Password does not match!";
            return false;
        }
    }

    // Fetch all users (admins, team leaders, and team members)
    public function findAll() {
        $stmt = $this->pdo->query("SELECT id, name FROM users");
        return $stmt->fetchAll();
    }

    // Add a new member (visitor)
    public function addMember($name, $email, $phone, $physical_address) {
        $stmt = $this->pdo->prepare("INSERT INTO members (name, email, phone, address, status) VALUES (?, ?, ?, ?, 'visitor')");
        return $stmt->execute([$name, $email, $phone, $physical_address]);
    }

    // Fetch all members (visitors and confirmed)
    public function getAllMembers() {
        $stmt = $this->pdo->query("SELECT id, name, phone FROM members");
        return $stmt->fetchAll();
    }

    // get all team members
    public function getAllTeamMembers() {
        $stmt = $this->pdo->query("SELECT id, name FROM users WHERE role = 'team_member'");
        return $stmt->fetchAll();
    }
    

    // Update visitor status to confirmed member
    public function confirmMember($member_id) {
        $stmt = $this->pdo->prepare("UPDATE members SET status = 'confirmed' WHERE id = ?");
        return $stmt->execute([$member_id]);
    }

}
?>
