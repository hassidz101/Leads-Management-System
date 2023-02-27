<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{route('admin.dashboard')}}">
                    <i class="material-icons-outlined">space_dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>


            </li>
            @if(auth()->user()->role == App\Models\User::ADMIN_ROLE)
            <li><a href="{{route('admin.agents-view')}}">
                    <i class="material-icons">supervised_user_circle</i>
                    <span class="nav-text">Agents</span>
                </a>
            </li>
            @endif
            <li><a href="{{route('admin.lead-view')}}" >
                    <i class="material-icons">article</i>
                    <span class="nav-text">Leads</span>
                </a>
            </li>


        </ul>

    </div>
</div>