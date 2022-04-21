<?php include 'Recipe.php';?>
<!DOCTYPE html>
<html>
 
<head>
<title>Secrets of Malaysian</title>
    <style><?php include 'Recipe.css'; ?></style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
 <div class="header">
    <div id="home">
        <div class="navbackground">
        <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="../FYP-Images/ChilliAss.png" width="124" length="164">
            </div>
            <div class="text">
                 <h1>Secrets of Malaysian</h1>
            </div>
            <div class="hamburger-menu">
                <input id="menu__toggle" type="checkbox" />
                <label class="menu__btn" for="menu__toggle">
                    <span></span>
                </label>
                <ul class="menu__box">
                    <li><a class="menu__item" href="../FYP-MainMenu.html">Home</a></li>
                    <li><a class="menu__item" href="../FYP-MainMenu.html">Recipe</a></li>
                    <li><a class="menu__item" href="../FYP-MainMenu.html">Categories</a></li>
                    <li><a class="menu__item" href="../Login-Page.html">Account</a></li>
                </ul>
            </div>
        </div>
        </div>
        </div>

<?php $image = "../uploads/".$array['filename'] ?>

<div class = "recipe">
 <div class = "recipe_name"> 
  <h1 id = "name" > <?php echo $array['recipe_name'] ?></h1> by <?php echo $array['username'] ?> 

 </div> 

 <div class = "recipe_name"> 
  <label> <img src="<?php echo $image; ?>"> <label>
  
 </div>
 <br>

 <div class = "recipe_name">
 <?php checkFavourite($array['recipe_id'], $user_id, $conn); ?>
</div>

 <div class = "recipe_name"> 
 <br>
  <label> <b><u>Category</u></b> <br> 
    <?php 
        foreach($array['category_name'] as $key => $value) {
            if ($key === array_key_last($array['category_name'])) {
                echo $value;
            } else {
                echo $value . ", ";
            }
        }
    ?> 
  <label>
 </div>
 <br>

 <div class = "recipe_name"> 
  <label> <b><u>Ingredients</u></b> <br> 
  <?php echo nl2br($array['ingredient_name']) ?> <label>
 </div>
 <br>

 <div class = "recipe_name"> 
  <label> <b><u>Steps</u></b> <br> 
  <?php echo nl2br($array['steps']) ?> <label>
 </div>

</div>


<script type="text/javascript"> 
/*
    [1] $(handler); is the recommended way to write $(document).ready(handler);
    [2] preferable to use 'let' instead of 'var' for variable declaration (for block level scoping)
*/
$(function() { // see [1]
    $( '.button' ).on( 'click' , function(/*e*/) {
        // e.preventDefault(); // not sure if this is required, .button is represented by a div which do not have a Default behaviour
        let recipe_id = $(this).attr('recipe_id'); // see [2]
        let user_id = $(this).attr('user_id');
        let method = $(this).attr('method');
        
        if (method == "Like") {
            $(this).attr( "method" , "Unlike" );
            $( "#" + user_id ).replaceWith(
                "<img id=" + user_id.toString() + " src='favon.png'>"
            );
            $( "#favText" ).replaceWith( "<span id='favText'> Favourited! </span>" );
            
        } else {
            $(this).attr( "method" , "Like" );
            $("#" + user_id).replaceWith(
                "<img id=" + user_id.toString() + " src='favoff.png'>"
            );
            $( "#favText" ).replaceWith( "<span id='favText'> Click to add to Favourites! </span>" );
        }

        $.ajax({
            url: "Favourites.php",
            type: "GET",
            data: {
                recipe_id: recipe_id,
                user_id: user_id,
                method: method
            },
            cache: false,
            success: function(data) {}

            
        });
    });
});
</script>

</body>
</html>