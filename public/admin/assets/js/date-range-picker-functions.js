
var dateFormatGlobal = "MM-DD-YYYY HH:mm";

function getLocaleSettings(locale)
{
    let  localeSettings = null;

    if (locale === 'tr') {
        let dateFormat = "DD-MM-YYYY HH:mm";

        dateFormatGlobal = dateFormat;

        localeSettings = {
            "format": dateFormat,
            "separator": " - ",
            "applyLabel": "Uygula",
            "cancelLabel": "Temizle",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Ozel",
            "weekLabel": "W",
            "daysOfWeek": [
                "Pzt",
                "Sal",
                "Çar",
                "Per",
                "Cum",
                "Cmt",
                "Pzr"
            ],
            "monthNames": [
                "Ocak",
                "Şubat",
                "Mart",
                "Nisan",
                "Mayıs",
                "Haziran",
                "Temmuz",
                "Ağustos",
                "Eylül",
                "Ekim",
                "Kasım",
                "Aralık"
            ],
            "firstDay": 1
        };

    } else {
        let dateFormat = "DD-MM-YYYY HH:mm";

        dateFormatGlobal = dateFormat;
        localeSettings = {
            "format": dateFormat,
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        };
    }

    return localeSettings;
}

function getRangeSettings(locale)
{
    let rangeSettings = null;

    if (locale === 'tr') {
        rangeSettings = {
            'Bugun': [moment(), moment()],
            'Dun': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Gun Once': [moment().subtract(6, 'days'), moment()],
            '10 Gun Once': [moment().subtract(9, 'days'), moment()],
            '20 Gun Once': [moment().subtract(19, 'days'), moment()],
            '30 Gun Once': [moment().subtract(29, 'days'), moment()],
        };
    } else {
        rangeSettings = {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Days Ago': [moment().subtract(6, 'days'), moment()],
            '10 Days Ago': [moment().subtract(9, 'days'), moment()],
            '20 Days Ago': [moment().subtract(19, 'days'), moment()],
            '30 Days Ago': [moment().subtract(29, 'days'), moment()],
        };
    }

    return rangeSettings;
}

function createDateRangePickerForElement(className, locale)
{
    let localeSettings = getLocaleSettings(locale);
    let rangeSettings = getRangeSettings(locale);

    $('.' + className).daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePickerIncrement: 5,
        timePicker24Hour: true,
        buttonClasses: ' btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        //autoApply: true,
        opens: 'center',
        locale: localeSettings,
        autoUpdateInput: false,
        ranges: rangeSettings,
    }, function (date) {
        $('.' + className).val(date.format(dateFormatGlobal));
    });

    $('.' + className).on('cancel.daterangepicker', function (ev, picker) {
        //do something, like clearing an input
        $('.' + className).val('');
    });
}
