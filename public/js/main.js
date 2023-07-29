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

    $("#courses").select2();

    // Reset select on input change
    $("#courses").on("select2:open", function () {
        var searchInput = $(".select2-search__field");
        searchInput.val("");
    });
})(jQuery);
