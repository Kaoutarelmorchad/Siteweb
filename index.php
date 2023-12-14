<?php
include 'connection.php';
include 'header.php';
?>
<html>
<script src="https://kit.fontawesome.com/c3f1d5478b.js" crossorigin="anonymous"></script>
<body>
    <!-- SIdeNav Mobile -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
      
    </div>
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

    

    <!-- Slideshow container -->
    <div class="slideshow-container">

        <!-- Full-width images with number -->
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <a href="#"><img src="https://images.kikocosmetics.com/mediaObject/2023/launches/3Dhydra-limited/Launch_3DHydraLipgloss-LimitedEdition_Landing_Header-Desktop/webp-resolutions/res-1920x600/Launch_3DHydraLipgloss-LimitedEdition_Landing_Header-Desktop.webp"></a>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <a href="#"><img src="https://kyliecosmetics.com/cdn/shop/collections/PLP-Imagery_Cosmetics_Lips_Desktop_MCP_opt-2.jpg?crop=center&height=1616&v=1675696887&width=2880"></a>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <a href="#"> <img src="https://facesbeauty.ma//media/catalog/category/Faces_Morocco_French_RDFL_1920x640.jpg"></a>
        </div>

    </div>
    <br>

    <!-- The dots/circles -->
    <div class="dotclass" style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <!--Script for SlideShow-->
    <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 4000); // Change image every 4 seconds
        }
    </script>


    <!--Product Slideshow-->

    <h2 id="pproductscont" style="text-align:center;">Story behind</h2>
    
        <div class="productmySlides">
            <div class="products">

            <?php
                  $sql = "SELECT  pro_img FROM products WHERE marque='home4'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {

                  while($row = $result->fetch_assoc()) {
                    echo "<table style='border: none;'>";
                  echo "<tr><td><div class='picontainer'><img style='width:400px'src='".$row["pro_img"]."' alt='Red Kurta' class='pimage'></div></td>" ;  
                  echo "<td><div style='font-size=60px'>'For us, lipstick is much more than a mere makeup product. It's a symbol of confidence, a radiance that comes from within and brightens every smile. We believe that every woman deserves to feel confident, strong, and beautiful every day. Each of our shades has been carefully selected to represent a unique facet of the feminine personality. From bold reds to delicate pinks, every hue tells a different story and adapts to all occasions.'</div></td>";       
                  echo "</div>";
                  echo "</div>";
                  echo "</table>";
                  }
                  }  
            ?>            

        </div>
        </div>

       

    </div>
    
    <?php
                  $cust_id = 0;
                  if(!empty($_SESSION["loggedin"])){
                    $cust_id = $_SESSION["id"];
                  }
                  if (isset($_POST['pro_id']) && $_POST['pro_id']!="" && $cust_id!=0){
                  $code = $_POST["pro_id"];
                  $in = true;
                  
                  $q = "SELECT pro_id, ordered FROM cart WHERE pro_id = $code";
                  $r = $conn->query($q);
                  if ($r->num_rows > 0) {
                       while($ro = $r->fetch_assoc()) {
                                  if($ro["pro_id"] == $code && $ro["ordered"] == 0)
                                  {
                                     $in = false;
                                     
                                     $que = "UPDATE cart SET quantity = quantity + 1 WHERE   pro_id = $code";
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
                else
                {
                        if($cust_id==0 && isset($_POST['p_id']))
                        {
                        
                        echo '<div id="NotiWindow" class="Notimodal">
                          <div class="Notimodal-content">
                            <span class="Noticlose">&times;</span>
                            <p>Not Logged In!</p>
                          </div>
                        </div>';
                        
                        }
                }
    ?>
    
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

  

    <!--Script for Products SLideshow-->

    <script>
        var pslideIndex = 1;
        pshowSlides(pslideIndex);

        function pplusSlides(n) {
            pshowSlides(pslideIndex += n);
        }

        function pcurrentSlide(n) {
            pshowSlides(pslideIndex = n);
        }

        function pshowSlides(n) {
            var i;
            var slides = document.getElementsByClassName("productmySlides ");
            var dots = document.getElementsByClassName("dot ");
            if (n > slides.length) {
                pslideIndex = 1
            }
            if (n < 1) {
                pslideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none ";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active ", " ");
            }
            slides[pslideIndex - 1].style.display = "block ";
            dots[pslideIndex - 1].className += " active ";
        }
    </script>



<?php require_once "footer.php"; ?>

</body>

</html>