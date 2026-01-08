<?php $user = Auth::user(); ?>
<div class="navbar-header">
    @php
        $dashboardUrl = '/superAdmin';
        if($user->role->name == 'HRD') {
            $dashboardUrl = '/hrd';
        } elseif($user->role->name == 'Staff') {
            $dashboardUrl = '/staff';
        }
    @endphp
    <a class="navbar-brand" href="{{ $dashboardUrl }}" style="display: flex; align-items: center;">
        <img src="{{ URL::to('/admin') }}/assets/images/logo-sakti.png" alt="SAKTI" style="height: 24px; width: auto;">
        <span style="margin-left: 10px; font-size: 15px; font-weight: 600; color: #fff; letter-spacing: 1px;">SAKTI</span>
    </a>

    <ul class="nav navbar-nav visible-xs-block">
        <!-- Mobile toggles removed as requested -->
    </ul>
</div>

<div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav">
        <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

    </ul>

    <p class="navbar-text"><span class="label bg-success">Online</span></p>

    <ul class="nav navbar-nav navbar-right">

        <li class="dropdown dropdown-user">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <span>{{ $user->nama }}</span>
                <i class="caret"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                <?php $encrypt = Crypt::encrypt(Auth::user()->id); ?>
                <li><a href="{{ route('profil.show', $encrypt) }}"><i class="icon-user"></i> Profil Saya</a></li>
                <li><a href="{{ route('pass.index') }}"><i class=" icon-unlocked"></i> Ganti Password</a></li>
                <li><a href="{{ route('logout') }}"><i class="icon-switch2"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
