<script src="{{ asset('js/main.min.js') }}"></script>
<script src="{!! asset('js/plugins/validate/jquery.validate.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/toastr/toastr.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/comman_function.js') !!}" type="text/javascript"></script>

@if (!empty($js)) 
@foreach ($js as $value) 
<script src="{{ asset('js/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif
<script>
    jQuery(document).ready(function() {

        @if (!empty($funinit))
                @foreach ($funinit as $value)
                    {{  $value }}
                @endforeach
        @endif
    });
</script>
@section('scripts')
@show