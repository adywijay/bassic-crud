$(document).ready(function () {
    $('.parallax').parallax();
    $('.tabs').tabs();
    $('.fixed-action-btn').floatingActionButton();
    $('.tooltipped').tooltip();
    $('.basic-validate').validate();
    $('.sidenav').sidenav(); // Sidenav
    $('.collapsible').collapsible(); //Collabsible
    $('.dropdown-trigger').dropdown({
        hover: true
    }); // Dropdown
    $('select').formSelect(); // Select form
    $('.modal').modal(); //modal
    $('#sidebar-1').sidenav({ edge: 'left' });
    $('#sidebar-2').sidenav({ edge: 'right' });

    // ADD CLASS TO SIDEBAR-2 VIA JAVASCRIPT
    // See: https://stackoverflow.com/questions/29593944/css-media-query-adding-class-to-html
    // And: http://jsfiddle.net/9y1p42Lq/
    //
    // ON DOCUMENT READY
    if ($(window).width() >= 1925) {
        $('#sidebar-2').addClass("sidenav-fixed");
        $('#burger-icon-2').addClass("hide");
    }
    else {
        $('#sidebar-2').removeClass("sidenav-fixed");
        $('#burger-icon-2').removeClass("hide");
    }
});

// ON RESIZE
$(window).resize(function () {
    if ($(window).width() >= 1925) {
        $('#sidebar-2').addClass("sidenav-fixed");
        $('#burger-icon-2').addClass("hide");
    }
    else {
        $('#sidebar-2').removeClass("sidenav-fixed");
        $('#burger-icon-2').removeClass("hide");
    }
});



