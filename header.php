<nav class="navbar navbar-expand bg-dark navbar-dark sticky-top">
        <div class="container-lg">
            <a class="navbar-brand" href="."><i class="bi bi-search-heart-fill"></i></i>Kafee</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil ['username'];
                        ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-fill"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="logout"><i class="bi bi-door-open-fill"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>