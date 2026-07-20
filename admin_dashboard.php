<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | AquaTrace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <link rel="stylesheet" href="adminDashboard_style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="adminbar" id="sidebar">
        <div class="adminbar-title">
            <a href="#" class="navbar-brand">
                <img src="images/— AQUATRACE —.png" alt="AquaTrace Logo" class="logo-img">
                <span class="logo-text">AQUATRACE</span>
            </a>
        </div>

        <nav>
            <a href="admin_dashboard.php" class="adminnav active" data-label="Dashboard">
                <i class="fas fa-tachometer-alt"></i> <span class="sidebar-text">Dashboard</span>
            </a>
            <a href="admin_ports.php" class="adminnav" data-label="Ports">
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
    <h5 class="welcometext mb-0">Welcome, Admin!</h5>

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

  </div>
</header>

<!-- Main -->
<main class="admin-body">

  <!-- Stats -->
   <div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <a href="admin_vessel.php" class="text-decoration-none">
      <div class="card admin-card shadow-sm text-center py-3">
        <div class="card-body">
          <i class="fas fa-ship fa-2x text-primary mb-2"></i>
          <div class="text-primary small">Vessels</div>
          <h5>50</h5>
        </div>
      </div>
    </a>
  </div>

  <div class="col-6 col-md-3">
    <a href="admin_ports.php" class="text-decoration-none">
      <div class="card admin-card shadow-sm text-center py-3">
        <div class="card-body">
          <i class="fas fa-map-pin fa-2x text-primary mb-2"></i>
          <div class="text-primary small">Ports</div>
          <h5>13</h5>
        </div>
      </div>
    </a>
  </div>

  <div class="col-6 col-md-3">
    <a href="admin_users.php" class="text-decoration-none">
      <div class="card admin-card shadow-sm text-center py-3">
        <div class="card-body">
          <i class="fas fa-users fa-2x text-primary mb-2"></i>
          <div class="text-primary small">Users</div>
          <h5>40</h5>
        </div>
      </div>
    </a>
  </div>

  <div class="col-6 col-md-3">
    <a href="reports_admin.html" class="text-decoration-none">
      <div class="card admin-card shadow-sm text-center py-3">
        <div class="card-body bg-white">
          <i class="fas fa-file-lines fa-2x text-primary mb-2"></i>
          <div class="text-primary small">Reports</div>
          <h5>10</h5>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- Map -->
<div class="card shadow-sm ">
  <div class="card-header d-flex text-center text-white bg-primary">
    <h5 class="mb-0 fw-bold">MINDANAO MAP</h5>
  </div>
  <div class="card-body position-relative">
    <div id="map"></div>
  </div>
</div>
<br><br>
<!-- Registered Vessels (Moved Below Map) -->
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center text-white bg-primary">
    <h5 class="mb-0 fw-bold">REGISTERED VESSELS</h5>
  </div>

<div class="card-body"> <br>
    <div id="vesselList"></div>
  </div>
</div>
</main> 

<!-- Add Vessel Modal -->
<div class="modal fade" id="addVesselModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #06326a;">
        <h5 class="modal-title">Add New Vessel</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="addVesselForm">
          <input type="hidden" id="vesselLat">
          <input type="hidden" id="vesselLng">
          <div class="mb-3">
            <label class="form-label">Vessel Name</label>
            <input type="text" class="form-control" id="vesselName" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" id="vesselWhere" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" class="form-control" id="vesselType" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Extra Info</label>
            <input type="text" class="form-control" id="vesselExtra">
          </div>
          <div class="text-end">
            <button type="submit" class="btn text-white" style="background-color: #06326a;">Add Vessel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  // Sidebar toggle
  document.getElementById("toggle-btn").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("collapsed");
  });

  var map = L.map('map').setView([7.1907, 125.4553], 7);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 6,
    maxZoom: 18,
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  var vessels = [];
  var vesselList = document.getElementById("vesselList");

  function addVessel(name, where, type, extra, lat, lng) {
    var marker = L.marker([lat, lng])
      .addTo(map)
      .bindPopup("<b>" + name + "</b><br>" + where + "<br>");

    var vessel = { name, where, type, extra, lat, lng, marker };
    vessels.push(vessel);

var card = document.createElement("div");
card.className = "vessel-card shadow-sm";
card.innerHTML = `
  <h5 class="mb-1">${name}</h5>
  <p class="mb-1"><strong> Current location:</strong> ${where}</p>
  <div class="d-flex justify-content-end">
    <button class="btn btn-sm btn-outline-primary me-2">View</button>
    <button class="btn btn-sm btn-outline-primary me-2">Delete</button>
  </div>
`;

document.getElementById("vesselList").appendChild(card);

    // Notification bell logic
const notifBell = document.getElementById('notifBell');
const notifDropdown = document.getElementById('notifDropdown');
const notifList = document.getElementById('notifList');
const notifBadge = document.getElementById('notifBadge');
let notifCount = 0;

// Toggle dropdown visibility
notifBell.addEventListener('click', () => {
  notifDropdown.classList.toggle('show');
});

// Hide dropdown when clicking outside
document.addEventListener('click', (e) => {
  if (!notifBell.contains(e.target) && !notifDropdown.contains(e.target)) {
    notifDropdown.classList.remove('show');
  }
});

// Function to add a new notification
function addNotification(message) {
  notifCount++;
  notifBadge.textContent = notifCount;
  notifBadge.classList.remove('d-none');

  // Remove "no notifications" message if present
  if (notifList.children[0]?.tagName === "P") notifList.innerHTML = "";

  const item = document.createElement('div');
  item.className = 'list-group-item list-group-item-action';
  item.textContent = message;
  notifList.prepend(item);

  // Mark notification as read on click
  item.addEventListener('click', () => {
    item.classList.add('text-muted');
    item.style.background = '#f8f9fa';
    notifCount = Math.max(0, notifCount - 1);
    notifBadge.textContent = notifCount;
    if (notifCount === 0) notifBadge.classList.add('d-none');
  });
}

// Demo: add new notifications automatically
setTimeout(() => addNotification("New vessel added: MV Davao Star"), 2000);
setTimeout(() => addNotification("System check completed successfully"), 5000);
setTimeout(() => addNotification("Port activity report available"), 8000);

    card.querySelector(".btn-outline-primary").addEventListener("click", function() {
      map.setView([lat, lng], 12);
      marker.openPopup();
    });

    card.querySelector(".btn-outline-danger").addEventListener("click", function() {
      map.removeLayer(marker);
      vesselList.removeChild(card);
      vessels = vessels.filter(v => v !== vessel);
    });

    vesselList.appendChild(card);
  }

  map.on('click', function(e) {
    document.getElementById("vesselLat").value = e.latlng.lat;
    document.getElementById("vesselLng").value = e.latlng.lng;
    var addModal = new bootstrap.Modal(document.getElementById("addVesselModal"));
    addModal.show();
  });

  document.getElementById("addVesselForm").addEventListener("submit", function(e) {
    e.preventDefault();

    var name = document.getElementById("vesselName").value.trim();
    var where = document.getElementById("vesselWhere").value.trim();
    var type = document.getElementById("vesselType").value.trim();
    var extra = document.getElementById("vesselExtra").value.trim() || "N/A";
    var lat = parseFloat(document.getElementById("vesselLat").value);
    var lng = parseFloat(document.getElementById("vesselLng").value);

    addVessel(name, where, type, extra, lat, lng);

    var addModal = bootstrap.Modal.getInstance(document.getElementById("addVesselModal"));
    addModal.hide();
    e.target.reset();
  });

  // Demo vessels
  addVessel("Vessel A", "Davao Gulf", "Fishing Boat", "Capacity: 30 tons", 7.0920, 125.6330);
  addVessel("Vessel B", "Samal Island", "Passenger Ferry", "Status: Active", 7.1417, 125.7097);
  addVessel("Vessel C", "Mati", "Cargo Ship", "Last updated: Today", 6.9556, 126.2167);
</script>

</body>
</html>