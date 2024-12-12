<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Portal Factura</title>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <!-- BOOTSTRAP 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <!-- BOOTSTRAP 5 (OFFLINE)-->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- ICONOS BOOTSTRAP 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
    /* Estilos personalizados para la barra de navegación */
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    *,
    ::after,
    ::before {
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    #sidebar,
    .sidebar-nav,
    #side-navbar {
        background-color: #252525;
    }

    h3 {
        font-size: 1.2375rem;
        color: #000000;
    }

    a {
        cursor: pointer;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
    }

    li {
        list-style: none;
    }

    /* Layout skeleton */

    .wrapper {
        align-items: stretch;
        display: flex;
        width: 100%;
    }

    #sidebar {
        max-width: 264px;
        min-width: 264px;
        transition: all 0.35s ease-in-out;
        box-shadow: 0 0 35px 0 rgba(49, 57, 66, 0.5);
        z-index: 1111;
    }

    /* Sidebar collapse */

    #sidebar.collapsed {
        margin-left: -264px;
    }

    .main {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
        transition: all 0.35s ease-in-out;
    }

    .sidebar-logo {
        padding: 1.15rem 1.5rem;
    }

    .sidebar-logo a {
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .sidebar-nav {
        padding: 0;
    }

    .sidebar-header {
        color: #ffffff;
        font-size: .75rem;
        padding: 1.5rem 1.5rem .375rem;
    }

    a.sidebar-link {
        padding: .625rem 1.625rem;
        color: #ffffff;
        position: relative;
        display: block;
        font-size: 1rem;
    }

    .sidebar-link[data-bs-toggle="collapse"]::after {
        border: solid;
        border-width: 0 .075rem .075rem 0;
        content: "";
        display: inline-block;
        padding: 2px;
        position: absolute;
        right: 1.5rem;
        top: 1.4rem;
        transform: rotate(-135deg);
        transition: all .2s ease-out;
    }

    .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
        transform: rotate(45deg);
        transition: all .2s ease-out;
    }

    .content {
        flex: 1;
        max-width: 100vw;
        width: 100vw;
    }

    /* Responsive */

    @media (min-width:768px) {
        .content {
            width: auto;
        }
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">

                <!-- Titulo -->
                <div class="sidebar-logo">
                    <a href="portal.php">Portal facturas</a>
                </div>

                <!-- Apartados -->
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Gestion
                    </li>

                    <li class="sidebar-item">
                        <a href="Alumnos.php" class="sidebar-link">
                            <i class="bi bi-file-earmark-person"></i>
                            Alumnos
                        </a>

                    </li>
                    <li class="sidebar-item">
                        <a href="Padres.php" class="sidebar-link">
                            <i class="bi bi-person-fill"></i>
                            Padres
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="Bitacora.php" class="sidebar-link collapsed">
                            <i class="bi bi-building"></i>
                            Administración
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Facturación
                    </li>
                    <li class="sidebar-item">
                        <a href="factura.php" class="sidebar-link collapsed">
                            <i class="bi bi-file-earmark-diff"></i>
                            Crear factura
                        </a>
                    </li>
                </ul>


            </div>
        </aside>
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom" id="side-navbar">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button" data-bs-theme="dark">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">

                    </div>
                </div>