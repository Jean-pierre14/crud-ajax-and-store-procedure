$(document).ready(function() {
    selectUser()
    $('#action').click(function() {
        let username = $('#username').val();
        let fullname = $('#fullname').val();

        if (username != '' && fullname != '') {
            let action = "insert";
            $.ajax({
                url: './config/config.php',
                method: 'POST',
                data: {
                    action,
                    username,
                    fullname
                },
                success: function(data) {
                    selectUser()
                }
            })
            alert(username + ' ' + fullname)
        } else {
            alert("Some fields are empty")
        }
    })
    $(document).on('click', '.update', function() {
        let id = $(this).attr('id')
        let action = 'getUser'

        $.ajax({
            url: './config/config.php',
            method: 'POST',
            data: {
                action,
                id
            },
            dataType: 'json',
            success: function(data) {
                $('#id_user').val(id)
                $('#username').val(data.username)
                $('#fullname').val(data.fullname)
                $('#action').text('Update ' + data.username)
            }
        })
    })
})

function selectUser() {
    let action = "select"
    $.ajax({
        url: './config/config.php',
        method: 'POST',
        data: {
            action
        },
        success: function(data) {
            $('#result').html(data)
        }
    })
}