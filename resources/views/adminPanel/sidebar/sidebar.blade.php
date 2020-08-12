@section('sidebar')

<ul class="app-menu">
    @php
        $routeName = Route::current()->getName();
        $accountManagement   = array('vCreateAccounts','vSearchAccounts','vViewAccounts','vUpdateAccounts');
        $productManagement  = array('vCreateProduct','vViewProducts','vDeletedProducts');
        $thirdPartyAPISetup = array('vSMSAPISetupView');
        $sliderManagement   = array('vViewSliders','vDeletedSliders');
    @endphp

    <li><a class="app-menu__item {{$routeName == 'vDashboard' ? 'active' : ''}}" href="admin"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

    <li class="treeview {{ in_array($routeName,$accountManagement) ? 'is-expanded' : ''}}">
        <a class="app-menu__item" href="../search" data-toggle="treeview"><i class="far fa-id-card"></i><span class="app-menu__label">Account Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item {{$routeName == 'vCreateAccounts' ? 'active' : ''}}" href="{!! route('vCreateAccounts') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">Create Account<span></a></li>
            <li><a class="treeview-item {{$routeName == 'vSearchAccounts' ? 'active' : ''}}" href="{!! route('vSearchAccounts') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">Search Accounts<span></a></li>
            <li><a class="treeview-item {{$routeName == 'vViewAccounts' ? 'active' : ''}}" href="{!! route('vViewAccounts') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">View Accounts<span></a></li>
            <li><a class="treeview-item {{$routeName == 'vUpdateAccounts' ? 'active' : ''}}" href="{!! route('vUpdateAccounts') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">Update Accounts<span></a></li>
        </ul>
    </li>

    <li class="treeview {{ in_array($routeName,$productManagement) ? 'is-expanded' : ''}}">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="fas fa-box-open"></i><span class="app-menu__label">Product Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item {{$routeName == 'vCreateProduct' ? 'active' : ''}}" href="{!! route('vCreateProduct') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">Create Product<span></a></li>
            <li><a class="treeview-item {{$routeName == 'vViewProducts' ? 'active' : ''}}" href="{!! route('vViewProducts') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">View Products<span></a></li>
            <li><a class="treeview-item {{$routeName == 'vDeletedProducts' ? 'active' : ''}}" href="{!! route('vDeletedProducts') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">Deleted Products<span></a></li>
        </ul>
    </li>

    <li class="treeview {{ in_array($routeName,$sliderManagement) ? 'is-expanded' : ''}}">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="fas fa-image"></i><span class="app-menu__label">Slider Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item {{$routeName == 'vViewSliders' ? 'active' : ''}}" href="{!! route('vViewSliders') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">View Sliders</span></a></li>
            <li><a class="treeview-item {{$routeName == 'vDeletedSliders' ? 'active' : ''}}" href="{!! route('vDeletedSliders') !!}"><i class="icon fa fa-circle-o"></i><span class="app-menu_sub_item">Deleted Sliders</span></a></li>
        </ul>
    </li>

    <li class="treeview {{ in_array($routeName,$thirdPartyAPISetup) ? 'is-expanded' : ''}}">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="fab fa-cloudversify"></i><span class="app-menu__label">Third Party API Setup</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item {{$routeName == 'vSMSAPISetupView' ? 'active' : ''}}" href="{!! route('vSMSAPISetupView') !!}"><i class="fas fa-sms"></i><span class="app-menu_sub_item">SMS API Setup</span></a></li>
        </ul>
    </li>
</ul>
@endsection
