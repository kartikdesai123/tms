@if($selectstatus == "active")
     <div style="height:200px;overflow:scroll">
        <div class="row">  
            <div class="col-12" style="background-color: #eff3f6">
                <div class="col-8 pull-left">
                    <span style="color: red">{{ trans('words.dash_name') }}</span>
                </div>

                <div class="col-4 pull-right">
                    <span style="color: red">Status</span>
                </div>
            </div>
            
            <div class="col-12">
                @php    
                    $active = 0;
                    $inactive = 0;
                @endphp
                @foreach($resultList as $key => $value)
                    @php    

                        $endcontratDate = date('Y-m-d',strtotime($value['endContract']));
                        $alertData = date('Y-m-d', strtotime('-56 days', strtotime($value['endContract'])));
                        $currentDate = date("Y-m-d");
                        if($currentDate < $endcontratDate){
                        $active ++;
                    @endphp
                        <div class="col-8 pull-left">
                            <span>{{ $value['name']." ".$value['surname']}}</span>
                        </div>
                    @php } 
                        if($currentDate < $endcontratDate){
                         
                    @endphp
                        <div class="col-4 pull-right" style="padding-left: 35px;">
                            <span><i class="fa fa-circle" style="color:#34aa44;"></i></span>
                        </div><hr> 
                    @php}
                    @endphp 
                @endforeach
            </div>
            

            </div>
        </div>

        <div class="row">
            <div class="col-12"><br>
                <div class="pull-right">
                    <span><b>Active Worker : {{ $active }}/ Inactive Worker : {{ $inactive }}</b></span>
                </div>
            </div>
        </div>



@else

    @if($selectstatus == "inactive")
    
         <div style="height:200px;overflow:scroll">
        <div class="row">  
            <div class="col-12" style="background-color: #eff3f6">
                <div class="col-8 pull-left">
                    <span style="color: red">{{ trans('words.dash_name') }}</span>
                </div>

                <div class="col-4 pull-right">
                    <span style="color: red">Status</span>
                </div>
            </div>
            <div class="col-12">
                @php    
                    $active = 0;
                    $inactive = 0;
                @endphp
                @foreach($resultList as $key => $value)
                    @php    

                        $endcontratDate = date('Y-m-d',strtotime($value['endContract']));
                        $alertData = date('Y-m-d', strtotime('-56 days', strtotime($value['endContract'])));
                        $currentDate = date("Y-m-d");
                        if($currentDate >= $endcontratDate){
                        $inactive ++;
                    @endphp
                        <div class="col-8 pull-left">
                            <span>{{ $value['name']." ".$value['surname']}}</span>
                        </div>
                    @php } 
                        if($currentDate >= $endcontratDate){
                         
                    @endphp
                        <div class="col-4 pull-right" style="padding-left: 35px;">
                            <span><i class="fa fa-circle" style="color:#ed1c24;"></i></span>
                        </div><hr> 
                    @php}
                    @endphp 
                @endforeach
            </div>


            </div>
        </div>

        <div class="row">
            <div class="col-12"><br>
                <div class="pull-right">
                    <span><b>Active Worker : {{ $active }}/ Inactive Worker : {{ $inactive }}</b></span>
                </div>
            </div>
        </div>


    @else
        <div style="height:200px;overflow:scroll">
        <div class="row">  
            <div class="col-12" style="background-color: #eff3f6">
                <div class="col-8 pull-left">
                    <span style="color: red">{{ trans('words.dash_name') }}</span>
                </div>

                <div class="col-4 pull-right">
                    <span style="color: red">Status</span>
                </div>
            </div>
            <div class="col-12">
                @php    
                $active = 0;
                $inactive = 0;
                @endphp
                @foreach($resultList as $key => $value)
                <div class="col-8 pull-left">
                    <span>{{ $value['name']." ".$value['surname']}}</span>
                </div>
                @php    

                $endcontratDate = date('Y-m-d',strtotime($value['endContract']));
                $alertData = date('Y-m-d', strtotime('-56 days', strtotime($value['endContract'])));
                $currentDate = date("Y-m-d");

                if($currentDate < $endcontratDate){
                 $active ++;
                @endphp
                    <div class="col-4 pull-right" style="padding-left: 35px;">
                        <span><i class="fa fa-circle" style="color:#34aa44;"></i></span>
                    </div>
                @php}
                else{
                $inactive ++;
                @endphp
                    <div class="col-4 pull-right" style="padding-left: 35px;"> 
                        <span><i class="fa fa-circle" style="color:#ed1c24;"></i></span>
                    </div>
                @php}
                @endphp <hr> 
                @endforeach

            </div>


            </div>
        </div>

        <div class="row">
            <div class="col-12"><br>
                <div class="pull-right">
                    <span><b>Active Worker : {{ $active }}/ Inactive Worker : {{ $inactive }}</b></span>
                </div>
            </div>
        </div>

    


    @endif


@endif