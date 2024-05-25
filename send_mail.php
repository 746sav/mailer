<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";

    $mail = new PHPMailer(true); /* Создаем объект MAIL */
    $mail->CharSet = "UTF-8"; /* Задаем кодировку UTF-8 */
    $mail->IsHTML(true); /* Разрешаем работу с HTML */

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

    $yourEmail = 'smokotinaAV@yandex.ru'; // ваш email на яндексе
    $password = 'Cresexe030*'; // ваш пароль к яндексу или пароль приложения

    // настройки SMTP
    $mail->Mailer = 'smtp';
    $mail->Host = 'ssl://smtp.yandex.ru';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = $yourEmail; // ваш email - тот же что и в поле From:
    $mail->Password = $password; // ваш пароль;


    // формируем письмо

    // от кого: это поле должно быть равно вашему email иначе будет ошибка
    $mail->setFrom($yourEmail, 'Ваше Имя');

    // кому - получатель письма
    $mail->addAddress('smokotinaAV@yandex.ru', 'Алена');  // кому

    $mail->Subject = 'Проверка';  // тема письма

    $mail->msgHTML("<html><body>
				<h1>Проверка связи!</h1>
				<p>Это тестовое письмо.</p>
				</html></body>");


    if ($mail->send()) { // отправляем письмо
    echo 'Письмо отправлено!';
    }    else {
    echo 'Ошибка: ' . $mail->ErrorInfo;
    }
    $mail->SMTPDebug = 2;

?>