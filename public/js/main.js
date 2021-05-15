$(document).ready(function () {
    selectUser()
    $(document).on('#action', 'click', function(){
        alert("Clicked")
    })
})
function selectUser(){
    let action = "select"
    $.ajax({
        url: './config/config.php',
        method: 'POST',
        data: {action},
        success: function(data){
            $('#result').html(data)
        }
    })
}

function insertUser(){
    let action = "insert"
    $.ajax({
        url: '',
        method: '',
        data: {action, username, fullname},
        success: function(data){
            selectUser()
        }
    })
}