function checkvalue() {
    var e = $.trim(document.getElementById("tags").value),
        t = $.trim(document.getElementById("searchplace").value);
    return "" == e && "" == t ? !1 : void 0
}

function check() {
    var e = $.trim(document.getElementById("tags1").value),
        t = $.trim(document.getElementById("searchplace1").value);
    return "" == e && "" == t ? !1 : void 0
}

function business_home_post(e) {
    isProcessing || (isProcessing = !0, $.ajax({
        type: "POST",
        url: base_url + "business_profile/business_home_post?page=" + e,
        data: {
            total_record: $("#total_record").val()
        },
        dataType: "html",
        beforeSend: function() {
            "undefined" == e || $("#loader").show()
        },
        complete: function() {
            $("#loader").hide()
        },
        success: function(e) {
            $(".loader").remove(), $(".business-all-post").append(e);
            var t = $(".post-design-box").length;
            0 == t ? $("#dropdownclass").addClass("no-post-h2") : $("#dropdownclass").removeClass("no-post-h2"), isProcessing = !1
        }
    }))
}

function business_home_three_user_list() {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/business_home_three_user_list/",
        data: "",
        dataType: "html",
        beforeSend: function() {
            $(".profile-boxProfileCard_follow").html('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>')
        },
        success: function(e) {
            $(".loader").remove(), $(".profile-boxProfileCard_follow").html(e)
        }
    })
}

function post_like(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/like_post",
        data: "post_id=" + e,
        dataType: "json",
        success: function(t) {
            $(".likepost" + e).html(t.like), $(".likeusername" + e).html(t.likeuser), $(".comment_like_count" + e).html(t.like_user_count), $(".likeduserlist" + e).hide(), "0" == t.like_user_total_count ? document.getElementById("likeusername" + e).style.display = "none" : document.getElementById("likeusername" + e).style.display = "block", $("#likeusername" + e).addClass("likeduserlist1")
        }
    })
}

function insert_comment(e) {
    $("#post_comment" + e).click(function() {
        $(this).prop("contentEditable", !0), $(this).html("")
    });
    var t = $("#post_comment" + e),
        o = t.html();
    if (o = o.replace(/&nbsp;/gi, " "), o = o.replace(/<br>$/, ""), o = o.replace(/&gt;/gi, ">"), o = o.replace(/div/gi, "p"), "" == o || "<br>" == o) return !1;
    if (/^\s+$/gi.test(o)) return !1;
    o = o.replace(/&/g, "%26"), $("#post_comment" + e).html("");
    var n = document.getElementById("threecomment" + e),
        l = document.getElementById("fourcomment" + e);
    "block" === n.style.display && "none" === l.style.display ? $.ajax({
        type: "POST",
        url: base_url + "business_profile/insert_commentthree",
        data: "post_id=" + e + "&comment=" + encodeURIComponent(o),
        dataType: "json",
        success: function(t) {
            $("textarea").each(function() {
                $(this).val("")
            }), $(".insertcomment" + e).html(t.comment), $(".comment_count" + e).html(t.comment_count)
        }
    }) : $.ajax({
        type: "POST",
        url: base_url + "business_profile/insert_comment",
        data: "post_id=" + e + "&comment=" + encodeURIComponent(o),
        dataType: "json",
        success: function(t) {
            $("textarea").each(function() {
                $(this).val("")
            }), $("#fourcomment" + e).html(t.comment), $(".comment_count" + e).html(t.comment_count)
        }
    })
}

function entercomment(e) {
    $("#post_comment" + e).click(function() {
        $(this).prop("contentEditable", !0)
    }), $("#post_comment" + e).keypress(function(t) {
        if (13 == t.keyCode && !t.shiftKey) {
            t.preventDefault();
            var o = $("#post_comment" + e),
                n = o.html();
            if (n = n.replace(/&nbsp;/gi, " "), n = n.replace(/<br>$/, ""), n = n.replace(/&gt;/gi, ">"), n = n.replace(/div/gi, "p"), "" == n || "<br>" == n) return !1;
            if (/^\s+$/gi.test(n)) return !1;
            if (n = n.replace(/&/g, "%26"), $("#post_comment" + e).html(""), window.preventDuplicateKeyPresses) return;
            window.preventDuplicateKeyPresses = !0, window.setTimeout(function() {
                window.preventDuplicateKeyPresses = !1
            }, 500);
            var l = document.getElementById("threecomment" + e),
                s = document.getElementById("fourcomment" + e);
            "block" === l.style.display && "none" === s.style.display ? $.ajax({
                type: "POST",
                url: base_url + "business_profile/insert_commentthree",
                data: "post_id=" + e + "&comment=" + encodeURIComponent(n),
                dataType: "json",
                success: function(t) {
                    $("textarea").each(function() {
                        $(this).val("")
                    }), $(".insertcomment" + e).html(t.comment), $(".comment_count" + e).html(t.comment_count)
                }
            }) : $.ajax({
                type: "POST",
                url: base_url + "business_profile/insert_comment",
                data: "post_id=" + e + "&comment=" + encodeURIComponent(n),
                dataType: "json",
                success: function(t) {
                    $("textarea").each(function() {
                        $(this).val("")
                    }), $("#fourcomment" + e).html(t.comment), $(".comment_count" + e).html(t.comment_count)
                }
            })
        }
    }), $(".scroll").click(function(e) {
        e.preventDefault(), $("html,body").animate({
            scrollTop: $(this.hash).offset().top
        }, 1200)
    })
}

function commentall(e) {
    var t = document.getElementById("threecomment" + e),
        o = document.getElementById("fourcomment" + e),
        n = document.getElementById("insertcount" + e);
    $(".post-design-commnet-box").show(), "block" === t.style.display && "none" === o.style.display && (t.style.display = "none", o.style.display = "block", n.style.visibility = "show", $.ajax({
        type: "POST",
        url: base_url + "business_profile/fourcomment",
        data: "bus_post_id=" + e,
        success: function(t) {
            $("#fourcomment" + e).html(t)
        }
    }))
}

function comment_like(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/like_comment",
        data: "post_id=" + e,
        success: function(t) {
            $("#likecomment" + e).html(t)
        }
    })
}

function comment_like1(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/like_comment1",
        data: "post_id=" + e,
        success: function(t) {
            $("#likecomment1" + e).html(t)
        }
    })
}

function comment_delete(e) {
    $(".biderror .mes").html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + e + " onClick='comment_deleted(" + e + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"), $("#bidmodal").modal("show")
}

function comment_deleted(e) {
    var t = document.getElementById("post_delete" + e);
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/delete_comment",
        data: "post_id=" + e + "&post_delete=" + t.value,
        dataType: "json",
        success: function(e) {
            $(".insertcomment" + t.value).html(e.comment), $(".comment_count" + t.value).html(e.comment_count), $(".post-design-commnet-box").show()
        }
    })
}

function comment_deletetwo(e) {
    $(".biderror .mes").html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + e + " onClick='comment_deletedtwo(" + e + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"), $("#bidmodal").modal("show")
}

function comment_deletedtwo(e) {
    var t = document.getElementById("post_deletetwo" + e);
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/delete_commenttwo",
        data: "post_id=" + e + "&post_delete=" + t.value,
        dataType: "json",
        success: function(e) {
            $(".insertcommenttwo" + t.value).html(e.comment), $(".comment_count" + t.value).html(e.comment_count), $(".post-design-commnet-box").show()
        }
    })
}

function comment_editbox(e) {
    document.getElementById("editcomment" + e).style.display = "inline-block", document.getElementById("showcomment" + e).style.display = "none", document.getElementById("editsubmit" + e).style.display = "inline-block", document.getElementById("editcommentbox" + e).style.display = "none", document.getElementById("editcancle" + e).style.display = "block", $(".post-design-commnet-box").hide()
}

function comment_editcancle(e) {
    document.getElementById("editcommentbox" + e).style.display = "block", document.getElementById("editcancle" + e).style.display = "none", document.getElementById("editcomment" + e).style.display = "none", document.getElementById("showcomment" + e).style.display = "block", document.getElementById("editsubmit" + e).style.display = "none", $(".post-design-commnet-box").show()
}

function comment_editboxtwo(e) {
    $("div[id^=editcommenttwo]").css("display", "none"), $("div[id^=showcommenttwo]").css("display", "block"), $("button[id^=editsubmittwo]").css("display", "none"), $("div[id^=editcommentboxtwo]").css("display", "block"), $("div[id^=editcancletwo]").css("display", "none"), document.getElementById("editcommenttwo" + e).style.display = "inline-block", document.getElementById("showcommenttwo" + e).style.display = "none", document.getElementById("editsubmittwo" + e).style.display = "inline-block", document.getElementById("editcommentboxtwo" + e).style.display = "none", document.getElementById("editcancletwo" + e).style.display = "block", $(".post-design-commnet-box").hide()
}

function comment_editcancletwo(e) {
    document.getElementById("editcommentboxtwo" + e).style.display = "block", document.getElementById("editcancletwo" + e).style.display = "none", document.getElementById("editcommenttwo" + e).style.display = "none", document.getElementById("showcommenttwo" + e).style.display = "block", document.getElementById("editsubmittwo" + e).style.display = "none", $(".post-design-commnet-box").show()
}

function comment_editbox3(e) {
    document.getElementById("editcomment3" + e).style.display = "block", document.getElementById("showcomment3" + e).style.display = "none", document.getElementById("editsubmit3" + e).style.display = "block", document.getElementById("editcommentbox3" + e).style.display = "none", document.getElementById("editcancle3" + e).style.display = "block", $(".post-design-commnet-box").hide()
}

function comment_editcancle3(e) {
    document.getElementById("editcommentbox3" + e).style.display = "block", document.getElementById("editcancle3" + e).style.display = "none", document.getElementById("editcomment3" + e).style.display = "none", document.getElementById("showcomment3" + e).style.display = "block", document.getElementById("editsubmit3" + e).style.display = "none", $(".post-design-commnet-box").show()
}

function comment_editbox4(e) {
    document.getElementById("editcomment4" + e).style.display = "block", document.getElementById("showcomment4" + e).style.display = "none", document.getElementById("editsubmit4" + e).style.display = "block", document.getElementById("editcommentbox4" + e).style.display = "none", document.getElementById("editcancle4" + e).style.display = "block", $(".post-design-commnet-box").hide()
}

function comment_editcancle4(e) {
    document.getElementById("editcommentbox4" + e).style.display = "block", document.getElementById("editcancle4" + e).style.display = "none", document.getElementById("editcomment4" + e).style.display = "none", document.getElementById("showcomment4" + e).style.display = "block", document.getElementById("editsubmit4" + e).style.display = "none", $(".post-design-commnet-box").show()
}

function edit_comment(e) {
    $("#editcomment" + e).click(function() {
        $(this).prop("contentEditable", !0)
    });
    var t = $("#editcomment" + e),
        o = t.html();
    return o = o.replace(/&nbsp;/gi, " "), o = o.replace(/<br>$/, ""), o = o.replace(/&gt;/gi, ">"), o = o.replace(/div/gi, "p"), "" == o || "<br>" == o ? !1 : /^\s+$/gi.test(o) ? !1 : (o = o.replace(/&/g, "%26"), $.ajax({
        type: "POST",
        url: base_url + "business_profile/edit_comment_insert",
        data: "post_id=" + e + "&comment=" + encodeURIComponent(o),
        success: function(t) {
            document.getElementById("editcomment" + e).style.display = "none", document.getElementById("showcomment" + e).style.display = "block", document.getElementById("editsubmit" + e).style.display = "none", document.getElementById("editcommentbox" + e).style.display = "block", document.getElementById("editcancle" + e).style.display = "none", $("#showcomment" + e).html(t), $(".post-design-commnet-box").show()
        }
    }), void $(".scroll").click(function(e) {
        e.preventDefault(), $("html,body").animate({
            scrollTop: $(this.hash).offset().top
        }, 1200)
    }))
}

function commentedit(e) {
    $("#editcomment" + e).click(function() {
        $(this).prop("contentEditable", !0)
    }), $("#editcomment" + e).keypress(function(t) {
        if (13 == t.which && 1 != t.shiftKey) {
            t.preventDefault();
            var o = $("#editcomment" + e),
                n = o.html();
            if (n = n.replace(/&nbsp;/gi, " "), n = n.replace(/<br>$/, ""), n = n.replace(/&gt;/gi, ">"), n = n.replace(/div/gi, "p"), "" == n || "<br>" == n) return !1;
            if (/^\s+$/gi.test(n)) return !1;
            if (n = n.replace(/&/g, "%26"), window.preventDuplicateKeyPresses) return;
            window.preventDuplicateKeyPresses = !0, window.setTimeout(function() {
                window.preventDuplicateKeyPresses = !1
            }, 500), $.ajax({
                type: "POST",
                url: base_url + "business_profile/edit_comment_insert",
                data: "post_id=" + e + "&comment=" + encodeURIComponent(n),
                success: function(t) {
                    document.getElementById("editcomment" + e).style.display = "none", document.getElementById("showcomment" + e).style.display = "block", document.getElementById("editsubmit" + e).style.display = "none", document.getElementById("editcommentbox" + e).style.display = "block", document.getElementById("editcancle" + e).style.display = "none", $("#showcomment" + e).html(t), $(".post-design-commnet-box").show()
                }
            })
        }
    }), $(".scroll").click(function(e) {
        e.preventDefault(), $("html,body").animate({
            scrollTop: $(this.hash).offset().top
        }, 1200)
    })
}

function edit_commenttwo(e) {
    $("#editcommenttwo" + e).click(function() {
        $(this).prop("contentEditable", !0)
    });
    var t = $("#editcommenttwo" + e),
        o = t.html();
    return o = o.replace(/&nbsp;/gi, " "), o = o.replace(/<br>$/, ""), o = o.replace(/&gt;/gi, ">"), o = o.replace(/div/gi, "p"), "" == o || "<br>" == o ? !1 : /^\s+$/gi.test(o) ? !1 : (o = o.replace(/&/g, "%26"), $.ajax({
        type: "POST",
        url: base_url + "business_profile/edit_comment_insert",
        data: "post_id=" + e + "&comment=" + encodeURIComponent(o),
        success: function(t) {
            document.getElementById("editcommenttwo" + e).style.display = "none", document.getElementById("showcommenttwo" + e).style.display = "block", document.getElementById("editsubmittwo" + e).style.display = "none", document.getElementById("editcommentboxtwo" + e).style.display = "block", document.getElementById("editcancletwo" + e).style.display = "none", $("#showcommenttwo" + e).html(t), $(".post-design-commnet-box").show()
        }
    }), void $(".scroll").click(function(e) {
        e.preventDefault(), $("html,body").animate({
            scrollTop: $(this.hash).offset().top
        }, 1200)
    }))
}

function commentedittwo(e) {
    $("#editcommenttwo" + e).click(function() {
        $(this).prop("contentEditable", !0)
    }), $("#editcommenttwo" + e).keypress(function(t) {
        if (13 == t.which && 1 != t.shiftKey) {
            t.preventDefault();
            var o = $("#editcommenttwo" + e),
                n = o.html();
            if (n = n.replace(/&nbsp;/gi, " "), n = n.replace(/<br>$/, ""), n = n.replace(/&gt;/gi, ">"), n = n.replace(/div/gi, "p"), "" == n || "<br>" == n) return !1;
            if (/^\s+$/gi.test(n)) return !1;
            if (n = n.replace(/&/g, "%26"), window.preventDuplicateKeyPresses) return;
            window.preventDuplicateKeyPresses = !0, window.setTimeout(function() {
                window.preventDuplicateKeyPresses = !1
            }, 500), $.ajax({
                type: "POST",
                url: base_url + "business_profile/edit_comment_insert",
                data: "post_id=" + e + "&comment=" + encodeURIComponent(n),
                success: function(t) {
                    document.getElementById("editcommenttwo" + e).style.display = "none", document.getElementById("showcommenttwo" + e).style.display = "block", document.getElementById("editsubmittwo" + e).style.display = "none", document.getElementById("editcommentboxtwo" + e).style.display = "block", document.getElementById("editcancletwo" + e).style.display = "none", $("#showcommenttwo" + e).html(t), $(".post-design-commnet-box").show()
                }
            })
        }
    }), $(".scroll").click(function(e) {
        e.preventDefault(), $("html,body").animate({
            scrollTop: $(this.hash).offset().top
        }, 1200)
    })
}

function commentedit2(e) {
    $(document).ready(function() {
        $("#editcomment2" + e).keypress(function(t) {
            if (13 == t.keyCode && !t.shiftKey) {
                var o = $("#editcomment2" + e).val();
                if (t.preventDefault(), window.preventDuplicateKeyPresses) return;
                window.preventDuplicateKeyPresses = !0, window.setTimeout(function() {
                    window.preventDuplicateKeyPresses = !1
                }, 500), $.ajax({
                    type: "POST",
                    url: base_url + "business_profile/edit_comment_insert",
                    data: "post_id=" + e + "&comment=" + o,
                    success: function(t) {
                        document.getElementById("editcomment2" + e).style.display = "none", document.getElementById("showcomment2" + e).style.display = "block", document.getElementById("editsubmit2" + e).style.display = "none", document.getElementById("editcommentbox2" + e).style.display = "block", document.getElementById("editcancle2" + e).style.display = "none", $("#showcomment2" + e).html(t)
                    }
                })
            }
        })
    })
}

function edit_comment3(e) {
    var t = document.getElementById("editcomment3" + e);
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/edit_comment_insert",
        data: "post_id=" + e + "&comment=" + t.value,
        success: function(t) {
            document.getElementById("editcomment3" + e).style.display = "none", document.getElementById("showcomment3" + e).style.display = "block", document.getElementById("editsubmit3" + e).style.display = "none", document.getElementById("editcommentbox3" + e).style.display = "block", document.getElementById("editcancle3" + e).style.display = "none", $("#showcomment3" + e).html(t), $(".post-design-commnet-box").show()
        }
    })
}

function commentedit3(e) {
    $(document).ready(function() {
        $("#editcomment3" + e).keypress(function(t) {
            if (13 == t.keyCode && !t.shiftKey) {
                var o = $("#editcomment3" + clicked_id).val();
                if (t.preventDefault(), window.preventDuplicateKeyPresses) return;
                window.preventDuplicateKeyPresses = !0, window.setTimeout(function() {
                    window.preventDuplicateKeyPresses = !1
                }, 500), $.ajax({
                    type: "POST",
                    url: base_url + "business_profile/edit_comment_insert",
                    data: "post_id=" + e + "&comment=" + o,
                    success: function(t) {
                        document.getElementById("editcomment3" + e).style.display = "none", document.getElementById("showcomment3" + e).style.display = "block", document.getElementById("editsubmit3" + e).style.display = "none", document.getElementById("editcommentbox3" + e).style.display = "block", document.getElementById("editcancle3" + e).style.display = "none", $("#showcomment3" + e).html(t)
                    }
                })
            }
        })
    })
}

function edit_comment4(e) {
    var t = document.getElementById("editcomment4" + e);
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/edit_comment_insert",
        data: "post_id=" + e + "&comment=" + t.value,
        success: function(t) {
            document.getElementById("editcomment4" + e).style.display = "none", document.getElementById("showcomment4" + e).style.display = "block", document.getElementById("editsubmit4" + e).style.display = "none", document.getElementById("editcommentbox4" + e).style.display = "block", document.getElementById("editcancle4" + e).style.display = "none", $("#showcomment4" + e).html(t)
        }
    })
}

function commentedit4(e) {
    $(document).ready(function() {
        $("#editcomment4" + e).keypress(function(t) {
            if (13 == t.keyCode && !t.shiftKey) {
                var o = $("#editcomment4" + clicked_id).val();
                if (t.preventDefault(), window.preventDuplicateKeyPresses) return;
                window.preventDuplicateKeyPresses = !0, window.setTimeout(function() {
                    window.preventDuplicateKeyPresses = !1
                }, 500), $.ajax({
                    type: "POST",
                    url: base_url + "business_profile/edit_comment_insert",
                    data: "post_id=" + e + "&comment=" + o,
                    success: function(t) {
                        document.getElementById("editcomment4" + e).style.display = "none", document.getElementById("showcomment4" + e).style.display = "block", document.getElementById("editsubmit4" + e).style.display = "none", document.getElementById("editcommentbox4" + e).style.display = "block", document.getElementById("editcancle4" + e).style.display = "none", $("#showcomment4" + e).html(t)
                    }
                })
            }
        })
    })
}

function check_length(e) {
    if (maxLen = 50, e.my_text.value.length > maxLen) {
        var t = "You have reached your maximum limit of characters allowed";
        $(".biderror .mes").html("<div class='pop_content'>" + t + "</div>"), $("#bidmodal").modal("show"), e.my_text.value = e.my_text.value.substring(0, maxLen)
    } else e.text_num.value = maxLen - e.my_text.value.length
}

function check_lengthedit(e) {
    maxLen = 50;
    var t = document.getElementById("editpostname" + e).value;
    if (t.length > maxLen) {
        text_num = maxLen - t.length;
        var o = "You have reached your maximum limit of characters allowed";
        $("#postedit .mes").html("<div class='pop_content'>" + o + "</div>"), $("#postedit").modal("show");
        var n = t.substring(0, maxLen);
        $("#editpostname" + e).val(n)
    } else text_num = maxLen - t.length, $("#text_num_" + e).val(parseInt(text_num))
}

function save_post(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/business_profile_save",
        data: "business_profile_post_id=" + e,
        success: function(t) {
            $(".savedpost" + e).html(t)
        }
    })
}

function followuser_two(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/follow_two",
        data: "follow_to=" + e,
        success: function(t) {
            $(".fr" + e).html(t), $("#fad" + e).fadeOut(6e3)
        }
    })
}

function followclose(e) {
    $("#fad" + e).fadeOut(4e3)
}

function myFunction(e) {
    var t = document.getElementById("myDropdown" + e).className;
    t = t.split(" ").pop(-1), "show" != t ? ($(".dropdown-content1").removeClass("show"), $("#myDropdown" + e).addClass("show")) : $(".dropdown-content1").removeClass("show"), $(document).on("keydown", function(t) {
        27 === t.keyCode && (document.getElementById("myDropdown" + e).classList.toggle("hide"), $(".dropdown-content1").removeClass("show"))
    })
}

function read(e) {
    return function(t) {
        var o = t.target.result,
            n = $("<img/>", {
                src: o,
                title: encodeURIComponent(e.name),
                "class": "thumb"
            }),
            l = $("<span/>", {
                html: n,
                "class": "thumbParent"
            }).append('<span class="remove_thumb"/>');
        thumbsArray.push(o), $list.append(l)
    }
}

function handleFileSelect(e) {
    e.preventDefault();
    var t = e.target.files,
        o = t.length;
    if (o > maxUpload || thumbsArray.length >= maxUpload) return alert("Sorry you can upload only 5 images");
    for (var n = 0; o > n; n++) {
        var l = t[n];
        if (l.type.match("image.*")) {
            var s = new FileReader;
            s.onload = read(l), s.readAsDataURL(l)
        }
    }
}

function imgval(e) {
    var t = document.getElementById("file-1").files,
        o = document.getElementById("test-upload-product").value,
        n = o.trim(),
        l = document.getElementById("test-upload-des").value,
        s = l.trim(),
        i = document.getElementById("file-1").value;
    if ("" == i && "" == n && "" == s) return $("#post .mes").html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post."), $("#post").modal("show"), $(document).on("keydown", function(e) {
        27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
    }), e.preventDefault(), !1;
    for (var d = 0; d < t.length; d++) {
        var a = t[d].name,
            m = t[0].name,
            c = m.split(".").pop(),
            r = a.split(".").pop(),
            p = ["jpg", "jpeg", "PNG", "gif", "png", "psd", "bmp", "tiff", "iff", "xbm", "webp"],
            u = ["mp4", "webm", "MP4"],
            y = ["mp3"],
            f = ["pdf"],
            h = $.inArray(c, p) > -1,
            g = $.inArray(c, u) > -1,
            b = $.inArray(c, y) > -1,
            v = $.inArray(c, f) > -1;
        if (1 == h) {
            var _ = $.inArray(r, p) > -1;
            if (!(1 == _ && t.length <= 10)) return $(".biderror .mes").html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf."), $("#posterrormodal").modal("show"), setInterval("window.location.reload()", 1e4), $(document).on("keydown", function(e) {
                27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
            }), e.preventDefault(), !1
        } else if (1 == g) {
            var _ = $.inArray(r, u) > -1;
            if (1 != _ || 1 != t.length) return $(".biderror .mes").html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf."), $("#posterrormodal").modal("show"), setInterval("window.location.reload()", 1e4), $(document).on("keydown", function(e) {
                27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
            }), e.preventDefault(), !1
        } else if (1 == b) {
            var _ = $.inArray(r, y) > -1;
            if (1 != _ || 1 != t.length) return $(".biderror .mes").html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf."), $("#posterrormodal").modal("show"), setInterval("window.location.reload()", 1e4), $(document).on("keydown", function(e) {
                27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
            }), e.preventDefault(), !1;
            if ("" == o) return $(".biderror .mes").html("<div class='pop_content'>You have to add audio title."), $("#posterrormodal").modal("show"), $(document).on("keydown", function(e) {
                27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
            }), e.preventDefault(), !1
        } else if (1 == v) {
            var _ = $.inArray(r, f) > -1;
            if (1 != _ || 1 != t.length) return t.length > 10 ? $(".biderror .mes").html("<div class='pop_content'>You can not upload more than 10 files at a time.") : $(".biderror .mes").html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf."), $("#posterrormodal").modal("show"), setInterval("window.location.reload()", 1e4), $(document).on("keydown", function(e) {
                27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
            }), e.preventDefault(), !1;
            if ("" == o) return $(".biderror .mes").html("<div class='pop_content'>You have to add pdf title."), $("#posterrormodal").modal("show"), setInterval("window.location.reload()", 1e4), $(document).on("keydown", function(e) {
                27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
            }), e.preventDefault(), !1
        } else if (0 == g) return $(".biderror .mes").html("<div class='pop_content'>This File Format is not supported Please Try to Upload MP4 or WebM files.."), $("#posterrormodal").modal("show"), setInterval("window.location.reload()", 1e4), $(document).on("keydown", function(e) {
            27 === e.keyCode && ($("#posterrormodal").modal("hide"), $(".modal-post").show())
        }), e.preventDefault(), !1
    }
}

function contentedit(e) {
    $("#post_comment" + e).click(function() {
        $(this).prop("contentEditable", !0), $(this).html("")
    }), $("#post_comment" + e).keypress(function(t) {
        if (13 == t.which && 1 != t.shiftKey) {
            t.preventDefault();
            var o = $("#post_comment" + e),
                n = o.html();
            if (n = n.replace(/&nbsp;/gi, " "), n = n.replace(/<br>$/, ""), "" == n || "<br>" == n) return !1;
            if (/^\s+$/gi.test(n)) return !1;
            n = n.replace(/&/g, "%26"), $("#post_comment" + e).html("");
            var l = document.getElementById("threecomment" + e),
                s = document.getElementById("fourcomment" + e);
            "block" === l.style.display && "none" === s.style.display ? $.ajax({
                type: "POST",
                url: base_url + "business_profile/insert_commentthree",
                data: "post_id=" + e + "&comment=" + encodeURIComponent(n),
                dataType: "json",
                success: function(t) {
                    $("input").each(function() {
                        $(this).val("")
                    }), $("#insertcount" + e).html(t.count), $(".insertcomment" + e).html(t.comment), $(".comment_count" + e).html(t.comment_count)
                }
            }) : $.ajax({
                type: "POST",
                url: base_url + "business_profile/insert_comment",
                data: "post_id=" + e + "&comment=" + encodeURIComponent(n),
                success: function(t) {
                    $("input").each(function() {
                        $(this).val("")
                    }), $("#fourcomment" + e).html(t), $(".comment_count" + e).html(t.comment_count)
                }
            })
        }
    }), $(".scroll").click(function(e) {
        e.preventDefault(), $("html,body").animate({
            scrollTop: $(this.hash).offset().top
        }, 1200)
    })
}

function likeuserlist(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/likeuserlist",
        data: "post_id=" + e,
        dataType: "html",
        success: function(e) {
            var t = e;
            $("#likeusermodal .mes").html(t), $("#likeusermodal").modal("show")
        }
    })
}

function remove_post(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/business_profile_deleteforpost",
        dataType: "json",
        data: "business_profile_post_id=" + e,
        success: function(t) {
            $("#removepost" + e).remove(), "count" == t.notcount && $(".nofoundpost").html(t.notfound);
            var o = $(".post-design-box").length;
            0 == o ? $("#dropdownclass").addClass("no-post-h2") : $("#dropdownclass").removeClass("no-post-h2");
            var n = $(".post-design-box").length;
            0 == n && $(".art_no_post_avl").show()
        }
    })
}

function del_particular_userpost(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/del_particular_userpost",
        dataType: "json",
        data: "business_profile_post_id=" + e,
        success: function(t) {
            $("#removepost" + e).remove(), "count" == t.notcount && $(".nofoundpost").html(t.notfound)
        }
    })
}

function user_postdelete(e) {
    $(".biderror .mes").html("<div class='pop_content'> Do you want to delete this post?<div class='model_ok_cancel'><a class='okbtn' id=" + e + " onClick='remove_post(" + e + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"), $("#bidmodal").modal("show")
}

function user_postdeleteparticular(e) {
    $(".biderror .mes").html("<div class='pop_content'>Do you want to delete this post from your profile?.<div class='model_ok_cancel'><a class='okbtn' id=" + e + " onClick='del_particular_userpost(" + e + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"), $("#bidmodal").modal("show")
}

function OnPaste_StripFormatting(e, t) {
    if (t.originalEvent && t.originalEvent.clipboardData && t.originalEvent.clipboardData.getData) {
        t.preventDefault();
        var o = t.originalEvent.clipboardData.getData("text/plain");
        window.document.execCommand("insertText", !1, o)
    } else if (t.clipboardData && t.clipboardData.getData) {
        t.preventDefault();
        var o = t.clipboardData.getData("text/plain");
        window.document.execCommand("insertText", !1, o)
    } else window.clipboardData && window.clipboardData.getData && (_onPaste_StripFormatting_IEPaste || (_onPaste_StripFormatting_IEPaste = !0, t.preventDefault(), window.document.execCommand("ms-pasteTextOnly", !1)), _onPaste_StripFormatting_IEPaste = !1)
}

function khdiv(e) {
    $.ajax({
        type: "POST",
        url: base_url + "business_profile/edit_more_insert",
        data: "business_profile_post_id=" + e,
        dataType: "json",
        success: function(t) {
            document.getElementById("editpostdata" + e).style.display = "block", document.getElementById("editpostbox" + e).style.display = "none", document.getElementById("editpostdetailbox" + e).style.display = "none", document.getElementById("editpostsubmit" + e).style.display = "none", document.getElementById("khyati" + e).style.display = "none", document.getElementById("khyatii" + e).style.display = "block", $("#editpostdata" + e).html(t.title), $("#khyatii" + e).html(t.description)
        }
    })
}

function editpost(e) {
    var t = $("#editpostdata" + e + " a").html(),
        o = $("#khyatii" + e).html();
    $("#myDropdown" + e).removeClass("show"), document.getElementById("editpostdata" + e).style.display = "none", document.getElementById("editpostbox" + e).style.display = "block", document.getElementById("editpostdetailbox" + e).style.display = "block", document.getElementById("editpostsubmit" + e).style.display = "block", document.getElementById("khyatii" + e).style.display = "none", document.getElementById("khyati" + e).style.display = "none", t = t.trim(), o = o.trim(), $("#editpostname" + e).val(t), $("#editpostdesc" + e).html(o)
}

function edit_postinsert(e) {
    var t = document.getElementById("editpostname" + e),
        o = ($("#editpostdesc" + e), $("#editpostdesc" + e).html());
    o = o.replace(/&/g, "%26"), o = o.replace(/&gt;/gi, ">"), o = o.replace(/&nbsp;/gi, " "), o = o.replace(/div/gi, "p"), "" == t.value && "" == o ? ($(".biderror .mes").html("<div class='pop_content'>You must either fill title or description."), $("#bidmodal").modal("show"), document.getElementById("editpostdata" + e).style.display = "block", document.getElementById("editpostbox" + e).style.display = "none", document.getElementById("khyati" + e).style.display = "block", document.getElementById("editpostdetailbox" + e).style.display = "none", document.getElementById("editpostsubmit" + e).style.display = "none") : $.ajax({
        type: "POST",
        url: base_url + "business_profile/edit_post_insert",
        data: "business_profile_post_id=" + e + "&product_name=" + t.value + "&product_description=" + o,
        dataType: "json",
        success: function(t) {
            document.getElementById("editpostdata" + e).style.display = "block", document.getElementById("editpostbox" + e).style.display = "none", document.getElementById("editpostdetailbox" + e).style.display = "none", document.getElementById("editpostsubmit" + e).style.display = "none", document.getElementById("khyati" + e).style.display = "block", $("#editpostdata" + e).html(t.title), $("#khyati" + e).html(t.description), $("#postname" + e).html(t.postname)
        }
    })
}

function seemorediv(e) {
    document.getElementById("seemore" + e).style.display = "block", document.getElementById("lessmore" + e).style.display = "none"
}
$(function() {
    $("#tags").autocomplete({
        source: function(e, t) {
            var o = new RegExp("^" + $.ui.autocomplete.escapeRegex(e.term), "i");
            t($.grep(data, function(e) {
                return o.test(e.label)
            }))
        },
        minLength: 1,
        select: function(e, t) {
            e.preventDefault(), $("#tags").val(t.item.label), $("#selected-tag").val(t.item.label)
        },
        focus: function(e, t) {
            e.preventDefault(), $("#tags").val(t.item.label)
        }
    })
}), $(function() {
    $("#searchplace").autocomplete({
        source: function(e, t) {
            var o = new RegExp("^" + $.ui.autocomplete.escapeRegex(e.term), "i");
            t($.grep(data1, function(e) {
                return o.test(e.label)
            }))
        },
        minLength: 1,
        select: function(e, t) {
            e.preventDefault(), $("#searchplace").val(t.item.label), $("#selected-tag").val(t.item.label)
        },
        focus: function(e, t) {
            e.preventDefault(), $("#searchplace").val(t.item.label)
        }
    })
}), $(function() {
    $("#tags1").autocomplete({
        source: function(e, t) {
            var o = new RegExp("^" + $.ui.autocomplete.escapeRegex(e.term), "i");
            t($.grep(data, function(e) {
                return o.test(e.label)
            }))
        },
        minLength: 1,
        select: function(e, t) {
            e.preventDefault(), $("#tag1").val(t.item.label), $("#selected-tag").val(t.item.label)
        },
        focus: function(e, t) {
            e.preventDefault(), $("#tags1").val(t.item.label)
        }
    })
}), $(function() {
    $("#searchplace1").autocomplete({
        source: function(e, t) {
            var o = new RegExp("^" + $.ui.autocomplete.escapeRegex(e.term), "i");
            t($.grep(data1, function(e) {
                return o.test(e.label)
            }))
        },
        minLength: 1,
        select: function(e, t) {
            e.preventDefault(), $("#searchplace1").val(t.item.label), $("#selected-tag").val(t.item.label)
        },
        focus: function(e, t) {
            e.preventDefault(), $("#searchplace1").val(t.item.label)
        }
    })
}), $(document).ready(function() {
    business_home_post(), business_home_three_user_list(), $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            var e = $(".page_number:last").val(),
                t = $(".total_record").val(),
                o = $(".perpage_record").val();
            if (parseInt(o) <= parseInt(t)) {
                var n = t / o;
                n = parseInt(n, 10);
                var l = t % o;
                if (l > 0 && (n += 1), parseInt(e) <= parseInt(n)) {
                    var s = parseInt($(".page_number:last").val()) + 1;
                    business_home_post(s)
                }
            }
        }
    })
});
var isProcessing = !1;
$("#content").on("change keyup keydown paste cut", "textarea", function() {
    $(this).height(0).height(this.scrollHeight);
}).find("textarea").change();
var modal = document.getElementById("myModal"),
    btn = document.getElementById("myBtn"),
    span = document.getElementsByClassName("close1")[0];
btn.onclick = function() {
    modal.style.display = "block"
}, span.onclick = function() {
    modal.style.display = "none"
}, window.onclick = function(e) {
    e.target == modal && (modal.style.display = "none")
}, window.onclick = function(e) {
    if (!e.target.matches(".dropbtn1")) {
        var t, o = document.getElementsByClassName("dropdown-content1");
        for (t = 0; t < o.length; t++) {
            var n = o[t];
            n.classList.contains("show") && n.classList.remove("show")
        }
    }
};
var $fileUpload = $("#files"),
    $list = $("#list"),
    thumbsArray = [],
    maxUpload = 5;
$fileUpload.change(function(e) {
    handleFileSelect(e)
}), $list.on("click", ".remove_thumb", function() {
    var e = $(".remove_thumb"),
        t = e.index(this);
    $(this).closest("span.thumbParent").remove(), thumbsArray.splice(t, 1)
}), $("#file-fr").fileinput({
    language: "fr",
    uploadUrl: "#",
    allowedFileExtensions: ["jpg", "jpeg", "PNG", "gif", "png", "psd", "bmp", "tiff", "iff", "xbm", "webp", "mp4", "mp3", "pdf"]
}), $("#file-es").fileinput({
    language: "es",
    uploadUrl: "#",
    allowedFileExtensions: ["jpg", "jpeg", "PNG", "gif", "png", "psd", "bmp", "tiff", "iff", "xbm", "webp", "mp4", "mp3", "pdf"]
}), $("#file-0").fileinput({
    allowedFileExtensions: ["jpg", "jpeg", "PNG", "gif", "png", "psd", "bmp", "tiff", "iff", "xbm", "webp", "mp4", "mp3", "pdf"]
}), $("#file-1").fileinput({
    uploadUrl: "#",
    allowedFileExtensions: ["jpg", "jpeg", "PNG", "gif", "png", "psd", "bmp", "tiff", "iff", "xbm", "webp", "mp4", "mp3", "pdf"],
    overwriteInitial: !1,
    maxFileSize: 1e6,
    maxFilesNum: 10,
    slugCallback: function(e) {
        return e.replace("(", "_").replace("]", "_")
    }
}), $("#file-3").fileinput({
    showUpload: !1,
    showCaption: !1,
    browseClass: "btn btn-primary btn-lg",
    fileType: "any",
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    overwriteInitial: !1,
    initialPreviewAsData: !0,
    initialPreview: ["http://lorempixel.com/1920/1080/transport/1", "http://lorempixel.com/1920/1080/transport/2", "http://lorempixel.com/1920/1080/transport/3"],
    initialPreviewConfig: [{
        caption: "transport-1.jpg",
        size: 329892,
        width: "120px",
        url: "{$url}",
        key: 1
    }, {
        caption: "transport-2.jpg",
        size: 872378,
        width: "120px",
        url: "{$url}",
        key: 2
    }, {
        caption: "transport-3.jpg",
        size: 632762,
        width: "120px",
        url: "{$url}",
        key: 3
    }]
}), $("#file-4").fileinput({
    uploadExtraData: {
        kvId: "10"
    }
}), $(".btn-warning").on("click", function() {
    var e = $("#file-4");
    e.attr("disabled") ? e.fileinput("enable") : e.fileinput("disable")
}), $(".btn-info").on("click", function() {
    $("#file-4").fileinput("refresh", {
        previewClass: "bg-info"
    })
}), $(document).ready(function() {
    $("#test-upload").fileinput({
        showPreview: !1,
        allowedFileExtensions: ["jpg", "jpeg", "PNG", "gif", "png", "psd", "bmp", "tiff", "iff", "xbm", "webp", "mp4", "mp3", "pdf"],
        elErrorContainer: "#errorBlock"
    }), $("#kv-explorer").fileinput({
        theme: "explorer",
        uploadUrl: "#",
        overwriteInitial: !1,
        initialPreviewAsData: !0,
        initialPreview: ["http://lorempixel.com/1920/1080/nature/1", "http://lorempixel.com/1920/1080/nature/2", "http://lorempixel.com/1920/1080/nature/3"],
        initialPreviewConfig: [{
            caption: "nature-1.jpg",
            size: 329892,
            width: "120px",
            url: "{$url}",
            key: 1
        }, {
            caption: "nature-2.jpg",
            size: 872378,
            width: "120px",
            url: "{$url}",
            key: 2
        }, {
            caption: "nature-3.jpg",
            size: 632762,
            width: "120px",
            url: "{$url}",
            key: 3
        }]
    })
}), $(document).ready(function() {
    $("#post").on("click", function() {
        $(".modal-post").show()
    })
}), $("body").on("click", "*", function(e) {
    var t = $(e.target).attr("class").toString().split(" ").pop();
    "fa-ellipsis-v" != t && $("div[id^=myDropdown]").hide().removeClass("show")
}), $(".like_ripple").click(function(e) {
    $(".ripple").remove();
    var t = $(this).offset().left,
        o = $(this).offset().top,
        n = $(this).width(),
        l = $(this).height();
    $(this).prepend("<span class='ripple'></span>"), n >= l ? l = n : n = l;
    var s = e.pageX - t - n / 2,
        i = e.pageY - o - l / 2;
    $(".ripple").css({
        width: n,
        height: l,
        top: i + "px",
        left: s + "px"
    }).addClass("rippleEffect")
}), $(document).ready(function() {
    $("video").mediaelementplayer({
        alwaysShowControls: !1,
        videoVolume: "horizontal",
        features: ["playpause", "progress", "volume", "fullscreen"]
    })
}), $(document).on("keydown", function(e) {
    27 === e.keyCode && ($(".modal-post").show() && $(document).on("keydown", function(e) {
        27 === e.keyCode && $(".modal-post").hide()
    }), document.getElementById("myModal").style.display = "none")
});
var modal = document.getElementById("myModal");
window.onclick = function(e) {
    e.target == modal && (modal.style.display = "none")
};
var _onPaste_StripFormatting_IEPaste = !1;
jQuery(document).mouseup(function(e) {
    var t = $("#myModal");
    jQuery(document).mouseup(function(e) {
        var o = $("#close");
        o.is(e.target) || 0 !== o.has(e.target).length || t.hide()
    })
}), $(document).on("keydown", function(e) {
    27 === e.keyCode && $("#likeusermodal").modal("hide")
}), $(".posterror-modal-close").on("click", function() {
    document.getElementById("myModal").style.display = "block"
}), jQuery(document).ready(function(e) {
    var t = e(".progress-bar"),
        o = e(".sr-only"),
        n = {
            beforeSend: function() {
                document.getElementById("progress_div").style.display = "block";
                var e = "0%";
                t.width(e), o.html(e), document.getElementById("myModal").style.display = "none"
            },
            uploadProgress: function(e, n, l, s) {
                var i = s + "%";
                t.width(i), o.html(i)
            },
            success: function() {
                var e = "100%";
                t.width(e), o.html(e)
            },
            complete: function(t) {
                e(".art_no_post_avl").hide(), document.getElementById("test-upload-product").value = "", document.getElementById("test-upload-des").value = "", document.getElementById("file-1").value = "", e("input[name='text_num']").val(50), e(".file-preview-frame").hide(), document.getElementById("progress_div").style.display = "none", e(".business-all-post div:first").remove(), e(".business-all-post").prepend(t.responseText);
                var o = e(".post-design-box").length;
                0 == o ? e("#dropdownclass").addClass("no-post-h2") : (document.getElementById("art_no_post_avl").style.display = "none", e("#dropdownclass").removeClass("no-post-h2")), e("html, body").animate({
                    scrollTop: e(".upload-image-messages").offset().top - 100
                }, 150)
            }
        };
    return e(".upload-image-form").ajaxForm(n), !1
}), $(window).load(function() {
    var e = $(".post-design-box").length;
    0 == e && $("#dropdownclass").addClass("no-post-h2")
}), $("#postedit").on("click", function() {}), $(document).on("keydown", function(e) {
    27 === e.keyCode && $("#postedit").modal("hide")
}), $("#file-1").on("click", function(e) {
    var t = document.getElementById("test-upload-product").value,
        o = document.getElementById("test-upload-des").value;
    document.getElementById("artpostform").reset(), document.getElementById("test-upload-product").value = t, document.getElementById("test-upload-des").value = o
});