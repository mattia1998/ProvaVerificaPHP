<?php
   include 'conn.inc.php';
   session_start();
   $_SESSION['id'] = 0;
?>

<html>
   <head>
     <title>HOMEPAGE</title>
     <script type="text/javascript">
       function erroreCampi() {
         alert("RIEMPIRE TUTTI I CAMPI");
       }
     </script>
   </head>
   <body>
      <br>
      <p align="center">
         LASCIA UN COMMENTO ! 
      </p>
      <br>
      <br>
      <br>
      <left>
         <form action="" method="POST">
            Nome : <input type="text" name="nome">
            <br>
            <br>
            <select name="argomento">
              <?php
                $connessione = new mysqli("localhost","root","","post");
                $query = $connessione->query("SELECT * FROM generi");
                while($row = $query->fetch_row()) {
                  echo "<option value=".$row[0].">".$row[1]."</option>";
                }
              ?>
            </select>
            <br>
            <br>
            Commento
            <br>
            <textarea name="commento" rows="5" cols="30"></textarea>
           <br>
           <br>
           <input type="submit" name="invia" value ="INVIA">
         </form>
      </left>
      
      <?php
         if(isset($_POST['nome'])) {
            try {
              $connessione = new mysqli("localhost","root","","post");
              $nome = $_POST['nome'];
              $argomento = $_POST['argomento'];
              $commento = $_POST['commento'];
              $sql = "INSERT INTO commenti(idUtente, Nome, Genere, Commento, idGenere) VALUES('".$_SESSION['id']."', '".$nome."','".$argomento."','".$commento."','1')";
              $connessione->query($sql);
              
               if($_POST['nome'] == "" OR $_POST['commento'] == "") {
                 echo '<script type="text/javascript">erroreCampi();</script>';
               } 
               else {
                 $_SESSION['id']++;
               }
            }
            catch(PDOExcpetion $e) {
               echo 'Errore';
            }
         }
      ?>  
   </body>
</html>


