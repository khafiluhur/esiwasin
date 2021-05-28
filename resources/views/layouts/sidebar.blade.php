<nav id="sidebar" style="background-color: #D10102;" aria-label="Main Navigation">
    <div class="content-header bg-white-5">
        <a class="font-w600 text-dual" href="{{route('home')}}">
            <img style="height: 20px;" src="{{asset('/media/favicons/Dekena.png')}}" />
            <span class="smini-hide">
                <span class="font-w700 font-size-h5">Setjen Wantannas</span>
            </span>
        </a>
    </div>

    <div class="content-side content-side-full">
        <ul class="nav-main">
            
            @if(Auth::user()->level == 8)
            <li class="nav-main-item">
                <a <?php if($page == "home") echo "class='nav-main-link active'";?> class="nav-main-link" href="{{route('home')}}">
                    <i class="nav-main-link-icon si si-speedometer text-white"></i>
                    <span class="nav-main-link-name text-white">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a <?php if($page == "useradmin") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/useradmin') }}">
                    <i class="nav-main-link-icon si si-user text-white"></i>
                    <span class="nav-main-link- text-white">User Admin</span>
                </a>
            </li>
            @else
            
            @if($permission->dashboard == 1)
            @else
<li class="nav-main-item">
                <a <?php if($page == "home") echo "class='nav-main-link active'";?> class="nav-main-link" href="{{route('home')}}">
                    <i class="nav-main-link-icon si si-speedometer text-white"></i>
                    <span class="nav-main-link-name text-white">Dashboard</span>
                </a>
            </li>
            @endif
            
            <li class="nav-main-heading text-white font-w700">Penugasan</li>
            @if($permission->audit == 1)
            @else
            <li class="nav-main-item">
                <a <?php if($page == "audit") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/audit') }}">
                    <i class="nav-main-link-icon si si-notebook text-white"></i>
                    <span class="nav-main-link-name text-white">Audit</span>
                </a>
            </li>
            @endif

            @if($permission->reviu == 1)
            @else
            <li class="nav-main-item">
                <a <?php if($page == "review") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/review') }}">
                    <i class="nav-main-link-icon si si-eyeglasses text-white"></i>
                    <span class="nav-main-link-name text-white">Reviu</span>
                </a>
            </li>
            @endif

            @if($permission->evaluasi == 1)
            @else
            <li class="nav-main-item">
                <a <?php if($page == "evaluasi") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/evaluasi') }}">
                    <i class="nav-main-link-icon si si-grid text-white"></i>
                    <span class="nav-main-link-name text-white">Evaluasi</span>
                </a>
            </li>
            @endif

            @if($permission->pemantauan == 1)
            @else
            <li class="nav-main-item">
                <a <?php if($page == "pemantauan") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/pemantauan') }}">
                    <i class="nav-main-link-icon si si-screen-desktop text-white"></i>
                    <span class="nav-main-link-name text-white">Pemantauan</span>
                </a>
            </li>
            @endif

            <li class="nav-main-item">
                <a <?php if($page == "pengawasan") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/pengawasan') }}">
                    <i class="nav-main-link-icon si si-layers text-white"></i>
                    <span class="nav-main-link-name text-white">Pengawasan Lainnya</span>
                </a>
            </li>

            <li class="nav-main-heading"></li>
            @if($permission->dokumentasi == 1)
            @else
            <li class="nav-main-item">
                <a <?php if($page == "dokumentasi") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/dokumentasi') }}">
                    <i class="nav-main-link-icon si si-envelope text-white"></i>
                    <span class="nav-main-link-name text-white">Dokumentasi</span>
                </a>
            </li>
            @endif

            @if($permission->laporan == 1)
            @else
            <li class="nav-main-item">
                <a <?php if($page == "laporan") echo "class='nav-main-link active'";?>  class="nav-main-link" href="{{ url('/laporan') }}">
                    <i class="nav-main-link-icon si si-book-open text-white"></i>
                    <span class="nav-main-link-name text-white">Laporan</span>
                </a>
            </li>
            @endif
            @endif
            
        </ul>
    </div>
</nav>