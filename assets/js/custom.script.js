/*let base_url      = window.location.origin;
 let pathArray     = window.location.pathname.split('/');
 let filteredArray = pathArray.filter(function (item){
 return item !== "";
 });
 
 let directoryArray = filteredArray.splice(0, filteredArray.length - 1);
 directoryArray.forEach(function (item){
 base_url += '/' + item;
 });
 */
let base_url = $("#base_url").val();

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

function logOutUser(){
    $.ajax({
        url   : base_url + '/db.php',
        method: 'POST',
        data  : {
            'action': 'logout'
        },
    }).done(function (response){
        let result = JSON.parse(response);
        if (result.success){
            window.location.href = 'index.php';
        }
    });
}