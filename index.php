<?php
   include 'conn.inc.php';
   session_start();
   $_SESSION['id'] = 0;
   $connessione = new mysqli("localhost", "root", "", "post");
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
      <table border="2" align="center">
        <tr>
          <td>
            <p>
              INSERISCI UN COMMENTO !
            </p>
            <div align="left">
               <form action="" method="POST">
                  Nome : <input type="text" name="nome">
                  <br>
                  <br>
                  <select name="argomento">
                    <?php
                      $query = $connessione->query("SELECT * FROM generi ORDER BY generi.Descrizione");
                      while($row = $query->fetch_row()) {
                        echo "<option value='".$row[1]."'>".$row[1]."</option>";
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
            </div>
          </td>
          <td>
            <p>
              GUARDA I COMMENTI !
            </p>
            <table>
              <td>
                  <?php
                    $query = $connessione->query("SELECT commenti.Nome FROM commenti ORDER BY commenti.Nome");
                    while($row = $query->fetch_row()) {
                      echo "<tr>
                              ".$row[0]."<br><br>
                           </tr>";
                    }
                  ?>
              </td>
            </table>
          </td>
         </tr>
       </table>
      
      <?php
         if(isset($_POST['nome'])) {
            try {
              $nome = $_POST['nome'];
              $argomento = $_POST['argomento'];
              $commento = $_POST['commento'];
              $query = $connessione->query("SELECT * FROM generi ORDER BY generi.Descrizione");
              $row = $query->fetch_row();
              $sql = "INSERT INTO commenti(idUtente, Nome, Genere, Commento, idGenere) VALUES('".$_SESSION['id']."', '".$nome."','".$argomento."','".$commento."','".$row[0]."')";
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


