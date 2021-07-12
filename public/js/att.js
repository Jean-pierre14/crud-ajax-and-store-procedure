$(document).ready(function () {
    select()
})

function select() {
    $.ajax({
        url: './config/att.php',
        method: 'POST',
        data: { action: 'select' },
        success: function (data) {
            $('#results').html(data)
        }
    })
}