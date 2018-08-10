<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP + jQuery, Сортировка списка с сохранением при помощи jQuery Sortable</title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/1.12.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
include('db_connection.php');
?>
<div class="container">
    <div class="jumbotron">
        <h1>PHP + jQuery</h1>
        <p>Сортировка списка с помощью jQuery Sortable</p>
    </div>
    <button class="save btn btn-success">Сохранить сортировку</button>
    <br />
    <br />
    <br />
    <div class="alert alert-success" id="response" role="alert">Отсортируйте и сохраните :)</div>
    <?php
    if ($result = mysqli_query($link, 'SELECT * FROM sortable ORDER BY position')) {
        ?>
        <ul class="list-group sortable">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li class="list-group-item" id=item-' . $row['id'] .'">' . $row['name'] . '</li>';
            }
            ?>
        </ul>
        <?php
        mysqli_free_result($result);
    }
    mysqli_close($link);
    ?>
</div>
<script type="text/javascript">
    var ul_sortable = $('.sortable');
    ul_sortable.sortable({
        revert: 100,
        placeholder: 'placeholder'
    });
    ul_sortable.disableSelection();
    var btn_save = $('button.save'),
        div_response = $('#response');
    btn_save.on('click', function(e) {
        e.preventDefault();
        var sortable_data = ul_sortable.sortable('serialize');
        div_response.text('Сохраняем');
        $.ajax({
            data: sortable_data,
            type: 'POST',
            url: 'save.php',
            success:function(result) {
                div_response.text(result);
            }
        });
    });
</script>
</body>
</html>