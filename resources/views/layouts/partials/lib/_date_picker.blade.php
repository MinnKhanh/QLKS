
    <link rel="stylesheet" href="{!! asset('assets/css/chosen.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/css/datepicker.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/css/bootstrap-timepicker.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/css/daterangepicker.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/css/bootstrap-datetimepicker.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/css/colorpicker.css') !!}" />

    <script src="{!! asset('assets/js/date-time/bootstrap-datepicker.js') !!}"></script>
    <script src="{!! asset('assets/js/date-time/daterangepicker.js') !!}"></script>


        <script>
            $("document").ready(function() {
            //or change it into a date range picker

            //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
            $('input[name=start_date]').daterangepicker({
                'applyClass' : 'btn-sm btn-success',
                'cancelClass' : 'btn-sm btn-default',
                locale: {
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                }
            },function(start, end) {
                console.log(this.format);
                this.element[0].dispatchEvent(new Event('input'));

            })
                .prev().on(ace.click_event, function(){
                $(this).next().focus();
            });

            $('input[name=date_end]').daterangepicker({
                'applyClass' : 'btn-sm btn-success',
                'cancelClass' : 'btn-sm btn-default',
                locale: {
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                }
            })
                .prev().on(ace.click_event, function(){
                $(this).next().focus();
            });
            $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    showOtherMonths: true,
                    selectOtherMonths: false
            });
            $('.date-picker2').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    showOtherMonths: true,
                    selectOtherMonths: false
            });

        });
    </script>
