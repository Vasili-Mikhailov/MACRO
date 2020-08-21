<?php
    // Поключение к базе данных
    $conn = new mysqli('localhost', 'root', 'password', 'phpmyadmin');
    if($conn->connect_error){
        die('Connection Failed!' . $conn->connect_error);
    }

    if(isset($_GET['show'])){
        // Запрос всех текстов с заголовками
        $sql = $conn->query("SELECT * FROM topics");
        for ($topics = []; $row = $sql->fetch_assoc(); $topics[] = $row);
        foreach($topics as $key => $topic){
            // Обработка текстов
            $topics[$key]['text'] = findAndReplace($topics[$key]['text']);
            $topics[$key]['text'] = findAndRemove($topics[$key]['text']);
            // Получение последних трех комментариев для текста в данной итерации
            $sql = $conn->query("SELECT topics_messages.comment AS comment, date_added AS date
                FROM topics JOIN topics_messages
                ON topics.id = topics_messages.topics_id
                WHERE topics.id = {$topic['id']}
                ORDER BY topics_messages.date_added DESC
                LIMIT 3");
            for ($comments = []; $row = $sql->fetch_assoc(); $comments[] = $row);
            // Добавленик трех последних комментариев для каждого текста
            $topics[$key]['comments'] = [];
            foreach($comments as $comment){
                $topics[$key]['comments'][] = $comment;
            }
        }
        // Возвращение JSON представления данных
        $data['topics'] = $topics;
        echo json_encode($data);

        $sql->close();
    }

    $conn->close();

    // Функция для удаления из текста элементов хранящихся в массиве $arr
    function findAndRemove($text)
    {
        $arr = ['some', 'words', 'to', 'remove'];
        foreach($arr as $elem){
            $text = str_ireplace($elem, '', $text);
        }
        return $text;
    }

    // Функция для замены элементов текста соответсвующих ключам массива $arr значениями массива
    function findAndReplace($text)
    {
        $arr = ['this' => 'is', 'for' => 'replace'];
        foreach($arr as $key => $elem){
            $text = str_ireplace($key, $elem, $text);
        }
        return $text;
    }
