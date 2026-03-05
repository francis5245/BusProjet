<div class="sidebar">
    <div class="logo">
      <img src="{{ asset('asset/image/icone.png') }}" alt="Logo">
      <span>BUS365</span>
    </div>
    <div class="user">
      <img src="{{ asset('asset/image/Avatar.jpg') }}" alt="User" class="rounded-circle">
      <span>Super Admin</span>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
          <i class="fas fa-th-large"></i> <span>Tableau de bord</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.drive.dashboard') }}" class="nav-link">
          <i class="fas fa-tachometer-alt"></i> <span>Tableau de bord du conducteur</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#dashboardTicketSubmenu" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
          <i class="fas fa-ticket-alt"></i> <span>Réservation de billet</span> <i class="fas fa-caret-down ms-auto"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="dashboardTicketSubmenu">
          <li class="nav-item"><a href="TicketBooking.html#book" class="nav-link sub-link"><i class="fas fa-plus"></i> <span>Réservez votre billet</span></a></li>
          <li class="nav-item"><a href="TicketBooking.html#tickets" class="nav-link sub-link"><i class="fas fa-list"></i> <span>Liste des billets</span></a></li>
          <li class="nav-item"><a href="TicketBooking.html#journey" class="nav-link sub-link"><i class="fas fa-route"></i> <span>Liste des parcours</span></a></li>
          <li class="nav-item"><a href="TicketBooking.html#refund" class="nav-link sub-link"><i class="fas fa-undo"></i> <span>Liste des remboursements</span></a></li>
          <li class="nav-item"><a href="TicketBooking.html#cancel" class="nav-link sub-link"><i class="fas fa-times"></i> <span>Liste des annulations</span></a></li>
          <li class="nav-item"><a href="TicketBooking.html#booktime" class="nav-link sub-link"><i class="fas fa-clock"></i> <span>Heure de réservation</span></a></li>
          <li class="nav-item"><a href="TicketBooking.html#bookingtimelist" class="nav-link sub-link"><i class="far fa-clock"></i> <span>Liste des heures de réservation</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#agentSubmenu" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
          <i class="fas fa-users"></i> <span>Agent</span> <i class="fas fa-caret-down ms-auto"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="agentSubmenu">
          <li class="nav-item"><a href="Agent_list.html" class="nav-link sub-link"><i class="fas fa-list"></i> <span>Liste des agents</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#accountSubmenu" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
          <i class="fas fa-wallet"></i> <span>Compte</span> <i class="fas fa-caret-down ms-auto"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="accountSubmenu">
          <li class="nav-item"><a href="TransactionList.html" class="nav-link sub-link"><i class="fas fa-list"></i> <span>Liste des transactions</span></a></li>
          <li class="nav-item"><a href="AgentPayment.html" class="nav-link sub-link"><i class="fas fa-money-bill-wave"></i> <span>Paiement de l'agent</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#passengerSubmenu" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
          <i class="fas fa-user"></i> <span>Passenger</span> <i class="fas fa-caret-down ms-auto"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="passengerSubmenu">
          <li class="nav-item"><a href="PassagerList.html" class="nav-link sub-link"><i class="fas fa-list"></i> <span>Liste des passagers</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#employeeSubmenu" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
          <i class="fas fa-briefcase"></i> <span>Employé</span> <i class="fas fa-caret-down ms-auto"></i>
        </a>
        <ul class="collapse list-unstyled submenu" id="employeeSubmenu">
          <li class="nav-item"><a href="employerTypeList.html" class="nav-link sub-link"><i class="fas fa-list"></i> <span>Liste des types d'employés</span></a></li>
          <li class="nav-item"><a href="EmployeeList.html" class="nav-link sub-link"><i class="fas fa-users"></i> <span>Liste des employés</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-chart-bar"></i> <span>Rapport</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-question-circle"></i> <span>Enquête</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-suitcase"></i> <span>Bagage</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-cogs"></i> <span>Paramètres logiciels</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-wrench"></i> <span>Paramètres du site web</span>
        </a>
      </li>
    </ul>
  </div>
