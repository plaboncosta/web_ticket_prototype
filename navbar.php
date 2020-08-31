<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">My Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Verify Ticket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" onclick="logOutUser()">Log out</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileMenuLink"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="./assets/images/language.webp" class="language-icon" alt="">
                    ENG
                </a>
                <div class="dropdown-menu" aria-labelledby="profileMenuLink">
                    <a class="dropdown-item" href="#">BANG</a>
                    <a class="dropdown-item" href="#">ENG</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hey <?php echo !empty($_SESSION['user_info']['first_name']) ? $_SESSION['user_info']['first_name'] : ''; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="icofont-user-alt-2"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>