<?php
//require 'conn.php';
$link     = mysqli_connect("localhost", "lejamby", "", "mastercard_budget");

  
   session_start();
   $lifetime = 86400;
   session_set_cookie_params($lifetime, $httponly = true);
   $username = $_POST["username"];
   $password = $_POST["password"];
   //ob_start();

  if (isset($_SESSION['username'])) {
                     $username = $_SESSION['username'];
                  $result =  mysqli_query($link, "SELECT * FROM Users WHERE username = '$username';");
                  $jsonResponse = json_encode($result);

                  } 
            else {
                      $result    = mysqli_query($link, "SELECT * FROM User WHERE username = '$username';");
                      $rows      = mysqli_num_rows($result);
                      $rowresult = mysqli_fetch_assoc($result);
                      if ($rows == 1) {
                          $pwdSQL = mysqli_query($link, "SELECT password FROM User WHERE username='$username';");
                          $pwd    = mysqli_fetch_assoc($pwdSQL);
                      
                          if (password_verify($password, $pwd["password"])) {
                              
                              $_SESSION['username'] = $username;
                            


                          } else {
                              header("location:index.html?invalidcred");
                             //echo "wrong hash";
                              exit();
                          }
                      } else {
                          header("location:index.html?invalidcred");
                          //echo "wrong usernameee";
                          exit();
                      }
                  }

$username = $_SESSION['username'];

$user_attributes_query = mysqli_query($link, "SELECT * FROM User WHERE username = '$username' ");
$user_info = mysqli_fetch_assoc($user_attributes_query);


$user_id_result = mysqli_query($link, "SELECT user_id FROM User WHERE username = '$username' ");

$user_id_array=mysqli_fetch_assoc($user_id_result);

$user_id = $user_id_array["user_id"];

$budget_id_result = mysqli_query($link, "SELECT budget_id FROM Profile WHERE user_id = '$user_id' ");

$budget_id_array = mysqli_fetch_assoc($budget_id_result);

$budget_id = $budget_id_array["budget_id"];

$budget_stuff_array = mysqli_query($link, "SELECT * FROM Budget WHERE budget_id = '$budget_id' ");                    
$budget_stuff= mysqli_fetch_assoc($budget_stuff_array);

?>


<!DOCTYPE html>
<html>

<head>
    <title>DashBoard</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.4/jquery.fullPage.min.css" media="screen,projection" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.6.9/vendors/jquery.easings.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.6.9/vendors/jquery.slimscroll.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/style.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="Javascript/dashboard.js"></script>
    <script src="Javascript/current_location.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.2.0/mustache.js"></script>
    <script src="Javascript/mustacheLoad.js"></script>
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
              <script src="Javascript/apicall.js"></script>
</head>

<body onload = "loadUser();">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.4/jquery.fullPage.min.js"></script>
    <div class="row">
        <nav>
            <div class="nav-wrapper gg">
                <a href="#" class="brand-logo white-text gg">Budget Pig Dashboard</a>
                
            </div>
            <ul id="slide-out" class="side-nav fixed light-blue darken-4 white-text">
                <div class="logo">
                    <h3 class="center">Dashboard</h3>
                </div>
                <li><a class="menuItem white-text dashboard-link">Your Suggestions</a></li>
                <li><a class="menuItem white-text preferences-link">Preferences</a></li>
                <li><a class="menuItem white-text" href="logout.php">SignOut</a></li>

            </ul>
        </nav>
    </div>


    <div class="content row gg">
        <!--dashboard-->
        <div class="dashboard-content">
            <div class="col s12 m12 l12">
                <h2 class = "center-align">Your Information</h2>
                <div class = "col s12 m12 l12 ">
                    <div class = "col s12 m12 l4 info">
                        <h3 class = "center-align">Information</h3>
                         <p class = "flow-text">Hello, <?php echo $user_info['fname'] . " ". $user_info['lname']; ?></p>
                         <p class = "flow-text" id="latlong">Longitude and Latitude: </p>
                         <p class = "flow-text" id = "zipcodearea"></p>
                         
                         <p class = "flow-text" id = "msg"></p>
                         
                    </div>
                      <div class = "col s12 m12 l4 info">
                        <h3 class = "center-align">Budget</h3>
                        <h3 class = "center-align">$<?php echo $budget_stuff['total'] ?></h3>
                          <h3 class = "center-align">Food Limit per Meal: <?php echo "$".sprintf('%0.2f', floatval($budget_stuff['Food'] / 42.0)) ?></h3>
                    </div>
                      <div class = "col s12 m12 l4 info">
                        <h3 class = "center-align">Allocation</h3>
                         <br/>
                  <div id = "distlegend" class = "center-align"> 
                     <span style = "background:#558b2f;display:inline-block;padding:.3em;" class = "white-text">Food</span>
                     <span style = "background:#f53217;display:inline-block;padding:.3em;" class = "white-text">Utility</span>
                      <span style = "background:#303f9f;display:inline-block;padding:.3em;" class = "white-text">Rent</span>
                     <span style = "background:#f57f17;display:inline-block;padding:.3em;" class = "white-text">Transport</span>
                    
                      <span style = "background:#f57f17;display:inline-block;padding:.3em;" class = "white-text">Other</span>
                  </div>
                  <br/>
                        <canvas id = "dist">
                                     <script>
                            var distData = [{
                                value: <?php echo $budget_stuff['Food'] ?>,
                                label: '',
                                color: '#558b2f'
                            }, {
                                value: <?php echo $budget_stuff['Other'] ?>,
                                label: '',
                                color: '#f57f17'
                            }, 
                            {
                                value: <?php echo $budget_stuff['Transport'] ?>,
                                label: '',
                                color: '#f57f17'
                            }, 
                            {
                                value: <?php echo $budget_stuff['Utility'] ?>,
                                label: '',
                                color: '#f53217'
                            }, {
                                value: <?php echo $budget_stuff['Rent'] ?>,
                                label: '',
                                color: '#303f9f'
                            }];
                                var context = document.getElementById('dist').getContext('2d');
    empChart = new Chart(context).Doughnut(distData);
                        </script>
                  </canvas>

                    </div>
             
                </div>
            </div>
            <script>
     
    /*var socket = new WebSocket('wss://10.200.213.144:8080');
  
    socket.send('Hi Raymond');
    socket.close();*/
         
            </script>
            
        </div>
        <!--end dashboard-->
        <div id = "cardz" class  = "cardz">
            
        </div>
        <!--edit prferences-->
        <div class="preferences-content">
            <div class="col s12 m12 l12" id="change">
                <h1>Edit your Preferences</h1>
                <div class="changeform">
    
                    <div class="row">
                        <form class="col s12" action="budget.php" method="POST">
                            <div class="row">
    
                                <div class="input-field col s12 m12 l6 offset-l3">
                                    <input id="paycheck" name="budget" placeholder = "$<?php echo $budget_stuff['total'] ?>" type="text" class="validate">
                                    <label for="budget">Your Paycheck(every 2 weeks)</label>
                                </div>
                                <div class="input-field col s12 m12 l6 offset-l3">
                                    <input id="food" name="food" placeholder="<?php echo $budget_stuff['Food'] ?>" type="text" class="validate">
                                    <label for="food">Food</label>
                                </div>
                                <div class="input-field col s12 m12 l6 offset-l3">
                                    <input id="leisure" name="leisure" placeholder="<?php echo $budget_stuff['Other'] ?>" type="text" class="validate">
                                    <label for="leisure">Leisure</label>
                                </div>
                                <div class="input-field col s12 m12 l6 offset-l3">
                                    <input id="transportation" name="transportation" placeholder="<?php echo $budget_stuff['Transport'] ?>" type="text" class="validate">
                                    <label for="transportation">Transportation</label>
                                </div>
                                <div class="input-field col s12 m12 l6 offset-l3">
                                    <input id="utilities" name="utilities" placeholder="<?php echo $budget_stuff['Utility'] ?>" type="text" class="validate">
                                    <label for="utilities">Utitlies</label>
                                </div>
                                <div class="input-field col s12 m12 l6 offset-l3">
                                    <input id="rent" name="rent" placeholder="<?php echo $budget_stuff['Rent'] ?>" type="text" class="validate">
                                    <label for="rent">Rent</label>
                                </div>
                            </div>
                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
                        </form>
                    </div>
    
                </div>
            </div>
        </div>
        <!--finish edit preferences-->

        <script id="template" type="x-tmpl-mustache">
          <!--cards-->
                {{#Business}}
                
        <div id="card">
                
           
                <div class="col s12 m4 food-card">
                  <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                      <span class="card-title">{{ Name }}</span>
                      <p>Address: {{ Address }}</p>
                      <p>{{ City }}, {{ State}} {{ Zipcode }}</p>
                      <p>Phone: {{ Phone }}</p>
                      <p>Price: {{ Price }}</p>
                      <p>Website: {{ Website }}</p>
                    </div>
                    <div class="card-action">
                      <a href="#" onclick = "confirmPrice('{{Price}}','<?php echo sprintf("%0.2f", floatval($budget_stuff["Food"] / 42.0)) ?>')">Order Here</a>
                     
                    </div>
                  </div>
                </div>
              
        </div>
              
              {{/Business}}
       
             <!--end cards-->
        </script>
      
        


    </div>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=&signed_in=true&callback=yay"-->
<!--        async defer></script>-->

</body>

</html>