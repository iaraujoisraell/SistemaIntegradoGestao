    <?php

    for($i=0; $i<10000000; $i++) { 
    if ($i%10000 == 0) echo ((int) $i/100000)."-"; 
    flush(); 
    } 

    
    function ajaxobj() {  
    try {  
    _ajaxobj = new ActiveXObject("Msxml2.XMLHTTP");  
    } catch (e) {  
    try {  
    _ajaxobj = new ActiveXObject("Microsoft.XMLHTTP");  
    } catch (E) {  
    _ajaxobj = false;  
    }  
    }  

    if (!_ajaxobj && typeof XMLHttpRequest!="undefined") {  
    _ajaxobj = new XMLHttpRequest();  
    }  

    return _ajaxobj;  
    } 
    function prueba () {  
    ajax = ajaxobj();  
    ajax.open("GET", "res.php", true);  
    ajax.onreadystatechange=function() { 
    if (ajax.readyState == 3) {  

    // Mostramos o percentual 
    var res = ajax.responseText; 
    res = res.split("-");  
    alert(res[res.length-2]);  
    } else if (ajax.readyState == 4) {  

    // Fim
    alert("FIM");  
    }  
    }  

    // Enviamos algo para que o processo funcione
    ajax.send(null);  
    }  

    ?>