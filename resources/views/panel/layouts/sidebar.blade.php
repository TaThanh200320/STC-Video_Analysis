<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
            $PermissionUser = App\Models\PermissionRole::getPermission('user', Auth::user()->role_id);
            $PermissionRole = App\Models\PermissionRole::getPermission('role', Auth::user()->role_id);
            $PermissionConfig = App\Models\PermissionRole::getPermission('config', Auth::user()->role_id);
            $PermissionAlarm = App\Models\PermissionRole::getPermission('alarm', Auth::user()->role_id);
            $PermissionEvents = App\Models\PermissionRole::getPermission('events', Auth::user()->role_id);
            $PermissionVideoAnalysis = App\Models\PermissionRole::getPermission(
                'video-analysis',
                Auth::user()->role_id,
            );
        @endphp

        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) != 'dashboard') collapsed @endif" href="{{ url('panel/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (!empty($PermissionUser))
            <li class="nav-item @if (Request::segment(2) != 'user') collapsed @endif">
                <a class="nav-link" href="{{ url('panel/user') }}">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li>
        @endif

        @if (!empty($PermissionRole))
            <li class="nav-item @if (Request::segment(2) != 'role') collapsed @endif">
                <a class="nav-link" href="{{ url('panel/role') }}">
                    <i class="bi bi-person"></i>
                    <span>Role</span>
                </a>
            </li>
        @endif

        @if (!empty($PermissionConfig))
            <li class="nav-item @if (Request::segment(2) != 'config') collapsed @endif">
                <a class="nav-link" href="{{ url('panel/permission') }}">
                    <i class="bi bi-person"></i>
                    <span>Config</span>
                </a>
            </li>
        @endif

        @if (!empty($PermissionAlarm))
            <li class="nav-item @if (Request::segment(2) != 'alarm') collapsed @endif">
                <a class="nav-link" href="{{ url('panel/alarm') }}">
                    <i class="bi bi-bookmarks"></i>
                    <span>Alarm</span>
                </a>
            </li>
        @endif

        @if (!empty($PermissionEvents))
            <li class="nav-item @if (Request::segment(2) != 'events') collapsed @endif">
                <a class="nav-link" href="{{ url('panel/events') }}">
                    <i class="bi bi-tags"></i>
                    <span>Events</span>
                </a>
            </li>
        @endif

        @if (!empty($PermissionVideoAnalysis))
            <li class="nav-item @if (Request::segment(2) != 'video-analysis') collapsed @endif">
                <a class="nav-link" href="{{ url('panel/video-analysis') }}">
                    <i class="bi bi-camera"></i>
                    <span>Video Analysis</span>
                </a>
            </li>
        @endif
</aside>
