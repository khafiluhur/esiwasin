<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center"></div>

        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded" src="{{asset('/media/avatars/avatar10.jpg')}}" alt="Header Avatar" style="width: 18px;">
                    <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->nama }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary" style="background-color: #D10102 !important;">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{asset('/media/avatars/avatar10.jpg')}}" alt="">
                    </div>
                    <div class="p-2">
                        <h5 class="dropdown-header text-uppercase">User Options</h5>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('view.profile') }}">
                            <span>Profile</span>
                            <span>
                                <i class="si si-user ml-1"></i>
                            </span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('setting.profile') }}">
                            <span>Settings</span>
                            <i class="si si-settings"></i>
                        </a>
                        <div role="separator" class="dropdown-divider"></div>
                        <h5 class="dropdown-header text-uppercase">Actions</h5>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}">
                            <span>Log Out</span>
                            <i class="si si-logout ml-1"></i>
                        </a>
                        <form id="logout-form" action="" method="GET" style="display: none;">
                            <!-- @csrf -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="page-header-search" class="overlay-header bg-white">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>

    <div id="page-header-loader" class="overlay-header bg-white">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>

</header>