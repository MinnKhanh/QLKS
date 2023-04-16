$("document").ready(function () {
    $(".select2-box").select2({
        width: 'resolve'
    });
    initDatePicker();
    initDatePickerNow();
    initDateLocalPicker();
    window.addEventListener('setDateForDatePicker', e => {
        initDatePicker();
    })
    window.livewire.on('setDatePicker', () => {
        initDatePicker()
    })
    window.livewire.on('resetDateKendo', () => {
        document.getElementById('fromDate').value = '';
        document.getElementById('toDate').value = '';
    })
    window.livewire.on('resetDateRangerKendo', () => {
        document.getElementById('transactionDate').value = '';
    })
    window.addEventListener('show-toast', event => {
        let type = event.detail.type;
        let message = event.detail.message;
        Swal.fire({
            title: message,
            icon: type,
            confirmButtonText: 'OK',
            showCancelButton: false,
            showCloseButton: true
        });
        return;
    });
    window.addEventListener('alert', event => {
        let type = event.detail.type;
        switch (type) {
            case "success":
                toastr.success(event.detail.message);
                break;
            case "error":
                toastr.error(event.detail.message);
                break;
            case "warning":
                toastr.warning(event.detail.message);
                break;
            case "info":
                toastr.info(event.detail.message);
                break;
            default:
                toastr.info(event.detail.message);
                break;
        }
    });

    window.addEventListener('setDatePickerNow', event => {
        let id = $('#buyDate').attr('id');
        $('#buyDate').kendoDatePicker({
            format: 'dd/MM/yyyy',
            type: 'number',
            change: function () {
                if (this.value() != null) {
                    window.livewire.emit('set' + id, {
                        [id]: this.value() ? this.value().toLocaleDateString('en-US') : null
                    });
                }

            }
        });
    });
    window.addEventListener('setDateLocalPickerNow', event => {
        let id = $('#transactionDate').attr('id');
        alert(id);
        $('#transactionDate').kendoDateTimePicker({
            format: 'dd/MM/yyyy HH:mm tt',
            type: 'number',
            max: new Date(),
            change: function () {
                if (this.value() != null) {
                    window.livewire.emit('set' + id, {
                        ['transactionDate']: this.value() ? this.value().toLocaleString('en-US') : null
                    });
                }
            }
        });
    });
    window.addEventListener('setDateLocalPickerNow', event => {
        let id = $('#birthdayDate').attr('id');
       alert(id);
        $('#birthdayDate').kendoDateTimePicker({
            format: 'dd/MM/yyyy HH:mm tt',
            type: 'number',
            change: function () {
                if (this.value() != null) {
                    window.livewire.emit('set' + id, {
                        ['birthdayDate']: this.value() ? this.value().toLocaleString('en-US') : null
                    });
                }
            }
        });
    });
    window.addEventListener('setDatePickerEdit', event => {
        var count = document.getElementById('count_accessories').value;
        var i;
        for (i = 0; i < count; i++) {
            if (i % 2 !== 0) {
                $('#buyDateEdit' + i).kendoDatePicker({
                    format: 'dd/MM/yyyy',
                    value: event.detail.date,
                    change: function () {
                        if (this.value() != null) {
                            window.livewire.emit('setbuyDateEdit', {
                                ['buyDateEdit']: this.value() ? this.value().toLocaleDateString('en-US') : null
                            });
                        }
                    }
                });
                i++;
            }
        }

    });
    window.addEventListener('setDatePickerEdit2', event => {
        var count = document.getElementById('count_accessories').value;
        var i;
        for (i = 0; i < count; i++) {
            if (i % 2 === 0) {
                $('#buyDateEdit' + i).kendoDatePicker({
                    format: 'dd/MM/yyyy',
                    value: event.detail.date,
                    change: function () {
                        if (this.value() != null) {
                            window.livewire.emit('setbuyDateEdit', {
                                ['buyDateEdit']: this.value() ? this.value().toLocaleDateString('en-US') : null
                            });
                        }
                    }
                });
                i++;
            }
        }

    });
    window.addEventListener('setDatePickerUpdate', event => {
        let count = document.getElementById('count_accessories').value;
        for (var i = 0; i < count + 1; i++) {
            let id = $('#buyDateEdit' + i).attr('id');
            $('#buyDateEdit' + i).kendoDatePicker({
                format: 'dd/MM/yyyy',
                change: function () {
                    if (this.value() != null) {
                        window.livewire.emit('setbuyDateEdit', {
                            ['buyDateEdit']: this.value() ? this.value().toLocaleDateString('en-US') : null
                        });
                    }

                }
            });
            i++;
        }
    });
    window.addEventListener('setSelect2', event => {
        let id = $('#buyDateEdit').attr('id');
        $(".select2-box").select2({
            width: 'resolve',
        });

    });
    // $(".select2-user-info").select2({
    //     theme: "bootstrap",
    // }
    // );
    // window.livewire.on('close-model-create', () => {
    //     document.getElementById('close-model-create').click();
    // });
    // window.livewire.on('setSelect2Input', () => {
    //     $(".select2-user-info").select2({
    //         theme: "bootstrap",
    //     }
    //     );
    //     $('.select2-user-info').val(null).trigger('change');
    // });


    $("input.format_number").on({
        keyup: function () {
            formatCurrency($(this));
        },
        // blur: function () {
        //     formatCurrency($(this));
        // }
    });



});

// function formatNumber(n) {
//     return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
// }

function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    let input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
        return;
    }

    // original length
    let original_len = input_val.length;

    // initial caret position
    let caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        let decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        let left_side = input_val.substring(0, decimal_pos);
        let right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;

        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }

    // send updated string to input
    input.val(input_val);
    // put caret back in the right position
    let updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function initDatePicker(target = '.input-date-kendo') {
    $(target).each(function () {
        let id = $(this).attr('id');
        let checkSetNullWhenEnterInvalidDate = $(this).attr('set-null-when-enter-invalid-date');
        $(this).kendoDatePicker({
            format: 'dd/MM/yyyy',
            max: new Date(),
            type: 'number',
            change: function () {
                if (checkSetNullWhenEnterInvalidDate == 1) {
                    if (!this.value()) {
                        this.value(null);
                    }
                    window.livewire.emit('set' + id, {
                        [id]: this.value() ? this.value().toLocaleDateString('en-US') : null
                    });
                } else {
                    if (!this.value()) {
                        this.value(new Date());
                    }
                    window.livewire.emit('set' + id, {
                        [id]: this.value().toLocaleDateString('en-US')
                    });
                }
                if (this.value() != null) {
                    window.livewire.emit('set' + id, {
                        [id]: this.value() ? this.value().toLocaleDateString('en-US') : null
                    });
                }

            }
        });
        $(this).blur(() => {
            let datepicker = $(this).data("kendoDatePicker");
            if ($(this).val() != "") {
                datepicker.trigger("change");
            }
        })
    });
}

function initDateLocalPicker(target = '.input-date-local-kendo') {
    $(target).each(function () {
        let id = $(this).attr('id');
        let checkSetNullWhenEnterInvalidDate = $(this).attr('set-null-when-enter-invalid-date');
        $(this).kendoDateTimePicker({
            format: 'dd/MM/yyyy hh:mm tt',
            type: 'number',
            value: new Date(),
            max: new Date(),
            change: function () {
                if (checkSetNullWhenEnterInvalidDate == 1) {
                    if (!this.value()) {
                        this.value(null);
                    }
                    window.livewire.emit('set' + id, {
                        [id]: this.value() ? this.value().toLocaleString('en-US') : null
                    });
                } else {
                    if (!this.value()) {
                        this.value(new Date());
                    }
                    window.livewire.emit('set' + id, {
                        [id]: this.value().toLocaleString('en-US')
                    });
                }
                if (this.value() != null) {
                    window.livewire.emit('set' + id, {
                        [id]: this.value() ? this.value().toLocaleString('en-US') : null
                    });
                }

            }
        });
    });
}

function initDatePickerNow(target = '.input-date-kendo-now') {
    $(target).each(function () {
        let id = $(this).attr('id');
        let valueDate = document.getElementById(id).value;
        $(this).kendoDatePicker({
            format: 'dd/MM/yyyy',
            max: new Date(2199, 11, 31),
            type: 'number',
            change: function () {
                if (valueDate != null) {
                    window.livewire.emit('set' + id, {
                        valueDate
                    });
                }

            }
        });
        $(this).blur(() => {
            let datepicker = $(this).data("kendoDatePicker");
            if ($(this).val() !== "") {
                datepicker.trigger("change");
            }
        })
    });
}

function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}
