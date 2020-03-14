@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-table-responsive">
            <form id="deleteWorkplaces" method="post"> 
                 {{ csrf_field() }}                

                @if ( Session::has('flash_message') )
                <div class="alert success">
                  <span class="closebtn">×</span>  
                  <strong>Success!</strong> {{ Session::get('flash_message') }}
                </div>  
                @endif
                <table class="c-table" id="workplacedatatable">
                    <caption class="c-table__title">
                       {{ trans('words.workplaces-list') }}
                        <a class="c-table__title-action c-tooltip c-tooltip--left" href="{{ route('workplaces-add') }}" aria-label="{{ trans('words.add-workplace') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head no-sort">
                                <input value="0" type="checkbox" id="selectall"/>
                            </th>
                            <th class="c-table__cell c-table__cell--head">ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.company') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head" style="width:150px!important">{{ trans('words.adresses') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @for($i = 0 ;$i < count($arrWorkplaces);$i++,$count++)
                        <tr class="c-table__row">
                            <td class="c-table__cell">
                                <input class="case" type="checkbox" name="delid[]" data-name="{{$arrWorkplaces[$i]->company}}" value="{{ $arrWorkplaces[$i]->id }}" />
                            </td>
                            <td class="c-table__cell">{{ $count }}</td>
                            <td class="c-table__cell">{{ $arrWorkplaces[$i]->company }}</td>
                            <td class="c-table__cell" style="width:130px">{{ $arrWorkplaces[$i]->adresses }}</td>
                            <td class="c-table__cell">
                                <a href=" {{ route('workplaces-edit',[$arrWorkplaces[$i]->id])}} "><span class="c-tooltip c-tooltip--top"  aria-label="{{ trans('words.edit') }}">
                                    <i class="fa fa-edit" ></i></span>
                                </a>
                                 <a href="javascript:;" class="delete"  data-id="{{ $arrWorkplaces[$i]->id }}"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="{{ trans('words.delete') }}">
                                        <i class="fa fa-trash-o"></i></span>
                                </a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
          

            </div><!-- // .col-12 -->

        </div>
         <div class="col-12">

            <button id="delete_checkboxd" type="submit" class="delete_checkboxd"> 
                    {{ trans('words.delete-selected') }}
            </button> 
        </div>
    </div>
      </form>
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
button{
    cursor: pointer;
    border-radius: 4px;
    border-right: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    display: block;
    height: 2.1875rem;
    padding: 0 16px;
    border: 1px solid #e6eaee;
    background-color: #fff;
    font-size: .875rem;
    font-weight: 600;
    line-height: 2.1875rem;
    text-align: center;
}
.alert {
    opacity: 1;
    color: white;
    background-color: #f44336;
    border-color: #ebccd1;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.closebtn {
    padding-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 20px;
    line-height: 18px;
    cursor: pointer;
    transition: 0.3s;
}
.c-table-responsive .c-table {
    display: table !important;
    overflow-y: hidden;
}
</style>
<script type="text/javascript">
    $(function(){

    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });

    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){

        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }

    });
});
</script>
<script>
$(document).ready(function(){
    $(".closebtn").click(function(){
        $(".alert").hide();
    });
});
</script>
@endsection
