<?php
session_start();
include 'connection.php';
include 'header.php';
$cust_id = 0;
 $source_url = $_SERVER['QUERY_STRING'];
 if(!empty($_SESSION["loggedin"])){
        $cust_id = $_SESSION["id"];
 }

$name = "";
$img = "";

$price = 0;

  $sql = "SELECT pro_name, pro_img,  pro_price FROM products WHERE pro_id = $source_url";
  $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
          $name = $row["pro_name"];
          $img = $row["pro_img"];
        
          $price = $row["pro_price"];
        
    }
  }

    if (isset($_POST['AddToCartBT'])) {
   
        $query = "INSERT INTO cart (pro_id, quantity, cus_id, ordered, pro_price) VALUES ( $source_url,1,$cust_id,0,$price)";
        if($result = mysqli_query($conn, $query)) 
   {
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

 ?>


<html>

<body>
    <!-- SIdeNav Mobile -->

   
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

<script>
    // Get the modals
    var modalId01 = document.getElementById('id01');
    var modalNotiWindow = document.getElementById('NotiWindow');

    // When the user clicks anywhere outside of a modal, close it
    window.onclick = function(event) {
        if (event.target == modalId01) {
            modalId01.style.display = "none";
        }
        if (event.target == modalNotiWindow) {
            modalNotiWindow.style.display = "none";
        }
    }
</script>



    <div style="margin: 0 5%;" class="row">
        <div style="width: 50%; margin: 1% 5%;" class="column02">

            <div style="width: 80%;" class="slideshow-container">

                <div class="mySlides fade">
                    
                    <img src="<?php echo $img ?>" style="width:100%; border-radius: 2%;">
                    <!-- <div class="text">Caption Text</div> -->
                </div>

                

              

               
            </div>


            <br>



            <script>
                var slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("pdot");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                }
            </script>


        </div>

        <div class="column">
            <h2 class="prot" style="text-align:left; padding-top: 0px;"><?php echo $name ?></h2>
            <p style="font-weight: 700;" class="prot"><?php echo $price ?> MAD</p>
            
            <form method="post" action="">
           
            <button type="submit" class="AddToCart" name="AddToCartBT">Add to Cart</button>

            </form>
            <div class="ProductRatings">
                <span class="heading" style="margin-left: 12px;">User Rating</span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
            </div>
           
            <div class="row">
                <div class="side">
                    <div>5 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-5"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>150</div>
                </div>
                <div class="side">
                    <div>4 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-4"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>63</div>
                </div>
                <div class="side">
                    <div>3 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-3"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>15</div>
                </div>
                <div class="side">
                    <div>2 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-2"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>6</div>
                </div>
                <div class="side">
                    <div>1 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-1"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>20</div>
                </div>
            </div>

            

        </div>
    </div>

    ?

<?php require_once "footer.php"; ?>

</body>

</html>