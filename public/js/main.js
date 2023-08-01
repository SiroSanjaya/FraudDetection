(function ($) {
    "use strict";

    $(".js-select2").select2({
        closeOnSelect: false,
        placeholder: "Click to select an option",
        allowHtml: true,
        allowClear: true,
        tags: true, // создает новые опции на лету
    });

    $(".icons_select2").select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true,
        placeholder: "Click to select an option",
        dropdownParent: $(".select-icon"), //обавили класс
        allowClear: true,
        multiple: false,
    });
    

    function iformat(icon, badge) {
        var originalOption = icon.element;
        var originalOptionBadge = $(originalOption).data("badge");

        return $(
            '<span><i class="fa ' +
                $(originalOption).data("icon") +
                '"></i> ' +
                icon.text +
                '<span class="badge">' +
                originalOptionBadge +
                "</span></span>"
        );
    }

    $("#id_0").datetimepicker({
        allowInputToggle: true,
        showClose: true,
        showClear: true,
        showTodayButton: true,
        format: "MM/DD/YYYY",
        icons: {
            time: "fa fa-clock-o",

            date: "fa fa-calendar-o",

            up: "fa fa-chevron-up",

            down: "fa fa-chevron-down",

            previous: "fa fa-chevron-left",

            next: "fa fa-chevron-right",

            today: "fa fa-chevron-up",

            clear: "fa fa-trash",

            close: "fa fa-close",
        },
    });

    $("#courses").select2();

    // Reset select on input change
    $("#courses").on("select2:open", function () {
        var searchInput = $(".select2-search__field");
        searchInput.val("");
    });

    rome(input_from, {
        dateValidator: rome.val.beforeEq(input_to),
        time: false,
    });

    rome(input_to, {
        dateValidator: rome.val.afterEq(input_from),
        time: false,
    });

})(jQuery);
