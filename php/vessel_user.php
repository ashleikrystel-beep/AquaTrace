<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AquaTrace | My Vessels</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- AOS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="vesseluser_style.css">
</head>

<body>
  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h4>Menu</h4>
      <div class="sidebar-close" id="sidebarClose">
        <i class="fas fa-times"></i>
      </div>
    </div>

    <ul class="sidebar-menu">
      <li><a href="web_user.html"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="vessel_user.html"><i class="fas fa-ship"></i> Vessels</a></li>
      <li><a href="ports_user.html"><i class="fas fa-anchor"></i> Ports</a></li>
      <li><a href="news_user.html"><i class="fas fa-newspaper"></i> News</a></li>
      <hr class="sidebar-divider">
      <li><a href="registerboat.html"><i class="fas fa-ship"></i> Register Boat</a></li>
      <li><a href="reports.html"><i class="fas fa-file-alt"></i> Reports</a></li>
      <li><a href="analytics_user.html"><i class="fas fa-chart-line"></i> Analytics</a></li>
      <hr class="sidebar-divider">
      <li><a href="about_user.html"><i class="fas fa-info-circle"></i> About</a></li>
      <li><a href="contact_user.html"><i class="fas fa-envelope"></i> Contact</a></li>
      <hr class="sidebar-divider">
      <li><a href="loginsignup.html" class="logout-item"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
    </ul>
  </div>

  <!-- NAVIGATION BAR -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="web_user.html">
        <img src="images/— AQUATRACE —.png" alt="AquaTrace" height="40" loading="eager">
        <p>AQUATRACE</p>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto d-none d-lg-flex">
          <li class="nav-item"><a class="nav-link" href="web_user.html">HOME</a></li>
          <li class="nav-item"><a class="nav-link active" href="vessel_user.html">VESSELS</a></li>
          <li class="nav-item"><a class="nav-link" href="ports_user.html">PORTS</a></li>
          <li class="nav-item"><a class="nav-link" href="news_user.html">NEWS</a></li>
          <li class="nav-item"><a class="nav-link" href="analytics_user.html">ANALYTICS</a></li>
        </ul>

        <div class="d-flex">
          <div class="user-profile-btn" id="sidebarToggle">
            <i class="fas fa-user"></i>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- PAGE HEADER -->
  <div class="page-header" data-aos="fade-up" data-aos-duration="900">
    <div class="container text-center">
      <h1><i class="fas fa-ship"></i> My Vessels</h1>
      <p>Track and manage all your registered vessels in real-time</p>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="container pb-5">

    <!-- Statistics -->
    <div class="stats-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
      <div class="stat-card">
        <div class="stat-number" id="totalVessels">0</div>
        <div class="stat-label">Total Vessels</div>
      </div>
      <div class="stat-card">
        <div class="stat-number" id="activeVessels">0</div>
        <div class="stat-label">Active</div>
      </div>
      <div class="stat-card">
        <div class="stat-number" id="dockedVessels">0</div>
        <div class="stat-label">Docked</div>
      </div>
      <div class="stat-card">
        <div class="stat-number" id="transitVessels">0</div>
        <div class="stat-label">In Transit</div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="map-container my-4" data-aos="fade-up" data-aos-duration="1000">
      <h2 class="text-center mb-3"><i class="fas fa-map-marker-alt"></i> Live Vessel Tracking</h2>
      <div id="map"></div>
      <div class="map-legend">
        <div class="legend-item">
          <i class="fas fa-anchor" style="color: #007bff;"></i> Ports
        </div>
        <div class="legend-item">
          <i class="fas fa-ship" style="color: #28a745;"></i> Active
        </div>
        <div class="legend-item">
          <i class="fas fa-ship" style="color: #007bff;"></i> Docked
        </div>
        <div class="legend-item">
          <i class="fas fa-ship" style="color: #ffc107;"></i> In Transit
        </div>
      </div>
    </div>

    <!-- Vessel Cards -->
    <div id="vesselsContainer" class="mt-4">
      <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h4>No vessels registered yet</h4>
        <p>Register your first vessel to start tracking!</p>
      </div>
    </div>
  </div>

  <!-- Update Vessel Modal -->
  <div class="custom-modal-overlay" id="updateModal">
    <div class="custom-modal-content update-modal">
      <div class="modal-header-custom">
        <h3><i class="fas fa-edit"></i> Update Vessel Location</h3>
        <button class="close-modal-btn" id="closeUpdateModal">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form id="updateVesselForm">
        <div class="modal-body-custom">
          <div class="update-vessel-info">
            <div class="vessel-icon-modal">
              <i class="fas fa-ship"></i>
            </div>
            <div>
              <h4 id="modalVesselName">Vessel Name</h4>
              <span id="modalVesselType" class="vessel-type-badge">Type</span>
            </div>
          </div>

          <div class="form-section-modal">
            <label class="form-label-modal">
              <i class="fas fa-map-marker-alt"></i> Current Location/Port *
            </label>
            <select class="form-control-modal" id="updateLocation" required>
              <option value="">Select location</option>
              <option value="7.128,125.664">Davao City Port</option>
              <option value="7.133,125.783">Samal Island Port</option>
              <option value="7.443,125.807">Tagum Port</option>
              <option value="6.951,126.243">Mati Port</option>
              <option value="7.05,125.7">En Route - Davao Gulf</option>
              <option value="7.15,125.8">En Route - Samal Waters</option>
              <option value="6.95,126.0">En Route - Mati Coast</option>
            </select>
          </div>

          <div class="form-section-modal">
            <label class="form-label-modal">
              <i class="fas fa-clipboard-list"></i> Status *
            </label>
            <select class="form-control-modal" id="updateStatus" required>
              <option value="">Select status</option>
              <option value="Active">Active</option>
              <option value="Docked">Docked</option>
              <option value="In Transit">In Transit</option>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-section-modal">
                <label class="form-label-modal">
                  <i class="fas fa-calendar-check"></i> Arrival Date & Time
                </label>
                <input type="datetime-local" class="form-control-modal" id="updateArrival">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-section-modal">
                <label class="form-label-modal">
                  <i class="fas fa-calendar-times"></i> Departure Date & Time
                </label>
                <input type="datetime-local" class="form-control-modal" id="updateDeparture">
              </div>
            </div>
          </div>

          <div class="form-section-modal">
            <label class="form-label-modal">
              <i class="fas fa-sticky-note"></i> Additional Notes
            </label>
            <textarea class="form-control-modal" id="updateNotes" rows="3"
              placeholder="Add any relevant information about the vessel's current status..."></textarea>
          </div>
        </div>

        <div class="modal-footer-custom">
          <button type="button" class="btn-cancel-modal" id="cancelUpdate">
            <i class="fas fa-times"></i> Cancel
          </button>
          <button type="submit" class="btn-submit-modal">
            <i class="fas fa-save"></i> Update Location
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="custom-modal-overlay" id="successModal">
    <div class="custom-modal-content">
      <div class="custom-modal-body">
        <div class="success-icon-modal mb-4">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <h3 class="mb-3" id="modalTitle">Update Successful!</h3>
        <p class="text-muted mb-4" id="modalMessage">Vessel location has been updated successfully.</p>
        <button type="button" class="btn-modal-close" id="closeSuccessModal">
          <i class="bi bi-check-lg"></i> Close
        </button>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
      <div class="footer-top">
        <nav class="footer-nav" data-aos="fade-up" data-aos-delay="200">
          <ul>
            <li><a href="#">VESSELS</a></li>
            <li><a href="#">PORTS</a></li>
            <li><a href="#">ANALYTICS</a></li>
            <li><a href="#">TRACKING</a></li>
            <li><a href="#">NEWS</a></li>
          </ul>
        </nav>

        <div class="social-links" data-aos="fade-up" data-aos-delay="400">
          <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
        </div>

        <div class="footer-links" data-aos="fade-up" data-aos-delay="600">
          <a href="#">CONTACT</a>
          <a href="#">API DOCS</a>
          <a href="#">SUPPORT</a>
          <a href="#">PRIVACY</a>
          <a href="#">TERMS</a>
        </div>
      </div>
    </div>

    <div class="footer-bottom" data-aos="fade-up" data-aos-delay="800">
      <div class="container">
        <p>
          REAL-TIME VESSEL TRACKING, CRAFTED WITH ⚓ IN THE MARITIME INDUSTRY<br>
          ©<span class="footer-brand">AQUATRACE</span> | ALL RIGHTS RESERVED
        </p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="vesseluser_script.js"></script>

  <script>
    // Sample vessel data - In production, this would come from a database
    let vessels = [{
        id: 1,
        name: "MV Pacific Explorer",
        type: "Cargo Vessel",
        imo: "IMO9876543",
        owner: "John Doe",
        homePort: "Manila",
        flag: "Philippines",
        loa: "185.5",
        grossTonnage: "25,400",
        status: "Active",
        location: "7.05,125.7",
        locationName: "En Route - Davao Gulf",
        arrival: "",
        departure: "",
        notes: "",
        history: []
      },
      {
        id: 2,
        name: "SS Manila Star",
        type: "Passenger Ferry",
        imo: "IMO8765432",
        owner: "Jane Smith",
        homePort: "Cebu",
        flag: "Philippines",
        loa: "120.0",
        grossTonnage: "15,200",
        status: "Docked",
        location: "7.128,125.664",
        locationName: "Davao City Port",
        arrival: "2024-01-15T08:30",
        departure: "",
        notes: "Scheduled maintenance",
        history: []
      },
      {
        id: 3,
        name: "MV Coral Queen",
        type: "Cargo Vessel",
        imo: "IMO7654321",
        owner: "Mike Johnson",
        homePort: "Davao",
        flag: "Philippines",
        loa: "200.0",
        grossTonnage: "30,500",
        status: "Active",
        location: "7.0,125.6",
        locationName: "En Route - Davao Gulf",
        arrival: "",
        departure: "2024-01-14T14:00",
        notes: "",
        history: []
      }
    ];

    let map;
    let markers = {};
    let currentEditingVessel = null;

    // Initialize everything when DOM is loaded
    document.addEventListener("DOMContentLoaded", function() {
      AOS.init({
        duration: 1000,
        once: true,
        offset: 100
      });

      initSidebar();
      initNavbar();
      initMap();
      renderVessels();
      updateStatistics();
      initModalHandlers();
    });

    // ==================== SIDEBAR ====================
    function initSidebar() {
      const sidebar = document.getElementById('sidebar');
      const sidebarOverlay = document.getElementById('sidebarOverlay');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebarClose = document.getElementById('sidebarClose');

      function openSidebar() {
        sidebar.classList.add('active');
        sidebarOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeSidebar() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        document.body.style.overflow = '';
      }

      sidebarToggle.addEventListener('click', openSidebar);
      sidebarClose.addEventListener('click', closeSidebar);
      sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // ==================== NAVBAR ====================
    function initNavbar() {
      window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });
    }

    // ==================== MAP INITIALIZATION ====================
    function initMap() {
      setTimeout(function() {
        map = L.map('map').setView([7.0, 125.5], 9);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add port markers
        const ports = [{
            name: 'Davao City Port',
            coords: [7.128, 125.664]
          },
          {
            name: 'Samal Island Port',
            coords: [7.133, 125.783]
          },
          {
            name: 'Tagum Port',
            coords: [7.443, 125.807]
          },
          {
            name: 'Mati Port',
            coords: [6.951, 126.243]
          }
        ];

        const portIcon = L.divIcon({
          className: 'custom-marker port-marker',
          html: '<div style="background: rgba(255,255,255,0.9); border-radius: 50%; padding: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"><i class="fas fa-anchor" style="font-size: 24px; color: #007bff;"></i></div>',
          iconSize: [40, 40],
          iconAnchor: [20, 20]
        });

        ports.forEach(port => {
          L.marker(port.coords, {
              icon: portIcon
            })
            .addTo(map)
            .bindPopup(`<b>${port.name}</b>`);
        });

        // Add vessel markers
        updateMapMarkers();

        window.map = map;
        map.invalidateSize();
      }, 200);
    }

    // ==================== UPDATE MAP MARKERS ====================
    function updateMapMarkers() {
      // Clear existing vessel markers
      Object.values(markers).forEach(marker => map.removeLayer(marker));
      markers = {};

      // Add new markers for each vessel
      vessels.forEach(vessel => {
        const coords = vessel.location.split(',').map(Number);
        const color = getStatusColor(vessel.status);

        const vesselIcon = L.divIcon({
          className: 'custom-marker vessel-marker',
          html: `<div style="background: rgba(255,255,255,0.9); border-radius: 50%; padding: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"><i class="fas fa-ship" style="font-size: 20px; color: ${color};"></i></div>`,
          iconSize: [35, 35],
          iconAnchor: [17.5, 17.5]
        });

        const marker = L.marker(coords, {
            icon: vesselIcon
          })
          .addTo(map)
          .bindPopup(`
        <div style="text-align: center;">
          <b>${vessel.name}</b><br>
          <span style="color: ${color}; font-weight: 600;">${vessel.status}</span><br>
          <small>${vessel.locationName}</small>
        </div>
      `);

        markers[vessel.id] = marker;
      });
    }

    function getStatusColor(status) {
      switch (status) {
        case 'Active':
          return '#28a745';
        case 'Docked':
          return '#007bff';
        case 'In Transit':
          return '#ffc107';
        default:
          return '#6c757d';
      }
    }

    // ==================== RENDER VESSELS ====================
    function renderVessels() {
      const container = document.getElementById('vesselsContainer');

      if (vessels.length === 0) {
        container.innerHTML = `
      <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h4>No vessels registered yet</h4>
        <p>Register your first vessel to start tracking!</p>
      </div>
    `;
        return;
      }

      container.innerHTML = vessels.map(vessel => `
    <div class="vessel-card" data-aos="fade-up">
      <div class="vessel-header">
        <div class="vessel-icon"><i class="fas fa-ship"></i></div>
        <div class="vessel-title">
          <h3>${vessel.name}</h3>
          <span class="vessel-type">${vessel.type}</span>
        </div>
        <span class="status-badge status-${vessel.status.toLowerCase().replace(' ', '-')}">${vessel.status}</span>
      </div>
      <div class="vessel-details">
        <div class="detail-item">
          <i class="fas fa-id-card"></i>
          <div class="detail-content">
            <div class="detail-label">IMO Number</div>
            <div class="detail-value">${vessel.imo}</div>
          </div>
        </div>
        <div class="detail-item">
          <i class="fas fa-map-marker-alt"></i>
          <div class="detail-content">
            <div class="detail-label">Current Location</div>
            <div class="detail-value">${vessel.locationName}</div>
          </div>
        </div>
        <div class="detail-item">
          <i class="fas fa-user"></i>
          <div class="detail-content">
            <div class="detail-label">Owner</div>
            <div class="detail-value">${vessel.owner}</div>
          </div>
        </div>
        <div class="detail-item">
          <i class="fas fa-anchor"></i>
          <div class="detail-content">
            <div class="detail-label">Home Port</div>
            <div class="detail-value">${vessel.homePort}</div>
          </div>
        </div>
        <div class="detail-item">
          <i class="fas fa-flag"></i>
          <div class="detail-content">
            <div class="detail-label">Flag State</div>
            <div class="detail-value">${vessel.flag}</div>
          </div>
        </div>
        <div class="detail-item">
          <i class="fas fa-ruler"></i>
          <div class="detail-content">
            <div class="detail-label">Length (LOA)</div>
            <div class="detail-value">${vessel.loa} meters</div>
          </div>
        </div>
        ${vessel.arrival ? `
          <div class="detail-item">
            <i class="fas fa-calendar-check"></i>
            <div class="detail-content">
              <div class="detail-label">Arrival</div>
              <div class="detail-value">${formatDateTime(vessel.arrival)}</div>
            </div>
          </div>
        ` : ''}
        ${vessel.departure ? `
          <div class="detail-item">
            <i class="fas fa-calendar-times"></i>
            <div class="detail-content">
              <div class="detail-label">Departure</div>
              <div class="detail-value">${formatDateTime(vessel.departure)}</div>
            </div>
          </div>
        ` : ''}
      </div>
      <div class="vessel-actions mt-3">
        <button class="btn-update" onclick="openUpdateModal(${vessel.id})">
          <i class="fas fa-edit"></i> Update Location
        </button>
        <button class="btn-history" onclick="viewHistory(${vessel.id})">
          <i class="fas fa-history"></i> View History
        </button>
      </div>
    </div>
  `).join('');
    }

    // ==================== UPDATE STATISTICS ====================
    function updateStatistics() {
      const total = vessels.length;
      const active = vessels.filter(v => v.status === 'Active').length;
      const docked = vessels.filter(v => v.status === 'Docked').length;
      const transit = vessels.filter(v => v.status === 'In Transit').length;

      document.getElementById('totalVessels').textContent = total;
      document.getElementById('activeVessels').textContent = active;
      document.getElementById('dockedVessels').textContent = docked;
      document.getElementById('transitVessels').textContent = transit;
    }

    // ==================== MODAL HANDLERS ====================
    function initModalHandlers() {
      const updateModal = document.getElementById('updateModal');
      const successModal = document.getElementById('successModal');
      const updateForm = document.getElementById('updateVesselForm');

      // Close buttons
      document.getElementById('closeUpdateModal').onclick = closeUpdateModal;
      document.getElementById('cancelUpdate').onclick = closeUpdateModal;
      document.getElementById('closeSuccessModal').onclick = closeSuccessModal;

      // Click outside to close
      updateModal.onclick = (e) => {
        if (e.target === updateModal) closeUpdateModal();
      };

      successModal.onclick = (e) => {
        if (e.target === successModal) closeSuccessModal();
      };

      // Form submission
      updateForm.onsubmit = (e) => {
        e.preventDefault();
        handleUpdateSubmit();
      };
    }

    function openUpdateModal(vesselId) {
      const vessel = vessels.find(v => v.id === vesselId);
      if (!vessel) return;

      currentEditingVessel = vesselId;

      // Populate modal
      document.getElementById('modalVesselName').textContent = vessel.name;
      document.getElementById('modalVesselType').textContent = vessel.type;
      document.getElementById('updateLocation').value = vessel.location;
      document.getElementById('updateStatus').value = vessel.status;
      document.getElementById('updateArrival').value = vessel.arrival || '';
      document.getElementById('updateDeparture').value = vessel.departure || '';
      document.getElementById('updateNotes').value = vessel.notes || '';

      // Show modal
      document.getElementById('updateModal').classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeUpdateModal() {
      document.getElementById('updateModal').classList.remove('show');
      document.body.style.overflow = '';
      currentEditingVessel = null;
    }

    function closeSuccessModal() {
      document.getElementById('successModal').classList.remove('show');
      document.body.style.overflow = '';
    }

    function handleUpdateSubmit() {
      const vessel = vessels.find(v => v.id === currentEditingVessel);
      if (!vessel) return;

      const locationValue = document.getElementById('updateLocation').value;
      const locationText = document.getElementById('updateLocation').selectedOptions[0].text;
      const status = document.getElementById('updateStatus').value;
      const arrival = document.getElementById('updateArrival').value;
      const departure = document.getElementById('updateDeparture').value;
      const notes = document.getElementById('updateNotes').value;

      // Save to history
      vessel.history.push({
        timestamp: new Date().toISOString(),
        location: vessel.location,
        locationName: vessel.locationName,
        status: vessel.status,
        arrival: vessel.arrival,
        departure: vessel.departure
      });

      // Update vessel data
      vessel.location = locationValue;
      vessel.locationName = locationText;
      vessel.status = status;
      vessel.arrival = arrival;
      vessel.departure = departure;
      vessel.notes = notes;

      // Update UI
      renderVessels();
      updateStatistics();
      updateMapMarkers();

      // Close update modal and show success
      closeUpdateModal();

      document.getElementById('modalTitle').textContent = 'Location Updated!';
      document.getElementById('modalMessage').textContent = `${vessel.name} has been updated successfully. The map has been refreshed with the new location.`;
      document.getElementById('successModal').classList.add('show');
    }

    function viewHistory(vesselId) {
      const vessel = vessels.find(v => v.id === vesselId);
      if (!vessel) return;

      if (vessel.history.length === 0) {
        alert('No movement history available for this vessel yet.');
        return;
      }

      let historyText = `Movement History for ${vessel.name}:\n\n`;
      vessel.history.forEach((entry, index) => {
        historyText += `${index + 1}. ${formatDateTime(entry.timestamp)}\n`;
        historyText += `   Location: ${entry.locationName}\n`;
        historyText += `   Status: ${entry.status}\n\n`;
      });

      alert(historyText);
    }

    // ==================== HELPER FUNCTIONS ====================
    function formatDateTime(datetime) {
      if (!datetime) return 'N/A';
      const date = new Date(datetime);
      return date.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      });
    }
  </script>

</body>

</html>