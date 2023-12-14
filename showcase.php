<?php
    session_start();
    include 'connection.php';
    include 'header.php';
    $cat_id = 0;
   
    $prices = 0;
    $pricee = 0;
    if(!empty($_GET['cat']))
    {
      $cat_id = intval($_GET['cat']);
    }
   
    if(!empty($_GET['pricee']))
    {
      $prices = intval($_GET['prices']);
      $pricee = intval($_GET['pricee']);
    }
 
?>

<html>

<body>
   


  
    <!--Script for Login Box-->

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



            <!-- sCRIPT FOR COLLAPSABLE LIST-->
            <script>
                var coll = document.getElementsByClassName("collapsible");
                var i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function() {
                        this.classList.toggle("cactive");
                        var content = this.nextElementSibling;
                        if (content.style.maxHeight) {
                            content.style.maxHeight = null;
                        } else {
                            content.style.maxHeight = content.scrollHeight + "px";
                        }
                    });
                }
            </script>
        </div>
        <div style="margin-left: 4%; width: 62.67%" class="column02">

            <?php
                   $cat_name = "";
                   $sql = "SELECT cat_name FROM categories WHERE cat_id = $cat_id";
                   $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
  // output data of each row
                  while($row = $result->fetch_assoc()) {
                          $cat_name = $row["cat_name"];
                  }
                }
            ?>

            <h2 style="text-align:center;"><?php
             if($cat_id != 0)
              {
                echo $cat_name;
              }
             
              else if($pricee != 0)
              {
                echo 'pro_price Between '.$prices.' And '.$pricee;
              }
              else
              {
                echo "All";
              }
             ?></h2>
            <div class="btn-group category-box" style="width:100%">
            <?php
                  if($cat_id != 0)
                  {
                    $sql = "SELECT pro_id, pro_name, pro_price, pro_img FROM products WHERE cat_id = $cat_id";
                  }
                  
                  else if($pricee != 0)
                  {
                    $sql = "SELECT pro_id, pro_name, pro_price, pro_img FROM products WHERE pro_price BETWEEN $prices AND $pricee";
                  }
                  else
                  {
                    $sql = "SELECT pro_id, pro_name, pro_price, pro_img FROM products";
                  }
                  
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo  '<form class="card" method="post" action="">
                       <input type="hidden" name="p_id" value="' .$row["pro_id"]. '" />                       
                    <a href="product.php?' . $row["pro_id"] . '">
                        <img src="'.$row["pro_img"].'" alt="Denim Jeans">
                        <h3>' . $row["pro_name"] . '</h3>
                        <p class="price">PKR ' . $row["pro_price"] .'</p>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </a>
                    <p><button type="submit" class="add-to-cart">Add to Cart</button></p>
                    </form>';
                    }    
                  }
                  if (isset($_POST['pro_id']) && $_POST['pro_id']!=""){
                  $code = $_POST["pro_id"];
                  $cust_id = $_SESSION["cus_id"];
                  $in = true;
                  $q = "SELECT pro_id FROM cart WHERE cus_id = $cust_id";
                  $r = $conn->query($q);
                  if ($r->num_rows > 0) {
                       while($ro = $r->fetch_assoc()) {
                                  if($ro["pro_id"] == $code)
                                  {
                                     $in = false;        
                                     $que = "UPDATE cart SET pro_quantity = pro_quantity + 1 WHERE cus_id = $cust_id AND pro_id = $code";
			             if($res = mysqli_query($conn, $que)) {
				          echo '<div id="NotiWindow" class="Notimodal">
                          <div class="Notimodal-content">
                            <span class="Noticlose">&times;</span>
                            <p>Already Added! Quantity Updated.</p>
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
                  }
                  }
                  if($in)
                  {
                  $query = "INSERT INTO cart (cus_id, pro_id) VALUES ($cust_id, $code)";
		            	if($result = mysqli_query($conn, $query)) {
			                  	echo '<div id="NotiWindow" class="Notimodal">
                          <div class="Notimodal-content">
                            <span class="Noticlose">&times;</span>
                            <p>Added to Cart!</p>
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
  }
?>     
</div>
            

            <!-- Script for Add to Cart Button -->

            <script>
                i = 0;
                addToCartButton = document.querySelectorAll(".add-to-cart");

                document.querySelectorAll('.add-to-cart').forEach(function(addToCartButton) {
                    addToCartButton.addEventListener('click', function() {

                        if (addToCartButton.innerHTML == "Added!") {
                            addToCartButton.innerHTML = "Add to Cart";
                            document.getElementById("cart-quantity").innerHTML = i -= 1;
                        } else {
                            addToCartButton.innerHTML = "Added!";
                            document.getElementById("cart-quantity").innerHTML = i += 1;
                        }
                    });
                });
            </script>

        </div>
    </div>
    
        <!-- Script for NotiWindow-->
<script>
// Get the modal
var modal = document.getElementById("NotiWindow");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("Noticlose")[0];

// When the user clicks the button, open the modal 
function displayNoti() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<?php require_once "footer.php"; ?>

</body>

</html>