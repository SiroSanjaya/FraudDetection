<li class="nav-item">
    <a class="nav-link {{ request()->is('leads*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#leadsManagementCollapse" aria-expanded="false" aria-controls="leadsManagementCollapse">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Leads Management</span>
    </a>
    <div class="collapse" id="leadsManagementCollapse">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('leads.index') }}">View Leads</a></li>
            <li class="list-group-item"><a href="{{ route('leads.create') }}">Create Lead</a></li>
        </ul>
    </div>
</li>