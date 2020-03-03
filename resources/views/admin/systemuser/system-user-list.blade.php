@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div c-table-responsive>
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">
                       System User List  

                        <a class="c-table__title-action c-tooltip c-tooltip--top" href="{{ route('system-add-user') }}" aria-label="Add User">
                            <i class="fa fa-plus"></i>
                        </a>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">ID</th>
                            <th class="c-table__cell c-table__cell--head">Name&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Extension&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Inopla Username&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Language&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                        <tr class="c-table__row">
                            <td class="c-table__cell">{{ $count }}</td>
                            <td class="c-table__cell">{{ $arrUser[$i]->name }}</td>
                            <td class="c-table__cell">{{ $arrUser[$i]->email }}</td>
                            <td class="c-table__cell">{{ $arrUser[$i]->type }}</td>
                            <td class="c-table__cell">{{ $arrUser[$i]->type }}</td>
                            <td class="c-table__cell">
                                <a href=" {{ route('system-edit-user',[$arrUser[$i]->id])}} "><span class="c-tooltip c-tooltip--top"  aria-label="Edit">
                                    <i class="fa fa-edit" ></i></span>
                                </a>
                                 <a href="javascript:;" class="delete"  data-id="{{ $arrUser[$i]->id }}"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="Delete">
                                        <i class="fa fa-trash-o" ></i></span>
                                </a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>

            </div><!-- // .col-12 -->
        </div>
    </div>

</div><!-- // .container -->
<style>
/*    a.c-board__btn.c-tooltip.c-tooltip--top {
        position: absolute;
        margin-left: 743px;
        margin-bottom: 41px;
    }*/
.c-table__title .c-tooltip{
    position: absolute;
}
</style>

@endsection
