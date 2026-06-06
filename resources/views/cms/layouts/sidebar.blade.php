<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cms.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
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
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="mdi mdi-domain menu-icon"></i>
                <span class="menu-title">Department</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.department.index') }}">List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('cms.department.index') }}">Create</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
