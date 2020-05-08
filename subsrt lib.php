<?php

/**
 * Class InFileSeach
 * 
 * Класс для различных механизмов поиска строки в файле
 * 
 * @author Москалев Роман <moslik123@gmail.com>
 * @version 1.0
 */
class InFileSeach {
   
    /**
 * Метод для поиска вложения строки в файле
 * 
 * @param string $str SubString for search
 * 
 * @return string|array Result of searching or array of errors
 */
public static function InString(string $str) {
    $errors = array();
    $expensions = ['text/plain', 'text/uri-list', 'application/plain'];
    $fileName = $_FILES['userfile']['name'];
    $fileTemp = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];

    if (!in_array($fileType, $expensions)) {
        $errors[] = "Недопустимый тип файла";
    }

    if (empty($errors)) {
        move_uploaded_file($fileTemp, "Text/" . $fileName);
        $fileContent = file_get_contents("Text/" . $fileName);

        $substrPosition = strpos($fileContent, $str);
        
        $row = 0;
        //Line Break position
        $LineBrPos = 0;
        $col = 0;
        
        if($substrPosition === false)
        {
            return "Поиск не дал результатов";
        }
        /* Пока позиция найденого вложения больше позиции переноса строки
         * увеличиваем счетчик позиции строки
         * уменьшаем позицию строки вложения относительно переноса строки
         * и ищем следующую позицию переноса строки, если таковая имеется
        */
        while ($substrPosition > $LineBrPos) {
            $row++;
            //
            $col = $substrPosition - $LineBrPos;
            //Если достигли конца файла - прерываем цикл
            if (strpos($fileContent, "\n", $LineBrPos + 1) === false) {
                break;
            }
            $LineBrPos = strpos($fileContent, "\n", $LineBrPos + 1);
        }
        //Если искомое вхождение находится в начале файла
        if ($row == 0) {
            $col = 1;
            $row = 1;
        }
        //Если вхождение в первой строке
        else if ($row == 1) {
            $col += 1;
        }
        $result = "Строка " . $row . " Позиция " . $col;

        return $result;
    } else {
        return($errors);
    }
}

    
}



?>
