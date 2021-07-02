$(document).ready(function () {
    let i = 1
    $('#addmore').click(function () {
        i++
        jQuery('#form').append(`<div class="form-group" id="row${i}">
                <label for="name">Name</label>
                <input type="text" name="name[]" class="form-control" placeholder="Entre the name">
                <button type="button" class="btn btn-sm btn-danger btn_remove" id="${i}">Remove</button>
            </div>`);
    })
    $(document).on('click', '.btn_remove', function () {
        let btn_id = $(this).attr('id')
        $(`#row${btn_id}`).remove()
    })
    $(document).on('click', '#submit', function () {
        $.ajax({
            url: './config/add.php',
            method: 'POST',
            data: $('#myForm').serialize(),
            success: function (data) {
                $('#error').html(data)
                $('#myForm')[0].reset()
                $('#form').html('')
                Resultats()
            }
        })
    })
    $('#yesDeleteAll').click(function () {

        $.ajax({
            url: './config/config.php',
            method: 'POST',
            data: { action: 'yesDeleteAll' },
            success: function (data) {
                Resultats();
                $('#error').html(data)
            }
        })
    })
    usersId()
    Resultats()
})

function Resultats() {
    let action = 'resultats'
    let limit = 10
    $.ajax({
        url: './config/config.php',
        method: 'POST',
        data: { action, limit },
        success: function (data) {
            $('#results').html(data)
        }
    })
}

function usersId() {
    let action = 'usersId'
    $.ajax({
        url: './config/config.php',
        method: 'POST',
        data: { action },
        success: function (data) {
            $('#usersId').html(data)
        }
    })
}