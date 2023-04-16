<div class="col-10 row pr-0" wire:ignore>
    <div class="col-5 pr-0">
        <input type="text" class="form-control" id="fromDate" max="{{ date('Y-m-d') }}">
    </div>
    <div class="col-2 justify-content-center align-items-center">
        <p class="text-center pt-2">～</p>
    </div>
    <div class="col-5 pr-0 pl-0">
        <input type="text" class="form-control" id="toDate" max="{{ date('Y-m-d') }}">
    </div>
</div>
<script>
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    document.addEventListener('livewire:load', function () {
        setDatePickerUI();
    });
    function setDatePickerUI() {
            $("#fromDate").kendoDatePicker({
                value: new Date(today.getFullYear(), (today.getMonth()), 1),
                format: "dd/MM/yyyy"
            });
            $("#toDate").kendoDatePicker({
                value: new Date(today.getFullYear(), (today.getMonth()), today.getDate()),
                format: "dd/MM/yyyy"
            });
            var datepickerFrom = $("#fromDate").data("kendoDatePicker");
            var datepickerTo = $("#toDate").data("kendoDatePicker");

            datepickerFrom.max(new Date());
            datepickerTo.max(new Date());

            datepickerFrom.bind("change", function() {
                var value = this.value();
                if (value != null) {
                    window.livewire.emit('setfromDate', {
                        ['fromDate']: value.toLocaleDateString('en-US')
                    });
                    datepickerTo.min(value)
                }
            });

            datepickerTo.bind("change", function() {
                let value = this.value();
                if (value != null) {
                    window.livewire.emit('settoDate', {
                        ['toDate']: value.toLocaleDateString('en-US')
                    });
                    datepickerFrom.max(value)
                }
            });
        };
</script>
