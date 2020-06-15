$(document).ready(function(){
    window.setTimeout(function() {
        $(".alert").remove();
    }, 6000);
});

$(document).ready(function(){
    $("#myToast").toast('show');
});
