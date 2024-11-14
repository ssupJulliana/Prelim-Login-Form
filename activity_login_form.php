<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $selected_role = $_POST['role'] ?? '';

    // Predefined static accounts (User roles with predefined accounts)
    $accounts = [
        'Admin' => [
            ['username' => 'admin', 'password' => 'Pass1234'],
            ['username' => 'renmark', 'password' => 'Pogi1234']
        ],
        'Content Manager' => [
            ['username' => 'pepito', 'password' => 'manaloto'],
            ['username' => 'juan', 'password' => 'Delacruz']
        ],
        'System User' => [
            ['username' => 'pedro', 'password' => 'penduko']
        ]
    ];

    $authenticated = false;
    $error_message = ''; // Variable to hold error message
    $success_message = ''; // Variable to hold success message

    // Loop through all roles and check for matching username, password, and role
    foreach ($accounts as $role_name => $users) {
        // If the selected role matches the role in the array
        if ($role_name === $selected_role) {
            foreach ($users as $user) {
                // Check if both username and password match
                if ($user['username'] === $username && $user['password'] === $password) {
                    $authenticated = true;
                    $success_message = "Welcome to the system: $username"; // Success message
                    break 2; // Exit both loops when a match is found
                }
            }
        }
    }

    // If authentication fails or incorrect credentials
    if (!$authenticated) {
        $error_message = 'Invalid Username/Password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/activity_login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/style.css">
    
    
    <script>
        // Function to close the alert
        function closeAlert(alertId) {
            var alert = document.getElementById(alertId);
            alert.style.display = 'none'; // Hides the alert box
        }
    </script>
</head>
<body>

    <!-- Error Alert for Invalid Credentials -->
    <?php if (!empty($error_message)): ?>
        <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?php echo $error_message; ?></strong>
            <button type="button" class="close" onclick="closeAlert('error-alert')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Success Alert for Correct Credentials -->
    <?php if (!empty($success_message)): ?>
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $success_message; ?></strong>
            <button type="button" class="close" onclick="closeAlert('success-alert')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Login Box Container -->
    <div class="login-container">
        <!-- Login Box -->
        <div class="login-box">
            <!-- Profile Image -->
            <div class="profile-box">
                <img src="img/activityprofile.png" alt="Profile Picture">
            </div>

            <!-- Form -->
            <form action="" method="POST">
                <!-- Role Dropdown -->
                <select name="role" id="role" class="form-control mb-3">
                    <option value="Admin" <?php echo (isset($selected_role) && $selected_role === 'Admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="Content Manager" <?php echo (isset($selected_role) && $selected_role === 'Content Manager') ? 'selected' : ''; ?>>Content Manager</option>
                    <option value="System User" <?php echo (isset($selected_role) && $selected_role === 'System User') ? 'selected' : ''; ?>>System User</option>
                </select>

                <!-- User Name (Replaced Email with User Name and removed label) -->
                <input type="text" id="username" name="username" placeholder="User Name" required class="form-control mb-3">

                <!-- Password (Removed label and added placeholder inside textbox) -->
                <input type="password" id="password" name="password" placeholder="Password" required class="form-control mb-3">

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

</body>
</html>
