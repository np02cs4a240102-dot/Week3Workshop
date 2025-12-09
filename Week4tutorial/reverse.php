<form method="POST">
    Enter a word:<input type="text" name="word">
    <button>Reverse</button>
</form>

<?php
if (isset($_POST['word'])){
    $str =$_POST['word'];
    $rev ="";
    for ($i= strlen($str)-1; $i >=0; $i--) {
        $rev .=$str[$i];

    }

    echo "Reversed; $rev";

}