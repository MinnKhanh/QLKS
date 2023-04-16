
    <!-- Hiển thị thông báo thành công  -->
<!-- custom toastr -->
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

<script src="{{asset('js/toastr.min.js')}}"></script>
<script>
   toastr.options = {
    "closeButton": false,
    "debug": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

</script>
<!-- Hiển thị thông báo thành công  -->
@if ( Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
    <?php
        session()->forget('success');
    ?>
@endif
<!-- Hiển thị thông báo lỗi  -->
@if ( Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}");
    </script>
    <?php
    session()->forget('error');
    ?>
@endif

<!-- Hiển thị cảnh báo -->
@if ( Session::has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert" style="margin-bottom: 10px;">
        <strong>{{ Session::get('warning') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    <?php session()->forget('warning');?>
@endif

