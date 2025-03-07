<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homeopathy_clinic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM appointments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Booked Appointments</title>
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/fontawesome-pro.css">
    <link rel="stylesheet" href="assets/css/main.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #185EC8; /* Match primary theme color */
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .table-container {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: #185EC8;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">Homeopathy Clinic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="view-appointments.php">Admin Panel</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Appointments Table -->
    <div class="container table-container">
        <h2 class="text-center mb-4">Booked Appointments</h2>
        
        <?php if ($result->num_rows > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Appointment Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                <td><?php echo htmlspecialchars($row["age"]); ?></td>
                                <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                <td><?php echo htmlspecialchars($row["appointment_time"]); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning text-center" role="alert">
                No appointments found.
            </div>
        <?php } ?>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
