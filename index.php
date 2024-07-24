<?php
error_reporting(E_ERROR | E_PARSE);
$host = "localhost";
$user = "root";
$password = "951753bs";
$dbname = "recipes";
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


if(isset($_POST["submit"])){
    if ( $_POST['ingredients_text'] != "" && $_POST["imageLink"] != "" && $_POST["recipe_title_header"] != ""){
        $sql = "INSERT INTO myrecipes (recipe_text, recipe_image, recipe_title) VALUES(:recipe_text, :recipe_image, :recipe_title)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['recipe_text' => htmlspecialchars($_POST["ingredients_text"]),'recipe_image'=> $_POST["imageLink"], 'recipe_title'=> $_POST["recipe_title_header"]]);
        header("Location: " . $_SERVER["REQUEST_URI"]);
    }
}

$id = $_GET['Did'];
    $sql = "DELETE FROM myrecipes WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);


    if(isset($_POST["submit_edit"])){
        if ( $_POST['ingredients_text_edit'] != "" && $_POST["imageLink_edit"] != "" && $_POST["recipe_title_header_edit"] != "" ){

            $id = $_SERVER["REQUEST_URI"];
            $character = '=';
            $id = strstr($id, $character, false);
            $id = str_replace("=",'', $id);

            $sql = "UPDATE myrecipes SET recipe_text = :recipe_text, recipe_image = :recipe_image, recipe_title = :recipe_title WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['recipe_text' => htmlspecialchars($_POST["ingredients_text_edit"]), "recipe_image" => $_POST["imageLink_edit"], 'recipe_title'=> $_POST["recipe_title_header_edit"],'id' => $id]);
            header("Location: " . $_SERVER["REQUEST_URI"]);
        }
    }
?>



<html>
    <head>
        <title>Recipe Book</title>
        <meta charset="UTF-8">
        <meta name="viewport" width="device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="/public/styles/style.css">
        <link rel="icon"type="image/x-icon"href="/public/assets/istockphoto-472344753-612x612.jpg"/>
    </head>
    <body>

        <div class="header">
            <div class="addPart">    
            <div class="image_link_part">
                    <div class="image_link_title">place the image link here</div>
                    <div class="image_link_div">
                    <form action="" method="post">
                            <input type="text" name="imageLink" placeholder="image link">
                    </div>
                    
                </div>

                <div class="recipe_title_part">
                    <div class="recipe_title_title">place the recipe title here</div>
                    <div class="recipe_title_div">
                        <input type="text" name="recipe_title_header" placeholder="image title">
                    </div>
                </div>

                <div class="ingredients_part">
                    <div class="ingredients_title"> the ingredients </div>
                    <div class="textAreaDiv"> 
                        
                            <textarea name="ingredients_text" rows="" cols="" placeholder="ingredients"></textarea>
                    </div>
                </div>
                <div class="submitDib">
                            <input type="submit" name="submit" value="add">
                        </form>
                    </div>
            </div>


        <div class="Title">Recipe <span>Book</span></div>



        <div class="editPart">    
            <div class="image_link_part">
                    <div class="image_link_title">place the image link here</div>
                    <div class="image_link_div">
                    <form action="" method="post">
                            <input type="text" name="imageLink_edit" placeholder="image link">
                    </div>
                    
                </div>

                <div class="recipe_title_part">
                    <div class="recipe_title_title">place the recipe title here</div>
                    <div class="recipe_title_div">
                        <input type="text" name="recipe_title_header_edit" placeholder="image title">
                    </div>
                </div>

                <div class="ingredients_part">
                    <div class="ingredients_title"> the ingredients </div>
                    <div class="textAreaDiv"> 
                        
                            <textarea name="ingredients_text_edit" rows="" cols="" placeholder="ingredients"></textarea>
                    </div>
                </div>
                <div class="submitDib">
                            <input type="submit" name="submit_edit" value="edit">
                        </form>
                    </div>
            </div>
        </div>

        <div class="recipes_body flex-wrap">

        <!-- <div class="recipe">
            <div class="recipe_title">recipe title</div>
            <div class="imageDiv">
                <img src="https://cdn.loveandlemons.com/wp-content/uploads/2020/03/baking-recipes-1-580x565.jpg">
            </div>
            <div class="recipeText">There’s no more joyful way to spend an afternoon than baking. I do most of the cooking in our house, but baking recipes are the ones that bring Jack and me together. He might stretch a batch of pizza dough while I prep the toppings, or we’ll work together to make a jumbo tray of cinnamon rolls to devour the next morning. If you have kids, easy baking recipes are a great way to get them into the kitchen. Let them stir together brownies and lick the spoon or decorate a batch of cookies with bright sprinkles and frosting. The process might be messy, but the results will be delicious nonetheless.There’s no more joyful way to spend an afternoon than baking. I do most of the cooking in our house, but baking recipes are the ones that bring Jack and me together. He might stretch a batch of pizza dough while I prep the toppings, or we’ll work together to make a jumbo tray of cinnamon rolls to devour the next morning. If you have kids, easy baking recipes are a great way to get them into the kitchen. Let them stir together brownies and lick the spoon or decorate a batch of cookies with bright sprinkles and frosting. The process might be messy, but the results will be delicious nonetheless.</div>
<div class="buttons">
    <div class="editButtonDiv" id="38">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" fill="#0F0F0F"></path></svg>
    </div>
    <div class="deleteButtonDiv" id="38">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" fill="none"><path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
    </div>
</div>
</div> -->

        </div>

        <script src="/src/script.js"></script>
    </body>
</html>


<?php

$stmt = $pdo->query("SELECT * FROM myrecipes");
while($row = $stmt->fetch()){

    $recipe_title = $row->recipe_title;
    $recipe_image = $row->recipe_image;
    $recipeText = $row->recipe_text;
    $id = $row->id;
?>

<script>
    var recipes_body = document.querySelector(".recipes_body");
    var recipe = document.createElement("div");
    recipe.className = "recipe";

    recipe.innerHTML = `
    <div class="recipe_title"><?php echo $recipe_title ?></div>
            <div class="imageDiv">
                <img src="<?php echo $recipe_image ?>">
            </div>
            <div class="recipeText"><?php echo $recipeText ?></div>
<div class="buttons">
    <div class="editButtonDiv" id="<?php echo $id ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" fill="#0F0F0F"></path></svg>
    </div>
    <div class="deleteButtonDiv" id="<?php echo $id ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" fill="none"><path d="M5 5L19 19M5 19L19 5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
    </div>
</div>
`;
    recipes_body.appendChild(recipe);

</script>

<?php } ?>