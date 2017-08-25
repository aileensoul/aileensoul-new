

                                       

                                       $(function () {
        // alert('hi');
        $("#searchplace").autocomplete({
source: function (request, response) {
var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
        response($.grep(data1, function (item) {
        return matcher.test(item.label);
                                                   }));
                                               },
                                               minLength: 1,
                                               select: function (event, ui) {
                event.preventDefault();
                $("#searchplace").val(ui.item.label);
                $("#selected-tag").val(ui.item.label);
                // window.location.href = ui.item.value;
                                               }
                                               ,
                                               focus: function (event, ui) {
                event.preventDefault();
                $("#searchplace").val(ui.item.label);
                                               }
                                           });
                                       });



                                    

                                        $(function () {
                // alert('hi');
                $("#tags").autocomplete({
        source: function (request, response) {
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(data, function (item) {
                return matcher.test(item.label);
                                                    }));
                                                },
                                                minLength: 1,
                                                select: function (event, ui) {
                        event.preventDefault();
                        $("#tags").val(ui.item.label);
                        $("#selected-tag").val(ui.item.label);
                        // window.location.href = ui.item.value;
                                                }
                                                ,
                                                focus: function (event, ui) {
                        event.preventDefault();
                        $("#tags").val(ui.item.label);
                                                }
                                            });
                                        });



                                       

                                        $(function () {
                        // alert('hi');
                        $("#searchplace1").autocomplete({
                source: function (request, response) {
                var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                        response($.grep(data1, function (item) {
                        return matcher.test(item.label);
                                                    }));
                                                },
                                                minLength: 1,
                                                select: function (event, ui) {
                                event.preventDefault();
                                $("#searchplace1").val(ui.item.label);
                                $("#selected-tag").val(ui.item.label);
                                // window.location.href = ui.item.value;
                                                }
                                                ,
                                                focus: function (event, ui) {
                                event.preventDefault();
                                $("#searchplace1").val(ui.item.label);
                                                }
                                            });
                                        });



                                  

                                        $(function () {
                                // alert('hi');
                                $("#tags1").autocomplete({
                        source: function (request, response) {
                        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                response($.grep(data, function (item) {
                                return matcher.test(item.label);
                                                    }));
                                                },
                                                minLength: 1,
                                                select: function (event, ui) {
                                        event.preventDefault();
                                        $("#tags1").val(ui.item.label);
                                        $("#selected-tag").val(ui.item.label);
                                        // window.location.href = ui.item.value;
                                                }
                                                ,
                                                focus: function (event, ui) {
                                        event.preventDefault();
                                        $("#tags1").val(ui.item.label);
                                                }
                                            });
                                        });


                        function check() {
                                        var keyword = $.trim(document.getElementById('tags1').value);
                                        var place = $.trim(document.getElementById('searchplace1').value);
                                        if (keyword == "" && place == "") {
                                return false;
                            }
                        }

function checkvalue(){
                                        //alert("hi");
                                        var searchkeyword = $.trim(document.getElementById('tags').value);
                                        var searchplace = $.trim(document.getElementById('searchplace').value);
                                        // alert(searchkeyword);
                                        // alert(searchplace);
                                        if (searchkeyword == "" && searchplace == ""){
                                //alert('Please enter Keyword');
                                return false;
  }
}
  
