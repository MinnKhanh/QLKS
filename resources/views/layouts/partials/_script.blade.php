<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/metisMenu.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.toast.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/kendo.all.min.js') }}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('js/helper.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>
<!-- CORE SCRIPTS-->
<script src="{{asset('assets/js/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/common.js')}}" type="text/javascript"></script>
<script src="{{asset('js/app-core.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@include('layouts.partials._message')
<script>
    $(document).ready(function () {
        if($(window).height() > $("body").height()){
            $(".body-container").css("min-height", $(window).height() +"px");
        }

        $(".memu-main-left li").click(function (event) {
            event.stopPropagation()
            $(this).find("ul").first().toggleClass("active");
            $(this).toggleClass("active");
        });

        $(".parent-menu").each(function(){
        if($(this).find(".child-menu").length == 0)
            {
                $(this).hide();
            }
        });
    });
</script>

<script>
    window.addEventListener('alert', event => {
                 toastr[event.detail.type](event.detail.message,
                 event.detail.title ?? ''), toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    }
                });
</script>

