

<div class="c-modal modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="standard-modal" data-backdrop="static">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="c-modal__content">
            <div class="c-modal__header">
                <h3 class="c-modal__title">Delete Record</h3>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </div>
            <div class="c-modal__body">
                <p>Are you sure want to delete ?</p>
            </div>
            <div class="c-modal__footer">
                <button class="c-btn c-btn--info pull-right" data-dismiss="modal">Cancel</button>
                <button class="c-btn c-btn--danger yes-sure"><i class="fa fa-trash-o u-mr-xsmall "  data-id=""></i> Delete</button>
            </div>
        </div><!-- // .c-modal__content -->
    </div><!-- // .c-modal__dialog -->
</div><!-- // .c-modal -->


<script src="{{ asset('js/main.min.js') }}"></script>
<script src="{!! asset('js/plugins/validate/jquery.validate.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/toastr/toastr.min.js') !!}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/jquery.timepicker.js') }}"></script>
<script src="{!! asset('js/comman_function.js') !!}" type="text/javascript"></script>



@if (!empty($pluginjs)) 
@foreach ($pluginjs as $value) 
<script src="{{ url('js/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif
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
        $('#start_time').timepicker('hh:mm:ss');
        $('#end_time').timepicker('hh:mm:ss');
        $('#pausetime').timepicker('hh:mm:ss');
</script>

@section('scripts')
@show