<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BoxIcons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="logindesign.css">

    <title>AquaTrace | Login & Registration</title>

</head>

<body>
    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="web_landing.html">
                <img src="images/— AQUATRACE —.png" alt="AquaTrace" height="40" loading="eager">
                <p>AQUATRACE</p>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="web_landing.html">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="vessel_landing.html">VESSELS</a></li>
                    <li class="nav-item"><a class="nav-link" href="ports_landing.html">PORTS</a></li>
                    <li class="nav-item"><a class="nav-link" href="news_landing.html">NEWS</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            ABOUT
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="about_landing.html">ABOUT US</a></li>
                            <li><a class="dropdown-item" href="contact_landing.html">CONTACT</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="analytics_landing.html">ANALYTICS</a></li>
                </ul>
                <div class="d-flex">
                    <a onclick="showRegister()" class="btn btn-outline-light btn-sm me-2">SIGN UP</a>
                    <a onclick="showLogin()" class="btn btn-outline-light btn-sm">LOG IN</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <div class="form-box">

            <!-- Close Button -->
            <button class="close-btn" onclick="goHome()" title="Close"> 
                <i class="bx bx-x"></i>
            </button>

            <!-- LOGIN FORM -->
            <div class="login-container" id="login">
                <div class="top">
                    <span>Don't have an account? <a onclick="showRegister()">Sign Up</a></span>
                    <header>Login</header>
                </div>
                <form action="php/owner_login_process.php" method="POST">
                    <div class="input-box">
                        <input type="text" class="input-field" name="username" placeholder="Username or Email">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" name="password" placeholder="Password" id="loginPassword">
                        <i class="bx bx-hide password-toggle" onclick="togglePassword('loginPassword', this)"></i>
                    </div>
                    <?php
                        if (isset($_GET['error'])){
                            $error = $_GET['error'];
                            echo "<small class='text-muted'>$error</small>";
                        }
                    ?>
                    <div class="input-box">
                        <button class="btn btn-primary">Log in</button>
                    </div>
                </form>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a>Forgot password?</a></label>
                    </div>
                </div>

                <!-- Admin Login Icon -->
                <div style="text-align: center; margin-top: 20px;">
                    <div class="admin-icon-btn" onclick="showAdmin()" title="Admin Login">
                        <i class="bx bx-user"></i>
                        <span>Admin Login</span>
                    </div>
                </div>
            </div>

            <!-- REGISTER FORM -->
            <div class="register-container hidden" id="register">
                <div class="top">
                    <span>Have an account? <a onclick="showLogin()">Login</a></span>
                    <header>Sign Up</header>
                </div>
                <form id="initialRegisterForm" onsubmit="return proceedToFullRegistration(event)">
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="First Name" id="firstName" required>
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Last Name" id="lastName" required>
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="email" class="input-field" placeholder="Email" id="email" required>
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password" id="password" required>
                        <i class="bx bx-hide password-toggle" onclick="togglePassword('password', this)"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Confirm Password" id="confirmPassword"
                            required>
                        <i class="bx bx-hide password-toggle" onclick="togglePassword('confirmPassword', this)"></i>
                    </div>
                    <div class="input-box">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" id="register-check">
                            <label for="register-check"> Remember Me</label>
                        </div>
                        <div class="two">
                            <label><a>Terms & conditions</a></label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ADMIN LOGIN FORM -->
            <div class="admin-container hidden" id="admin">
                <div class="top">
                    <span>Regular user? <a onclick="showLogin()">User Login</a></span>
                    <header>Admin Login</header>
                </div>
                <form action="php/admin_login_process.php" method="POST">
                    <div class="input-box">
                        <input type="text" class="input-field" name="username" placeholder="Admin Username">
                        <i class="bx bx-shield"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" name="password" placeholder="Admin Password" id="adminPassword">
                        <i class="bx bx-hide password-toggle" onclick="togglePassword('adminPassword', this)"></i>
                    </div>
                                        
                    <?php
                        if (isset($_GET['error'])){
                            $error = $_GET['error'];
                            echo "<small class='text-muted'>$error</small>";
                        }
                    ?>

                    <div class="input-box">
                        <button type="submit" class="btn btn-primary">Admin Log in</button>
                    </div>
                </form>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="admin-check">
                        <label for="admin-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a>Contact Support</a></label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <nav class="footer-nav">
                    <ul>
                        <li><a href="#">VESSELS</a></li>
                        <li><a href="#">PORTS</a></li>
                        <li><a href="#">ANALYTICS</a></li>
                        <li><a href="#">TRACKING</a></li>
                        <li><a href="#">NEWS</a></li>
                    </ul>
                </nav>

                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <div class="footer-links">
                    <a href="#">CONTACT</a>
                    <a href="#">API DOCS</a>
                    <a href="#">SUPPORT</a>
                    <a href="#">PRIVACY</a>
                    <a href="#">TERMS</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>
                    REAL-TIME VESSEL TRACKING, CRAFTED WITH ⚓ IN THE MARITIME INDUSTRY<br>
                    ©<span class="footer-brand">AQUATRACE</span> | ALL RIGHTS RESERVED
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('bx-hide');
                iconElement.classList.add('bx-show');
            } else {
                input.type = 'password';
                iconElement.classList.remove('bx-show');
                iconElement.classList.add('bx-hide');
            }
        }

        function showLogin() {
            document.getElementById('login').classList.remove('hidden');
            document.getElementById('register').classList.add('hidden');
            document.getElementById('admin').classList.add('hidden');
        }

        function showRegister() {
            document.getElementById('login').classList.add('hidden');
            document.getElementById('register').classList.remove('hidden');
            document.getElementById('admin').classList.add('hidden');
        }

        function showAdmin() {
            document.getElementById('login').classList.add('hidden');
            document.getElementById('register').classList.add('hidden');
            document.getElementById('admin').classList.remove('hidden');
        }

        function goHome() {
            window.location.href = 'web_landing.html';
        }

        function proceedToFullRegistration(event) {

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return false;
            }

            // Store initial registration data
            const registrationData = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                password: password
            };

            // Store in sessionStorage to pass to next page
            sessionStorage.setItem('registrationData', JSON.stringify(registrationData));

            // Redirect to full registration page
            window.location.href = 'loginRegister.php';

            return false;
        }

        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        window.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const form = urlParams.get('form');

            if (form === 'register') {
                showRegister();
            } else if (form === 'login') {
                showLogin();
            } else if (form === 'admin') {
                showAdmin();
            }
        });

    </script>

</body>

</html>