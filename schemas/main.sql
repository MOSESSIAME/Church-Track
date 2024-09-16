-- 1. Users table to store admin, team leaders, and team members
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'team_leader', 'team_member') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Members table to store church visitors and confirmed members, including physical address
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,  -- New column for physical address
    status ENUM('visitor', 'confirmed') DEFAULT 'visitor',
    first_visit DATE NOT NULL,
    confirmed_at DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Follow-up table to track follow-up progress
CREATE TABLE follow_up (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    team_member_id INT NOT NULL,
    follow_up_date DATE NOT NULL,
    notes TEXT,
    status ENUM('pending', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    assignment_id int(11) NOT NULL,
    FOREIGN KEY (member_id) REFERENCES members(id),
    FOREIGN KEY (team_member_id) REFERENCES users(id)
);

-- 4. Teams table to group team members under team leaders
CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    team_leader_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (team_leader_id) REFERENCES users(id)
);

-- 5. Assignments table to assign team members to visitors
CREATE TABLE assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_member_id INT NOT NULL,
    member_id INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (team_member_id) REFERENCES users(id),
    FOREIGN KEY (member_id) REFERENCES members(id)
);
