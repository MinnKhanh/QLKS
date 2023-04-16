<div class="col-4 row" wire:ignore>
    <div class="col-5 pr-0">
        <input type="text" class="form-control" id="fromDate">
    </div>
    <div class="col-2 justify-content-center align-items-center">
        <p class="text-center pt-2">～</p>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" id="toDate">
    </div>
</div>
<script>
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    document.addEventListener('livewire:load', function() {
        setDatePickerUI();
    });

    function setDatePickerUI() {
        $("#fromDate").kendoDateTimePicker({
            // value: new Date(today.getFullYear(), (today.getMonth()), today.getDate()),
            format: "dd/MM/yyyy hh:mm tt"
        });
        $("#toDate").kendoDateTimePicker({
            // value: new Date(today.getFullYear(), (today.getMonth()), today.getDate()),
            format: "dd/MM/yyyy hh:mm tt"
        });
        var datepickerFrom = $("#fromDate").data("kendoDateTimePicker");
        var datepickerTo = $("#toDate").data("kendoDateTimePicker");

        // datepickerFrom.max(new Date());
        // datepickerTo.max(new Date());

        datepickerFrom.bind("change", function() {
            var value = this.value();
            if (value != null) {
                console.log(value)
                window.livewire.emit('setfromDateTime', {
                    ['fromDateTime']: value.toLocaleString('en-US')
                });
            }
        });

        datepickerTo.bind("change", function() {
            let value = this.value();
            if (value != null) {
                console.log(value)
                window.livewire.emit('settoDateTime', {
                    ['toDateTime']: value.toLocaleString('en-US')
                });
            }
        });
    };
</script>
