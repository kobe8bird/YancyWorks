<ul class="menu-nav">
    <li class="menu-item  {{ Request::segment(2) == 'dashboard' ? 'menu-item-active' : '' }}" aria-haspopup="true">
        <a href="{{ route('admin.dashboard') }}" class="menu-link ">
            <i class="menu-icon flaticon2-dashboard"></i>
            <span class="menu-text">Dashboard</span>
        </a>
    </li>
    <li class="menu-section">
        <h4 class="menu-text">Application</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item {{ Request::segment(2) == 'companies' ? 'menu-item-active' : '' }}" aria-haspopup="true">
        <a href="{{ route('admin.company.index') }}" class="menu-link">
            <i class="menu-icon flaticon-home"></i>
            <span class="menu-text">Companies</span>
        </a>
    </li>
    <li class="menu-item {{ Request::segment(2) == 'employees' ? 'menu-item-active' : '' }}" aria-haspopup="true">
        <a href="{{ route('admin.employee.index') }}" class="menu-link">
            <i class="menu-icon flaticon2-group"></i>
            <span class="menu-text">Employees</span>
        </a>
    </li>
    
</ul>