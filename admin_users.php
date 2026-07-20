<?php
include 'db/database.php';

$sql = "
    SELECT 
        o.owner_id,
        o.user_id,
        o.address_id,
        o.national_id,
        o.first_name,
        o.middle_name,
        o.last_name,
        o.gender,
        o.dob,
        o.nationality,
        o.company,
        o.job_title,
        o.industry,
        u.username,
        u.password,
        a.street_no,
        a.post_code,
        a.city,
        a.state,
        a.country,
        a.contact,
        a.email
    FROM owners o
    LEFT JOIN users u ON o.user_id = u.user_id
    LEFT JOIN address a ON o.address_id = a.address_id
    WHERE o.is_archived = 0
";

$query = $conn->query($sql);
$owners = [];

if ($query && $query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $owners[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | AquaTrace</title>
    <link href="adminUsers_style.css" rel="stylesheet">
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
            <a href="admin_users.php" class="adminnav active" data-label="Users">
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

    <!-- MAIN CONTENT -->
    <main class="admin-body">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card-userinfo">
                    <div class="card-header d-flex justify-content-between align-items-center text-white">
                        <h5 class="mb-0 fw-bold">REGISTERED USERS</h5>  
                        <button class="btn btn-light btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fas fa-plus"></i> Add User
                        </button>
                    </div> <br>

                    <!-- Personal Info Table -->
                    <div class="card card-sub table-card">
                        <div class="card-header bg-white py-2 px-3">
                            <strong>Personal Information</strong>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-dark">
                                            <tr>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Date of Birth</th>
                                                <th>Gender</th>
                                                <th>Nationality</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($owners as $row): ?>
                                                <tr
                                                    data-owner_id="<?= $row['owner_id'] ?>"
                                                    data-user_id="<?= $row['user_id'] ?>"
                                                    data-address_id="<?= $row['address_id'] ?>"
                                                    data-username="<?= htmlspecialchars($row['username'], ENT_QUOTES) ?>"
                                                    data-password="<?= htmlspecialchars($row['password'], ENT_QUOTES) ?>"
                                                    data-first="<?= htmlspecialchars($row['first_name'], ENT_QUOTES) ?>"
                                                    data-middle="<?= htmlspecialchars($row['middle_name'], ENT_QUOTES) ?>"
                                                    data-last="<?= htmlspecialchars($row['last_name'], ENT_QUOTES) ?>"
                                                    data-dob="<?= $row['dob'] ?>"
                                                    data-gender="<?= $row['gender'] ?>"
                                                    data-national_id="<?= htmlspecialchars($row['national_id'], ENT_QUOTES) ?>"
                                                    data-nationality="<?= htmlspecialchars($row['nationality'], ENT_QUOTES) ?>"
                                                    data-street="<?= htmlspecialchars($row['street_no'], ENT_QUOTES) ?>"
                                                    data-post="<?= $row['post_code'] ?>"
                                                    data-city="<?= htmlspecialchars($row['city'], ENT_QUOTES) ?>"
                                                    data-state="<?= htmlspecialchars($row['state'], ENT_QUOTES) ?>"
                                                    data-country="<?= htmlspecialchars($row['country'], ENT_QUOTES) ?>"
                                                    data-email="<?= htmlspecialchars($row['email'], ENT_QUOTES) ?>"
                                                    data-phone="<?= htmlspecialchars($row['contact'], ENT_QUOTES) ?>"
                                                    data-company="<?= htmlspecialchars($row['company'], ENT_QUOTES) ?>"
                                                    data-job="<?= htmlspecialchars($row['job_title'], ENT_QUOTES) ?>"
                                                    data-industry="<?= htmlspecialchars($row['industry'], ENT_QUOTES) ?>"
                                                >
                                                    <td><?= htmlspecialchars($row['username']) ?></td>
                                                    <td><?= htmlspecialchars($row['password']) ?></td>
                                                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['middle_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                                                    <td><?= $row['dob'] ?></td>
                                                    <td><?= $row['gender'] ?></td>
                                                    <td><?= htmlspecialchars($row['nationality']) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary edit-btn"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger delete-btn"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><br>

                    <!-- Address Information -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card card-sub table-card mb-3">
                                <div class="card-header bg-white py-2 px-3">
                                    <strong>Address Information</strong>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Street</th>
                                                    <th>Post Code</th>
                                                    <th>City</th>
                                                    <th>State/Province</th>
                                                    <th>Country</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($owners as $row): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($row['username']) ?></td>
                                                        <td><?= htmlspecialchars($row['street_no']) ?></td>
                                                        <td><?= htmlspecialchars($row['post_code']) ?></td>
                                                        <td><?= htmlspecialchars($row['city']) ?></td>
                                                        <td><?= htmlspecialchars($row['state']) ?></td>
                                                        <td><?= htmlspecialchars($row['country']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Work -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card card-sub table-card mb-3">
                                <div class="card-header bg-white py-2 px-3">
                                    <strong>Contact</strong>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-dark">
                                        <tr>
                                            <th>Username</th>
                                            <th>National ID</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Company</th>
                                            <th>Job Title</th>
                                            <th>Industry</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($owners as $row): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                <td><?= htmlspecialchars($row['national_id']) ?></td>
                                                <td><?= htmlspecialchars($row['email']) ?></td>
                                                <td><?= htmlspecialchars($row['contact']) ?></td>
                                                <td><?= htmlspecialchars($row['company']) ?></td>
                                                <td><?= htmlspecialchars($row['job_title']) ?></td>
                                                <td><?= htmlspecialchars($row['industry']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
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

    <!-- ===================== ADD USER MODAL ===================== -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" method="POST" action="php/add_user.php">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control" id="addPassword" name="password" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" class="form-control" id="addFirstName" name="first_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Middle Name</label>
                                <input type="text" class="form-control" id="addMiddleName" name="middle_name">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" class="form-control" id="addLastName" name="last_name" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <input type="date" class="form-control" id="addDob" name="dob">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Gender</label>
                                <select class="form-select" id="addGender" name="gender">
                                    <option value="">Select</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nationality</label>
                                <input type="text" class="form-control" id="addNationality" name="nationality" required>
                            </div>

                            <div class="col-md-12"><hr></div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Street Address</label>
                                <input type="text" class="form-control" id="addStreetAddress" name="street_no" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Post Code</label>
                                <input type="text" class="form-control" id="addPostCode" name="post_code" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">City</label>
                                <input type="text" class="form-control" id="addCity" name="city" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">State/Province</label>
                                <input type="text" class="form-control" id="addState" name="state" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Country</label>
                                <input type="text" class="form-control" id="addCountry" name="country" required>
                            </div>

                            <div class="col-md-12"><hr></div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">National ID</label>
                                <input type="text" class="form-control" id="addNationalID" name="national_id" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="addEmail" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone</label>
                                <input type="text" class="form-control" id="addPhone" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Company</label>
                                <input type="text" class="form-control" id="addCompany" name="company">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Job Title</label>
                                <input type="text" class="form-control" id="addPosition" name="position">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Industry</label>
                                <input type="text" class="form-control" id="addIndustry" name="industry">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveAddUser">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== EDIT USER MODAL ===================== -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST" action="php/update_user.php">
                        <input type="hidden" id="editIndex">
                        <input type="hidden" id="editOwnerId" name="owner_id">
                        <input type="hidden" id="editUserId" name="user_id">
                        <input type="hidden" id="editAddressId" name="address_id">

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" class="form-control" id="editUsername" name="username" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control" id="editPassword" name="password" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" class="form-control" id="editFirstName" name="first_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Middle Name</label>
                                <input type="text" class="form-control" id="editMiddleName" name="middle_name">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" class="form-control" id="editLastName" name="last_name" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <input type="date" class="form-control" id="editDob" name="dob" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Gender</label>
                                <select class="form-select" id="editGender" name="gender" required>
                                    <option value="">Select</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nationality</label>
                                <input type="text" class="form-control" id="editNationality" name="nationality" required>
                            </div>

                            <div class="col-md-12"><hr></div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Street Address</label>
                                <input type="text" class="form-control" id="editStreetAddress" name="street_no" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Post Code</label>
                                <input type="text" class="form-control" id="editPostCode" name="post_code" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">City</label>
                                <input type="text" class="form-control" id="editCity" name="city" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">State/Province</label>
                                <input type="text" class="form-control" id="editState" name="state" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Country</label>
                                <input type="text" class="form-control" id="editCountry" name="country" required>
                            </div>

                            <div class="col-md-12"><hr></div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">National ID</label>
                                <input type="text" class="form-control" id="editNationalID" name="national_id" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone</label>
                                <input type="text" class="form-control" id="editPhone" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Company</label>
                                <input type="text" class="form-control" id="editCompany" name="company">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Position</label>
                                <input type="text" class="form-control" id="editPosition" name="position">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Industry</label>
                                <input type="text" class="form-control" id="editIndustry" name="industry">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEditUser">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== DELETE USER MODAL ===================== -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white bg-danger">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete this user?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="confirmDeleteUser">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        /* Sidebar toggle */
        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");
        toggleBtn.addEventListener("click", () => sidebar.classList.toggle("collapsed"));

        /* Helper to show simple alerts */
        function showAlert(msg) {
        alert(msg);
        }

        /* ADD*/
        document.getElementById('saveAddUser').addEventListener('click', () => {
        const form = document.getElementById('addUserForm');
        const fd = new FormData(form);

        fetch('php/add_user.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.text())
        .then(text => {
            if (text.trim().toLowerCase().includes('success')) {
            showAlert('User added successfully.');
            location.reload();
            } else {
            showAlert('Add failed: ' + text);
            }
        })
        .catch(err => showAlert('Request failed: ' + err));
        });

        /* EDIT: open modal and populate fields from row data- attributes */
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const tr = this.closest('tr');
                if (!tr) return;

                // populate modal fields from data attributes
                document.getElementById('editOwnerId').value = tr.dataset.owner_id;
                document.getElementById('editUserId').value = tr.dataset.user_id;
                document.getElementById('editAddressId').value = tr.dataset.address_id;

                document.getElementById('editUsername').value = tr.dataset.username;
                document.getElementById('editPassword').value = tr.dataset.password;
                document.getElementById('editFirstName').value = tr.dataset.first;
                document.getElementById('editMiddleName').value = tr.dataset.middle;
                document.getElementById('editLastName').value = tr.dataset.last;
                document.getElementById('editDob').value = tr.dataset.dob;
                document.getElementById('editGender').value = tr.dataset.gender;
                document.getElementById('editNationalID').value = tr.dataset.national_id;
                document.getElementById('editNationality').value = tr.dataset.nationality;

                document.getElementById('editStreetAddress').value = tr.dataset.street;
                document.getElementById('editPostCode').value = tr.dataset.post;
                document.getElementById('editCity').value = tr.dataset.city;
                document.getElementById('editState').value = tr.dataset.state;
                document.getElementById('editCountry').value = tr.dataset.country;

                document.getElementById('editEmail').value = tr.dataset.email;
                document.getElementById('editPhone').value = tr.dataset.phone;
                document.getElementById('editCompany').value = tr.dataset.company;
                document.getElementById('editPosition').value = tr.dataset.job;
                document.getElementById('editIndustry').value = tr.dataset.industry;

                new bootstrap.Modal(document.getElementById('editUserModal')).show();
            });
        });

        /* Save edit*/
        document.getElementById('saveEditUser').addEventListener('click', () => {
        const form = document.getElementById('editUserForm');
        const fd = new FormData(form);

        fetch('php/update_user.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.text())
        .then(text => {
            if (text.trim().toLowerCase().includes('success')) {
            showAlert('User updated successfully.');
            location.reload();
            } else {
            showAlert('Update failed: ' + text);
            }
        })
        .catch(err => showAlert('Request failed: ' + err));
        });

        /* DELETE*/
        let deleteTargetOwnerId = null;
        document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const tr = this.closest('tr');
            if (!tr) return;
            deleteTargetOwnerId = tr.dataset.owner_id;
            // show confirmation modal
            new bootstrap.Modal(document.getElementById('deleteUserModal')).show();
        });
        });

        document.getElementById('confirmDeleteUser').addEventListener('click', () => {
        if (!deleteTargetOwnerId) return;
        const fd = new FormData();
        fd.append('owner_id', deleteTargetOwnerId);

        fetch('php/archive_user.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.text())
        .then(text => {
            if (text.trim().toLowerCase().includes('success')) {
            showAlert('User deleted.');
            location.reload();
            } else {
            showAlert('Delete failed: ' + text);
            }
        })
        .catch(err => showAlert('Request failed: ' + err));
        });
    </script>

</body>
</html>