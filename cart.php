<?php
include 'connection.php';
include 'header.php';
?>

<html>

<body>


   
    <!-- Script for SideNav Mobile -->
    <script>
        function openNav() {

            if (document.getElementById("mySidenav").style.width == "250px") {
                document.getElementById("mySidenav").style.width = "0";
            } else {
                document.getElementById("mySidenav").style.width = "250px";
            }
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <h2 style="text-align: center;">CART</h2>


    <div style="margin: 1%; background-color: white;" class="row">
        <div class="column02">
            <hr style="width: 98%;">
            <div class="chline1">
                <p style="margin-left: 16px;">Item</p>
                <p style="float: right;">Prix</p>
                <p style="float: right;">Quantité</p>
            </div>
            <hr style="width: 98%;">

            <div id="cart_products">

            </div>

 
            
            <?php
            $t_price = 0;
            $p_price = 0;
            $cust_id = 0;
            if(!empty($_SESSION["loggedin"])){
                $cust_id = $_SESSION["id"];
            }
            if (isset($_POST['p_id']) && $_POST['p_id']!=""){
                $code = $_POST["p_id"];
                $sql = "DELETE FROM cart WHERE  pro_id = $code";
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                  } else {
                    echo "Error deleting record: " . $conn->error;
                  }
            }

            $sql = "SELECT P.pro_price AS tprice, C.quantity FROM products P JOIN cart C ON P.pro_id = C.pro_id WHERE P.pro_id = C.pro_id AND C.ordered = 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $p_price = $row["tprice"] * $row["quantity"];
                    $t_price += $p_price;
                }
            }

            if (isset($_POST["minus"])){
                $code = $_POST["mp_id"];
                $sql = "UPDATE cart SET quantity = quantity - 1 WHERE  pro_id = $code AND quantity > 1";
                if ($conn->query($sql) === TRUE) {
                        echo '<div id="NotiWindow" class="Notimodal">
                    <div class="Notimodal-content">
                      <span class="Noticlose">&times;</span>
                      <p>Quantity Decreased!</p>
                    </div>
                  </div>';
                   } else {
              echo '<div id="NotiWindow" class="Notimodal">
                    <div class="Notimodal-content">
                      <span class="Noticlose">&times;</span>
                      <p>Error: ' . $sql . '<br>' . $conn->error . '</p>
                    </div>
                  </div>';
                    }
            }

            if (isset($_POST["plus"])){
                  $code = $_POST["pp_id"];
                  $sql = "UPDATE cart SET quantity = quantity + 1 WHERE  pro_id = $code";
                  if ($conn->query($sql) === TRUE) {
                      echo '<div id="NotiWindow" class="Notimodal">
                      <div class="Notimodal-content">
                        <span class="Noticlose">&times;</span>
                        <p>Quantity Increased!</p>
                      </div>
                    </div>';
                     } else {
                echo '<div id="NotiWindow" class="Notimodal">
                      <div class="Notimodal-content">
                        <span class="Noticlose">&times;</span>
                        <p>Error: ' . $sql . '<br>' . $conn->error . '</p>
                      </div>
                    </div>';
                      }
              }
?>
        </div>
      <script type="text/javascript">
  const xhttpr = new XMLHttpRequest();
  xhttpr.onload = function() {
    document.getElementById("cart_products").innerHTML = this.responseText;
  }
  xhttpr.open("GET", "cart_db.php");
  xhttpr.send();
</script>
        <div class="vl"></div>

        <div class="column">
            <h3>Bag Summary</h3>
            <hr style="width: 96%;">
            <div class="bagp">
                <p style="padding-left: 12px;">Subtotal: </p>
                <p style="margin-right: 9%;">MAD<?php echo $t_price; ?></p>
            </div>
            <hr style="width: 96%;">
            <div class="bagp">
                <p style="padding-left: 12px;"> Total: </p>
                <p style="margin-right: 9%;">MAD <?php echo $t_price; ?></p>
            </div>
            <hr style="width: 96%;">
            <button class="ptocheck" onclick="window.location.href='checkout.php';">PROCEED TO CHECKOUT</button>
            <br>
            <br>
            <button class="ptocheck" onclick="saveInvoice()">Save</button>
            

<script>
    function saveInvoice() {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Réponse du serveur après l'enregistrement de la facture
                alert("Invoice saved!");
            }
        };
        xhttp.open("GET", "facture.php", true);
        xhttp.send();
    }
</script>

        </div>
    </div>

    <?php require_once "footer.php"; ?>

    <!-- Script for NotiWindow-->
<script>
var modal = document.getElementById("NotiWindow");
var span = document.getElementsByClassName("Noticlose")[0]; 
function displayNoti() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>

</html>