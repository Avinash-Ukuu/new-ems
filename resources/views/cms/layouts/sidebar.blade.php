<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cms.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#user-management" aria-expanded="false"
                aria-controls="user-management">
                <i class="mdi-account-group mdi menu-icon"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.user.index') }}">Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.role.index') }}">Roles</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.permission.index') }}">Permission</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.module.index') }}">Modules</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#designation" aria-expanded="false"
                aria-controls="designation">
                <i class="mdi mdi-account-file-outline menu-icon"></i>
                <span class="menu-title">Designation</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="designation">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.designation.index') }}">List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.designation.index') }}">Create</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
