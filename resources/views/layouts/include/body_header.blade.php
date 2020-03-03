 <header class="c-navbar u-mb-medium">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button><!-- // .c-sidebar-toggle -->

        <h2 class="c-navbar__title u-mr-auto"><b>{{ trans('words.time-sheet-system') }}</b></h2>
         @php
                    if($detail['type'] !== 'ADMIN')
                    {
                @endphp
                    <span class="c-notification__icon">
                                <i class="fa fa-street-view u-mr-xsmall"></i>
                                {{ trans('words.staff-number') }} :  {{ $detail['staffnumber'] }} &nbsp;&nbsp;&nbsp;
                    </span>
                @php
                    }
                @endphp


        <div class="c-dropdown dropdown">
            <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               {{ trans('words.'.$detail['type']) }}
            </a>

            <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                @php
                    if($detail['type'] == 'ADMIN')
                    {
                @endphp
                    <a class="c-dropdown__item dropdown-item" href="{{ route('update-profile') }}">Edit Profile</a>
                @php
                    }
                @endphp
                <a class="c-dropdown__item dropdown-item" href="{{ route('logout') }}">{{ trans('words.Logout') }}</a>
<!--                <a class="c-dropdown__item dropdown-item" href="#">Manage Roles</a>-->
            </div>
        </div>
    </header>