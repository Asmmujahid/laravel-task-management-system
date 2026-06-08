<div class="sidebar">

   

    <ul class="sidebar-menu">

        @if(auth()->user()->role == 'admin')

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.teams.index') }}">
                    <i class="fas fa-user-group"></i>
                    <span>Manage Teams</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.tasks.index') }}">
                    <i class="fas fa-list-check"></i>
                    <span>Manage Tasks</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Categories</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.task.submissions') }}">
                    <i class="fas fa-file-circle-check"></i>
                    <span>Task Submissions</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.reports') }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-gear"></i>
                    <span>Settings</span>
                </a>
            </li>

            @elseif(auth()->user()->role == 'team_lead')

<li>
    <a href="{{ route('team_lead.dashboard') }}">
        <i class="fas fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
</li>

<li>
    <a href="{{ route('team_lead.tasks.index') }}">
        <i class="fas fa-list-check"></i>
        <span>Tasks</span>
    </a>
</li>

<li>
    <a href="{{ route('team_lead.teams.index') }}">
        <i class="fas fa-users"></i>
        <span>Teams</span>
    </a>
</li>

<li>
    <a href="{{ route('team_lead.categories.index') }}">
        <i class="fas fa-layer-group"></i>
        <span>Categories</span>
    </a>
</li>

<li>
    <a href="{{ route('team_lead.progress') }}">
        <i class="fas fa-chart-line"></i>
        <span>Progress</span>
    </a>
</li>

<li>
    <a href="{{ route('team_lead.submissions') }}">
        <i class="fas fa-file-circle-check"></i>
        <span>Submissions</span>
    </a>
</li>



@elseif(auth()->user()->role == 'team_member')

<li>
    <a href="{{ route('team_member.dashboard') }}">
        <i class="fas fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>
</li>

<li>
    <a href="{{ route('team_member.tasks') }}">
        <i class="fas fa-list-check"></i>
        <span>My Tasks</span>
    </a>
</li>

<li>
    <a href="{{ route('team_member.comments.files') }}">
        <i class="fas fa-file-upload"></i>
        <span>Comments & Files</span>
    </a>
</li>

<li>
    <a href="{{ route('team_member.profile.edit') }}">
        <i class="fas fa-user"></i>
        <span>My Profile</span>
    </a>
</li>

@endif

    </ul>

</div>