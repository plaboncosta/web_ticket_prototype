let base = "<?php echo $base_url; ?>";

$("input[type='number']").keyup(function (){
    if ($(this).val() < 0){
        $(this).val('');
    }
});

$("input[type='number']").change(function (){
    if ($(this).val() < 0){
        $(this).val('');
    }
});

$(function (){
    let dtToday = new Date();
    
    let month = dtToday.getMonth() + 1;
    let day   = dtToday.getDate();
    let year  = dtToday.getFullYear();
    if (month < 10){
        month = '0' + month.toString();
    }
    if (day < 10){
        day = '0' + day.toString();
    }
    
    let maxDate = year + '-' + month + '-' + day;
    $(".restrict-date").attr('min', maxDate);
});

function logOutUser() {

}