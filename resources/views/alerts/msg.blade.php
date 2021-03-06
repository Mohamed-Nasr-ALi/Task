@if (session('message'))
    <!-- Position toasts -->
    <div style="position: absolute; top: 50px; right: 0;">
        <div style="width:600px;" class="toast" id="myToast" data-delay="9000">
            <div class="toast-header">
                <strong class="mr-auto"><i class="fa fa-globe"></i> projects</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body text-white" style="background-color: rgba(0,0,0,0.5) !important;">
                {{ Session::get('message') }}
            </div>
        </div>
    </div>
@endif
