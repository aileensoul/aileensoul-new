$(function () {
    function split(val) {
        return val.split(/,\s*/);
    }
    function extractLast(term) {
        return split(term).pop();
    }
    /* first box */
    $("#tags").bind("keydown", function (event) {
        if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
            event.preventDefault();
        }
    })
            .autocomplete({
                minLength: 1,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    $.getJSON(base_url + "business_profile/ajax_business_skill", {term: extractLast(request.term)}, response);
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {
                    var terms = split(this.value);
                    if (terms.length <= 1) {
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    } else {
                        var last = terms.pop();
                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                        $(this).effect("highlight", {}, 1000);
                        $(this).attr("style", "border: solid 1px red;");
                        return false;
                    }
                }
            });
    /* first box*/
    /* location box*/
    $("#searchplace").bind("keydown", function (event) {
        if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
            event.preventDefault();
        }
    })
            .autocomplete({
                minLength: 1,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    $.getJSON(base_url + "business_profile/ajax_location_data", {term: extractLast(request.term)}, response);
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {
                    var terms = split(this.value);
                    if (terms.length <= 1) {
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    } else {
                        var last = terms.pop();
                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                        $(this).effect("highlight", {}, 1000);
                        $(this).attr("style", "border: solid 1px red;");
                        return false;
                    }
                }
            });
    /* location box*/
});
