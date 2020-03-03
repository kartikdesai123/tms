@php
$currentRoute = Route::current()->getName();
@endphp
<div class="o-page__sidebar js-page-sidebar">
    <div class="c-sidebar">
        <a class="c-sidebar__brand" href="{{ route('worker-dashboard') }}">
           <!--  <img class="c-sidebar__brand-img" src="img/logo.png" alt="Logo"> -->
           <img class="c-sidebar__brand-img" src="{{ asset('img/logo.png') }}" alt="Logo">
           {{ trans('words.Dashboard') }}
        </a>
        <h4 class="c-sidebar__title">{{ trans('words.Dashboard') }}</h4>
        <ul class="c-sidebar__list">
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'worker-dashboard' || $currentRoute == 'information-worker-edit' ? 'is-active' : '') }}" href="{{ route('worker-dashboard') }}">
                    <i class="fa fa-home u-mr-xsmall"></i>{{ trans('words.Add_time') }} 
                </a>
            </li>
            
<!--            <li class="c-sidebar__item">
                <a class="c-sidebar__link  {{ ($currentRoute == 'worker-disease' ? 'is-active' : '') }}" href="{{ route('worker-disease') }}">
                    <i class="fa fa-medkit u-mr-xsmall"></i>Disease
                </a>
            </li>-->
            
            <li class="c-sidebar__item">
                <i class="fa fa-flag-icon-us"></i>
            </li>
            <li class="c-sidebar__item" style="position: absolute; bottom: 0px; margin-bottom: 20px; padding-left: 35px;">
                <div class="language-selection {{ (isset($_COOKIE['language']) && ($_COOKIE['language']) == 'gr' ? 'active' : '') }}" style="display: inline;">
                    <a href="javascript:;" class="language" data-lang="gr">
                        @if(($_COOKIE['language']) ==  'gr')
                        <img class="" src="{{ asset('img/flag/german.png') }}" alt="German-Logo"  style='height : 22px;'>
                        @else
                        <img class="" src="{{ asset('img/flag/german-notactive.png') }}" alt="German-Logo"  style='height : 22px;'>
                        @endif
                    </a>
                </div>
                
                <div class="language-selection {{ (isset($_COOKIE['language']) && ($_COOKIE['language']) ==  'en' ? 'active' : (!isset($_COOKIE['language']))?'active':'')  }} " style="display: inline;">
                    <a href="javascript:;" class="language" data-lang="en" style="padding-left: 10px;">
                       @if(($_COOKIE['language']) ==  'en')
                        <img class="" src="{{ asset('img/flag/english.png') }}" alt="English-Logo"  style='height : 22px;'>
                       @else 
                        <img class="" src="{{ asset('img/flag/english-notactive.png') }}" alt="English-Logo"  style='height : 22px;'>
                        @endif
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>