<!-- CUSTOM LEFT BAR -->
<?php
  if(isset($left_bar)){
    $this->load->view($left_bar); 
  }else{
    echo '<script type="text/javascript">
              $(document).ready(function(){
                $("nav#main_topnav .toggle-aside").remove();
                $("section#main_content").css("margin","0");
              });
            </script>';
  } 
?>

<!--MAIN CONTENT-->
<section id="main_content">
  <div class="container-fluid">

