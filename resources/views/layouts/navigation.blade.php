<!-- Navbar -->
<?php if(Auth::user()->role == '1') {?>
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
    <!-- Settings Dropdown -->
    <x-dropdown>
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-dark dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')" class="bg-gray text-dark dark:text-gray-400">
                {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();" class="bg-red text-dark dark:text-gray-400">
                    {{ __('Se déconnecter') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
        {{-- <img src="logo/favicon.ico"> --}}
        <x-application-logo/>

    <!-- Sidebar -->
    <div class="sidebar mt-2">

        <!-- Sidebar Menu -->
        <nav class="">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                <a href="/dashboard" class="nav-link" active="request()->routeIs('dashboard')">
                    <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                    <p>
                    Accueil
                    </p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/pointage" class="nav-link" active="request()->routeIs('index')">
                        <i class="nav-icon fas fa-qrcode text-info"></i>
                        <p>Scanner le QR Code</p>
                    </a>
                    </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-tie text-info"></i>
                    <p>
                    Personnel
                    <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="/pointpersonnel" class="nav-link" active="request()->routeIs('Pointpers')">
                        <i class="far fa-hand-pointer nav-icon"></i>
                        <p>Liste pointage</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="/listepersonnel" class="nav-link" active="request()->routeIs('Listepers')">
                        <i class="far fa-list-alt nav-icon"></i>
                        <p>Liste personnel</p>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-friends text-info"></i>
                    <p>
                        CI/OS
                        <i class="fas fa-angle-left right"></i>

                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/pointAS" class="nav-link" active="request()->routeIs('PointAS')">
                        <i class="far fa-hand-pointer nav-icon"></i>
                        <p>Liste pointage</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/listeAS" class="nav-link" active="request()->routeIs('ListeAS')">
                        <i class="far fa-list-alt nav-icon"></i>
                        <p>Liste CI/OS</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                <a href="/visiteur" class="nav-link" active="request()->routeIs('Visiteur')">
                    <i class="nav-icon fas fa-users text-info"></i>
                    <p>Visiteur</p>
                </a>
                </li>
                <?php if(Auth::user()->admin == '1') {?>
                <li class="nav-item">
                    <a href="/utilisateur" class="nav-link" active="request()->routeIs('Utilisateur')">
                    <i class="nav-icon fas fa-user text-info"></i>
                    <p>Utisateur</p>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php } ?>
