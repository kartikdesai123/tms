 <div style="overflow:scroll">
     <table class="c-table" id="datatable" width="100%">
            <thead class="c-table__head c-table__head--slim">
                <tr class="c-table__row">
                    <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.Workplaces') }}</th>
                    <th class="c-table__cell c-table__cell--head">{{ trans('words.date') }}</th>
                    <th class="c-table__cell c-table__cell--head">{{ trans('words.start-date') }}&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">{{ trans('words.end-time') }}&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">{{ trans('words.pause-time') }}&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">{{ trans('words.total_time') }}&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head" style="max-width: 10%;">{{ trans('words.reason') }}&nbsp;&nbsp;</th>
                </tr>
            </thead>
        <tbody>
        @if(count($arrTimeheet) > 0)
        @for($i = 0 ;$i < count($arrTimeheet);$i++)
        <tr class="c-table__row" >
            <td class="c-table__cell">{{ $arrTimeheet[$i]['workplaces'] }} </td>
            <td class="c-table__cell">{{ date('d.m.Y',strtotime($arrTimeheet[$i]['c_date'])) }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['start_time'] }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['end_time'] }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['pause_time'] }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['total_time'] }}</td>
            @if($arrTimeheet[$i]['isTImeSheet'] != 'yes')
                @if($arrTimeheet[$i]['diseaseId'] == NULL)
                    <td class="c-table__cell">{{ trans('words.holiday') }}</td>
                @else
                    <td class="c-table__cell"> 
                    @if($arrTimeheet[$i]['submitted'] == 'submited')
                        {{ trans('words.ds') }}
                    @else
                        {{ trans('words.dns') }}
                    @endif
                    </td>
                @endif
                
            @else
                <td class="c-table__cell">{{ $arrTimeheet[$i]['reason'] }}</td>
            @endif
           
        </tr>
        @endfor
        <tr>
            <td class="c-table__cell" colspan="7" style="text-align: right">{{ trans('words.holiday') }} : {{ $holidays }} &nbsp;&nbsp;&nbsp;{{ trans('words.disease') }} : {{ $disease }} &nbsp;&nbsp;&nbsp;  {{ trans('words.total_time') }}: {{ $totaltime }}</td>
        </tr>
        @else
        <tr class="c-table__row">
            <td colspan="7" class="c-table__cell center" style="color: red;">No Record Found</td>
        </tr>
        @endif
    </tbody>
    </table>
 </div>