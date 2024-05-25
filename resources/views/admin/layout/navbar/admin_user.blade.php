<!-- User Management with Collapse -->
<li class="nav-item">
    <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#userManagementCollapse" aria-expanded="false" aria-controls="userManagementCollapse">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">User Management</span>
    </a>
    <div class="collapse" id="userManagementCollapse">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('users.index') }}">Manage Users</a></li>
            <li class="list-group-item"><a href="{{ route('roles.index') }}">Assign Permissions</a></li>
            <li class="list-group-item"><a href="{{ route('permissions.create') }}">Add New Permission</a></li>

            <!-- Additional links can be added here if needed in the future -->
        </ul>
    </div>
</li>
<!-- Leads Management Dropdown converted to Collapse for Bootstrap 5 -->
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
            <li class="list-group-item"><a href="{{ route('lead.approvals.index') }}">Leads Approval</a></li>

        </ul>
    </div>
</li>
<!-- Customer Management Dropdown converted to Collapse for Bootstrap 5 -->
<li class="nav-item">
    <a class="nav-link {{ request()->is('customers*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#customerManagementCollapse" aria-expanded="false" aria-controls="customerManagementCollapse">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-briefcase-24 text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Customer Management</span>
    </a>
    <div class="collapse" id="customerManagementCollapse">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('customers.index') }}">View Customers</a></li>
            <!-- Additional customer-related links can be added here -->
        </ul>
    </div>
    </li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('items*') ? 'active' : '' }}" href="{{ route('items.index') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-box-2 text-success text-sm opacity-10"></i> <!-- Changed the icon to represent 'items' -->
        </div>
        <span class="nav-link text-white ms-1">Manage Items</span> <!-- Changed the text to reflect the link's purpose -->
    </a>
</li>
<!-- Order Management Dropdown -->
<li class="nav-item">
    <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#orderManagementCollapse" aria-expanded="false" aria-controls="orderManagementCollapse">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-cart text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Order Management</span>
    </a>
    <div class="collapse" id="orderManagementCollapse">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('orders.index') }}">View Orders</a></li>
            <li class="list-group-item"><a href="{{ route('orders.create') }}">Create Order</a></li>
            <!-- Additional order-related links can be added here -->
        </ul>
    </div>
</li>



<li class="nav-item">
    <a class="nav-link {{ request()->is('DataPoint*') ? 'active' : '' }}" href="{{ route('DataPoint') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Data Point</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('DataOrder*') ? 'active' : '' }}" href="{{ route('DataOrder') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Data Order</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('DeliveryOrder*') ? 'active' : '' }}" href="{{ route('DeliveryOrder') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Delivery Order</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('PointActivity*') ? 'active' : '' }}" href="{{ route('PointActivity') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Fraud Point</span>
    </a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link {{ request()->is('PointActivity*') ? 'active' : '' }}" href="{{ route('PointActivity') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link text-white ms-1">Fraud Point Activity</span>
    </a>
</li> --}}
