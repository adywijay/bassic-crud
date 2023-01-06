@section('sidenav')
    <ul id="sidebar-1" class="sidenav sidenav-fixed">
        <li>
            <div class="user-view">
                <div class="background" height="100">
                    <img src="{{ asset('load_extern/images/bg/user-profile-bg.jpg') }}">
                </div>
                <a href="#"><img class="circle" src="{{ asset('load_extern/images/user.png') }}"></a>
                <a href="#"><span class="white-text name">{{ Session::get('nik') }}</span></a>
                <a href="#"><span class="white-text email">{{ Session::get('email') }}</span></a>
            </div>
        </li>
    @show
    <li>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header"><i class="material-icons">storage</i>Master Data
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('jabatan') }}"><i class="material-icons">loyalty</i>Jabatan</a></li>
                        <li><a href="{{ route('role') }}"><i class="material-icons">enhanced_encryption</i>Role</a></li>
                        <li><a href="{{ route('muser') }}"><i class="material-icons">assignment_ind</i>User</a></li>
                        <li><a href="{{ route('candid') }}"><i class="material-icons">contact_phone</i>Kandidat</a></li>
                        <li><a href="{{ route('employment') }}"><i class="material-icons">group</i>Karyawan</a></li>
                        <li><a href="{{ route('accounts') }}"><i class="material-icons">vpn_lock</i>Accounts</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header hide-on-large-only show-on-small">
                    <a href="{{ route('logoutinternal') }}" class="btn">Logout</a>
                </div>
            </li>
        </ul>
    </li>
    <ul>
