<table class="c-table" id="datatable">
    <thead class="c-table__head c-table__head--slim">
        <tr class="c-table__row">
            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.Worker') }}</th>
            <th class="c-table__cell c-table__cell--head">{{ trans('words.date') }}</th>
            <th class="c-table__cell c-table__cell--head">{{ trans('words.total_time') }}&nbsp;&nbsp;</th>
            <th class="c-table__cell c-table__cell--head" style="max-width: 10%;">{{ trans('words.reason') }}&nbsp;&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @if(count($arrTimeheet) > 0)
        @for($i = 0 ;$i < count($arrTimeheet);$i++)
        <tr class="c-table__row">
            <td class="c-table__cell">{{ $arrTimeheet[$i]['name'] }} {{ $arrTimeheet[$i]['surname'] }}</td>
            <td class="c-table__cell">{{ date('d.m.Y',strtotime($arrTimeheet[$i]['c_date'])) }}</td>
         
            <td class="c-table__cell">{{ $arrTimeheet[$i]['total_time'] }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['reason'] }}</td>
            
        </tr>
        @endfor
        <tr>
            <td class="c-table__cell" colspan="4" style="text-align: right">Total Time : {{ $totaltime }}</td>
        </tr>
        @else
        <tr class="c-table__row">
            <td colspan="4" class="c-table__cell center" style="color: red;">No Record Found</td>
        </tr>
        @endif
    </tbody>
</table>