<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELECT</title>
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/58594917?v=4" type="image/x-icon">
    <link rel="stylesheet" href="./public/css/style.css">
</head>

<body>
    <select name="" id="select" class="form-control">
        <option value="">-- select --</option>
        <option value="married">Married</option>
        <option value="not married">not Married</option>
    </select>
    <div class="none">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere repudiandae praesentium obcaecati architecto
            inventore distinctio atque nisi doloremque ipsam beatae asperiores, saepe sunt provident cum! Quaerat sequi
            adipisci eum fuga?
        </p>
        <form action="" id="myform">
            <input type="hidden" name="action" value="array">
            <div class="group">
                <label for="num">Number</label>
                <input type="text" autocomplete="off" name="num" id="num" placeholder="Enter the number">
            </div>
            <div id="add"></div>
            <button type="button" id="submit" class="button">
                Submit
            </button>
        </form>
    </div>
</body>
<script src="./public/js/jquery-3.4.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#select').change(function() {
        let d = $(this).val()
        if (d === 'married') {
            $(".none").show()
        } else {
            $('.none').hide()
        }
    })
    $('#num').keyup(function() {
        let u = $(this).val()
        if (u != '') {
            if (u > 5) {
                $('#add').html('<p class="msg red">The number can\'t go above 5</p>')
            } else {
                $('#add').html('')
                for (i = 1; i <= u; i++) {
                    $('#add').append(`<div class="group">
                <label for="name${i}">Name ${i}</label>
                <input type="text" name="name[${i}]" id="name${i}" placeholder="Enter the number">
            </div>`)
                }
            }
        } else {
            $('#add').html('')
        }
    })
    $('#submit').click(function() {

        $.ajax({
            url: './config/config.php',
            method: 'POST',
            data: $('#myform').serialize(),
            success: function(data) {
                if (data === 'success') {
                    $('#add').html('Success')
                } else {
                    $('#add').html('Error from bakend' + data)
                }
            }
        })
    })
})
</script>

</html>