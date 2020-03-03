@php
$currentRoute = Route::current()->getName();
@endphp
<div class="o-page__sidebar js-page-sidebar">
    <div class="c-sidebar">
        <a class="c-sidebar__brand" href="{{ route('admin-dashboard') }}">
           <!-- <img class="c-sidebar__brand-img" src="img/logo.png" alt="Logo"> -->
           <img class="c-sidebar__brand-img" src="{{ asset('img/logo.png') }}" alt="Logo"> {{ trans('words.Dashboard') }}
        </a>
        <h4 class="c-sidebar__title"><!-- Dashboard --></h4>
        <ul class="c-sidebar__list">
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'admin-dashboard' ? 'is-active' : '') }}" href="{{ route('admin-dashboard') }}">
                    <i class="fa fa-home u-mr-xsmall"></i>{{ trans('words.Overview') }} 
                </a>
            </li>
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'workplaces-add' || $currentRoute == 'workplaces-edit' || $currentRoute == 'workplaces-list' || $currentRoute == 'add-workplaces' || $currentRoute == 'edit-workplaces' ? 'is-active' : '') }}" href="{{ route('workplaces-list') }}">
                    <i class="fa fa-newspaper-o u-mr-xsmall"></i>{{ trans('words.Workplaces') }}
                </a>
            </li>
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'worker-list' || $currentRoute == 'worker-add' || $currentRoute == 'worker-list-search' || $currentRoute == 'worker-edit'  || $currentRoute == 'system-add-user' || $currentRoute == 'system-edit-user' ? 'is-active' : '') }}" href="{{ route('worker-list') }}">
                    <i class="fa fa-users u-mr-xsmall"></i>{{ trans('words.Worker') }}
                </a>
            </li>
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute  == 'timesheet-list-search' || $currentRoute  == 'timesheet-list' || $currentRoute == 'timesheet-add' || $currentRoute == 'timesheet-edit' ? 'is-active' : '') }}" href="{{ route('timesheet-list') }}">
                    <i class="fa fa-calendar u-mr-xsmall"></i>{{ trans('words.Timesheet') }}
                </a>
            </li>
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'information-list-search' || $currentRoute == 'information-list' || $currentRoute == 'information-add' || $currentRoute == 'information-edit' ? 'is-active' : '') }}" href="{{ route('information-list') }}">
                    <i class="fa fa-info-circle u-mr-xsmall"></i>{{ trans('words.Information') }}
                </a>
            </li>
            
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'disease' || $currentRoute == 'edit-disease' || $currentRoute == 'disease-list' || $currentRoute == 'disease-list' || $currentRoute == 'disease-list-search' ? 'is-active' : '') }}" href="{{ route('disease') }}">
                   <i class="fa fa-medkit u-mr-xsmall"></i>{{ trans('words.disease') }}
                </a>
            </li>
            
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'holiday' || $currentRoute == 'edit-holiday' || $currentRoute == 'edit-holidays' || $currentRoute == 'holiday-list-search'  ? 'is-active' : '') }}" href="{{ route('holiday') }}">
                   <i class="fa fa-universal-access u-mr-xsmall"></i>{{ trans('words.holiday')}}
                </a>
            </li>
            
            <li class="c-sidebar__item">
                <a class="c-sidebar__link {{ ($currentRoute == 'customer-details' ||  $currentRoute == 'newCustomer' || $currentRoute == 'add-customer' ? 'is-active' : '') }}" href="{{ route('newCustomer') }}">
                   <i class="fa fa-user-plus u-mr-xsmall"></i>{{ trans('customer.customerlist')}}
                </a>
            </li>
            
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
                <!-- <div class="language-selection {{ (isset($_COOKIE['language']) && ($_COOKIE['language']) ==  'tr' ? 'active' : '') }}" style="display: inline;">
                    <a href="javascript:;" class="language" data-lang="tr" style="padding-left: 10px;">
                       @if(($_COOKIE['language']) ==  'tr')
                        <img class="" src="{{ asset('img/flag/turkish.png') }}" alt="Turkish-Logo"  style='height : 22px;'>
                        @else
                        <img class="" src="{{ asset('img/flag/turkisch-notactive.png') }}" alt="Turkish-Logo"  style='height : 22px;'>
                        @endif
                    </a>
                </div>  -->
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