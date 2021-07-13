$(document).ready(function () {
    select()
    $(document).on("click", ".yes", function () {
        let id = $(this).attr('id')
        alert(id)
        $.ajax({
            url: './config/att.php',
            method: 'POST',
            data: { action: 'yes', id },
            success: function (data) {
                select()
            }
        })
    })
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