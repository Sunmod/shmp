var enableDays = [];


    function enableAllTheseDays(date) {
        var fDate = $.datepicker.formatDate('dd-mm-yy', date);
        var result = [false, ""];
        $.each(enableDays, function(k, d) {
            if (fDate === d) {
                result = [true, "highlight-green"];
            }
        });
        return result;
    }

    $("#datepicker").datepicker({
        dateFormat: "Y-m-d",
        beforeShowDay: enableAllTheseDays,
        showOtherMonths: true,

    });