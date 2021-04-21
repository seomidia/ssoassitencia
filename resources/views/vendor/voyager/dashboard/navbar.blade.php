<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            @section('breadcrumbs')
            <ol class="breadcrumb hidden-xs">
                @php
                $segments = array_filter(explode('/', str_replace(route('voyager.dashboard'), '', Request::url())));
                $url = route('voyager.dashboard');
                @endphp
                @if(count($segments) == 0)
                    <li class="active"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</li>
                @else
                    <li class="active">
                        <a href="{{ route('voyager.dashboard')}}"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</a>
                    </li>
                    @foreach ($segments as $segment)
                        @php
                        $url .= '/'.$segment;
                        @endphp
                        @if ($loop->last)
                            <li>{{ ucfirst(urldecode($segment)) }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ ucfirst(urldecode($segment)) }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ol>
            @show
        </div>
        @php
            $role = \DB::table('user_roles')->where('user_id',Auth::user()->id)->get();
            $permissao = (count($role) > 0) ? $role[0]->role_id : '';
        @endphp

    @if($permissao == 6)
        <ul class="nav navbar-nav @if (__('voyager::generic.is_rtl') == 'true') navbar-left @else navbar-right @endif" style="margin-right: 45px; scroll-behavior: smooth">
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                   aria-expanded="false">
                    <div class="voyager-bubble" style="font-size: 26px;margin-top: 6px;"><span style="background: #c41b1b;font-size: 10px;font-weight: bold;color: #fff;padding: 3px;border-radius: 50%;position: relative;left: -36px;top: -18px;">
                            @php
                                $total = DB::table('anamnesis')->where([
                                        'user_id_examining_doctor'=> \Auth::user()->id,
                                        'step'=> 'step_med_p',
                                        ])
                                        ->count();
                                echo $total;
                            @endphp
                        </span></div>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-animated" style="overflow: auto;max-height: 300px;">
                    <li class="profile-img">
                        <div class="voyager-activity" style="font-size: 18px"></div>
                        <div class="profile-body">
                           Anamneses a ser liberadas
                        </div>
                    </li>
                    <li class="divider"></li>
                        @php
                            $list = DB::table('anamnesis as a')
                                    ->leftjoin('users as u','a.user_id_employee','=','u.id')
                                    ->leftjoin('user_data as ud','a.user_id_employee','=','ud.user_id')
                                    ->select(
                                        'a.id as anaminese_id',
                                        'u.name',
                                        'ud.cpf',
                                        'ud.nasc',
                                        'u.id'
                                        )
                                    ->where([
                                        'user_id_examining_doctor'=> \Auth::user()->id,
                                        'step'=> 'step_med_p',
                                        ])
                                    ->get();
                        @endphp
                    @if($total > 0)
                    @foreach($list as $key => $itens)
                       <li><a class="detalhe" href="{{$itens->anaminese_id}}">{{$itens->name}}</a></li>
                    @endforeach
                    @else
                        {{'Não existe liberações pendentes.'}}
                    @endif
                </ul>
            </li>
        </ul>
        @endif
            <ul class="nav navbar-nav @if (__('voyager::generic.is_rtl') == 'true') navbar-left @else navbar-right @endif">
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                   aria-expanded="false"  style="padding: 0 10px 0 4px"><img src="{{ $user_avatar }}" class="profile-img"> <span
                            class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="{{ $user_avatar }}" class="profile-img">
                        <div class="profile-body">
                            <h5>{{ Auth::user()->name }}</h5>
                            <h6>{{ Auth::user()->email }}</h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    @if(is_array($nav_items) && !empty($nav_items))
                    @foreach($nav_items as $name => $item)
                    <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                        @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                        <form action="{{ route('voyager.logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-block">
                                @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                <i class="{!! $item['icon_class'] !!}"></i>
                                @endif
                                {{__($name)}}
                            </button>
                        </form>
                        @else
                        <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                            @if(isset($item['icon_class']) && !empty($item['icon_class']))
                            <i class="{!! $item['icon_class'] !!}"></i>
                            @endif
                            {{__($name)}}
                        </a>
                        @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</nav>

@if(Auth::user()->role_id == 6)

@foreach($list as $key => $item)
    @foreach(App\Http\Controllers\AnamineseController::get_anamnese('a.id',$item->anaminese_id) as $key2 => $amnesis)
        @include('partials.medico.modal')
    @endforeach
@endforeach
@endif
