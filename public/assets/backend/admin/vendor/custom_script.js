function bannerClick(e) {
    window.location.href = e;
}
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}
function openNav() {
    (document.getElementById("mySidebar").style.width = "300px"), (document.getElementById("mainwrapper").style.marginRight = "300px");
}
function closeNav() {
    (document.getElementById("mySidebar").style.width = "0"), (document.getElementById("mainwrapper").style.marginRight = "0");
}
function checkedAll() {
    0 == checked ? (checked = !0) : (checked = !1);
    for (var e = 0; e < document.getElementById("form_check").elements.length; e++) document.getElementById("form_check").elements[e].checked = checked;
}
function permissions(e, t) {
		
    for (var a = document.getElementsByName("summe_code[]"), l = 0, s = new Array(), o = 0; o < a.length; o++) a[o].checked && ((s[l] = a[o].value), l++);
    if ("" == s) return alert("Please check one or more!"), !1;
    var n = "permissions?approve_val=" + s + "&&tablename=" + e + "&&status=" + t;
    window.location.href = n;
}
function permissionsProducts(e, t) {
    for (var a = document.getElementsByName("summe_code[]"), l = 0, s = new Array(), o = 0; o < a.length; o++) a[o].checked && ((s[l] = a[o].value), l++);
    if ("" == s) return alert("Please check one or more!"), !1;
    var n = "permissions?approve_val=" + s + "&&tablename=" + e + "&&status=" + t;
    window.location.href = n;
}
function changestatus(e) {
    for (var t = document.getElementsById("changemtype").value, a = document.getElementsByName("summe_code[]"), l = 0, s = new Array(), o = 0; o < a.length; o++) a[o].checked && ((s[l] = a[o].value), l++);
    if ("" == s) return alert("Please check one or more!"), !1;
    var n = "changestatus?approve_val=" + s + "&&tablename=" + e + "&&status=" + t;
    window.location.href = n;
}
function deletedata(e, t) {
    for (var a = document.getElementsByName("summe_code[]"), l = 0, s = new Array(), o = e, n = !1, c = 0; c < a.length; c++) a[c].checked && ((s[l] = a[c].value), l++);
    if ("" == s) return swal({ title: "Unchecked credential!", text: "Please check one or more!", icon: "warning" }), !1;
    swal({ title: "Are you sure?", imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}", confirmButtonText: "Ok, Delete It", showCloseButton: !0, showCancelButton: !0, text: "Do you want to Delete Selected Data !" }).then(
        function (e) {
            e.value
                ? ((n = !0),
                  $.ajax({
                      type: "GET",
                      url: o,
                      data: { id: s, deletetype: "multiple", deleteimage: n, tablename: t },
                      cache: !1,
                      success: function (e) {
                          for (c in (swal({ title: "Successfully Delete!", text: "All selected data are deleted", type: "success" }), e.length, e)) $("#tablerow" + e[c]).fadeOut("slow");
                      },
                  }))
                : 0 === e.value
                ? ((n = !1),
                  $.ajax({
                      type: "GET",
                      url: o,
                      data: { id: s, deletetype: "multiple", deleteimage: n, tablename: t },
                      cache: !1,
                      success: function (e) {
                          for (c in (swal({ title: "Successfully Delete!", text: "All selected Submission are deleted", type: "success" }), e.length, e)) $("#tablerow" + e[c]).fadeOut("slow");
                      },
                  }))
                : console.log("modal was dismissed by ${result.dismiss}");
        }
    );
}
function deleteSingle(e, t, a) {
    var l = t,
        s = !1;
    swal({ imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}", title: "Are you sure?", confirmButtonText: "Ok, Delete It", showCloseButton: !0, showCancelButton: !0, text: "Do you want to Delete Selected data !" }).then(
        function (t) {
            t.value
                ? ((s = !0),
                  $.ajax({
                      type: "GET",
                      url: l,
                      data: { id: e, deletetype: "single", deleteimage: s, tablename: a },
                      cache: !1,
                      success: function (t) {
                          swal({ title: "Successfully Delete!", text: "All selected data are deleted", type: "success" }), $("#tablerow" + e).fadeOut("slow");
                      },
                  }))
                : 0 === t.value
                ? ((s = !1),
                  $.ajax({
                      type: "GET",
                      url: l,
                      data: { id: e, deletetype: "single", deleteimage: s, tablename: a },
                      cache: !1,
                      success: function (t) {
                          swal({ title: "Successfully Delete!", text: "All selected Submission are deleted", type: "success" }), $("#tablerow" + e).fadeOut("slow");
                      },
                  }))
                : console.log("modal was dismissed by ${result.dismiss}");
        }
    );
}
function deleteCommonSingle(e, t, a) {
    swal({
        title: "Are you sure?",
        text: "Do you want to delete this item ? Make sure after deleting you completely lost all related data of this item form aleshamart system.",
        confirmButtonText: "Ok, Delete It",
        type: "warning",
        showCloseButton: !0,
        showCancelButton: !0,
    }).then(function (l) {
        l.value
            ? $.ajax({
                  type: "GET",
                  url: "commonsingledelete",
                  data: { id: a, column: t, table: e },
                  cache: !1,
                  success: function (e) {
                      swal({ title: "Successfully Delete!", text: "All selected data are deleted", type: "success" }), $("#tablerow" + a).fadeOut("slow");
                  },
                  error: function (e, t) {},
              })
            : swal({ title: "Congratulation!", text: "Your Prodcut is still here", type: "success" });
    });
}
$(document).ready(function () {
    $(".sidebars").click(function () {
        $(".megamenu").slideToggle();
    }),
        $(window).on("scroll", function () {
            $(this).scrollTop() > 300 ? ($("#fixheader").addClass("stickyHeader"), $(".navFooterBackToTop").show("slow")) : ($("#fixheader").removeClass("stickyHeader"), $(".navFooterBackToTop").hide("slow"));
        }),
        $(window).width() <= 480 &&
            jQuery(".submenus").on("click", function () {
                jQuery(".dropdown").toggleClass("display");
            });
}),
    $(document).ready(function () {
        $("ul.tabs li").click(function () {
            var e = $(this).attr("data-tab");
            $("ul.tabs li").removeClass("active"), $(".tab-content1").removeClass("active"), $(this).addClass("active"), $("#" + e).addClass("active");
        }),
            $("ul.tabs2 li").click(function () {
                var e = $(this).attr("data-tab");
                $("ul.tabs2 li").removeClass("active"), $(".tab-content2").removeClass("active"), $(this).addClass("active"), $("#" + e).addClass("active");
            });
    }),
    (checked = !1),
    $(document).ready(function () {
        $("#minicarts").on("click", function () {
            $(".shopping-cart").fadeToggle("fast");
        });
    });
