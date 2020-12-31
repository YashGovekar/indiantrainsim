<!--**********************************
            Nav header start
***********************************-->
<div class="nav-header bg-white" >
    <a href="{{ config('app.main_url') }}" class="brand-logo">
        <img class="h-100 mx-auto p-1" src="/assets/frontend/images/logo.png" alt="">
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->


<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left"></div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <div class="header-info">
                                <span>Hey, <strong>{{ auth()->user()->name }}</strong></span>
                                <small>Admin Profile</small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form method="post" action="{{ route('frontend.auth.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    <span class="ml-2">Logout </span>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="ai-icon" aria-expanded="false">
                    <i class="lni lni-layers"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('admin.files.index') }}" aria-expanded="false">
                    <i class="lni lni-files"></i>
                    <span class="nav-text">Files</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('admin.file-sections.index') }}" aria-expanded="false">
                    <i class="lni lni-calendar"></i>
                    <span class="nav-text">File Sections</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('admin.users.index') }}" aria-expanded="false">
                    <i class="lni lni-network"></i>
                    <span class="nav-text">Users</span>
                </a>
            </li>
        </ul>
    </div>


</div>
<!--**********************************
    Sidebar end
***********************************-->
