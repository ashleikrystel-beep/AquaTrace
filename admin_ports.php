<?php
include 'db/database.php';

$sql = "SELECT
        p.port_id,
        p.name,
        a.city,
        a.state
        FROM ports p
        JOIN address a ON p.address_id = a.address_id
        WHERE p.is_archived = 0
";
$query = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ports | AquaTrace</title>
    <link href="adminPorts_style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Sidebar -->
    <aside class="adminbar" id="sidebar">
        <div class="adminbar-title">
            <a href="#" class="navbar-brand">
                <img src="images/— AQUATRACE —.png" alt="AquaTrace Logo" class="logo-img">
                <span class="logo-text">AQUATRACE</span>
            </a>
        </div>

        <nav>
            <a href="admin_dashboard.php" class="adminnav" data-label="Dashboard">
                <i class="fas fa-tachometer-alt"></i> <span class="sidebar-text">Dashboard</span>
            </a>
            <a href="admin_ports.php" class="adminnav active" data-label="Ports">
                <i class="fas fa-anchor"></i> <span class="sidebar-text">Ports</span>
            </a>
            <a href="admin_users.php" class="adminnav" data-label="Users">
                <i class="fas fa-user"></i> <span class="sidebar-text">Users</span>
            </a>
            <a href="admin_vessel.php" class="adminnav" data-label="Vessels">
                <i class="fas fa-ship"></i> <span class="sidebar-text">Vessels</span>
            </a>
            <a href="admin_reports.php" class="adminnav" data-label="Reports">
                <i class="fas fa-chart-bar"></i> <span class="sidebar-text">Reports</span>
            </a>
            <a href="admin_about.html" class="adminnav" data-label="About">
                <i class="fas fa-info-circle"></i> <span class="sidebar-text">About</span>
            </a>
        </nav>

        <div class="logout-btn">
            <a href="loginsignup.html" data-label="Logout">
                <i class="fas fa-sign-out-alt"></i> <span class="sidebar-text">Logout</span>
            </a>
        </div>
    </aside>

    <!-- Topbar -->
    <header class="adminheader">
        <div class="d-flex align-items-center w-100">
            <button class="btn btn-outline-secondary me-2" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="ms-auto position-relative me-3">
            <button class="btn position-relative" id="notifBell">
                <i class="fas fa-bell fa-lg text-secondary"></i>
                <span id="notifBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
                    0
                </span>
            </button>

            <div id="notifDropdown" class="dropdown-menu dropdown-menu-end shadow-sm p-2" style="min-width: 280px;">
                <h6 class="dropdown-header">Notifications</h6>
                <div id="notifList" class="list-group small">
                    <p class="text-center text-muted mb-0">No new notifications</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="admin-body">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card-userinfo">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-light fw-bold">PORTS INFORMATION</h5>
                        
                        <button class="btn btn-light btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#addPortModal">
                            <i class="fas fa-plus"></i> Add Port
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Port Name</th>
                                    <th>City</th>
                                    <th>Province</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if ($query->num_rows > 0) {
                                        while ($row = $query->fetch_assoc()) {
                                            echo "
                                            <tr data-port-id='{$row['port_id']}'>
                                                <td>{$row['name']}</td>
                                                <td>{$row['city']}</td>
                                                <td>{$row['state']}</td>
                                                <td>
                                                    <button class='btn btn-sm btn-outline-primary' onclick='deletePort(this)'><i class='fas fa-trash'></i></button>
                                                </td>
                                            </tr>
                                            ";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>No ports found</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ===================== ADD PORT MODAL ===================== -->
    <div class="modal fade" id="addPortModal" tabindex="-1" aria-labelledby="addPortModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addPortModalLabel">Add New Port</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addPortForm">
                        <div class="mb-3">
                            <label class="form-label">Port Name</label>
                            <input type="text" class="form-control" id="addPortName" name="port_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" id="addCity" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Province</label>
                            <input type="text" class="form-control" id="addProvince" name="province" required>
                        </div>
                    </form>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveAddPort">Add Port</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== EDIT PORT MODAL ===================== -->
    <!-- <div class="modal fade" id="editPortModal" tabindex="-1" aria-labelledby="editPortModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editPortModalLabel">Edit Port Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPortForm">
                        <div class="mb-3">
                            <label class="form-label">Port Name</label>
                            <input type="text" class="form-control" id="editPortName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" id="editCity" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Province</label>
                            <input type="text" class="form-control" id="editProvince" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEditPort">Save Changes</button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- ===================== DELETE CONFIRM MODAL ===================== -->
    <div class="modal fade" id="deletePortModal" tabindex="-1" aria-labelledby="deletePortModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deletePortModalLabel">Delete Port</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this port record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeletePort">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle
        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");
        
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("collapsed");
        });

        let selectedRow = null;

        // ADD
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("saveAddPort").addEventListener("click", function() {
                const portName = document.getElementById("addPortName").value.trim();
                const city = document.getElementById("addCity").value.trim();
                const province = document.getElementById("addProvince").value.trim();

                console.log("Button clicked!"); // Debug
                console.log("Port Name:", portName, "City:", city, "Province:", province); // Debug

                if (!portName || !city || !province) {
                    alert("Please fill all fields.");
                    return;
                }

                console.log("Sending fetch request..."); // Debug

                fetch('php/add_ports.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `port_name=${encodeURIComponent(portName)}&city=${encodeURIComponent(city)}&province=${encodeURIComponent(province)}`
                })
                .then(res => {
                    console.log("Response received:", res); // Debug
                    return res.json();
                })
                .then(data => {
                    console.log("Data received:", data); // Debug
                    if(data.status === "success") {
                        const tbody = document.querySelector("table tbody");
                        
                        // Remove "No ports found" message if it exists
                        const noDataRow = tbody.querySelector('td[colspan="4"]');
                        if (noDataRow) {
                            noDataRow.closest('tr').remove();
                        }
                        
                        const tr = document.createElement("tr");
                        tr.innerHTML = `
                            <td>${portName}</td>
                            <td>${city}</td>
                            <td>${province}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" onclick="deletePort(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>`;
                        tbody.appendChild(tr);

                        document.getElementById("addPortForm").reset();
                        const modal = bootstrap.Modal.getInstance(document.getElementById("addPortModal"));
                        modal.hide();
                        
                        alert("Port added successfully!"); // Success message
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("An error occurred. Check console for details.");
                });
            });
        });

        // Delete (Archive) Button Function
        function deletePort(button) {
            selectedRow = button.closest("tr");
            new bootstrap.Modal(document.getElementById('deletePortModal')).show();
        }

        // Confirm Delete (Archive)
        document.getElementById("confirmDeletePort").addEventListener("click", function () {
            if (selectedRow) {
                const portId = selectedRow.getAttribute('data-port-id');
                
                console.log("Archiving port ID:", portId); // Debug
                
                fetch('php/archive_port.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `port_id=${encodeURIComponent(portId)}`
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Archive response:", data); // Debug
                    if(data.status === "success") {
                        selectedRow.remove();
                        bootstrap.Modal.getInstance(document.getElementById('deletePortModal')).hide();
                        alert("Port archived successfully!");
                        
                        // Check if table is empty and show "No ports found" message
                        const tbody = document.querySelector("table tbody");
                        if (tbody.children.length === 0) {
                            tbody.innerHTML = "<tr><td colspan='4' class='text-center'>No ports found</td></tr>";
                        }
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("An error occurred while archiving. Check console for details.");
                });
            }
        });
    </script>

</body>
</html>