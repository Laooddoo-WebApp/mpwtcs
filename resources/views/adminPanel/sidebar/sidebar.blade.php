@section('sidebar')

<ul class="app-menu">
    @php
        $routeName = Route::current()->getName();
    @endphp

<li><a class="app-menu__item {{$routeName == 'vPages' ? 'active' : ''}}" href="admin"><i class="app-menu__icon fa fa-file-word"></i><span class="app-menu__label">{{__('pages.pages')}}</span></a></li>

</ul>
@endsection
