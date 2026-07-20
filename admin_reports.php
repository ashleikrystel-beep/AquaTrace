<?php
include 'db/database.php';

$sql = "SELECT 
            r.report_id,
            r.date_created,
            v.name AS vessel_name,
            u.username AS owner_username,
            p.name AS port_name,
            r.report_type,
            r.severity,
            r.status
        FROM reports r
        LEFT JOIN vessels v ON r.related_vessel = v.vessel_id
        LEFT JOIN owners o ON v.owner_id = o.owner_id
        LEFT JOIN users u ON o.user_id = u.user_id
        LEFT JOIN ports p ON r.port_id = p.port_id
        ORDER BY r.date_created DESC
        ";

$query= $conn->query($sql);

if (!$query) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | AquaTrace</title>
    <link href="adminReports_style.css" rel="stylesheet">
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
            <a href="dashboard.html" class="adminnav" data-label="Dashboard">
                <i class="fas fa-tachometer-alt"></i> <span class="sidebar-text">Dashboard</span>
            </a>
            <a href="ports_admin.html" class="adminnav" data-label="Ports">
                <i class="fas fa-anchor"></i> <span class="sidebar-text">Ports</span>
            </a>
            <a href="users_admin.html" class="adminnav" data-label="Users">
                <i class="fas fa-user"></i> <span class="sidebar-text">Users</span>
            </a>
            <a href="admin_vessel.php" class="adminnav" data-label="Vessels">
                <i class="fas fa-ship"></i> <span class="sidebar-text">Vessels</span>
            </a>
            <a href="admin_reports.php" class="adminnav active" data-label="Reports">
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

    <div class="admin-body">
        <div class="container-fluid">
            <div class="row g-4 justify-content-center">

                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-10">
                    <div class="card p-4 shadow-sm rounded-4 border-0">
                        <h5 class="fw-bold text-center mb-4"><i class="bi bi-bar-chart-line me-2"></i>MONTHLY INCIDENT REPORTS</h5>
                        
                        <div class="bar-chart">
                            <div class="bar" style="height: 60%;"></div>
                            <div class="bar" style="height: 35%;"></div>
                            <div class="bar" style="height: 70%;"></div>
                            <div class="bar" style="height: 50%;"></div>
                            <div class="bar" style="height: 90%;"></div>
                            <div class="bar" style="height: 65%;"></div>
                            <div class="bar" style="height: 40%;"></div>
                            <div class="bar" style="height: 55%;"></div>
                            <div class="bar" style="height: 75%;"></div>
                            <div class="bar" style="height: 60%;"></div>
                        </div>
                        
                        <div class="bar-labels mt-3 text-center">
                            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span>
                            <span>May</span><span>Jun</span><span>Jul</span><span>Aug</span>
                            <span>Sep</span><span>Oct</span>
                        </div>
                    </div>
                </div>

                <!-- Donut Chart -->
                <div class="col-lg-6 col-md-10">
                    <div class="card p-4 shadow-sm rounded-4 border-0 text-center">
                        <h5 class="fw-bold mb-4"><i class="bi bi-pie-chart me-2"></i>VESSEL TYPES DISTRIBUTION</h5>
                        
                        <div class="donut-chart mx-auto mb-4">
                            <div class="hole"></div>
                        </div>
                        
                        <div class="legend d-flex justify-content-center flex-wrap gap-3">
                            <div><span class="dot blue"></span> Cargo Ships</div>
                            <div><span class="dot darkblue"></span> Tankers</div>
                            <div><span class="dot lightblue"></span> Fishing Vessels</div>
                            <div><span class="dot black"></span> Passenger Ships</div>
                            <div><span class="dot skyblue"></span> Other</div>
                        </div>
                    </div>
                </div>
                <br><br>

                <!-- Reports Table -->
                <div class="col-12">
                    <div class="card shadow-sm p-3">
                        <h5 class="mb-3 text-primary fw-bold text-center">Recent Maritime Incident Reports</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">DATE</th>
                                        <th scope="col">VESSEL NAME</th>
                                        <th scope="col">OWNER/USER</th>
                                        <th scope="col">PORT LOCATION</th>
                                        <th scope="col">INCIDENT TYPE</th>
                                        <th scope="col">SEVERITY</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white" id="reportsTableBody">
                                    <?php
                                    if ($query->num_rows > 0) {
                                        while($row = $query->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>".date("M d, Y", strtotime($row['date_created']))."</td>
                                                    <td>{$row['vessel_name']}</td>
                                                    <td>{$row['owner_username']}</td>
                                                    <td>{$row['port_name']}</td>
                                                    <td>{$row['report_type']}</td>
                                                    <td><span class='badge bg-primary text-light'>{$row['severity']}</span></td>
                                                    <td><span class='badge bg-primary text-light'>{$row['status']}</span></td>
                                                    <td>
                                                        <button class='btn btn-sm btn-outline-primary edit-btn' title='Edit'><i class='fas fa-edit'></i></button>
                                                        <button class='btn btn-sm btn-outline-primary delete-btn' title='Delete'><i class='fas fa-trash'></i></button>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No reports found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit Report</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Date</label>
                            <input type="text" id="editDate" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Vessel Name</label>
                            <input type="text" id="editVessel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Owner/User</label>
                            <input type="text" id="editOwner" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Port Location</label>
                            <input type="text" id="editPort" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Incident Type</label>
                            <input type="text" id="editIncident" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Severity</label>
                                <select id="editSeverity" class="form-select" required>
                                    <option value="LOW">LOW</option>
                                    <option value="MEDIUM">MEDIUM</option>
                                    <option value="HIGH">HIGH</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select id="editStatus" class="form-select" required>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Under Investigation">Under Investigation</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
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

        // Edit and Delete Functionality
        document.addEventListener('DOMContentLoaded', () => {
            let currentRow = null;
            let editModal = null;

            // Initialize modal
            const modalElement = document.getElementById('editModal');
            editModal = new bootstrap.Modal(modalElement);

            // Helper function to get severity badge class
            function getSeverityBadgeClass(severity) {
            switch(severity) {
                case 'LOW': return 'bg-secondary';
                case 'MEDIUM': return 'bg-warning text-dark';
                case 'HIGH': return 'bg-danger';
                default: return 'bg-secondary';
            }
            }

            // Helper function to get status badge class
            function getStatusBadgeClass(status) {
            switch(status) {
                case 'Resolved': return 'bg-success';
                case 'Under Investigation': return 'bg-info text-dark';
                case 'Closed': return 'bg-secondary';
                default: return 'bg-secondary';
            }
            }

            // Delete Function
            document.getElementById('reportsTableBody').addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.delete-btn');
            
            if (deleteBtn) {
                const row = deleteBtn.closest('tr');
                const vesselName = row.cells[1].textContent;
                
                if (confirm(`Are you sure you want to delete the report for "${vesselName}"?`)) {
                row.remove();
                
                // Show success message (optional)
                const toast = document.createElement('div');
                toast.className = 'position-fixed top-0 end-0 p-3';
                toast.style.zIndex = '11';
                toast.innerHTML = `
                    <div class="toast show" role="alert">
                    <div class="toast-header bg-success text-white">
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        Report deleted successfully!
                    </div>
                    </div>
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
                }
            }
            });

            // Edit Function - Open Modal
            document.getElementById('reportsTableBody').addEventListener('click', function(e) {
            const editBtn = e.target.closest('.edit-btn');
            
            if (editBtn) {
                currentRow = editBtn.closest('tr');
                const cells = currentRow.cells;
                
                // Fill modal fields with current data
                document.getElementById('editDate').value = cells[0].textContent.trim();
                document.getElementById('editVessel').value = cells[1].textContent.trim();
                document.getElementById('editOwner').value = cells[2].textContent.trim();
                document.getElementById('editPort').value = cells[3].textContent.trim();
                document.getElementById('editIncident').value = cells[4].textContent.trim();
                document.getElementById('editSeverity').value = cells[5].textContent.trim();
                document.getElementById('editStatus').value = cells[6].textContent.trim();

                // Show modal
                editModal.show();
            }
            });

            // Save Changes
            document.getElementById('saveEditBtn').addEventListener('click', function() {
            if (!currentRow) return;

            // Get form values
            const vessel = document.getElementById('editVessel').value.trim();
            const owner = document.getElementById('editOwner').value.trim();
            const port = document.getElementById('editPort').value.trim();
            const incident = document.getElementById('editIncident').value.trim();
            const severity = document.getElementById('editSeverity').value;
            const status = document.getElementById('editStatus').value;

            // Validate inputs
            if (!vessel || !owner || !port || !incident) {
                alert('Please fill in all required fields');
                return;
            }

            // Update row cells
            const cells = currentRow.cells;
            cells[1].textContent = vessel;
            cells[2].textContent = owner;
            cells[3].textContent = port;
            cells[4].textContent = incident;
            cells[5].innerHTML = `<span class="badge ${getSeverityBadgeClass(severity)}">${severity}</span>`;
            cells[6].innerHTML = `<span class="badge ${getStatusBadgeClass(status)}">${status}</span>`;

            // Hide modal
            editModal.hide();

            // Show success message
            const toast = document.createElement('div');
            toast.className = 'position-fixed top-0 end-0 p-3';
            toast.style.zIndex = '11';
            toast.innerHTML = `
                <div class="toast show" role="alert">
                <div class="toast-header bg-primary text-white">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    Report updated successfully!
                </div>
                </div>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
            });

            // Reset form when modal is hidden
            modalElement.addEventListener('hidden.bs.modal', function() {
            currentRow = null;
            document.getElementById('editForm').reset();
            });
        });
    </script>
</body>
</html>