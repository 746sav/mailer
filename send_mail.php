<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";
    require 'phpmailer/SMTP.php';

    $mail = new PHPMailer(true); /* Создаем объект MAIL */
    $mail->CharSet = "UTF-8"; /* Задаем кодировку UTF-8 */
    //$mail->IsHTML(true); /* Разрешаем работу с HTML */

    // $name = $_POST["name"]; /* Принимаем имя пользователя с формы .. */
    // $email = $_POST["email"]; /* Почту */
    // $phone = $_POST["phone"]; /* Телефон */
    // $message = $_POST["message"]; /* Сообщение с формы */

    // $email_template = "template_mail.html"; // Считываем файл разметки
    // $body = file_get_contents($email_template); // Сохраняем данные в $body
    // $body = str_replace('%name%', $name, $body); // Заменяем строку %name% на имя
    // $body = str_replace('%email%', $email, $body); // строку %email% на почту
    // $body = str_replace('%phone%', $phone, $body); // строку %phone% на телефон
    // $body = str_replace('%message%', $message, $body); // строку %message% на сообщение

    // $mail->addAddress("smokotinaAV@yandex.ru"); /* Здесь введите Email, куда отправлять */
    // $mail->setFrom($email);
    // $mail->Subject = "[Заявка с формы]"; /* Тема письма */
    // $mail->MsgHTML($body);

    // /* Проверяем отправлено ли сообщение */
    // if (!$mail->send()) {
    //     $message = "Ошибка отправки";
    // } else {
    //     $message = "Данные отправлены!";
    // }

    // /* Возвращаем ответ */	
    // $response = ["message" => $message];

    // /* Ответ в формате JSON */
    // header('Content-type: application/json');
    // echo json_encode($response);

        # проверка, что ошибки нет
if (!error_get_last()) {

    // Переменные, которые отправляет пользователь
    $name = $_POST['name'] ;
    $email = $_POST['email'];
    $text = $_POST['text'];
    $file = $_FILES['myfile'];
    
    
    // Формирование самого письма
    $title = "Заголовок письма";
    $body = "
    <h2>Новое письмо</h2>
    <b>Имя:</b> $name<br>
    <b>Почта:</b> $email<br><br>
    <b>Сообщение:</b><br>$text
    ";
    
    // Настройки PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['data']['debug'][] = $str;};
    
    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'smokotinaAV'; // Логин на почте
    $mail->Password   = 'Cresexe030*'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('smokotinaAV@yandex.ru', 'Helen'); // Адрес самой почты и имя отправителя
    
    // Получатель письма
    $mail->addAddress('smokotinaAV@yandex.ru');  
    $mail->addAddress('smokotinaalena5@gmail.com'); // Ещё один, если нужен
    
    // Прикрипление файлов к письму
    if (!empty($file['name'][0])) {
        for ($i = 0; $i < count($file['tmp_name']); $i++) {
            if ($file['error'][$i] === 0) 
                $mail->addAttachment($file['tmp_name'][$i], $file['name'][$i]);
        }
    }
    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    
    
    // Проверяем отправленность сообщения
    if ($mail->send()) {
        $data['result'] = "success";
        $data['info'] = "Сообщение успешно отправлено!";
    } else {
        $data['result'] = "error";
        $data['info'] = "Сообщение не было отправлено. Ошибка при отправке письма";
        $data['desc'] = "Причина ошибки: {$mail->ErrorInfo}";
    }
    
} else {
    $data['result'] = "error";
    $data['info'] = "В коде присутствует ошибка";
    $data['desc'] = error_get_last();
}

// Отправка результата
header('Content-Type: application/json');
echo json_encode($data);

?>