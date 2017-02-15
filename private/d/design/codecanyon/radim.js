$(document).ready(function() {

    function toggleNavbar(toggle, show, width, display) {
        $(".radim button.navbar-toggle").each(function() {
            eval('$(this.getAttribute("data-target")).' + toggle + 'Class("radim-small")'), $(".radim.navbar").css("width", width + "px"), eval('$(".radim .navbar-collapse").' + show + "()"), $(".container-radim").css("margin-left", width + "px"), $(".radim .navbar-brand").css("display", display)
        });
        if (toggle == 'add') { document.cookie = "radim-type=collapsed" } else { document.cookie = "radim-type=expanded" }
    }
    function get_cookie ( cookie_name )
    {
      var cookie_string = document.cookie ;
      if (cookie_string.length != 0) {
        var cookie_value = cookie_string.match ( '(^|;)[\s]*' + cookie_name + '=([^;]*)' );
        if (cookie_value) {
            return decodeURIComponent ( cookie_value[2] ) ;  
        } else {
            return '';
        }
      }
      return '' ;
    }
    function windowResize() {
        $(".radim button.navbar-toggle").each(window.innerWidth >= 992 ? function() {
            toggleNavbar("remove", "show", "227.656", "block")
        } : window.innerWidth >= 480 ? function() {
            toggleNavbar("add", "show", "53", "none")
        } : function() {
            toggleNavbar("remove", "hide", "0", "block")
        });
    }
    $(".radim.navbar").css("height", "calc(" + $("body").css("height") + ")"),
    $(".radim .dropdown>a").on("click", function(a) {
        a.stopPropagation(),
        $(this).parent("li.dropdown.open").length > 0 
        ? $(this).parent("li.dropdown").removeClass("open")
        : $(this).parents("li.dropdown").addClass("open"),
        $(this).parent("li.dropdown").find("li.dropdown").removeClass("open")
    }),
    $(".radim").on("click", '.navbar-form [type="submit"]', function(a) {
        return 0 == $(".radim-small").length ? !0 : void(0 == $(this).parents(".dropdown").length && (a.preventDefault(), toggleNavbar("remove", "show", 227.656, "block")))
    }), $(".radim button.navbar-toggle").click(function(a) {
        $(".radim li.dropdown").removeClass("open"),
        window.innerWidth >= 480 
        ? 0 == $(".navbar .radim-small").length 
        ? toggleNavbar("add", "show", "53", "none") 
        : toggleNavbar("remove", "show", "227.656", "block") 
        : 0 == $(".navbar .radim-small").length 
        ? toggleNavbar("add", "hide", "0", "block") 
        : toggleNavbar("remove", "show", "227.656", "block"),
        a.stopImmediatePropagation()
    });
    var radimW = $(window).width();
    $(window).resize(function() {
        radimW != $(window).width() && (windowResize(), radimW = $(window).width())
    });
    //console.log(get_cookie('radim-type'));
    if (get_cookie('radim-type') == 'collapsed') {
        toggleNavbar("add", "show", "53", "none");
    } else {
        toggleNavbar("remove", "show", "227.656", "block");
    }
});