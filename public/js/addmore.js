$(document).ready(function() {
    let i = 1
    $('#addmore').click(function() {
        i++
        jQuery('#form').append(`<div class="form-group" id="row${i}">
                <label for="name">Name</label>
                <input type="text" name="name[${i}]" class="form-control" placeholder="Entre the name">
                <button type="button" class="btn btn-sm btn-danger btn_remove" id="${i}">Remove</button>
            </div>`);
    })
    $(document).on('click', '.btn_remove', function() {
        let btn_id = $(this).attr('id')
        $(`#row${btn_id}`).remove()
    })
    $(document).on('click', '#submit', function() {
        $.ajax({
            url: './config/add.php',
            method: 'POST',
            data: $('#myForm').serialize(),
            success: function(data) {
                alert(data)
                $('#myForm')[0].reset()
            }
        })
    })
})