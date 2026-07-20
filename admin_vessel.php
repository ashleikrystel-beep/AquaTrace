<?php
include 'db/database.php';

$sql = "
    SELECT 
        v.vessel_id,
        v.name,
        v.imo,
        v.mmsi,
        v.call_sign,
        v.type,
        v.flag,
        v.LoA,
        v.gross_tonnage,
        v.year_built,
        u.username
    FROM vessels v
    JOIN owners o ON v.owner_id = o.owner_id
    JOIN users u ON o.user_id = u.user_id
";
$query = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vessels | AquaTrace</title>
    <link href="adminVessel_style.css" rel="stylesheet">
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
            <a href="admin_ports.php" class="adminnav" data-label="Ports">
                <i class="fas fa-anchor"></i> <span class="sidebar-text">Ports</span>
            </a>
            <a href="admin_users.php" class="adminnav" data-label="Users">
                <i class="fas fa-user"></i> <span class="sidebar-text">Users</span>
            </a>
            <a href="admin_vessel.php" class="adminnav active" data-label="Vessels">
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
    </header>

    <!-- Vessels Table -->
    <main class="admin-body">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card-userinfo">
                    <div class="card-header d-flex justify-content-between align-items-center text-white">
                        <h5 class="mb-0 fw-bold">REGISTERED VESSELS</h5>
                    </div>

                    <div class="p-3">
                        <div class="card card-sub table-card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Vessel Name</th>
                                                <th>Owner</th>
                                                <th>IMO Number</th>
                                                <th>MMSI Number</th>
                                                <th>Call Sign</th>
                                                <th>Vessel Type</th>
                                                <th>Flag State</th>
                                                <th>Length Overall (m)</th>
                                                <th>Gross Tonnage</th>
                                                <th>Year Built</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="vesselsTableBody" class="text-center">
                                            <?php if ($query && $query->num_rows > 0): ?>
                                            <?php while ($row = $query->fetch_assoc()): ?>
                                                <tr data-id="<?= $row['vessel_id']; ?>">
                                                    <td><?= $row['name']; ?></td>
                                                    <td><?= $row['username']; ?></td>
                                                    <td><?= $row['imo']; ?></td>
                                                    <td><?= $row['mmsi']; ?></td>
                                                    <td><?= $row['call_sign']; ?></td>
                                                    <td><?= $row['type']; ?></td>
                                                    <td><?= $row['flag']; ?></td>
                                                    <td><?= $row['LoA']; ?></td>
                                                    <td><?= $row['gross_tonnage']; ?></td>
                                                    <td><?= $row['year_built']; ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-primary delete-btn" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="11" class="text-center text-muted py-3">No vessels found</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit Vessel Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="row">
                            <input type="hidden" id="editVesselId">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Vessel Name</label>
                                <input type="text" id="editVesselName" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Owner</label>
                                <input type="text" id="editOwner" class="form-control" disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">IMO Number</label>
                                <input type="text" id="editIMO" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">MMSI Number</label>
                                <input type="text" id="editMMSI" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Call Sign</label>
                                <input type="text" id="editCallSign" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Vessel Type</label>
                                <select id="editVesselType" class="form-select" required>
                                    <option value="Passenger Ship">Passenger Ship</option>
                                    <option value="Cargo Ship">Cargo Ship</option>
                                    <option value="Tanker">Tanker</option>
                                    <option value="Cruise Ship">Cruise Ship</option>
                                    <option value="Fishing Vessel">Fishing Vessel</option>
                                    <option value="Container Ship">Container Ship</option>
                                    <option value="Bulk Carrier">Bulk Carrier</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Flag State</label>
                                <input type="text" id="editFlagState" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Length Overall (m)</label>
                                <input type="number" id="editLength" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gross Tonnage</label>
                                <input type="text" id="editTonnage" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Year Built</label>
                                <input type="number" id="editYearBuilt" class="form-control" min="1900" max="2025" required>
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

            // Delete Function (Soft Delete)
            document.getElementById('vesselsTableBody').addEventListener('click', function(e) {
                const deleteBtn = e.target.closest('.delete-btn');
                
                if (deleteBtn) {
                    const row = deleteBtn.closest('tr');
                    const vesselName = row.cells[0].textContent;
                    const imoNumber = row.cells[1].textContent;
                    const vesselId = row.getAttribute('data-id');

                    if (confirm(`Are you sure you want to delete "${vesselName}" (${imoNumber})? This will move it to archive.`)) {
                        fetch('php/archive_vessel.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: new URLSearchParams({ vessel_id: vesselId })
                        })
                        .then(res => res.text())
                        .then(data => {
                            if (data.trim() === 'success') {
                                row.remove();
                                showToast('Success', 'Vessel archived successfully!', 'primary');
                            } else {
                                showToast('Error', 'Failed to archive vessel.', 'danger');
                            }
                        })
                        .catch(() => showToast('Error', 'Request failed.', 'danger'));
                    }
                }
            });

            // Edit Function - Open Modal
            document.getElementById('vesselsTableBody').addEventListener('click', function(e) {
                const editBtn = e.target.closest('.edit-btn');
                
                if (editBtn) {
                    currentRow = editBtn.closest('tr');
                    const cells = currentRow.cells;
                    
                    // Fill modal fields with current data
                    document.getElementById('editVesselId').value = currentRow.dataset.id;
                    document.getElementById('editVesselName').value = cells[0].textContent.trim();
                    document.getElementById('editOwner').value = cells[1].textContent.trim();
                    document.getElementById('editIMO').value = cells[2].textContent.trim();
                    document.getElementById('editMMSI').value = cells[3].textContent.trim();
                    document.getElementById('editCallSign').value = cells[4].textContent.trim();
                    document.getElementById('editVesselType').value = cells[5].textContent.trim();
                    document.getElementById('editFlagState').value = cells[6].textContent.trim();
                    document.getElementById('editLength').value = cells[7].textContent.trim();
                    document.getElementById('editTonnage').value = cells[8].textContent.trim();
                    document.getElementById('editYearBuilt').value = cells[9].textContent.trim();

                    // Show modal
                    editModal.show();
                }
            });

            // Save Changes (Database Update)
            document.getElementById('saveEditBtn').addEventListener('click', function() {
                if (!currentRow) return;

                const vesselId = document.getElementById('editVesselId').value;
                const vesselName = document.getElementById('editVesselName').value.trim();
                const imo = document.getElementById('editIMO').value.trim();
                const mmsi = document.getElementById('editMMSI').value.trim();
                const callSign = document.getElementById('editCallSign').value.trim();
                const vesselType = document.getElementById('editVesselType').value.trim();
                const flagState = document.getElementById('editFlagState').value.trim();
                const length = document.getElementById('editLength').value.trim();
                const tonnage = document.getElementById('editTonnage').value.trim();
                const yearBuilt = document.getElementById('editYearBuilt').value.trim();

                if (!vesselName || !imo || !mmsi || !callSign || !vesselType || !flagState || !length || !tonnage || !yearBuilt) {
                    alert('Please fill in all required fields');
                    return;
                }

                // Send update request to backend
                fetch('php/update_vessel.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        vessel_id: vesselId,
                        name: vesselName,
                        imo: imo,
                        mmsi: mmsi,
                        call_sign: callSign,
                        type: vesselType,
                        flag: flagState,
                        LoA: length,
                        gross_tonnage: tonnage,
                        year_built: yearBuilt
                    })
                })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === 'success') {
                        // Update row visually
                        const cells = currentRow.cells;
                        cells[0].textContent = vesselName;
                        // cells[1] stays as Owner
                        cells[2].textContent = imo;
                        cells[3].textContent = mmsi;
                        cells[4].textContent = callSign;
                        cells[5].textContent = vesselType;
                        cells[6].textContent = flagState;
                        cells[7].textContent = length;
                        cells[8].textContent = tonnage;
                        cells[9].textContent = yearBuilt;

                        showToast('Success', 'Vessel information updated successfully!', 'primary');
                        editModal.hide();
                    } else {
                        showToast('Error', 'Failed to update vessel.', 'primary');
                    }
                })
                .catch(() => showToast('Error', 'Request failed.', 'primary'));
            });

            // Reset form when modal is hidden
            modalElement.addEventListener('hidden.bs.modal', function() {
                currentRow = null;
                document.getElementById('editForm').reset();
            });

            // Toast notification function
            function showToast(title, message, type) {
                const bgClass = type === 'primary' ? 'bg-primary' : 
                                type === 'success' ? 'bg-primary' :
                                type === 'danger' ? 'bg-danger' : 'bg-primary';
                const toast = document.createElement('div');
                toast.className = 'position-fixed top-0 end-0 p-3';
                toast.style.zIndex = '11';
                toast.innerHTML = `
                    <div class="toast show" role="alert">
                        <div class="toast-header ${bgClass} text-white">
                            <strong class="me-auto">${title}</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            }
        });
    </script>
</body>
</html>