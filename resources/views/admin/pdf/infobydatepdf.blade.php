<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
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
                <center><h3><b>Objekte Information</b></h3></center>
            <table class="c-table" id="datatable" border-colsafe="" style="width:100%">
                <thead class="c-table__head c-table__head--slim">
                    <tr class="c-table__row">
                        <th class="c-table__cell c-table__cell--head">Id</th>
                        <th class="c-table__cell c-table__cell--head">Staff Number</th>
                        <th class="c-table__cell c-table__cell--head">Worker</th>
                        <th class="c-table__cell c-table__cell--head">Workplace</th>
                        <th class="c-table__cell c-table__cell--head">Missing Time</th>
                        <th class="c-table__cell c-table__cell--head">Supervisor Reason</th>
                    </tr>
                    
                </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @if(count($arrInformation) > 0)
                        @for($i = 0 ;$i < count($arrInformation);$i++,$count++)
                        <tr class="c-table__row">
                            <td class="c-table__cell">{{ $arrInformation[$i]->id }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->staffnumber }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->name }} {{ $arrInformation[$i]->surname }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->workplaces }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->missing_hour }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->supervisior_reson }}</td>
                        </tr>
                        @endfor
                        @else
                        <tr class="c-table__row">
                            <td colspan="6" class="c-table__cell center text-center" align="center" style="color: red;">No Record Found</td>
                        </tr>
                        @endif
                    </tbody>
            </table>
    </body>
</html>
