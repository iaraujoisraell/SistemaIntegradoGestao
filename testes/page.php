<?php
include('db_connection.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Sortable - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  </style>
  <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    
      
    var ul_sortable = $('.sortable');
    ul_sortable.sortable({
        revert: 100,
        placeholder: 'placeholder'
    });
    ul_sortable.disableSelection();
    var btn_save = $('li.save'),
        div_response = $('#response');
    btn_save.on('mouseup', function(e) {
        e.preventDefault();
        setTimeout(function(){ 
        var sortable_data = ul_sortable.sortable('serialize');
        //div_response.text('aqui teste');
        $.ajax({
            data: sortable_data,
            type: 'POST',
            url: 'save.php',
            success:function(result) {
                div_response.text(result);
            }
        });
         }, 500);
    });
    
  });


  </script>
</head>
<body>

    
    <div class="container">
    
    <button class=" btn btn-success">Сохранить сортировку</button>
    <br />
    <br />
    <br />
    <div class="alert alert-success" id="response" role="alert"></div>
    
</div>
    
<ul id="sortable" class="list-group sortable">
    <?php
    if ($result = mysqli_query($link, 'SELECT * FROM sortable ORDER BY position')) {
        ?>
       
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            
               ?> 
    
                <li class="save ui-state-default" id=item-<?php echo $row['id']; ?>><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $row['name']; ?></li>
            
            <?php
            }
            ?>
        
        <?php
        mysqli_free_result($result);
    }
    mysqli_close($link);
    ?>
  
</ul>


</body>
</html>