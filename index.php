<?php
   include 'conn.inc.php';
   session_start();
?>

<html>
   <head>
      <title>HOMEPAGE</title>
   </head>
   <body>
      <br>
      <p align="center">
         LASCIA UN COMMENTO ! 
      </p>
      <br>
      <br>
      <br>
      <center>
         <form action="/" method="POST">
            Nome : <input type="text" name="nome">
            <br>
            <br>
            <select name="argomento">
               <option value="Prova">Prova</option>
            </select>
            <br>
            <br>
            Commento
            <br>
            <textarea name="commento" rows="5" cols="30"></textarea>
         </form>
         <br>
         <input type="submit" name="invia" value ="INVIA" align="left">
      </center>
      
      <?php
         if(isset($_POST['nome'])) {
            try {
               $connessione = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
               
               if($_POST['nome']== "" OR $_POST['commento'] == "") {
                  echo 'Riempire tutti i campi !';
               } 
               else {
                  $stm = $connessione->prepare("INSERT INTO commenti(Nome, Argomento, Commento) VALUES(:nome, :argomento, :commento)");
                  $stm->bindValue(':nome', $_POST['nome']);
                  $stm->bindValue(':argomento', $_POST['argomento']);
                  $stm->bindValue(':commento', $_POST['commento']);
                  $stm->execute();
                  
                  if($stm->errorCode() == 0) {
                     echo 'Grazie per aver commentato !';
                  }
                  else {
                     echo 'Errore !';
                  }
               }
            }
            catch(PDOExcpetion $e) {
               echo 'Errore';
            }
         }
      ?>
      
      
   </body>
</html>


