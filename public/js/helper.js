

function formatInputNumber(input) {
    let maxValue = Number(input.getAttribute('max'));

    let value = input.value;
    if(/[^0-9,.]/.test(value[value.length - 1])) {
        input.value = value.substr(0, value.length - 1);
    } else if (value.indexOf('.') > -1 && value[value.length - 1] == '.') {
        input.value = value;
    } else {
        value = removeFormatNumber(value);
        if (maxValue && value > maxValue) {
            value = maxValue;
        }
        input.value = formatNumber(value);
    }
}

function formatNumber(value) {
    if (isNaN(value))  return '' ;
    return value.toLocaleString('en-US');
}

function removeFormatNumber(value) {
    return Number((value + "").replace(/,/g, ''));
}
