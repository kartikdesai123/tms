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
                        <th class="c-table__cell c-table__cell--head">Objektleiter Name</th>
                        <th class="c-table__cell c-table__cell--head">Datum</th>
                        <th class="c-table__cell c-table__cell--head">Mitarbeiter</th>
                        <th class="c-table__cell c-table__cell--head">Objekt</th>
                        <th class="c-table__cell c-table__cell--head">Information Supervisior</th>
                    </tr>
                    
                </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @if(count($arrInformation) > 0)
                        @for($i = 0 ;$i < count($arrInformation);$i++,$count++)
                        <tr class="c-table__row">
                            <td class="c-table__cell">{{ $arrInformation[$i]->supervisorname }}</td>
                            <td class="c-table__cell">{{ date("d.m.Y", strtotime($arrInformation[$i]->c_date)) }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->name }} {{ $arrInformation[$i]->surname }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->workplaces }}</td>
                            <td class="c-table__cell">{{ $arrInformation[$i]->supervisior_reson }}</td>
                        </tr>
                        @endfor
                        @else
                        <tr class="c-table__row">
                            <td colspan="5" class="c-table__cell center" style="color: red;">No Record Found</td>
                        </tr>
                        @endif
                    </tbody>
            </table>
    </body>
</html>
