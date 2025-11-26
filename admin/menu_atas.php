<style>
    .navbar-brand span {
    font-size: 18px;
    letter-spacing: 0.5px;
}
.dropdown-menu-right {
    min-width: 180px;
}
.navbar .btn-dark:hover {
    background:#333 !important;
}

</style>
<!-- TOP NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
    
    <!-- Menu toggle (mobile) -->
    <button class="btn btn-light d-lg-none ml-2 mr-2" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="../img/logo.png" alt="Logo" style="height:35px; margin-right:8px;">
        <span class="font-weight-bold">SIRS Admin</span>
    </a>

    <!-- Right Actions -->
    <ul class="navbar-nav ml-auto">
        
        <!-- Dark Mode Toggle -->
        <li class="nav-item">
            <button class="btn btn-dark btn-sm mt-1 mr-2" onclick="toggleDarkMode()">
                <i class="fas fa-adjust"></i>
            </button>
        </li>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="profileDropdown" role="button" data-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow">
                <span class="dropdown-item-text">
                    <i class="fas fa-user mr-2"></i><b><?php echo $_SESSION['user']; ?></b>
                </span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="../logout.php">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<script>
    // Toggle Sidebar (Mobile)
    document.getElementById("menu-toggle").onclick = function(){
        document.getElementById("sidebar").classList.toggle("show");
    }

    // Toggle Dark Mode
    function toggleDarkMode(){
        document.body.classList.toggle("dark-mode");
        document.body.classList.toggle("light-mode");
        localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
    }

    // Apply theme saved
    (function(){
        let theme = localStorage.getItem("theme");
        document.body.classList.add(theme === "dark" ? "dark-mode" : "light-mode");
    })();
</script>

