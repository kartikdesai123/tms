<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
        <style>
            #datatable {
                border-collapse: collapse;
            }
            td,th{
                border: 1px solid #000;
            }
        </style>
    </head>
    <body>
            <center><h3><b>{{ $empdata }}</b></h3></center>
        <table class="c-table" id="datatable" border-colsafe="" style="width:100%">
            <thead class="c-table__head c-table__head--slim">
                <tr class="c-table__row">
                    <!--<th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">Mitarbeiter </th>-->
					<th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">Objekte </th>
                    <th class="c-table__cell c-table__cell--head">Datum</th>
                    <th class="c-table__cell c-table__cell--head">Startzeit &nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">Endzeit &nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">Pausenzeit &nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">Insgesamt &nbsp;&nbsp;</th>
                     <th class="c-table__cell c-table__cell--head">Grund/Erklärung&nbsp;&nbsp;</th>
                   
                </tr>
            </thead>
            <tbody>
                @if(count($arrTimeheet) > 0)
                @for($i = 0 ;$i < count($arrTimeheet);$i++)
                <tr class="c-table__row">
					<td class="c-table__cell">{{ $arrTimeheet[$i]['workplaces'] }}</td>
                    <!--<td class="c-table__cell">{{ $arrTimeheet[$i]['name'] }} {{ $arrTimeheet[$i]['surname'] }}</td>-->
                    <td class="c-table__cell">{{ date("d.m.Y", strtotime($arrTimeheet[$i]['c_date'])) }}</td>
                    <td class="c-table__cell">{{ $arrTimeheet[$i]['start_time'] }}</td>
                    <td class="c-table__cell">{{ $arrTimeheet[$i]['end_time'] }}</td>
                    <td class="c-table__cell">{{ $arrTimeheet[$i]['pause_time'] }}</td>
                    <td class="c-table__cell">{{ $arrTimeheet[$i]['total_time'] }}</td>
                    
                    @if($arrTimeheet[$i]['isTImeSheet'] != 'yes')
                        @if($arrTimeheet[$i]['diseaseId'] == NULL)
                            <td class="c-table__cell">{{ 'Urlaub' }}</td>
                        @else
                            <td class="c-table__cell"> 
                            @if($arrTimeheet[$i]['submitted'] == 'submited')
                                {{ 'Krank, eingereicht.' }}
                            @else
                                {{ 'Krank, nicht eingereicht.' }}
                            @endif
                            </td>
                        @endif

                    @else
                        <td class="c-table__cell">{{ $arrTimeheet[$i]['reason'] }}</td>
                    @endif
                </tr>
                
                
                @endfor
                <tr class="c-table__row">
                    
                    <td colspan="7" class="c-table__cell center" style=" text-align: right">Urlaub : {{ $holidays }} &nbsp;&nbsp;&nbsp;Krank : {{ $disease }} &nbsp;&nbsp;&nbsp; Insgesamt Zeit : {{ $totaltime }}</td>
                </tr>
                @else
                <tr class="c-table__row">
                    <td colspan="7" class="c-table__cell center" style="color: red;">No Record Found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </body>
</html>
