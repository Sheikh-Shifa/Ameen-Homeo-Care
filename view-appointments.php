<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit;
}
?>


<?php
$servername = "sql312.byethost3.com";
$username = "b3_38472809";
$password = "Shahidameen@1811";
$dbname = "b3_38472809_homeopathy_clinic";

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

    <!-- Bootstrap & Custom Styles -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/fontawesome-pro.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <style>
        body {
            background-color: #f5f5f5;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #434e44;
            /* Updated Theme Color */
        }

        .navbar-brand img {
            height: 50px;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        /* Table Styling */
        .table-container {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table thead {
            background-color: #739E77;
            /* Updated Theme Color */
            color: white;
        }

        .table tbody tr {
            transition: all 0.3s ease-in-out;
        }

        .table tbody tr:hover {
            background-color: rgba(115, 158, 119, 0.2);
            transform: scale(1.02);
        }

        /* Button Styling */
        .btn-custom {
            background-color: #739E77;
            color: white;
            font-weight: bold;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #5e8863;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="assets/imgs/logo/logo1.png" alt="logo not found">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="logout.php">Log Out</a></li>
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
                    <tbody id="appointmentTable">
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

    <!-- JavaScript for Fade-in Effect on Table Rows -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let rows = document.querySelectorAll("#appointmentTable tr");
            rows.forEach((row, index) => {
                row.style.opacity = "0";
                setTimeout(() => {
                    row.style.transition = "opacity 0.5s ease-in-out";
                    row.style.opacity = "1";
                }, index * 150);
            });
        });
    </script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php $conn->close(); ?>