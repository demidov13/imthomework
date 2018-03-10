<?php
require_once('phar://ask.phar/src/ask.php');

/* 
	API библиотеки обогатилось дополнительными функциями:
	save($user) - принмает ассоциативный массив вида ['username' => 'oleg', 'score' => 20]; 
				  username - имя пользователя в ЛАТИНИЦЕ (кирилицу не использовать)
				  score - очки пользователя
    find($username) - принимает строку (имя пользователя) и возвращает ассоциативный массив вида ['username' => 'oleg', 'score' => 20]
    				  или null если пользователь с таким username не найден
    findAll()		- возвращает коллекцию (многомерный массив) ВСЕХ пользователей когда-либо участвоваших в викторине.
    clear()			- очищает хранилище данных.

    Задача 2:
    Реализовать викторину похожую на первую часть домашнего задания, но теперь с большей логикой.
    Что бы участвовать в викторине, пользователь должен представиться (ввести имя пользователя на латинице). Если пользователь с таким username
    найден, следует вывести приветственное сообщение, которое проинформирует его о текущем положении очков ($user['score']).

    За правильные ответы, пользователь получает очки, эти очки фиксируются в поле $user['score']. По завершении теста, информация о достижении
    должна быть зафиксирована при помощи функции save($user); Очки можно рассчитывать по-разному, это на ваше усмотрение. Каждый вопрос может
    иметь свою сложность и по-разному насчитывать балы (очки). 

    Если пользователь ввел некорректные данные, которые прерывают работу программы - функция save($user) все равно должна быть вызвана
    что бы зафиксировать текущий результат.

    Сценарий имеет массив переданных ему аргументов (http://php.net/manual/ru/reserved.variables.argv.php), используйте это:
    	- Если пользователь запускает программу с аргументом stats (php index.php stats) - то необходимо имена пользователей и их очки.
    	- Если пользователь запускает программу с аргументом reset (php index.php reset) - то необходимо сбросить хранилище данных.


	Задача 3:
	Ничто не мешает расширять информацию о пользователе. Например, так: ['username' => 'oleg', 'score' => 20, 'question' => 5]
	Таким образом, вы можете сохранить информацию о том, на каком вопросе остановился пользователь.

	Добавьте метод load {username} что бы пользователь продолжил с того вопроса, на котором он остановился. Это может быть полезно, если
	пользователь прервал выполнение программы нажатием Ctrl + C или ввел некорректно ответ на один из вопросов, что привело к завершению программы.
	Подумайте, как это можно реализовать. Пример вызова: php index.php load oleg - это приведет к тому, что пользователь oleg продолжит с того вопроса
	на котором остановился. Если же для этого пользователя викторина была окончена, он просто начнет с первого вопроса.

*/

// -----------------------------Обработка аргументов argv---------------------------

if ($argv[1] == "stats") {
    $allUsers = findAll();
    if ($allUsers == null) {
        die("В викторине еще никто не участвовал.");
        }
    foreach ($allUsers as $user) {

            --$user["answer"];   

        printf("\033[93mПользователь %s ответил на %d вопросов и набрал %d баллов.\n \033[0m\n", $user["username"], $user["answer"], $user["score"]);
    }
} elseif ($argv[1] == "reset") {
    clear();
}

// --------------------------Запрос имени, поиск юзера и приветствие------------------------

$username = ask("Укажите своё имя на латинском языке");

if (strlen($username) == 0) {
    die("Вы не представились.");
 } elseif (is_numeric($username)) {
    die("Имя должно состоять только из букв.");
 } elseif (strlen($username) > 20) {
    die("Слишком длинное имя.");
 }

$user = find($username);
if ($user == null) {
$user = [
"username" => $username,
"score" => 0,
"answer" => 1
];
save($user);
// var_dump($user);
$start = ask(<<<EOT
 $user[username], добро пожаловать в викторину по основам PHP. Она состоит из 10 вопросов. 
 Для успешного прохождения нужно дать хотя бы 8 правильных ответов. 
 Будьте внимательны и отвечайте в том формате, который указан в скобках. 
 Как будете готовы, нажмите Enter. 
 Желаю удачи:)

EOT
);
} elseif ($user["answer"] > 10) {
$newtest = ask(<<<EOT
Приветствую, $user[username]! Вы завершили викторину и ответили правильно на $user[score] из 10 вопросов.
Если хотите начать заново, нажмите 1, если хотите завершить участие, нажмите 2.

EOT
);

if (strlen($newtest) == 0) {
    die("Вы не ввели ответ.");
    } elseif ((int)$newtest == false) {
    die("Вы не выбрали вариант ответа с помощью цифры.");
    } elseif ((int)abs($newtest) > 2) {
    die("Нужно было ввести 1 или 2.");
    } elseif ($newtest == 1) {
        $user["score"] = 0;
        $user["answer"] = 1;
        save($user);
    } elseif ($newtest == 2) {
        die("Спасибо за участие! Всего доброго!");
    }
} else {
$continue = ask(<<<EOT
Приветствую, $user[username]! Вы остановились на вопросе номер $user[answer]. Правильных ответов на вашем счету - $user[score]. Если желаете продолжить с того же места, нажмите 1, а если хотите начать сначала, нажмите 2.

EOT
);

if (strlen($continue) == 0) {
    die("Вы не ввели ответ.");
    } elseif ((int)$continue == false) {
    die("Вы не выбрали вариант ответа с помощью цифры.");
    } elseif ((int)abs($continue) > 2) {
    die("Нужно было ввести 1 или 2.");
    } elseif ($continue == 2) {
        $user["score"] = 0;
        $user["answer"] = 1;
        save($user);
    }
}
// var_dump($user);

// -----------------Цикл, запускающий функции с вопросами викторины-----------------

for ($i = 1; $i < 11; $i++) {
    $user = find($username);
      if ($i == $user["answer"] && $i == 1) {
        ans1($username);
    } elseif ($i == $user["answer"] && $i == 2) {
        ans2($username);
    } elseif ($i == $user["answer"] && $i == 3) {
        ans3($username);
    } elseif ($i == $user["answer"] && $i == 4) {
        ans4($username);
    } elseif ($i == $user["answer"] && $i == 5) {
        ans5($username);
    } elseif ($i == $user["answer"] && $i == 6) {
        ans6($username);
    } elseif ($i == $user["answer"] && $i == 7) {
        ans7($username);
    } elseif ($i == $user["answer"] && $i == 8) {
        ans8($username);
    } elseif ($i == $user["answer"] && $i == 9) {
        ans9($username);
    } elseif ($i == $user["answer"] && $i == 10) {
        ans10($username);
    }
}

// ----------------------Вывод результата викторины------------------------

$user = find($username);
if ($user["score"] < 8) {
        printf("\033[91m    %s, к сожалению, тест не сдан. Количество правильных ответов: %d.\033[0m\n", $user["username"], $user["score"]);
 } elseif ($user["score"] >= 8) {
        printf("\033[92m    Поздравляю, %s, тест пройден успешно! Вы ответили правильно на %d вопросов.\033[0m\n", $user["username"], $user["score"]);
 }

// -------------------Функции, обрабатывающие каждый вопрос викторины-------------------

function ans1 ($username) 
{
    $answer_one = ask(<<<EOT
    Вопрос 1 из 10:
 Как расшифровывается аббревиатура PHP? (Выберите один вариант, указав цифру)
 [1] Perfect HTML Power
 [2] Permutation HTML Program
 [3] Hypertext Preprocessor
 [4] P-code Hack Programm

EOT
);

 $user = find($username);
 if (strlen($answer_one) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_one == false) {
    die("Вы не выбрали вариант ответа с помощью цифры. Тест завершен.");
 } elseif ((int)abs($answer_one) > 4) {
    die("В вопросе только 4 варианта ответа, ваш выбор некорректен. Тест завершен.");
 } elseif ((int)abs($answer_one) == 3) {
    $user["score"]++;
 }
    $user["answer"] = 2;
    save($user);
    // var_dump($user);
    return $user;
}

function ans2 ($username) 
{    
    $answer_two = ask(<<<EOT
    Вопрос 2 из 10:
Где чаще всего используется значок \$ в языке PHP? (Выберите один вариант, указав цифру)
[1] Это обязательный первый символ при объявлении переменной
[2] Это обязательный первый символ при объявлении константы
[3] Это обязательный первый символ при объявлении класса
[4] Это обязательный первый символ при объявлении комментария

EOT
);
 
 $user = find($username);
 if (strlen($answer_two) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_two == false) {
    die("Вы не выбрали вариант ответа с помощью цифры. Тест завершен.");
 } elseif ((int)abs($answer_two) > 4) {
    die("В вопросе только 4 варианта ответа, ваш выбор некорректен. Тест завершен.");
 } elseif ((int)abs($answer_two) == 1) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans3 ($username) 
{
    $answer_three = ask(<<<EOT
    Вопрос 3 из 10:
Какие переменные объявлены некорректно и приведут к возникновению ошибки? (выберите несколько вариантов через запятую, например: 1,3)
[1] \$var3 = 3;
[2] \$3var = 3;
[3] \$-var3 = 3;
[4] \$_var3 = 3;

EOT
);

 $user = find($username);
 if (strlen($answer_three) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_three == false) {
    die("Вы не выбрали варианты ответа с помощью цифр. Тест завершен.");
 }

 $answer_three = explode(",", $answer_three);

 if (count($answer_three) < 2 || count($answer_three) > 4) {
    die("Вы выбрали недопустимое количество вариантов ответа. Тест завершен.");
 }

 if ($answer_three[0] == 2 && $answer_three[1] == 3) {
    $user["score"]++;
 } elseif ($answer_three[1] == 2 && $answer_three[0] == 3) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans4 ($username) 
{
    $answer_four = ask(<<<EOT
    Вопрос 4 из 10:
Что делает с переменной функция unset()? (Введите слово-ответ на английском с помощью клавиатуры)

EOT
);

 $user = find($username);
 if (strlen($answer_four) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif (is_numeric($answer_four)) {
    die("Ответ должен состоять из букв, а не цифр. Тест завершен.");
 } elseif (strlen($answer_four) > 100) {
    die("Недопустимое количество символов. Тест завершен.");
 }

 if (strcasecmp($answer_four, "delete") == 0) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans5 ($username) 
{
    $answer_five = ask(<<<EOT
    Вопрос 5 из 10:
Какая функция удаляет все пробелы и другие символы с начала и конца строки? (Выберите один вариант, указав цифру)
[1] ucfirst();
[2] sprintf();
[3] strstr();
[4] trim();

EOT
);

 $user = find($username);
 if (strlen($answer_five) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_five == false) {
    die("Вы не выбрали вариант ответа с помощью цифры. Тест завершен.");
 } elseif ((int)abs($answer_five) > 4) {
    die("В вопросе только 4 варианта ответа, ваш выбор некорректен. Тест завершен.");
 } elseif ((int)abs($answer_five) == 4) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans6 ($username) 
{
    $answer_six = ask(<<<EOT
    Вопрос 6 из 10:
Какой синтаксис используется для объявления массива? (выберите несколько вариантов через запятую, например: 1,3)
[1] \$var = array();
[2] \$var = mass();
[3] \$var = {};
[4] \$var = [];

EOT
);

 $user = find($username);
 if (strlen($answer_six) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_six == false) {
    die("Вы не выбрали варианты ответа с помощью цифр. Тест завершен.");
 }

 $answer_six = explode(",", $answer_six);

 if (count($answer_six) < 2 || count($answer_six) > 4) {
    die("Вы выбрали недопустимое количество вариантов ответа. Тест завершен.");
 }

 if ($answer_six[0] == 1 && $answer_six[1] == 4) {
    $user["score"]++;
 } elseif ($answer_six[1] == 1 && $answer_six[0] == 4) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans7 ($username) 
{
    $answer_seven = ask(<<<EOT
    Вопрос 7 из 10:
Переменной \$var присвоено значение "World". Какие строчки кода отобразят в браузере "Hello World"? (выберите несколько вариантов через запятую, например: 1,3)
[1] echo "Hello \$var";
[2] echo 'Hello \$var';
[3] echo 'Hello ' . \$var;
[4] echo 'Hello ' . '\$var';

EOT
);

 $user = find($username);
 if (strlen($answer_seven) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_seven == false) {
    die("Вы не выбрали варианты ответа с помощью цифр. Тест завершен.");
 }

 $answer_seven = explode(",", $answer_seven);

 if (count($answer_seven) < 2 || count($answer_seven) > 4) {
    die("Вы выбрали недопустимое количество вариантов ответа. Тест завершен.");
 }

 if ($answer_seven[0] == 1 && $answer_seven[1] == 3) {
    $user["score"]++;
 } elseif ($answer_seven[1] == 1 && $answer_seven[0] == 3) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans8 ($username) 
{
    $answer_eight = ask(<<<EOT
    Вопрос 8 из 10:
Сколько существует типов данных в PHP? (Введите число с помощью клавиатуры)

EOT
);

 $user = find($username);
 if (strlen($answer_eight) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_eight == false) {
    die("Ответ должен быть в виде числа. Тест завершен.");
 } elseif ((int)abs($answer_eight) > 9999999) {
    die("Недопустимое число. Тест завершен.");
 } elseif ((int)abs($answer_eight) == 9) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans9 ($username) 
{
    $answer_nine = ask(<<<EOT
    Вопрос 9 из 10:
Какая функция объединяет элементы массива в строку? (Выберите один вариант, указав цифру)
[1] explode();
[2] implode();
[3] compact();
[4] array_merge();

EOT
);

 $user = find($username);
 if (strlen($answer_nine) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif ((int)$answer_nine == false) {
    die("Вы не выбрали вариант ответа с помощью цифры. Тест завершен.");
 } elseif ((int)abs($answer_nine) > 4) {
    die("В вопросе только 4 варианта ответа, ваш выбор некорректен. Тест завершен.");
 } elseif ((int)abs($answer_nine) == 2) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}

function ans10 ($username) 
{
    $answer_ten = ask(<<<EOT
    Вопрос 10 из 10:
Как называется функция для сортировки и "переиндексации" массива? (Введите слово-ответ на английском с помощью клавиатуры)


EOT
);

 $user = find($username);
 if (strlen($answer_ten) == 0) {
    die("Вы не ввели ответ. Тест завершен.");
 } elseif (is_numeric($answer_ten)) {
    die("Ответ должен состоять из букв, а не цифр. Тест завершен.");
 } elseif (strlen($answer_ten) > 100) {
    die("Недопустимое количество символов. Тест завершен.");
 }

 if (strcasecmp($answer_ten, "sort") == 0) {
    $user["score"]++;
 }
    $user["answer"]++;
    save($user);
    // var_dump($user);
    return $user;
}