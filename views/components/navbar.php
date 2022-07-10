<?php
use App\Services\Router;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">My-Home</a>
        <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01"
                aria-controls="navbarExample01"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 top-menu">
                <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                        <i class="fa-solid fa-user-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <?php
                            if(!isset($_SESSION['user'])) {
                                ?>
                                <a class="dropdown-item" href="/login">login</a>
                                <?php
                            }else {
                                ?>
                                <a class="dropdown-item" href="/logout">logout</a>
                                <?php
                            }
                            ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>