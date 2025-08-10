<?php
session_start();
if (!isset($_SESSION["tusername"])) {
    header("Location: turf login page/userlogin.html"); // Redirect to login if session is destroyed
    exit();
}
?>

<!-- Jai shree ram -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toku Turf</title>
    <link rel="stylesheet" href="toku.css ">
 </head>
 <body>
   <div id="home-main">
      <div id="home-1">

         <div id="home-property">
            <div id="home">
               <div class="home-line1"></div>
               <div class="home-line2"></div>
               <div class="home-line3"></div>
            </div>
         </div>



         <ul id="nave">
            <a href="toku.html" id="nav-a"><li id="nav1">Home</li></a>
            <li id="nav2">Services</li>
            <li id="nav3">Contact</li>
            <li id="nav4">About Us</li>
         </ul>
 
           <!-- logo properties -->

         <img src="photos/logo2.jpg" alt="" id="logo" ><h3 id="logo-text1">TOKU:</h3>
         <h3 id="logo-text2"> Where Champions Are Made ></h3>
         <h3 id="logo-text3">Enjoy Our UI</h3>
  
           <!-- navegation list column1 -->
         <ul id="navigation-list">
            <a href="#section2"id="nave-list1"><li id="nave-list1">Register Your Turf</li></a>
            <a href="#section3"id="nave-list2"><li id="nave-list2">Reviews & Ratings</li></a>
         </ul>
  
            <!-- navegation list column2 -->
  
         <ul id="navigation-list">
            <a href="#section2"id="nave-list3"><li id="nave-list3">Cancle Booking</li></a>
            <a href="#section3"id="nave-list4"><li id="nave-list4">Rewards</li></a>
         </ul>
  
            <!-- navegation list column3 -->
  
         <ul id="navigation-list">
            <a href="#section2"id="nave-list5"><li id="nave-list5">Offered Turf List</li></a>
            <a href="#section3"id="nave-list6"><li id="nave-list6">History</li></a>
         </ul>
           
           <!-- profile  in top of the page -->
         <div id="profile">
            <img src="photos/profile.png.jpeg" alt="profile" width="50px" height="50px" id="profile-img">
         </div>
  
  
           <!-- profile informations -->
  
         <div id="profile-info">
            <table border="2" id="p-i-table">
               <h3 id="p-i-h3">Personal Informations</h3><br><br>
               <tr><td><strong>Name:</strong></td> &nbsp;&nbsp;<td id="tt1" style="text-transform: uppercase;"><?php echo $_SESSION["tusername"]; ?></td></tr>
        <tr><td><strong>Location:</strong></td>&nbsp;&nbsp; <td id="tt2"style="text-transform: uppercase;"><?php echo $_SESSION["tuserlocation"]; ?></td></tr>
        <tr><td><strong>Contact:</strong></td> &nbsp;&nbsp;<td id="tt3"style="text-transform: uppercase;"><?php echo $_SESSION["tusernumber"]; ?></td></tr>
        <tr><td><strong>Email:</strong></td> &nbsp;&nbsp;<td id="tt4"style="text-transform: uppercase;"><?php echo $_SESSION["tuseremail"]; ?></td></tr>
        <tr><td><strong>Age:</strong></td>&nbsp;&nbsp; <td id="tt5"style="text-transform: uppercase;"><?php echo $_SESSION["age"]; ?></td></tr>
            </table>
            
            <button id="pinfo-btn" onclick="window.location.href='turf login page/logout.php'">Logout</button>





         </div>
      </div>
        <!-- About our Services and info -->
         <div id="total-info">
            <div id="our-services">
               <h5>Hi Players You are here to choose your playing Turf for reduce your stress,<br>We provide our best services to you</h5>
               <h5>Welcome To Turf Toku</h5>
            </div>
            <div id='our-contact'>
               <h5>Mobile-Number : 9894886706,9894886706 </h5><br>
               <h5>Email : mukeskannan804@gmail.com</h5>
            </div>
            <div id='our-aboutus'>
              <h5> We are the team we build the websites and mobile applications </h5><br>
              <h5>Address:6th north street pattinamkathan Ramanathapuram</h5>
            </div>
         </div>
      
   </div>
  
        <!--Main Turf section user to visit all turf in the list -->
        <div id="intros">Welcome To Turf Toku-></div>
       <div id="intro">
         <span id="intro-sp1">Your One-stop </span><span id="intro-sp2">Destination for </span><span id="intro-sp3">Turf Bookings!</span>
      </div>
     
        <div id="turf-visit">
         <img src="photos/t-collection-logo.jpg" alt="" id="t-collection-logo"><img src="photos/t-c-banner.jpg" id="t-c-bannar">
         <div id="t-collection-text"><span>Find Your Perfect Pitch:</span> <span>Explore Available Turfs Near You</span><span>Book Now and Get Ready to Play!</span></div>
           <a href="turf-gallery.html">
           <div id="arrow-mark">
           <div id="arrow-mark2">Click Here To Visit And Book Your Turf Now</div>
           <img src="photos/t-collection-ftball.jpg" id="t-collection-ftball" alt=""></a>
           <div id="t-c-p">Click👆Here</div>
        </div>
          
        </div>
  
        <!-- Main Turf section column2 -->
        <section id="section2">
         <br><br><br>
         
        <div id="col2">
           
         <!-- Turf owner section in column2 -->
  
          
            <div id="turf-owner">
               <img src="photos/reegester image.jpg" alt="" id="sub-box-img">
               <div id="sub-box-p"><span id="sub-box-p-s1">Dear Turf Owner's Register </span><span>Your Turf Here!</span><p id="sub-box-click">Click</p> </div>
               <div id="turf-owner-background"></div>
               <a href="turf-owners.html" id="turf-owner-a">
                  <img src="photos/t-o-a-m.jpg" alt=""id="sub-box-img-a-m">
               </a>
            </div>
            
          
  
        <!-- Turf canceling section in column2 -->
          <div id="cancel-booking">
            <img src="photos/cancle booking logo.jpg" alt="" id="sub-box-img">
               <div id="sub-box-p"><span id="sub-box-p-s1"> Check Your Booking Status </span><span> Cancle Booking</span><p id="sub-box-click">Click</p> </div>
            <div id="cancel-booking-background"></div>
            <a href="turf-cancle.html" id="turf-owner-a">
               <img src="photos/t-o-a-m.jpg" alt=""id="sub-box-img-a-m">
            </a>
          </div>

          <!-- To view near by offered Turf in column2 -->
          <div id="offered-turf">
            <img src="photos/offer logo.jpg" alt="" id="sub-box-img">
               <div id="sub-box-p"><span id="sub-box-p-s1">Explore The Turf's Who  </span><span>Provide Offeres!</span><p id="sub-box-click">Click</p> </div>
            <div id="offered-turf-background"></div>
            <a href="turf-offer.html" id="turf-owner-a">
               <img src="photos/t-o-a-m.jpg" alt=""id="sub-box-img-a-m">
            </a>
          </div>
        </div>
     </section>
  
  
     <section id="section3">
      <br><br><br>
        <div id="col3">
            
        
           <!-- To provide review and rating to the played turf in column3 -->
           <div id="review-rating">
            <img src="photos/rrlogo.jpg" alt="" id="sub-box-img">
               <div id="sub-box-p"><span id="sub-box-p-s1">Share your experience!  Leave</span><span> your review of the turf</span><p id="sub-box-click">Click</p> </div>
            <div id="review-rating-background"></div>
            <a href="turf-offer.html" id="turf-owner-a">
               <img src="photos/t-o-a-m.jpg" alt=""id="sub-box-img-a-m">
            </a>
           </div>

           <!-- To view rewards want user gained in column3 -->
           <div id="rewards">
            <img src="photos/reward points.jpg" alt="" id="sub-box-img">
               <div id="sub-box-p"><span id="sub-box-p-s1">Gain your reward points! </span><span>for every booking</span><p id="sub-box-click">Click</p> </div>
            <div id="rewards-background"></div>
            <a href="turf-rewards.html" id="turf-owner-a">
               <img src="photos/t-o-a-m.jpg" alt=""id="sub-box-img-a-m">
            </a>
           </div>

           <!-- To view user history in our website in column3 -->
           <div id="history">
            <img src="photos/history logo.jpg" alt="" id="sub-box-img">
               <div id="sub-box-p"><span id="sub-box-p-s1">View History of Your </span><span> Bookings!</span><p id="sub-box-click">Click</p> </div>
           <div id="history-background"></div>
           <a href="turf-history.html" id="turf-owner-a">
            <img src="photos/t-o-a-m.jpg" alt=""id="sub-box-img-a-m">
         </a>
           </div>
        </div>
     </section>
     <br><br><br>

     <!-- Social media images and links -->
     <div id="social-media">
      <a href="https://www.instagram.com/albus_empire_07?igsh=MTd2aXBoNXZwMmRycA=="><img src="photos/Instagram_logo_2022.svg-removebg-preview.png" alt="" width="30px" height="30px" ></a><a href="https://www.instagram.com/albus_empire_07?igsh=MTd2aXBoNXZwMmRycA==">Instagram || </a>

      <a href="https://youtube.com/@vjsiddhuvlog?si=g2dtcqlkle6Esjim"><img src="photos/YouTube_full-color_icon__2017_.svg-removebg-preview.png" alt="" width="38.5px" height="30px" ></a><a href="https://youtube.com/@vjsiddhuvlog?si=g2dtcqlkle6Esjim">youtube ||</a>

      <a href="admin.html"><img src="photos/adminpage.jpg" alt="" width="40px" height="40px"  id="adminimg"></a><a href="admin.html"><p title="Only For Admins">ADMIN</p></a>
   </div>
   
     <script src="toku.js"></script>
 </body>
 </html>