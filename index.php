<?php
include 'subsrt lib.php';
?>

<form enctype="multipart/form-data" action="index.php" method="post">

    Поиск <input type="text" name="substr" /> <br /> 
    <input  type="hidden" name="MAX_FILE_SIZE" value="30000" />
    Загрузка файла: <input type="file" name="userfile" /> </br>
    <input type="submit" name="submit" value="Загрузить файл" /> <br />
</form>

<?php
if (isset($_FILES['userfile'])) {

    if (isset($_POST['substr'])) {
        $str = $_POST['substr'];
        echo '<pre>';
        print_r(InFileSeach::InString($str));
        echo '</pre>';
    }
   
}

 echo sizeof([0=>1,'0'=>4,NULL=>"bear",123]);
?>




