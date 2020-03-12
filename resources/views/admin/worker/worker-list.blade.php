@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<script>
    var start = '<?php echo (@$start) ? $start : 0; ?>';
    var length = '<?php echo (@$length) ? $length : 10; ?>';
</script>
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('worker-list-search') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.start-date') }}</label>

                                        @if(isset($dates))
                                        <input id="datepicker_1search" name="start_date" class="date c-input" type="text" value="{{ $dates['0'] }}" >
                                        @else
                                        <input id="datepicker_search1" name="start_date" class="date c-input" type="text"  placeholder="dd.mm.yyyy">
                                        @endif
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.end-date') }}</label>
                                        @if(isset($dates))
                                        <input id="datepicker_2search" name="end_date" class="date c-input" type="text" value="{{ $dates['1'] }}" >
                                        @else
                                        <input id="datepicker_search2" name="end_date" class="date c-input" type="text" placeholder="dd.mm.yyyy" >

                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <label class="c-field__label" for="type">&nbsp;</label>
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.save') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- // .col-12 -->
    </div>
</div><!-- // .container -->




<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-table-responsive">

                <table class="c-table" id="worker_datatable_demo">
                    <caption class="c-table__title">
                        {{ trans('words.worker-list') }}

                        <a class="c-table__title-action c-tooltip c-tooltip--left" href="{{ route('worker-add') }}" aria-label="{{ trans('words.add-worker') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.id') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.staff-number') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.name') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.surname') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Status &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.work-time') }}&nbsp;&nbsp;</th>

                            <th class="c-table__cell c-table__cell--head">{{ trans('words.last-login') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.total') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div><!-- // .col-12 -->
            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-5">
                    <i class="fa fa-circle" style="color:#34aa44;"></i>&nbsp;&nbsp;{{ trans('words.Active_Users') }}&nbsp;&nbsp;
                    <i class="fa fa-circle" style="color:#fd9a18;"></i>&nbsp;&nbsp;{{ trans('words.Users_In_Active_soon') }}&nbsp;&nbsp;
                    <i class="fa fa-circle" style="color:#ed1c24;"></i>&nbsp;&nbsp;{{ trans('words.In_Active_Users') }}&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

</div><!-- // .container -->
<style>
    /*    a.c-board__btn.c-tooltip.c-tooltip--top {
            position: absolute;
            margin-left: 743px;
            margin-bottom: 41px;
        }*/
    .c-table-responsive .c-table {
        display: table !important;
        overflow-y: hidden;
    }
    .c-table__title .c-tooltip{
        position: absolute;
    }
</style>
<div class="c-modal modal fade" id="blockModel" tabindex="-1" role="dialog" aria-labelledby="standard-modal" data-backdrop="static">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="c-modal__content">
            <div class="c-modal__header">
                <h3 class="c-modal__title">{{ trans('words.blockWorker') }}</h3>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </div>
            <div class="c-modal__body">
                <p>{{ trans('words.aresureBlock') }}</p>
            </div>
            <div class="c-modal__footer">
                <button class="c-btn c-btn--info pull-right" data-dismiss="modal">{{ trans('words.cancel') }}</button>
                <button class="c-btn c-btn--danger yes-sureBlock">{{ trans('words.block') }}</button>
            </div>
        </div><!-- // .c-modal__content -->
    </div><!-- // .c-modal__dialog -->
</div><!-- // .c-modal -->

<div class="c-modal modal fade" id="unblockModel" tabindex="-1" role="dialog" aria-labelledby="standard-modal" data-backdrop="static">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="c-modal__content">
            <div class="c-modal__header">
                <h3 class="c-modal__title">{{ trans('words.unblockWorker') }}</h3>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </div>
            <div class="c-modal__body">
                <p>{{ trans('words.aresureunBlock') }}</p>
            </div>
            <div class="c-modal__footer">
                <button class="c-btn c-btn--info pull-right" data-dismiss="modal">{{ trans('words.cancel') }}</button>
                <button class="c-btn c-btn--danger yes-sureUnblock">{{ trans('words.unblock') }}</button>
            </div>
        </div><!-- // .c-modal__content -->
    </div><!-- // .c-modal__dialog -->
</div><!-- // .c-modal -->

@endsection
