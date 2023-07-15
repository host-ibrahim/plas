$(document).ready(function() {
    $("#example1").DataTable();
    $("#example1 th, #example1 td").addClass("p-2 m-1");
    $("a.nav-link").each(function(i, e) {
        if ($(e).prop("href") == location.href) {
            $(this).addClass("active");
            return false;
        }
    });
});