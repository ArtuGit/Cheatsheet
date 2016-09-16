#!/usr/bin/php
<?php
///////////////////////////////////////////////////////////////////////////
// Created and developed by Greg Zemskov, Revisium Company
// Email: ai@revisium.com, http://revisium.com/ai/, skype: greg_zemskov

// Commercial usage is not allowed without a license purchase or written permission of author
// Source code usage is not allowed without author's permission

// Certificated in Federal Institute of Industrial Property in 2012
// http://revisium.com/ai/i/mini_aibolit.jpg

////////////////////////////////////////////////////////////////////////////
// Запрещено использование скрипта в коммерческих целях без приобретения лицензии.
// Запрещено использование исходного кода скрипта без приобретения лицензии.
//
// По вопросам приобретения лицензии обращайтесь в компанию "Ревизиум": http://www.revisium.com
// ai@revisium.com
// На скрипт получено авторское свидетельство в Роспатенте
// http://revisium.com/ai/i/mini_aibolit.jpg
///////////////////////////////////////////////////////////////////////////

// put 1 for expert mode, 0 for basic check and 2 for paranoic mode
// установите 1 для режима "Эксперта", 0 для быстрой проверки и 2 для параноидальной проверки (для лечения сайта) 
define('AI_EXPERT', 1); 

//define('LANG', 'EN');
define('LANG', 'RU');

// Put any strong password to open the script from web
// Впишите вместо put_any_strong_password_here сложный пароль	 
define('PASS', 'ymuUl20zWcA86dkXzs1W'); 

define('REPORT_MASK_PHPSIGN', 1);
define('REPORT_MASK_SPAMLINKS', 2);
//define('REPORT_MASK_DOORWAYS', 4);
define('REPORT_MASK_SUSP', 8);
define('REPORT_MASK_CANDI', 16);
//define('REPORT_MASK_WRIT', 32);
define('REPORT_MASK_FULL', REPORT_MASK_PHPSIGN | REPORT_MASK_SPAMLINKS | REPORT_MASK_SUSP

/* <-- remove this line to enable "recommendations"  

| REPORT_MASK_CANDI | REPORT_MASK_WRIT

 remove this line to enable "recommendations" --> */
);

$defaults = array(
	'path' => dirname(__FILE__),
	'scan_all_files' => 0, // full scan (rather than just a .js, .php, .html, .htaccess)
	'scan_delay' => 0, // delay in file scanning to reduce system load
	'max_size_to_scan' => '512K',
	'site_url' => '', // website url
	'no_rw_dir' => 0,
	'report_mask' =>  REPORT_MASK_FULL // full-featured report
);


define('DEBUG_MODE', 0);

define('DIR_SEPARATOR', '/');

if ((isset($_SERVER['OS']) && stripos('Win', $_SERVER['OS']) !== false)/* && stripos('CygWin', $_SERVER['OS']) === false)*/) {
   define('DIR_SEPARATOR', '\\');
}


if (LANG == 'RU') {
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// RUSSIAN INTERFACE
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
define('AI_STR_001', '<h3>AI-Болит v.%s &mdash; ищет вредоносный код и вирусы в файлах.</h3><h5>Григорий Земсков, компания "<a href="http://www.revisium.com/">Ревизиум</a>", 2012-2014, <a target=_blank href="http://revisium.com/ai/">Страница проекта на Revisium.com.</a> %s</h5>');
define('AI_STR_002', '<div class="update">Проверьте обновление на сайте <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. Возможно, ваша версия скрипта уже устарела.</div>');
define('AI_STR_003', 'ВНИМАНИЕ! Не оставляйте файл ai-bolit.php или файл отчета на сервере, и не давайте прямых ссылок с других сайтов на файл отчета или скрипта. Отчет содержит важную информацию о вашем сайте или сервере, сохраните его в надежном месте от посторонних глаз!');
define('AI_STR_004', 'Путь');
define('AI_STR_005', 'Дата создания');
define('AI_STR_006', 'Дата модификации');
define('AI_STR_007', 'Размер');
define('AI_STR_008', 'Конфигурация PHP');
define('AI_STR_009', "Вы установили слабый пароль на скрипт AI-BOLIT. Укажите пароль не менее 8 символов, содержащий латинские буквы в верхнем и нижнем регистре, а также цифры. Например, такой <b>%s</b>");
define('AI_STR_010', "Запустите скрипт с паролем, который установлен в переменной PASS (в начале файла). <br/>Например, так http://ваш_сайт_и_путь_до_скрипта/ai-bolit.php?p=<b>%s</b>");
define('AI_STR_011', 'Текущая директория не доступна для чтения скрипту. Пожалуйста, укажите права на доступ <b>rwxr-xr-x</b> или с помощью командной строки <b>chmod +r имя_директории</b>');
define('AI_STR_012', "<div class=\"rep\">Текущая база скрипта содержит %s шелл-сигнатур, а также %s других вредоносных фрагментов. Затрачено времени: <b>%s</b>.<br/>Сканирование начато: %s. Сканирование завершено: %s</div> ");
define('AI_STR_013', '<div class="rep">Всего проверено %s директорий и %s файлов.</div>');
define('AI_STR_014', '<div class="rep" style="color: #0000A0">Внимание, скрипт выполнил быструю проверку сайта. Проверяются только наиболее критические файлы, но часть вредоносных скриптов может быть не обнаружена. Пожалуйста, запустите скрипт из командной строки для выполнения полного тестирования. Подробнее смотрите в <a href="http://revisium.com/ai/faq.php">FAQ вопрос №10</a>.</div>');
define('AI_STR_015', '<div class="sec">Критические замечания</div>');
define('AI_STR_016', 'Найдены сигнатуры шелл-скрипта. Подозрение на вредоносный скрипт:');
define('AI_STR_017', 'Шелл-скрипты не найдены.');
define('AI_STR_018', 'Обнаружены сигнатуры javascript вирусов:');
define('AI_STR_019', 'Обнаружены сигнатуры исполняемых файлов unix. Они могут быть вредоносными файлами:');
define('AI_STR_020', 'Двойное расширение, зашифрованный контент или подозрение на вредоносный скрипт. Требуется дополнительный анализ:');
define('AI_STR_021', 'Подозрение на вредоносный скрипт:');
define('AI_STR_022', 'Список файловых ссылок (symlinks):');
define('AI_STR_023', 'Список скрытых файлов:');
define('AI_STR_024', 'Скорее всего этот файл лежит в каталоге с дорвеем:');
define('AI_STR_025', 'Не найдено директорий c дорвеями');
define('AI_STR_026', 'Предупреждения');
define('AI_STR_027', 'Опасный код в .htaccess (редирект на внешний сервер, подмена расширений или автовнедрение кода):');
define('AI_STR_028', 'В не .php файле содержится стартовая сигнатура PHP кода. Возможно, там вредоносный код:');
define('AI_STR_029', 'В этих файлах размещен код по продаже ссылок. Убедитесь, что размещали его вы:');
define('AI_STR_030', 'Непроверенные файлы - ошибка чтения');
define('AI_STR_031', 'В этих файлах размещены невидимые ссылки. Подозрение на ссылочный спам:');
define('AI_STR_032', 'Список невидимых ссылок:');
define('AI_STR_033', 'Отображены только первые ');
define('AI_STR_034', 'Найдены директории, в которых подозрительно много файлов .php или .html. Подозрение на дорвей:');
define('AI_STR_035', 'Скрипт использует код, который часто используются во вредоносных скриптах:');
define('AI_STR_036', 'Директории из файла .adirignore были пропущены при сканировании:');
define('AI_STR_037', 'Версии найденных CMS:');
define('AI_STR_038', 'Большие файлы (больше чем %s! Пропущено:');
define('AI_STR_039', 'Не найдено файлов больше чем %s');
define('AI_STR_040', 'Временные файлы или файлы(каталоги)-кандидаты на удаление по ряду причин:');
define('AI_STR_041', 'Потенциально небезопасно! Директории, доступные скрипту на запись:');
define('AI_STR_042', 'Не найдено директорий, доступных на запись скриптом');
define('AI_STR_043', 'Использовано памяти при сканировании: ');
define('AI_STR_044', '<div id="igid" style="display: none;"><div class="sec">Добавить в список игнорируемых</div><form name="ignore"><textarea name="list" style="width: 600px; height: 400px;"></textarea></form><div class="details">Скопируйте этот список и вставьте его в файл .aignore, чтобы исключить эти файлы из отчета.</div></div>');
define('AI_STR_045', '<div class="notice"><span class="vir">[!]</span> В скрипте отключено полное сканирование файлов, проверяются только .php, .html, .htaccess. Чтобы выполнить более тщательное сканирование, <br/>поменяйте значение настройки на <b>\'scan_all_files\' => 1</b> в самом верху скрипта. Скрипт в этом случае может работать очень долго. Рекомендуется отключить на хостинге лимит по времени выполнения, либо запускать скрипт из командной строки.</div>');
define('AI_STR_046', '[x] закрыть сообщение');
define('AI_STR_047', '<div class="offer" id="ofr"><span style="font-size: 15px;"><a href="http://www.revisium.com/ru/order/" target="_blank"><b>Оперативное лечение сайта от вирусов. Защита от взлома. Гарантия на работы. </b></a></span><br/><p style="color: #D0FFD0; font-size: 13px;">Быстро и качественно вылечим Ваш сайт от вирусов, удалим вредоносный код с сайта, поставим уникальную защиту от взлома. <a href="http://www.revisium.com/ru/order/" target=_blank>Отправьте нам запрос</a> на сайте www.revisium.com &rarr;</p><hr color=#E0E0E0 size=1><p style="color: #E0E0E0">Также приглашаем в группу ВКонтакте<br/> <a href="http://vk.com/siteprotect" target="_blank">"Безопасность Веб-сайтов"</a>. А еще у нас есть твиттер <a href="http://twitter.com/revisium" target=_blank>@revisium</a> и страница <a href="http://www.facebook.com/Revisium" target=_blank>facebook.com/revisium</a>. Присоединяйтесь!</p><hr color=#E0E0E0 size=1><p style="color: #E0E0E0"><b style="color: yellow">[$$$]</b> Если Вы хостер, веб-студия, seo-специалист или вебмастер&nbsp;&mdash; напишите нам на ai@revisium.com, для Вас есть партнерская программа.</p>');
define('AI_STR_048', '<p>Если у вас есть эккаунт ВКонтакте, приглашаем в <a href="http://vk.com/siteprotect" target=_blank>группу "Безопасность Веб-сайтов"</a>: там я делюсь опытом защиты веб-сайтов и поиска вредоносных скриптов.</p>');
define('AI_STR_049', 'Отказ от гарантий: даже если скрипт не нашел вредоносных скриптов на сайте, автор не гарантирует их полное отсутствие, а также не несет ответственности за возможные последствия работы скрипта ai-bolit.php или неоправданные ожидания пользователей относительно функциональности и возможностей.');
define('AI_STR_050', 'Замечания и предложения по работе скрипта и пропущенные вредоносные скрипты присылайте на <a href="mailto:ai@revisium.com">ai@revisium.com</a>.<p>Также будем чрезвычайно благодарны за любые упоминания скрипта AI-Bolit на вашем сайте, в блоге, среди друзей, знакомых и клиентов. Ссылочку можно поставить на <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. <p>Если будут вопросы - пишите <a href="mailto:ai@revisium.com">ai@revisium.com</a>. ');
define('AI_STR_051', 'Отчет по ');
define('AI_STR_052', 'Эвристический анализ обнаружил подозрительные файлы. Проверьте их на наличие вредоносного кода.');
define('AI_STR_053', 'Много косвенных вызовов функции');
define('AI_STR_054', 'Подозрение на обфусцированные переменные');
define('AI_STR_055', 'Подозрительное использование массива глобальных переменных');
define('AI_STR_056', 'Дробление строки на символы');
define('AI_STR_057', 'Сканирование выполнено в обычном режиме. Некоторые вредоносные скрипты могут быть не обнаружены.<br> Желательно проверить сайт в режиме "Эксперт". Подробно описано в <a href="http://www.revisium.com/ai/faq.php">FAQ</a> и инструкции к скрипту.');
define('AI_STR_058', 'Обнаружены фишинговые страницы:');

} else {
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ENGLISH INTERFACE
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
define('AI_STR_001', '<h3>AI-BOLIT v.%s &mdash; Advanced Server-Side Scanner of Viruses, Malicious and Hacker\'s Scripts.</h3><h5>Greg Zemskov, 2012-2014, <a target=_blank href="http://revisium.com/aibo/">AI-BOLIT web site.</a>. Non-commercial use only.</h5>');
define('AI_STR_002', '<div class="update">Check for updates on <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. Probably your version is out-of-date.</div>');
define('AI_STR_003', 'Caution! Do not leave either ai-bolit.php or report file on server and do not provide direct links to the report file. Report file contains sensitive information about your website which could be used by hackers. So keep it in safe place and don\'t leave on website!');
define('AI_STR_004', 'Path');
define('AI_STR_005', 'Created');
define('AI_STR_006', 'Modified');
define('AI_STR_007', 'Size');
define('AI_STR_008', 'PHP Info');
define('AI_STR_009', "Your password for AI-BOLIT is weak. Password must be more than 8 character length, contain both latin letters in upper and lower case, and digits. E.g. <b>%s</b>");
define('AI_STR_010', "Open AI-BOLIT with password specified in the beggining of file in PASS variable. <br/>E.g. http://you_website.com/ai-bolit.php?p=<b>%s</b>");
define('AI_STR_011', 'Current folder is not readable. Please change permission for <b>rwxr-xr-x</b> or using command line <b>chmod +r folder_name</b>');
define('AI_STR_012', "<div class=\"rep\">%s malicious signatures known, %s virus signatures and other malicious code. Elapsed: <b>%s</b
>.<br/>Started: %s. Stopped: %s</div> ");
define('AI_STR_013', '<div class="rep">Scanned %s folders and %s files.</div>');
define('AI_STR_014', '<div class="rep" style="color: #0000A0">Attention! Script has performed quick scan. It scans only .html/.js/.php files  in quick scan mode so some of malicious scripts might not be detected. <br>Please launch script from a command line thru SSH to perform full scan.');
define('AI_STR_015', '<div class="sec">Critical</div>');
define('AI_STR_016', 'Shell script signatures detected. Might be a malicious or hacker\'s script:');
define('AI_STR_017', 'Shell scripts signatures not detected.');
define('AI_STR_018', 'Javascript virus signatures detected:');
define('AI_STR_019', 'Unix executables signatures detected. They might be a malicious binaries or rootkits:');
define('AI_STR_020', 'Suspicious encoded strings, extra .php extention or external includes detected in PHP files. Might be a malicious or hacker\'s script:');
define('AI_STR_021', 'Might be a malicious or hacker\'s script:');
define('AI_STR_022', 'Symlinks:');
define('AI_STR_023', 'Hidden files:');
define('AI_STR_024', 'Files might be a part of doorway:');
define('AI_STR_025', 'Doorway folders not detected');
define('AI_STR_026', 'Warnings');
define('AI_STR_027', 'Malicious code in .htaccess (redirect to external server, extention handler replacement or malicious code auto-append):');
define('AI_STR_028', 'Non-PHP file has PHP signature. Check for malicious code:');
define('AI_STR_029', 'This script has black-SEO links or linkfarm. Check if it was installed by your:');
define('AI_STR_030', 'Reading error. Skipped.');
define('AI_STR_031', 'These files have invisible links, might be black-seo stuff:');
define('AI_STR_032', 'List of invisible links:');
define('AI_STR_033', 'Displayed first ');
define('AI_STR_034', 'Folders contained too many .php or .html files. Might be a doorway:');
define('AI_STR_035', 'Suspicious code detected. It\'s usually used in malicious scrips:');
define('AI_STR_036', 'The following list of files specified in .adirignore has been skipped:');
define('AI_STR_037', 'CMS found:');
define('AI_STR_038', 'Large files (greater than %s! Skipped:');
define('AI_STR_039', 'Files greater than %s not found');
define('AI_STR_040', 'Files recommended to be remove due to security reason:');
define('AI_STR_041', 'Potentially unsafe! Folders which are writable for scripts:');
define('AI_STR_042', 'Writable folders not found');
define('AI_STR_043', 'Memory used: ');
define('AI_STR_044', '<div id="igid" style="display: none;"><div class="sec">Add to ignore list</div><form name="ignore"><textarea name="list" style="width: 600px; height: 400px;"></textarea></form><div class="details">Copy and paste the following list into .aignore to eliminate these files from AI-BOLIT report.</div></div>');
define('AI_STR_045', '<div class="notice"><span class="vir">[!]</span> Ai-BOLIT is working in quick scan mode, only .php, .html, .htaccess files will be checked. Change the following setting \'scan_all_files\' => 1 to perform full scanning.</b>. </div>');
define('AI_STR_046', '[x] close window');
define('AI_STR_047', '<div class="offer" id="ofr"><span style="font-size: 15px;"><a href="http://www.revisium.com/ru/order/" target="_blank">
We will protect your website against hackers and viruses with guarantee!</a></span><br/>
<p>We completely remove malicious software and scripts from your website, protect website against hackers, check servers for rootkits and suid-files, teach you how to keep your website secured. <a href="http://www.revisium.com/en/order/">Contact Us</a>');
define('AI_STR_048', '');
define('AI_STR_049', "Disclaimer: I'm not liable to you for any damages, including general, special, incidental or consequential damages arising out of the use or inability to use the script (including but not limited to loss of data or report being rendered inaccurate or failure of the script). There's no warranty for the program. Use at your own risk. ");
define('AI_STR_050', "I'm sincerely appreciate reports for any bugs you may found in the script. Please email me: <a href=\"mailto:audit@revisium.com\">audit@revisium.com</a>.<p> Also I appriciate any reference to the script in your blog or forum posts. Thank you for the link to download page: <a href=\"http://revisium.com/aibo/\">http://revisium.com/aibo/</a>");
define('AI_STR_051', 'Report for ');
define('AI_STR_052', 'Heuristic Analyzer has detected suspicious files. Check if they are malware.');
define('AI_STR_053', 'Function called by reference');
define('AI_STR_054', 'Suspected for obfuscated variables');
define('AI_STR_055', 'Suspected for $GLOBAL array usage');
define('AI_STR_056', 'Abnormal split of string');
define('AI_STR_057', 'Scanning has been done in simple mode. It is strongly recommended to perform scanning in "Expert" mode. See readme.txt for details.');
define('AI_STR_058', 'Phishing pages detected:');
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// This is signatures wrapped into base64. 
$g_DBShe = unserialize(base64_decode("YTo0MDc6e2k6MDtzOjg6IlpPQlVHVEVMIjtpOjE7czoxMzoiTWFnZWxhbmdDeWJlciI7aToyO3M6MTM6InByb2ZleG9yLmhlbGwiO2k6MztzOjIwOiI8IS0tQ09PS0lFIFVQREFURS0tPiI7aTo0O3M6OToiLy9yYXN0YS8vIjtpOjU7czo1NzoiJHBhcmFtMm1hc2suIilcPVtcPHFxPlwiXSguKj8pKD89W1w8cXE+XCJdIClbXDxxcT5cIl0vc2llIjtpOjY7czoxOToiKTsgJGkrKykkcmV0Lj1jaHIoJCI7aTo3O3M6Mjc6ImVyZWdfcmVwbGFjZSg8cT4mZW1haWwmPHE+LCI7aTo4O3M6MTM6Il1dKSk7fX1ldmFsKCQiO2k6OTtzOjMwOiJmd3JpdGUoZm9wZW4oZGlybmFtZShfX0ZJTEVfXykiO2k6MTA7czoxMToiQmFieV9EcmFrb24iO2k6MTE7czoyNDoiJGlzZXZhbGZ1bmN0aW9uYXZhaWxhYmxlIjtpOjEyO3M6MTU6Ik5ldEBkZHJlc3MgTWFpbCI7aToxMztzOjM0OiJQYXNzd29yZDo8cz4iLiRfUE9TVFs8cT5wYXNzd2Q8cT5dIjtpOjE0O3M6MTU6IkNyZWF0ZWQgQnkgRU1NQSI7aToxNTtzOjEyOiJHSUY4OUE7PD9waHAiO2k6MTY7czoyODoib1RhdDhEM0RzRTgnJn5oVTA2Q0NINTskZ1lTcSI7aToxNztzOjIwOiIkbWQ1PW1kNSgiJHJhbmRvbSIpOyI7aToxODtzOjY6IjN4cDFyMyI7aToxOTtzOjMyOiIkaW09c3Vic3RyKCR0eCwkcCsyLCRwMi0oJHArMikpOyI7aToyMDtzOjE1OiJOaW5qYVZpcnVzIEhlcmUiO2k6MjE7czoyMToiN1AxdGQrTldsaWFJL2hXa1o0Vlg5IjtpOjIyO3M6MTA6Ijxkb3Q+SXJJc1QiO2k6MjM7czoxMDoibmRyb2l8aHRjXyI7aToyNDtzOjEwOiJhbmRleHxvb2dsIjtpOjI1O3M6MTc6IkhhY2tlZCBCeSBFbkRMZVNzIjtpOjI2O3M6MTc6IigkX1BPU1RbImRpciJdKSk7IjtpOjI3O3M6NTU6IigkaW5kYXRhLCRiNjQ9MSl7aWYoJGI2ND09MSl7JGNkPWJhc2U2NF9kZWNvZGUoJGluZGF0YSkiO2k6Mjg7czo3NToiJGltPXN1YnN0cigkaW0sMCwkaSkuc3Vic3RyKCRpbSwkaTIrMSwkaTQtKCRpMisxKSkuc3Vic3RyKCRpbSwkaTQrMTIsc3RybGVuIjtpOjI5O3M6MTg6Ijw/cGhwIGVjaG8gIiMhISMiOyI7aTozMDtzOjEwOiJQdW5rZXIyQm90IjtpOjMxO3M6MTE6IiRzaDNsbENvbG9yIjtpOjMyO3M6NDc6IkBjaHIoKCRoWyRlWyRvXV08PDQpKygkaFskZVsrKyRvXV0pKTt9fWV2YWwoJGQpIjtpOjMzO3M6MzY6InBwY3xtaWRwfHdpbmRvd3MgY2V8bXRrfGoybWV8c3ltYmlhbiI7aTozNDtzOjQwOiJhYmFjaG98YWJpemRpcmVjdG9yeXxhYm91dHxhY29vbnxhbGV4YW5hIjtpOjM1O3M6NToiWmVkMHgiO2k6MzY7czo4OiJkYXJrbWlueiI7aTozNztzOjEzOiJSZWFMX1B1TmlTaEVyIjtpOjM4O3M6NzoiT29OX0JveSI7aTozOTtzOjIwOiJfX1ZJRVdTVEFURUVOQ1JZUFRFRCI7aTo0MDtzOjY6Ik00bGwzciI7aTo0MTtzOjI1OiJjcmVhdGVGaWxlc0ZvcklucHV0T3V0cHV0IjtpOjQyO3M6ODoiUGFzaGtlbGEiO2k6NDM7czoyMjoiXmNeYV5sXnBeZV5yXl9eZ15lXnJecCI7aTo0NDtzOjE0OiI9PSAiYmluZHNoZWxsIiI7aTo0NTtzOjE1OiJXZWJjb21tYW5kZXIgYXQiO2k6NDY7czoyNToiaXNzZXQoJF9QT1NUWydleGVjZ2F0ZSddKSI7aTo0NztzOjM3OiJmd3JpdGUoJGZwc2V0diwgZ2V0ZW52KCJIVFRQX0NPT0tJRSIpIjtpOjQ4O3M6MjA6Ii1JL3Vzci9sb2NhbC9iYW5kbWluIjtpOjQ5O3M6MjE6IiRPT08wMDAwMDA9dXJsZGVjb2RlKCI7aTo1MDtzOjg6IllFTkkzRVJJIjtpOjUxO3M6MTU6ImxldGFrc2VrYXJhbmcoKSI7aTo1MjtzOjY6ImQzbGV0ZSI7aTo1MztzOjQzOiJmdW5jdGlvbiB1cmxHZXRDb250ZW50cygkdXJsLCAkdGltZW91dCA9IDUpIjtpOjU0O3M6NDY6Im92ZXJmbG93LXk6c2Nyb2xsO1wiPiIuJGxpbmtzLiRodG1sX21mWydib2R5J10iO2k6NTU7czoxNjoiTWFkZSBieSBEZWxvcmVhbiI7aTo1NjtzOjc1OiJpZihlbXB0eSgkX0dFVFsnemlwJ10pIGFuZCBlbXB0eSgkX0dFVFsnZG93bmxvYWQnXSkgJiBlbXB0eSgkX0dFVFsnaW1nJ10pKXsiO2k6NTc7czo2NToic3RyX3JvdDEzKCRiYXNlYVsoJGRpbWVuc2lvbiokZGltZW5zaW9uLTEpIC0gKCRpKiRkaW1lbnNpb24rJGopXSkiO2k6NTg7czo2MDoiUjBsR09EbGhFd0FRQUxNQUFBQUFBUC8vLzV5Y0FNN09ZLy8vblAvL3p2L09uUGYzOS8vLy93QUFBQUFBIjtpOjU5O3M6NDU6InByZWdfbWF0Y2goJyFNSURQfFdBUHxXaW5kb3dzLkNFfFBQQ3xTZXJpZXM2MCI7aTo2MDtzOjQ3OiJwcmVnX21hdGNoKCcvKD88PVJld3JpdGVSdWxlKS4qKD89XFtMXCxSXD0zMDJcXSI7aTo2MTtzOjM3OiIkdXJsID0gJHVybHNbcmFuZCgwLCBjb3VudCgkdXJscyktMSldIjtpOjYyO3M6ODA6IndwX3Bvc3RzIFdIRVJFIHBvc3RfdHlwZSA9ICdwb3N0JyBBTkQgcG9zdF9zdGF0dXMgPSAncHVibGlzaCcgT1JERVIgQlkgYElEYCBERVNDIjtpOjYzO3M6NjU6Imh0dHA6Ly8nLiRfU0VSVkVSWydIVFRQX0hPU1QnXS51cmxkZWNvZGUoJF9TRVJWRVJbJ1JFUVVFU1RfVVJJJ10pIjtpOjY0O3M6MzY6ImZ3cml0ZSgkZixnZXRfZG93bmxvYWQoJF9HRVRbJ3VybCddKSI7aTo2NTtzOjc0OiIkcGFyYW0geCAkbi5zdWJzdHIgKCRwYXJhbSwgbGVuZ3RoKCRwYXJhbSkgLSBsZW5ndGgoJGNvZGUpJWxlbmd0aCgkcGFyYW0pKSI7aTo2NjtzOjQ3OiIkdGltZV9zdGFydGVkLiRzZWN1cmVfc2Vzc2lvbl91c2VyLnNlc3Npb25faWQoKSI7aTo2NztzOjQ4OiIkdGhpcy0+Ri0+R2V0Q29udHJvbGxlcigkX1NFUlZFUlsnUkVRVUVTVF9VUkknXSkiO2k6Njg7czoyMToibHVjaWZmZXJAbHVjaWZmZXIub3JnIjtpOjY5O3M6Mjc6ImJhc2U2NF9kZWNvZGUoJGNvZGVfc2NyaXB0KSI7aTo3MDtzOjIxOiJ1bmxpbmsoJHdyaXRhYmxlX2RpcnMiO2k6NzE7czo0MToiZmlsZV9nZXRfY29udGVudHModHJpbSgkZlskX0dFVFsnaWQnXV0pKTsiO2k6NzI7czoxMDoiQ3liZXN0ZXI5MCI7aTo3MztzOjI3OiIvaG9tZS9teWRpci9lZ2dkcm9wL2ZpbGVzeXMiO2k6NzQ7czoyOToiLS1EQ0NESVIgW2xpbmRleCAkVXNlcigkaSkgMl0iO2k6NzU7czoxMjoidW5iaW5kIFJBVyAtIjtpOjc2O3M6MTE6InB1dGJvdCAkYm90IjtpOjc3O3M6MTM6InByaXZtc2cgJG5pY2siO2k6Nzg7czoyNjoicHJvYyBodHRwOjpDb25uZWN0IHt0b2tlbn0iO2k6Nzk7czo0Mzoic2V0IGdvb2dsZShkYXRhKSBbaHR0cDo6ZGF0YSAkZ29vZ2xlKHBhZ2UpXSI7aTo4MDtzOjIyOiJiaW5kIGpvaW4gLSAqIGdvcF9qb2luIjtpOjgxO3M6MTM6InByaXZtc2cgJGNoYW4iO2k6ODI7czoyNDoicjRhVGMuZFBudEUvZnp0U0YxYkgzUkgwIjtpOjgzO3M6MTA6ImJpbmQgZGNjIC0iO2k6ODQ7czozNToia2lsbCAtQ0hMRCBcJGJvdHBpZCA+L2Rldi9udWxsIDI+JjEiO2k6ODU7czo1MDoicmVnc3ViIC1hbGwgLS0gLCBbc3RyaW5nIHRvbG93ZXIgJG93bmVyXSAiIiBvd25lcnMiO2k6ODY7czozMDoiYmluZCBmaWx0IC0gIlwwMDFBQ1RJT04gKlwwMDEiIjtpOjg3O3M6Mjc6ImF5dSBwcjEgcHIyIHByMyBwcjQgcHI1IHByNiI7aTo4ODtzOjIwOiJzZXQgcHJvdGVjdC10ZWxuZXQgMCI7aTo4OTtzOjMzOiIvdXNyL2xvY2FsL2FwYWNoZS9iaW4vaHR0cGQgLURTU0wiO2k6OTA7czo3NjoiJHRzdTJbcmFuZCgwLGNvdW50KCR0c3UyKSAtIDEpXS4kdHN1MVtyYW5kKDAsY291bnQoJHRzdTEpIC0gMSldLiR0c3UyW3JhbmQoMCI7aTo5MTtzOjE5OiJmb3BlbignL2V0Yy9wYXNzd2QnIjtpOjkyO3M6MzU6IjBkMGEwZDBhNjc2YzZmNjI2MTZjMjAyNDZkNzk1ZjczNmQ3IjtpOjkzO3M6Mzc6IkpIWnBjMmwwWTI5MWJuUWdQU0FrU0ZSVVVGOURUMDlMU1VWZlYiO2k6OTQ7czo1OiJlLyouLyI7aTo5NTtzOjI4OiJAc2V0Y29va2llKCJoaXQiLCAxLCB0aW1lKCkrIjtpOjk2O3M6NDY6ImZpbmRfZGlycygkZ3JhbmRwYXJlbnRfZGlyLCAkbGV2ZWwsIDEsICRkaXJzKTsiO2k6OTc7czo2OToiQGNvcHkoJF9GSUxFU1tmaWxlTWFzc11bdG1wX25hbWVdLCRfUE9TVFtwYXRoXS4kX0ZJTEVTW2ZpbGVNYXNzXVtuYW1lIjtpOjk4O3M6NzY6ImludDMyKCgoJHogPj4gNSAmIDB4MDdmZmZmZmYpIF4gJHkgPDwgMikgKyAoKCR5ID4+IDMgJiAweDFmZmZmZmZmKSBeICR6IDw8IDQiO2k6OTk7czoxMToiVk9CUkEgR0FOR08iO2k6MTAwO3M6NTk6ImVjaG8geSA7IHNsZWVwIDEgOyB9IHwgeyB3aGlsZSByZWFkIDsgZG8gZWNobyB6JFJFUExZOyBkb25lIjtpOjEwMTtzOjk6IjxzdGRsaWIuaCI7aToxMDI7czo0NToiYWRkX2ZpbHRlcigndGhlX2NvbnRlbnQnLCAnX2Jsb2dpbmZvJywgMTAwMDEpIjtpOjEwMztzOjE3OiJpdHNva25vcHJvYmxlbWJybyI7aToxMDQ7czoyODoiaWYgc2VsZi5oYXNoX3R5cGUgPT0gJ3B3ZHVtcCI7aToxMDU7czo1OToiJGZyYW1ld29yay5wbHVnaW5zLmxvYWQoIiN7cnBjdHlwZS5kb3duY2FzZX1ycGMiLCBvcHRzKS5ydW4iO2k6MTA2O3M6NTc6InN1YnByb2Nlc3MuUG9wZW4oJyVzZ2RiIC1wICVkIC1iYXRjaCAlcycgJSAoZ2RiX3ByZWZpeCwgcCI7aToxMDc7czo1NzoiYXJncGFyc2UuQXJndW1lbnRQYXJzZXIoZGVzY3JpcHRpb249aGVscCwgcHJvZz0ic2N0dW5uZWwiIjtpOjEwODtzOjMyOiJydWxlX3JlcSA9IHJhd19pbnB1dCgiU291cmNlRmlyZSI7aToxMDk7czo1MDoib3Muc3lzdGVtKCdlY2hvIGFsaWFzIGxzPSIubHMuYmFzaCIgPj4gfi8uYmFzaHJjJykiO2k6MTEwO3M6NDI6ImNvbm5lY3Rpb24uc2VuZCgic2hlbGwgIitzdHIob3MuZ2V0Y3dkKCkpKyI7aToxMTE7czo2NzoicHJpbnQoIlshXSBIb3N0OiAiICsgaG9zdG5hbWUgKyAiIG1pZ2h0IGJlIGRvd24hXG5bIV0gUmVzcG9uc2UgQ29kZSI7aToxMTI7czo2OToiZGVmIGRhZW1vbihzdGRpbj0nL2Rldi9udWxsJywgc3Rkb3V0PScvZGV2L251bGwnLCBzdGRlcnI9Jy9kZXYvbnVsbCcpIjtpOjExMztzOjgzOiJzdWJwcm9jZXNzLlBvcGVuKGNtZCwgc2hlbGwgPSBUcnVlLCBzdGRvdXQ9c3VicHJvY2Vzcy5QSVBFLCBzdGRlcnI9c3VicHJvY2Vzcy5TVERPVSI7aToxMTQ7czo0NzoiaWYoaXNzZXQoJF9HRVRbJ2hvc3QnXSkmJmlzc2V0KCRfR0VUWyd0aW1lJ10pKXsiO2k6MTE1O3M6MTU6Ik5JR0dFUlMuTklHR0VSUyI7aToxMTY7czoyNToiSFRUUCBmbG9vZCBjb21wbGV0ZSBhZnRlciI7aToxMTc7czoyMToiODAgLWIgJDEgLWkgZXRoMCAtcyA4IjtpOjExODtzOjEzOiJleHBsb2l0Y29va2llIjtpOjExOTtzOjI2OiJzeXN0ZW0oInBocCAtZiB4cGwgJGhvc3QiKSI7aToxMjA7czoxMToic2ggZ28gJDEuJHgiO2k6MTIxO3M6MTI6ImF6ODhwaXgwMHE5OCI7aToxMjI7czozMDoidW5sZXNzKG9wZW4oUEZELCRnX3VwbG9hZF9kYikpIjtpOjEyMztzOjExOiJ3d3cudDBzLm9yZyI7aToxMjQ7czozOToiJHZhbHVlID1+IHMvJSguLikvcGFjaygnYycsaGV4KCQxKSkvZWc7IjtpOjEyNTtzOjE0OiJUaGUgRGFyayBSYXZlciI7aToxMjY7czoyOToifWVsc2VpZigkX0dFVFsncGFnZSddPT0nZGRvcyciO2k6MTI3O3M6MTY6InskX1BPU1RbJ3Jvb3QnXX0iO2k6MTI4O3M6Mzk6IkkvZ2NaL3ZYMEExMEREUkRnN0V6ay9kKzMrOHF2cXFTMUswK0FYWSI7aToxMjk7czo2NDoiRkozRmt1UEtGa1UvNTNXRUJtSWFpcGt0bkx3UVc4ejQ5ZGMxcmJiTHFzdzhlNjlsNnZKTSszLzEyNHhWbis3bCI7aToxMzA7czoxMDI6Ilx1MDAzY1x1MDA2OVx1MDA2ZFx1MDA2N1x1MDAyMFx1MDA3M1x1MDA3Mlx1MDA2M1x1MDAzZFx1MDAyMlx1MDA2OFx1MDA3NFx1MDA3NFx1MDA3MFx1MDAzYVx1MDAyZlx1MDAyZiI7aToxMzE7czozMDoiZnJlYWQoJGZwLCBmaWxlc2l6ZSgkZmljaGVybykpIjtpOjEzMjtzOjI0OiIkYmFzbGlrPSRfUE9TVFsnYmFzbGlrJ10iO2k6MTMzO3M6MTg6InByb2Nfb3BlbignSUhTdGVhbSI7aToxMzQ7czo1NjoiXHgzMVx4ZGJceGY3XHhlM1x4NTNceDQzXHg1M1x4NmFceDAyXHg4OVx4ZTFceGIwXHg2Nlx4Y2QiO2k6MTM1O3M6NTg6IkFBQUFBQUFBTUFBd0FCQUFBQWVBVUFBRFFBQUFEc0NRQUFBQUFBQURRQUlBQURBQ2dBRndBVUFBRUEiO2k6MTM2O3M6MzE6IiRpbmlbJ3VzZXJzJ10gPSBhcnJheSgncm9vdCcgPT4iO2k6MTM3O3M6NTg6IkhKM0hqdXRja29SZnBYZjlBMXpRTzJBd0RSclJleTl1R3ZUZWV6NzlxQWFvMWEwcmd1ZGtaa1I4UmEiO2k6MTM4O3M6NTA6ImN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9VUkwsICJodHRwOi8vJGhvc3Q6MjA4MiIpIjtpOjEzOTtzOjY0OiI8JT0gIlwiICYgb1NjcmlwdE5ldC5Db21wdXRlck5hbWUgJiAiXCIgJiBvU2NyaXB0TmV0LlVzZXJOYW1lICU+IjtpOjE0MDtzOjEwNDoic3FsQ29tbWFuZC5QYXJhbWV0ZXJzLkFkZCgoKFRhYmxlQ2VsbClkYXRhR3JpZEl0ZW0uQ29udHJvbHNbMF0pLlRleHQsIFNxbERiVHlwZS5EZWNpbWFsKS5WYWx1ZSA9IGRlY2ltYWwiO2k6MTQxO3M6OTA6IlJlc3BvbnNlLldyaXRlKCI8YnI+KCApIDxhIGhyZWY9P3R5cGU9MSZmaWxlPSIgJiBzZXJ2ZXIuVVJMZW5jb2RlKGl0ZW0ucGF0aCkgJiAiXD4iICYgaXRlbSI7aToxNDI7czoxMTE6Im5ldyBGaWxlU3RyZWFtKFBhdGguQ29tYmluZShmaWxlSW5mby5EaXJlY3RvcnlOYW1lLCBQYXRoLkdldEZpbGVOYW1lKGh0dHBQb3N0ZWRGaWxlLkZpbGVOYW1lKSksIEZpbGVNb2RlLkNyZWF0ZSI7aToxNDM7czo3MToiUmVzcG9uc2UuV3JpdGUoU2VydmVyLkh0bWxFbmNvZGUodGhpcy5FeGVjdXRlQ29tbWFuZCh0eHRDb21tYW5kLlRleHQpKSkiO2k6MTQ0O3M6ODM6IjwlPVJlcXVlc3QuU2VydmVydmFyaWFibGVzKCJTQ1JJUFRfTkFNRSIpJT4/dHh0cGF0aD08JT1SZXF1ZXN0LlF1ZXJ5U3RyaW5nKCJ0eHRwYXRoIjtpOjE0NTtzOjYwOiJvdXRzdHIgKz0gc3RyaW5nLkZvcm1hdCgiPGEgaHJlZj0nP2ZkaXI9ezB9Jz57MX0vPC9hPiZuYnNwOyIiO2k6MTQ2O3M6MzM6InJlLmZpbmRhbGwoZGlydCsnKC4qKScscHJvZ25tKVswXSI7aToxNDc7czo0MDoiZmluZCAvIC1uYW1lIC5zc2ggPiAkZGlyL3NzaGtleXMvc3Noa2V5cyI7aToxNDg7czo2MDoiRlNfY2hrX2Z1bmNfbGliYz0oICQocmVhZGVsZiAtcyAkRlNfbGliYyB8IGdyZXAgX2Noa0BAIHwgYXdrIjtpOjE0OTtzOjQ5OiJMeTgzTVRnM09XUXlNVEprWXpoalltWTBaRFJtWkRBME5HRXpaREUzWmprM1ptSTJOIjtpOjE1MDtzOjk1OiIkZmlsZSA9ICRfRklMRVNbImZpbGVuYW1lIl1bIm5hbWUiXTsgZWNobyAiPGEgaHJlZj1cIiRmaWxlXCI+JGZpbGU8L2E+Ijt9IGVsc2Uge2VjaG8oImVtcHR5Iik7fSI7aToxNTE7czo0ODoiREo3VklVN1JJQ1hyNnNFRVYyY0J0SERTT2U5blZkcEVHaEVtdlJWUk5VUmZ3MXdRIjtpOjE1MjtzOjUxOiJMejhfTHk4dkR4OGVfdjctN3U3dTNzN3V6czdPenE2dW5xN2VycTZ1dnE1LWpvNnVqbjUiO2k6MTUzO3M6ODM6ImlWQk9SdzBLR2dvQUFBQU5TVWhFVWdBQUFBb0FBQUFJQ0FZQUFBREEtbTYyQUFBQUFYTlNSMElBcnM0YzZRQUFBQVJuUVUxQkFBQ3hqd3Y4WVFVIjtpOjE1NDtzOjUxOiJzZXJ2ZXIuPC9wPlxyXG48L2JvZHk+PC9odG1sPiI7ZXhpdDt9aWYocHJlZ19tYXRjaCgiO2k6MTU1O3M6Nzc6IiRGY2htb2QsJEZkYXRhLCRPcHRpb25zLCRBY3Rpb24sJGhkZGFsbCwkaGRkZnJlZSwkaGRkcHJvYywkdW5hbWUsJGlkZCk6c2hhcmVkIjtpOjE1NjtzOjE1OiJwaHAgIi4kd3NvX3BhdGgiO2k6MTU3O3M6NjE6IiRwcm9kPSJzeSIuInMiLiJ0ZW0iOyRpZD0kcHJvZCgkX1JFUVVFU1RbJ3Byb2R1Y3QnXSk7JHsnaWQnfTsiO2k6MTU4O3M6MzA6IkBhc3NlcnQoJF9SRVFVRVNUWydQSFBTRVNTSUQnXSI7aToxNTk7czo2ODoiUE9TVCB7JHBhdGh9eyRjb25uZWN0b3J9P0NvbW1hbmQ9RmlsZVVwbG9hZCZUeXBlPUZpbGUmQ3VycmVudEZvbGRlcj0iO2k6MTYwO3M6ODc6IiJhZG1pbjEucGhwIiwgImFkbWluMS5odG1sIiwgImFkbWluMi5waHAiLCAiYWRtaW4yLmh0bWwiLCAieW9uZXRpbS5waHAiLCAieW9uZXRpbS5odG1sIiI7aToxNjE7czo5NzoiQHBhdGgxPSgnYWRtaW4vJywnYWRtaW5pc3RyYXRvci8nLCdtb2RlcmF0b3IvJywnd2ViYWRtaW4vJywnYWRtaW5hcmVhLycsJ2JiLWFkbWluLycsJ2FkbWluTG9naW4vJyI7aToxNjI7czozNjoiY2F0ICR7YmxrbG9nWzJdfSB8IGdyZXAgInJvb3Q6eDowOjAiIjtpOjE2MztzOjQ2OiI/dXJsPScuJF9TRVJWRVJbJ0hUVFBfSE9TVCddKS51bmxpbmsoUk9PVF9ESVIuIjtpOjE2NDtzOjQ2OiJsb25nIGludDp0KDAsMyk9cigwLDMpOy0yMTQ3NDgzNjQ4OzIxNDc0ODM2NDc7IjtpOjE2NTtzOjc1OiJjcmVhdGVfZnVuY3Rpb24oIiYkIi4iZnVuY3Rpb24iLCIkIi4iZnVuY3Rpb24gPSBjaHIob3JkKCQiLiJmdW5jdGlvbiktMyk7IikiO2k6MTY2O3M6ODY6ImZ1bmN0aW9uIGdvb2dsZV9ib3QoKSB7JHNVc2VyQWdlbnQgPSBzdHJ0b2xvd2VyKCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSk7aWYoIShzdHJwIjtpOjE2NztzOjc0OiJjb3B5KCRfRklMRVNbJ3Vwa2snXVsndG1wX25hbWUnXSwia2svIi5iYXNlbmFtZSgkX0ZJTEVTWyd1cGtrJ11bJ25hbWUnXSkpOyI7aToxNjg7czo2NzoiZm9yICgkdmFsdWUpIHsgcy8mLyZhbXA7L2c7IHMvPC8mbHQ7L2c7IHMvPi8mZ3Q7L2c7IHMvIi8mcXVvdDsvZzsgfSI7aToxNjk7czo0MjoiJGRiX2QgPSBAbXlzcWxfc2VsZWN0X2RiKCRkYXRhYmFzZSwkY29uMSk7IjtpOjE3MDtzOjUxOiJTZW5kIHRoaXMgZmlsZTogPElOUFVUIE5BTUU9InVzZXJmaWxlIiBUWVBFPSJmaWxlIj4iO2k6MTcxO3M6MjI6ImZ3cml0ZSAoJGZwLCAiJHlhemkiKTsiO2k6MTcyO3M6NTI6Im1hcCB7IHJlYWRfc2hlbGwoJF8pIH0gKCRzZWxfc2hlbGwtPmNhbl9yZWFkKDAuMDEpKTsiO2k6MTczO3M6Mjc6IjI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOyI7aToxNzQ7czo1OToiZ2xvYmFsICRteXNxbEhhbmRsZSwgJGRibmFtZSwgJHRhYmxlbmFtZSwgJG9sZF9uYW1lLCAkbmFtZSwiO2k6MTc1O3M6Njk6Il9fYWxsX18gPSBbIlNNVFBTZXJ2ZXIiLCJEZWJ1Z2dpbmdTZXJ2ZXIiLCJQdXJlUHJveHkiLCJNYWlsbWFuUHJveHkiXSI7aToxNzY7czoyOToiaWYgKGlzX2ZpbGUoIi90bXAvJGVraW5jaSIpKXsiO2k6MTc3O3M6Mzg6ImlmKCRjbWQgIT0gIiIpIHByaW50IFNoZWxsX0V4ZWMoJGNtZCk7IjtpOjE3ODtzOjI2OiIkY21kID0gKCRfUkVRVUVTVFsnY21kJ10pOyI7aToxNzk7czo1NToiJHVwbG9hZGZpbGUgPSAkcnBhdGguIi8iIC4gJF9GSUxFU1sndXNlcmZpbGUnXVsnbmFtZSddOyI7aToxODA7czozMzoiaWYgKCRmdW5jYXJnID1+IC9ecG9ydHNjYW4gKC4qKS8pIjtpOjE4MTtzOjQ2OiI8JSBGb3IgRWFjaCBWYXJzIEluIFJlcXVlc3QuU2VydmVyVmFyaWFibGVzICU+IjtpOjE4MjtzOjQ4OiJpZignJz09KCRkZj1AaW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKSkpe2VjaG8iO2k6MTgzO3M6Mzg6IiRmaWxlbmFtZSA9ICRiYWNrdXBzdHJpbmcuIiRmaWxlbmFtZSI7IjtpOjE4NDtzOjI0OiIkZnVuY3Rpb24oJF9QT1NUWydjbWQnXSkiO2k6MTg1O3M6Mjk6ImVjaG8gIkZJTEUgVVBMT0FERUQgVE8gJGRleiI7IjtpOjE4NjtzOjY4OiJpZiAoIUBpc19saW5rKCRmaWxlKSAmJiAoJHIgPSByZWFscGF0aCgkZmlsZSkpICE9IEZBTFNFKSAkZmlsZSA9ICRyOyI7aToxODc7czo4NzoiVU5JT04gU0VMRUNUICcwJyAsICc8PyBzeXN0ZW0oXCRfR0VUW2NwY10pO2V4aXQ7ID8+JyAsMCAsMCAsMCAsMCBJTlRPIE9VVEZJTEUgJyRvdXRmaWxlIjtpOjE4ODtzOjg5OiJpZihtb3ZlX3VwbG9hZGVkX2ZpbGUoJF9GSUxFU1siZmljIl1bInRtcF9uYW1lIl0sZ29vZF9saW5rKCIuLyIuJF9GSUxFU1siZmljIl1bIm5hbWUiXSkpKSI7aToxODk7czo3MjoiY29ubmVjdChTT0NLRVQsIHNvY2thZGRyX2luKCRBUkdWWzFdLCBpbmV0X2F0b24oJEFSR1ZbMF0pKSkgb3IgZGllIHByaW50IjtpOjE5MDtzOjUyOiJlbHNlaWYoQGlzX3dyaXRhYmxlKCRGTikgJiYgQGlzX2ZpbGUoJEZOKSkgJHRtcE91dE1GIjtpOjE5MTtzOjY4OiJ3aGlsZSAoJHJvdyA9IG15c3FsX2ZldGNoX2FycmF5KCRyZXN1bHQsTVlTUUxfQVNTT0MpKSBwcmludF9yKCRyb3cpOyI7aToxOTI7czoxODoiJGZlKCIkY21kICAyPiYxIik7IjtpOjE5MztzOjY5OiJzZW5kKFNPQ0s1LCAkbXNnLCAwLCBzb2NrYWRkcl9pbigkcG9ydGEsICRpYWRkcikpIGFuZCAkcGFjb3Rlc3tvfSsrOzsiO2k6MTk0O3M6Njk6In0gZWxzaWYgKCRzZXJ2YXJnID1+IC9eXDooLis/KVwhKC4rPylcQCguKz8pIFBSSVZNU0cgKC4rPykgXDooLispLykgeyI7aToxOTU7czozNzoiZWxzZWlmKGZ1bmN0aW9uX2V4aXN0cygic2hlbGxfZXhlYyIpKSI7aToxOTY7czo3MToic3lzdGVtKCIkY21kIDE+IC90bXAvY21kdGVtcCAyPiYxOyBjYXQgL3RtcC9jbWR0ZW1wOyBybSAvdG1wL2NtZHRlbXAiKTsiO2k6MTk3O3M6NTI6IiRfRklMRVNbJ3Byb2JlJ11bJ3NpemUnXSwgJF9GSUxFU1sncHJvYmUnXVsndHlwZSddKTsiO2k6MTk4O3M6ODc6IiRyYTQ0ICA9IHJhbmQoMSw5OTk5OSk7JHNqOTggPSAic2gtJHJhNDQiOyRtbCA9ICIkc2Q5OCI7JGE1ID0gJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOyI7aToxOTk7czo2NjoibXlzcWxfcXVlcnkoIkNSRUFURSBUQUJMRSBgeHBsb2l0YCAoYHhwbG9pdGAgTE9OR0JMT0IgTk9UIE5VTEwpIik7IjtpOjIwMDtzOjY2OiJwYXNzdGhydSggJGJpbmRpci4ibXlzcWxkdW1wIC0tdXNlcj0kVVNFUk5BTUUgLS1wYXNzd29yZD0kUEFTU1dPUkQiO2k6MjAxO3M6ODQ6IjxhIGhyZWY9JyRQSFBfU0VMRj9hY3Rpb249dmlld1NjaGVtYSZkYm5hbWU9JGRibmFtZSZ0YWJsZW5hbWU9JHRhYmxlbmFtZSc+U2NoZW1hPC9hPiI7aToyMDI7czo2MDoiaWYoZ2V0X21hZ2ljX3F1b3Rlc19ncGMoKSkkc2hlbGxPdXQ9c3RyaXBzbGFzaGVzKCRzaGVsbE91dCk7IjtpOjIwMztzOjQ3OiJpZiAoIWRlZmluZWQkcGFyYW17Y21kfSl7JHBhcmFte2NtZH09ImxzIC1sYSJ9OyI7aToyMDQ7czoyMzoic2hlbGxfZXhlYygndW5hbWUgLWEnKTsiO2k6MjA1O3M6OTE6ImlmIChtb3ZlX3VwbG9hZGVkX2ZpbGUoJF9GSUxFU1snZmlsYSddWyd0bXBfbmFtZSddLCAkY3VyZGlyLiIvIi4kX0ZJTEVTWydmaWxhJ11bJ25hbWUnXSkpIHsiO2k6MjA2O3M6ODM6ImlmIChlbXB0eSgkX1BPU1RbJ3dzZXInXSkpIHskd3NlciA9ICJ3aG9pcy5yaXBlLm5ldCI7fSBlbHNlICR3c2VyID0gJF9QT1NUWyd3c2VyJ107IjtpOjIwNztzOjM2OiI8JT1lbnYucXVlcnlIYXNodGFibGUoInVzZXIubmFtZSIpJT4iO2k6MjA4O3M6NjE6IlB5U3lzdGVtU3RhdGUuaW5pdGlhbGl6ZShTeXN0ZW0uZ2V0UHJvcGVydGllcygpLCBudWxsLCBhcmd2KTsiO2k6MjA5O3M6MzU6ImlmKCEkd2hvYW1pKSR3aG9hbWk9ZXhlYygid2hvYW1pIik7IjtpOjIxMDtzOjM2OiJzaGVsbF9leGVjKCRfUE9TVFsnY21kJ10gLiAiIDI+JjEiKTsiO2k6MjExO3M6NTM6IlBuVmxrV002MyFAI0AmZEt4fm5NRFdNfkR/L0Vzbn54fzZEQCNAJlB+fiw/blksV1B7UG9qIjtpOjIxMjtzOjI1OiIhJF9SRVFVRVNUWyJjOTlzaF9zdXJsIl0pIjtpOjIxMztzOjYwOiIoZXJlZygnXltbOmJsYW5rOl1dKmNkW1s6Ymxhbms6XV0qJCcsICRfUkVRVUVTVFsnY29tbWFuZCddKSkiO2k6MjE0O3M6MjM6IiRsb2dpbj1AcG9zaXhfZ2V0dWlkKCk7IjtpOjIxNTtzOjM4OiJzeXN0ZW0oInVuc2V0IEhJU1RGSUxFOyB1bnNldCBTQVZFSElTVCI7aToyMTY7czozMToiPEhUTUw+PEhFQUQ+PFRJVExFPmNnaS1zaGVsbC5weSI7aToyMTc7czozNjoiZXhlY2woIi9iaW4vc2giLCJzaCIsIi1pIiwoY2hhciopMCk7IjtpOjIxODtzOjI2OiJuY2Z0cHB1dCAtdSAkZnRwX3VzZXJfbmFtZSI7aToyMTk7czoyOToiJGFbaGl0c10nKTsgXHJcbiNlbmRxdWVyeVxyXG4iO2k6MjIwO3M6MjM6Inske3Bhc3N0aHJ1KCRjbWQpfX08YnI+IjtpOjIyMTtzOjQyOiIkYmFja2Rvb3ItPmNjb3B5KCRjZmljaGllciwkY2Rlc3RpbmF0aW9uKTsiO2k6MjIyO3M6NTk6IiRpemlubGVyMj1zdWJzdHIoYmFzZV9jb252ZXJ0KEBmaWxlcGVybXMoJGZuYW1lKSwxMCw4KSwtNCk7IjtpOjIyMztzOjUwOiJmb3IoOyRwYWRkcj1hY2NlcHQoQ0xJRU5ULCBTRVJWRVIpO2Nsb3NlIENMSUVOVCkgeyI7aToyMjQ7czo4OiJBc21vZGV1cyI7aToyMjU7czozNzoicGFzc3RocnUoZ2V0ZW52KCJIVFRQX0FDQ0VQVF9MQU5HVUFHRSI7aToyMjY7czozOToiJF9fX189QGd6aW5mbGF0ZSgkX19fXykpe2lmKGlzc2V0KCRfUE9TIjtpOjIyNztzOjg1OiIkc3Viaj11cmxkZWNvZGUoJF9HRVRbJ3N1J10pOyRib2R5PXVybGRlY29kZSgkX0dFVFsnYm8nXSk7JHNkcz11cmxkZWNvZGUoJF9HRVRbJ3NkJ10pIjtpOjIyODtzOjMyOiIka2E9Jzw/Ly9CUkUnOyRrYWthPSRrYS4nQUNLLy8/PiI7aToyMjk7czozMToiQ2F1dGFtIGZpc2llcmVsZSBkZSBjb25maWd1cmFyZSI7aToyMzA7czoxMjoiQlJVVEVGT1JDSU5HIjtpOjIzMTtzOjE4OiJwd2QgPiBHZW5lcmFzaS5kaXIiO2k6MjMyO3M6NTY6InhoIC1zICIvdXNyL2xvY2FsL2FwYWNoZS9zYmluL2h0dHBkIC1EU1NMIiAuL2h0dHBkIC1tICQxIjtpOjIzMztzOjQ4OiIkYT0oc3Vic3RyKHVybGVuY29kZShwcmludF9yKGFycmF5KCksMSkpLDUsMSkuYykiO2k6MjM0O3M6MjE6IiFAJF9DT09LSUVbJHNlc3NkdF9rXSI7aToyMzU7czo1ODoiU0VMRUNUIDEgRlJPTSBteXNxbC51c2VyIFdIRVJFIGNvbmNhdChgdXNlcmAsICdAJywgYGhvc3RgKSI7aToyMzY7czo0NDoiY29weSgkX0ZJTEVTW3hdW3RtcF9uYW1lXSwkX0ZJTEVTW3hdW25hbWVdKSkiO2k6MjM3O3M6NTQ6IiRNZXNzYWdlU3ViamVjdCA9IGJhc2U2NF9kZWNvZGUoJF9QT1NUWyJtc2dzdWJqZWN0Il0pOyI7aToyMzg7czoxNzoicmVuYW1lKCJ3c28ucGhwIiwiO2k6MjM5O3M6ODg6IiRyZWRpcmVjdFVSTD0naHR0cDovLycuJHJTaXRlLiRfU0VSVkVSWydSRVFVRVNUX1VSSSddO2lmKGlzc2V0KCRfU0VSVkVSWydIVFRQX1JFRkVSRVInXSkiO2k6MjQwO3M6NDA6IiRmaWxlcGF0aD1AcmVhbHBhdGgoJF9QT1NUWydmaWxlcGF0aCddKTsiO2k6MjQxO3M6NDI6Ildvcmtlcl9HZXRSZXBseUNvZGUoJG9wRGF0YVsncmVjdkJ1ZmZlciddKSI7aToyNDI7czoyMToiRmFUYUxpc1RpQ3pfRnggRngyOVNoIjtpOjI0MztzOjEzOiJ3NGNrMW5nIHNoZWxsIjtpOjI0NDtzOjIyOiJwcml2YXRlIFNoZWxsIGJ5IG00cmNvIjtpOjI0NTtzOjIwOiJTaGVsbCBieSBNYXdhcl9IaXRhbSI7aToyNDY7czoxMjoiUEhQU0hFTEwuUEhQIjtpOjI0NztzOjQ2OiJyb3VuZCgwKzk4MzAuNCs5ODMwLjQrOTgzMC40Kzk4MzAuNCs5ODMwLjQpKT09IjtpOjI0ODtzOjExMDoidnp2NmQraU92dGtkMzhUbEh1OG1RYXZYZG5KQ2JwUWNwWGhOYmJMbVpPcU1vcERaZU5hbGIrVktsZWRoQ2pwVkFNUVNRbnhWSUVDUUFmTHU1S2dMbXdCNmVoUVFHTlNCWWpwZzlnNUdkQmloWG8iO2k6MjQ5O3M6NjU6ImlmIChlcmVnKCdeW1s6Ymxhbms6XV0qY2RbWzpibGFuazpdXSsoW147XSspJCcsICRjb21tYW5kLCAkcmVncykpIjtpOjI1MDtzOjc2OiJMUzBnUkhWdGNETmtJR0o1SUZCcGNuVnNhVzR1VUVoUUlGZGxZbk5vTTJ4c0lIWXhMakFnWXpCa1pXUWdZbmtnY2pCa2NqRWdPa3c9IjtpOjI1MTtzOjE0MjoiNWpiMjBpS1c5eUlITjBjbWx6ZEhJb0pISmxabVZ5WlhJc0ltRndiM0owSWlrZ2IzSWdjM1J5YVhOMGNpZ2tjbVZtWlhKbGNpd2libWxuYldFaUtTQnZjaUJ6ZEhKcGMzUnlLQ1J5WldabGNtVnlMQ0ozWldKaGJIUmhJaWtnYjNJZ2MzUnlhWE4wY2lnayI7aToyNTI7czo0ODoid3NvRXgoJ3RhciBjZnp2ICcgLiBlc2NhcGVzaGVsbGFyZygkX1BPU1RbJ3AyJ10pIjtpOjI1MztzOjg2OiI8bm9icj48Yj4kY2RpciRjZmlsZTwvYj4gKCIuJGZpbGVbInNpemVfc3RyIl0uIik8L25vYnI+PC90ZD48L3RyPjxmb3JtIG5hbWU9Y3Vycl9maWxlPiI7aToyNTQ7czoxNjoiQ29udGVudC1UeXBlOiAkXyI7aToyNTU7czoxNDE6IjwvdGQ+PHRkIGlkPWZhPlsgPGEgdGl0bGU9XCJIb21lOiAnIi5odG1sc3BlY2lhbGNoYXJzKHN0cl9yZXBsYWNlKCJcIiwgJHNlcCwgZ2V0Y3dkKCkpKS4iJy5cIiBpZD1mYSBocmVmPVwiamF2YXNjcmlwdDpWaWV3RGlyKCciLnJhd3VybGVuY29kZSI7aToyNTY7czoxMDc6IkNRYm9HbDdmK3hjQXlVeXN4YjVtS1M2a0FXc25STGRTK3NLZ0dvWldkc3dMRkpaVjh0VnpYc3ErbWVTUEhNeFRJM25TVUI0ZkoydlIzcjNPbnZYdE5BcU42d24vRHRUVGkrQ3UxVU9Kd05MIjtpOjI1NztzOjM5OiJXU09zZXRjb29raWUobWQ1KCRfU0VSVkVSWydIVFRQX0hPU1QnXSkiO2k6MjU4O3M6MTI2OiJYMU5GVTFOSlQwNWJKM1I0ZEdGMWRHaHBiaWRkSUQwZ2RISjFaVHNOQ2lBZ0lDQnBaaUFvSkY5UVQxTlVXeWR5YlNkZEtTQjdEUW9nSUNBZ0lDQnpaWFJqYjI5cmFXVW9KM1I0ZEdGMWRHaGZKeTRrY20xbmNtOTFjQ3dnYlciO2k6MjU5O3M6Mzk6IkpAIVZyQComUkhSd35KTHcuR3x4bGhuTEp+PzEuYndPYnhiUHwhViI7aToyNjA7czoxMToiemVoaXJoYWNrZXIiO2k6MjYxO3M6MTYxOiIoJyInLCcmcXVvdDsnLCRmbikpLiciO2RvY3VtZW50Lmxpc3Quc3VibWl0KCk7XCc+Jy5odG1sc3BlY2lhbGNoYXJzKHN0cmxlbigkZm4pPmZvcm1hdD9zdWJzdHIoJGZuLDAsZm9ybWF0LTMpLicuLi4nOiRmbikuJzwvYT4nLnN0cl9yZXBlYXQoJyAnLGZvcm1hdC1zdHJsZW4oJGZuKSI7aToyNjI7czoxNjA6InByaW50KChpc19yZWFkYWJsZSgkZikgJiYgaXNfd3JpdGVhYmxlKCRmKSk/Ijx0cj48dGQ+Ii53KDEpLmIoIlIiLncoMSkuZm9udCgncmVkJywnUlcnLDMpKS53KDEpOigoKGlzX3JlYWRhYmxlKCRmKSk/Ijx0cj48dGQ+Ii53KDEpLmIoIlIiKS53KDQpOiIiKS4oKGlzX3dyaXRhYmwiO2k6MjYzO3M6NzM6IlIwbEdPRGxoRkFBVUFLSUFBQUFBQVAvLy85M2QzY0RBd0lhR2hnUUVCUC8vL3dBQUFDSDVCQUVBQUFZQUxBQUFBQUFVQUJRQUEiO2k6MjY0O3M6OTA6IjwlPVJlcXVlc3QuU2VydmVyVmFyaWFibGVzKCJzY3JpcHRfbmFtZSIpJT4/Rm9sZGVyUGF0aD08JT1TZXJ2ZXIuVVJMUGF0aEVuY29kZShGb2xkZXIuRHJpdiI7aToyNjU7czoxMTM6Im05MWRDd2dKR1Z2ZFhRcE93MEtjMlZzWldOMEtDUnliM1YwSUQwZ0pISnBiaXdnZFc1a1pXWXNJQ1JsYjNWMElEMGdKSEpwYml3Z01USXdLVHNOQ21sbUlDZ2hKSEp2ZFhRZ0lDWW1JQ0FoSkdWdmRYIjtpOjI2NjtzOjM4OiJSb290U2hlbGwhJyk7c2VsZi5sb2NhdGlvbi5ocmVmPSdodHRwOiI7aToyNjc7czo3NjoiYSBocmVmPSI8P2VjaG8gIiRmaXN0aWsucGhwP2RpemluPSRkaXppbi8uLi8iPz4iIHN0eWxlPSJ0ZXh0LWRlY29yYXRpb246IG5vbiI7aToyNjg7czoxMjc6IkNCMmFUWnBJREV3TWpRdERRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUTBLSTNKbGNYVnAiO2k6MjY5O3M6MTIyOiJudCkoZGlza190b3RhbF9zcGFjZShnZXRjd2QoKSkvKDEwMjQqMTAyNCkpIC4gIk1iICIgLiAiRnJlZSBzcGFjZSAiIC4gKGludCkoZGlza19mcmVlX3NwYWNlKGdldGN3ZCgpKS8oMTAyNCoxMDI0KSkgLiAiTWIgPCI7aToyNzA7czozNzoia2xhc3ZheXYuYXNwP3llbmlkb3N5YT08JT1ha3RpZmtsYXMlPiI7aToyNzE7czo0NDoiV1QrUHt+RVcwRXJQT3RuVUAjQCZebF5zUDFsZG55QCNAJm5zaytyMCxHVCsiO2k6MjcyO3M6MTE1OiJtcHR5KCRfUE9TVFsndXInXSkpICRtb2RlIHw9IDA0MDA7IGlmICghZW1wdHkoJF9QT1NUWyd1dyddKSkgJG1vZGUgfD0gMDIwMDsgaWYgKCFlbXB0eSgkX1BPU1RbJ3V4J10pKSAkbW9kZSB8PSAwMTAwIjtpOjI3MztzOjEwNToiLzB0VlNHL1N1djBVci9oYVVZQWRuM2pNUXdiYm9jR2ZmQWVDMjlCTjl0bUJpSmRWMWxrK2pZRFU5MkM5NGpkdERpZit4T1lqRzZDTGh4MzFVbzl4OS9lQVdnc0JLNjBrSzJtTHdxenFkIjtpOjI3NDtzOjg2OiJjcmxmLid1bmxpbmsoJG5hbWUpOycuJGNybGYuJ3JlbmFtZSgifiIuJG5hbWUsICRuYW1lKTsnLiRjcmxmLid1bmxpbmsoImdycF9yZXBhaXIucGhwIiI7aToyNzU7czoxNToiRFhfSGVhZGVyX2RyYXduIjtpOjI3NjtzOjMwOiJbQXY0YmZDWUNTLHhLV2skK1RrVVMseG5HZEF4W08iO2k6Mjc3O3M6MTE6ImN0c2hlbGwucGhwIjtpOjI3ODtzOjQ3OiJFeGVjdXRlZCBjb21tYW5kOiA8Yj48Zm9udCBjb2xvcj0jZGNkY2RjPlskY21kXSI7aToyNzk7czoxMzoiV1NDUklQVC5TSEVMTCI7aToyODA7czo3OiJjYXN1czE1IjtpOjI4MTtzOjE3OiJhZG1pbkBzcHlncnVwLm9yZyI7aToyODI7czoxNDoidGVtcF9yNTdfdGFibGUiO2k6MjgzO3M6MTc6IiRjOTlzaF91cGRhdGVmdXJsIjtpOjI4NDtzOjk6IkJ5IFBzeWNoMCI7aToyODU7czoxNjoiYzk5ZnRwYnJ1dGVjaGVjayI7aToyODY7czo4NDoiPHRleHRhcmVhIG5hbWU9XCJwaHBldlwiIHJvd3M9XCI1XCIgY29scz1cIjE1MFwiPiIuQCRfUE9TVFsncGhwZXYnXS4iPC90ZXh0YXJlYT48YnI+IjtpOjI4NztzOjMwOiIkcmFuZF93cml0YWJsZV9mb2xkZXJfZnVsbHBhdGgiO2k6Mjg4O3M6MTA6IkRyLmFib2xhbGgiO2k6Mjg5O3M6NjoiSyFMTDNyIjtpOjI5MDtzOjc6Ik1ySGF6ZW0iO2k6MjkxO3M6MTA6IkMwZGVyei5jb20iO2k6MjkyO3M6MjY6Ik9MQjpQUk9EVUNUOk9OTElORV9CQU5LSU5HIjtpOjI5MztzOjEwOiJCWSBNTU5CT0JaIjtpOjI5NDtzOjE2OiJDb25uZWN0QmFja1NoZWxsIjtpOjI5NTtzOjg6IkhhY2tlYWRvIjtpOjI5NjtzOjU6ImQzYn5YIjtpOjI5NztzOjU6InJhaHVpIjtpOjI5ODtzOjk6Ik1yLkhpVG1hbiI7aToyOTk7czoxMzoiU0VvRE9SLUNsaWVudCI7aTozMDA7czoxMDoiTXJsb29sLmV4ZSI7aTozMDE7czoyNzoiU21hbGwgUEhQIFdlYiBTaGVsbCBieSBaYUNvIjtpOjMwMjtzOjMzOiJOZXR3b3JrRmlsZU1hbmFnZXJQSFAgZm9yIGNoYW5uZWwiO2k6MzAzO3M6MTM6IldTTzIgV2Vic2hlbGwiO2k6MzA0O3M6MTI6IldlYiBTaGVsbCBieSI7aTozMDU7czozMjoiV2F0Y2ggWW91ciBzeXN0ZW0gU2hhbnkgd2FzIGhlcmUiO2k6MzA2O3M6Mjg6ImRldmVsb3BlZCBieSBEaWdpdGFsIE91dGNhc3QiO2k6MzA3O3M6MTE6IldlYkNvbnRyb2xzIjtpOjMwODtzOjEzOiJ3NGNrMW5nIHNoZWxsIjtpOjMwOTtzOjk6IlczRCBTaGVsbCI7aTozMTA7czo5OiJUaGVfQmVLaVIiO2k6MzExO3M6MTE6IlN0b3JtN1NoZWxsIjtpOjMxMjtzOjEzOiJTU0kgd2ViLXNoZWxsIjtpOjMxMztzOjIwOiJTaGVsbCBieSBNYXdhcl9IaXRhbSI7aTozMTQ7czoyNToiU2ltb3JnaCBTZWN1cml0eSBNYWdhemluZSI7aTozMTU7czoxOToiRy1TZWN1cml0eSBXZWJzaGVsbCI7aTozMTY7czoyNToiU2ltcGxlIFBIUCBiYWNrZG9vciBieSBESyI7aTozMTc7czoxNzoiU2FyYXNhT24gU2VydmljZXMiO2k6MzE4O3M6MjA6IlNhZmVfTW9kZSBCeXBhc3MgUEhQIjtpOjMxOTtzOjEwOiJDckB6eV9LaW5nIjtpOjMyMDtzOjIxOiJLQWRvdCBVbml2ZXJzYWwgU2hlbGwiO2k6MzIxO3M6MTY6IlJ1MjRQb3N0V2ViU2hlbGwiO2k6MzIyO3M6MjA6InJlYWxhdXRoPVN2QkQ4NWRJTnUzIjtpOjMyMztzOjE1OiJyZ29kYHMgd2Vic2hlbGwiO2k6MzI0O3M6MTM6InI1N3NoZWxsXC5waHAiO2k6MzI1O3M6NjoiUjU3U3FsIjtpOjMyNjtzOjU6InIwbmluIjtpOjMyNztzOjIyOiJwcml2YXRlIFNoZWxsIGJ5IG00cmNvIjtpOjMyODtzOjIyOiJQcmVzcyBPSyB0byBlbnRlciBzaXRlIjtpOjMyOTtzOjI2OiJQUFMgMS4wIHBlcmwtY2dpIHdlYiBzaGVsbCI7aTozMzA7czo2OiJQSFZheXYiO2k6MzMxO3M6MzU6IlBIUCBTaGVsbCBpcyBhbmludGVyYWN0aXZlIFBIUC1wYWdlIjtpOjMzMjtzOjEzOiJwaHBSZW1vdGVWaWV3IjtpOjMzMztzOjIwOiJQSFAgSFZBIFNoZWxsIFNjcmlwdCI7aTozMzQ7czo5OiJQSFBKYWNrYWwiO2k6MzM1O3M6MzE6Ik5ld3MgUmVtb3RlIFBIUCBTaGVsbCBJbmplY3Rpb24iO2k6MzM2O3M6MjA6IkxPVEZSRUUgUEhQIEJhY2tkb29yIjtpOjMzNztzOjIxOiJhIHNpbXBsZSBwaHAgYmFja2Rvb3IiO2k6MzM4O3M6MjE6IlBJUkFURVMgQ1JFVyBXQVMgSEVSRSI7aTozMzk7czoxODoiUEhBTlRBU01BLSBOZVcgQ21EIjtpOjM0MDtzOjI2OiJPIEJpUiBLUkFMIFRBS0xpVCBFRGlsRU1FWiI7aTozNDE7czoyMDoiTklYIFJFTU9URSBXRUItU0hFTEwiO2k6MzQyO3M6MjE6Ik5ldHdvcmtGaWxlTWFuYWdlclBIUCI7aTozNDM7czo3OiJOZW9IYWNrIjtpOjM0NDtzOjE2OiJIYWNrZWQgYnkgU2lsdmVyIjtpOjM0NTtzOjg6Ik4zdHNoZWxsIjtpOjM0NjtzOjE0OiJNeVNRTCBXZWJzaGVsbCI7aTozNDc7czoyNzoiTXlTUUwgV2ViIEludGVyZmFjZSBWZXJzaW9uIjtpOjM0ODtzOjE5OiJNeVNRTCBXZWIgSW50ZXJmYWNlIjtpOjM0OTtzOjk6Ik15U1FMIFJTVCI7aTozNTA7czoxNToiJE15U2hlbGxWZXJzaW9uIjtpOjM1MTtzOjE2OiJNb3JvY2NhbiBTcGFtZXJzIjtpOjM1MjtzOjEwOiJNYXRhbXUgTWF0IjtpOjM1MztzOjU6Im0waHplIjtpOjM1NDtzOjY6Im0wcnRpeCI7aTozNTU7czo1MDoiT3BlbiB0aGUgZmlsZSBhdHRhY2htZW50IGlmIGFueSwgYW5kIGJhc2U2NF9lbmNvZGUiO2k6MzU2O3M6MTA6Ik1hdGFtdSBNYXQiO2k6MzU3O3M6MzY6Ik1vcm9jY2FuIFNwYW1lcnMgTWEtRWRpdGlvTiBCeSBHaE9zVCI7aTozNTg7czoxMToiTG9jdXM3U2hlbGwiO2k6MzU5O3M6NzoiTGl6MHppTSI7aTozNjA7czo5OiJLQV91U2hlbGwiO2k6MzYxO3M6MTE6ImlNSGFCaVJMaUdpIjtpOjM2MjtzOjMyOiJIYWNrZXJsZXIgVnVydXIgTGFtZXJsZXIgU3VydW51ciI7aTozNjM7czoxNzoiSEFDS0VEIEJZIFJFQUxXQVIiO2k6MzY0O3M6MjU6IkhhY2tlZCBCeSBEZXZyLWkgTWVmc2VkZXQiO2k6MzY1O3M6Mjk6Img0bnR1IHNoZWxsIFtwb3dlcmVkIGJ5IHRzb2ldIjtpOjM2NjtzOjEzOiJHcmluYXkgR28wbyRFIjtpOjM2NztzOjE0OiJHb29nMWVfYW5hbGlzdCI7aTozNjg7czoxMToiR0hDIE1hbmFnZXIiO2k6MzY5O3M6MTM6IkdGUyBXZWItU2hlbGwiO2k6MzcwO3M6MjI6InRoaXMgaXMgYSBwcml2MyBzZXJ2ZXIiO2k6MzcxO3M6Mjc6Ikx1dGZlbiBEb3N5YXlpIEFkbGFuZGlyaW5peiI7aTozNzI7czoyMToiRmFUYUxpc1RpQ3pfRnggRngyOVNoIjtpOjM3MztzOjIwOiJGaXhlZCBieSBBcnQgT2YgSGFjayI7aTozNzQ7czoyMDoiRW1wZXJvciBIYWNraW5nIFRFQU0iO2k6Mzc1O3M6MzI6IkNvbWFuZG9zIEV4Y2x1c2l2b3MgZG8gRFRvb2wgUHJvIjtpOjM3NjtzOjE1OiJEZXZyLWkgTWVmc2VkZXQiO2k6Mzc3O3M6MzM6IkRpdmUgU2hlbGwgLSBFbXBlcm9yIEhhY2tpbmcgVGVhbSI7aTozNzg7czoyNDoiU2hlbGwgd3JpdHRlbiBieSBCbDBvZDNyIjtpOjM3OTtzOjEzOiJEYXJrRGV2aWx6LmlOIjtpOjM4MDtzOjc6ImQwbWFpbnMiO2k6MzgxO3M6MTE6IkN5YmVyIFNoZWxsIjtpOjM4MjtzOjIzOiJURUFNIFNDUklQVElORyAtIFJPRE5PQyI7aTozODM7czoxMjoiQ3J5c3RhbFNoZWxsIjtpOjM4NDtzOjM4OiJDb2RlZCBieSA6IFN1cGVyLUNyeXN0YWwgYW5kIE1vaGFqZXIyMiI7aTozODU7czoyMjoiY29va2llbmFtZSA9ICJ3aWVlZWVlIiI7aTozODY7czo5OiJDOTkgU2hlbGwiO2k6Mzg3O3M6MTc6IiRjOTlzaF91cGRhdGVmdXJsIjtpOjM4ODtzOjIyOiJDOTkgTW9kaWZpZWQgQnkgUHN5Y2gwIjtpOjM4OTtzOjk6ImMyMDA3LnBocCI7aTozOTA7czozMDoiV3JpdHRlbiBieSBDYXB0YWluIENydW5jaCBUZWFtIjtpOjM5MTtzOjExOiJkZXZpbHpTaGVsbCI7aTozOTI7czoxMjoiQlkgaVNLT1JQaVRYIjtpOjM5MztzOjc6IkJsMG9kM3IiO2k6Mzk0O3M6MjI6IkNvZGVkIEJ5IENoYXJsaWNoYXBsaW4iO2k6Mzk1O3M6OToiYVpSYWlMUGhQIjtpOjM5NjtzOjE2OiJBU1BYIFNoZWxsIGJ5IExUIjtpOjM5NztzOjEyOiJBTEVNaU4gS1JBTGkiO2k6Mzk4O3M6MTQ6IkFudGljaGF0IHNoZWxsIjtpOjM5OTtzOjY6IjB4ZGQ4MiI7aTo0MDA7czo5OiJ+IFNoZWxsIEkiO2k6NDAxO3M6MTQ6Il9zaGVsbF9hdGlsZGlfIjtpOjQwMjtzOjExOiJQLmgucC5TLnAueSI7aTo0MDM7czoxMDoiMS4xNzkuMjQ5LiI7aTo0MDQ7czoxMToiNjQuMjMzLjE2MC4iO2k6NDA1O3M6OToiNjQuNjguODAuIjtpOjQwNjtzOjExOiIyMTYuMjM5LjMyLiI7fQ=="));
$gX_DBShe = unserialize(base64_decode("YTo1MTp7aTowO3M6MTU6IkRhcmtDcmV3RnJpZW5kcyI7aToxO3M6MTE6IlNpbUF0dGFja2VyIjtpOjI7czoxMjoiXVtyb3VuZCgwKV0oIjtpOjM7czozMjoiPCEtLSNleGVjIGNtZD0iJEhUVFBfQUNDRVBUIiAtLT4iO2k6NDtzOjQ6IkFtIXIiO2k6NTtzOjg6Iltjb2RlcnpdIjtpOjY7czoxMToiWyBQaHByb3h5IF0iO2k6NztzOjY6IlNwYW1lciI7aTo4O3M6NzoiRGVmYWNlciI7aTo5O3M6MTE6IkRldmlsSGFja2VyIjtpOjEwO3M6Nzoid2VicjAwdCI7aToxMTtzOjY6ImswZC5jYyI7aToxMjtzOjU1OiJpc19jYWxsYWJsZSgnZXhlYycpIGFuZCAhaW5fYXJyYXkoJ2V4ZWMnLCAkZGlzYWJsZWZ1bmNzIjtpOjEzO3M6MTQ6IiRHTE9CQUxTWydfX19fIjtpOjE0O3M6MTg6ImlzX3dyaXRhYmxlKCIvdmFyLyI7aToxNTtzOjIzOiJldmFsKGZpbGVfZ2V0X2NvbnRlbnRzKCI7aToxNjtzOjM0OiIvcHJvYy9zeXMva2VybmVsL3lhbWEvcHRyYWNlX3Njb3BlIjtpOjE3O3M6NDk6IidodHRwZC5jb25mJywndmhvc3RzLmNvbmYnLCdjZmcucGhwJywnY29uZmlnLnBocCciO2k6MTg7czo3OiJicjB3czNyIjtpOjE5O3M6NzoibWlsdzBybSI7aToyMDtzOjM2OiJpbmNsdWRlKCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSkiO2k6MjE7czoxMDoiZGlyIC9PRyAvWCI7aToyMjtzOjM0OiJpZiAoKCRwZXJtcyAmIDB4QzAwMCkgPT0gMHhDMDAwKSB7IjtpOjIzO3M6NTk6ImlmIChpc19jYWxsYWJsZSgiZXhlYyIpIGFuZCAhaW5fYXJyYXkoImV4ZWMiLCRkaXNhYmxlZnVuYykpIjtpOjI0O3M6NDA6InNldGNvb2tpZSggIm15c3FsX3dlYl9hZG1pbl91c2VybmFtZSIgKTsiO2k6MjU7czoxOToicHJpbnQgIlNwYW1lZCc+PGJyPiI7aToyNjtzOjUxOiIkbWVzc2FnZSA9IGVyZWdfcmVwbGFjZSgiJTVDJTIyIiwgIiUyMiIsICRtZXNzYWdlKTsiO2k6Mjc7czoxNToiL2V0Yy9uYW1lZC5jb25mIjtpOjI4O3M6MTA6Ii9ldGMvaHR0cGQiO2k6Mjk7czoxMToiL3Zhci9jcGFuZWwiO2k6MzA7czoxODoiTmUgdWRhbG9zIHphZ3J1eml0IjtpOjMxO3M6MTQ6ImV4ZWMoInJtIC1yIC1mIjtpOjMyO3M6ODoiU2hlbGwgT2siO2k6MzM7czoxMToibXlzaGVsbGV4ZWMiO2k6MzQ7czo5OiJyb290c2hlbGwiO2k6MzU7czo5OiJhbnRpc2hlbGwiO2k6MzY7czoxMjoicjU3c2hlbGwucGhwIjtpOjM3O3M6MTE6IkxvY3VzN1NoZWxsIjtpOjM4O3M6MTE6IlN0b3JtN1NoZWxsIjtpOjM5O3M6ODoiTjN0c2hlbGwiO2k6NDA7czoxMToiZGV2aWx6U2hlbGwiO2k6NDE7czoxMjoiV2ViIFNoZWxsIGJ5IjtpOjQyO3M6NzoiRnhjOTlzaCI7aTo0MztzOjg6ImNpaHNoZWxsIjtpOjQ0O3M6NzoiTlREYWRkeSI7aTo0NTtzOjg6InI1N3NoZWxsIjtpOjQ2O3M6ODoiYzk5c2hlbGwiO2k6NDc7czo2MjoiPGRpdiBjbGFzcz0iYmxvY2sgYnR5cGUxIj48ZGl2IGNsYXNzPSJkdG9wIj48ZGl2IGNsYXNzPSJkYnRtIj4iO2k6NDg7czo5OiJSb290U2hlbGwiO2k6NDk7czo4OiJwaHBzaGVsbCI7aTo1MDtzOjI0OiJZb3UgY2FuIHB1dCBhIG1kNSBzdHJpbmciO30="));
$g_FlexDBShe = unserialize(base64_decode("YToyNzY6e2k6MDtzOjc5OiJSZXdyaXRlUnVsZVxzK1xeXChcLlwqXCksXChcLlwqXClcJFxzK1wkMlwucGhwXD9yZXdyaXRlX3BhcmFtcz1cJDEmcGFnZV91cmw9XCQyIjtpOjE7czo1ODoiZnVuY3Rpb25ccytyZWFkX3BpY1woXHMqXCRBXHMqXClccyp7XHMqXCRhXHMqPVxzKlwkX1NFUlZFUiI7aToyO3M6NTI6ImZpbGVtdGltZVwoXCRiYXNlcGF0aFxzKlwuXHMqWyciXS9jb25maWd1cmF0aW9uXC5waHAiO2k6MztzOjYyOiJsaXN0XHMqXChccypcJGhvc3RccyosXHMqXCRwb3J0XHMqLFxzKlwkc2l6ZVxzKixccypcJGV4ZWNfdGltZSI7aTo0O3M6NDE6Imxpc3RpbmdfcGFnZVwoXHMqbm90aWNlXChccypbJyJdc3ltbGlua2VkIjtpOjU7czozNToibWFrZV9kaXJfYW5kX2ZpbGVcKFxzKlwkcGF0aF9qb29tbGEiO2k6NjtzOjIxOiJmdW5jdGlvblxzK2luRGlhcGFzb24iO2k6NztzOjQxOiImJlxzKiFlbXB0eVwoXHMqXCRfQ09PS0lFXFtbJyJdZmlsbFsnIl1cXSI7aTo4O3M6MzM6ImZpbGVfZXhpc3RzXHMqXCgqXHMqWyciXS92YXIvdG1wLyI7aTo5O3M6NTk6InN0cl9yZXBsYWNlXChcJGZpbmRccyosXHMqXCRmaW5kXHMqXC5ccypcJGh0bWxccyosXHMqXCR0ZXh0IjtpOjEwO3M6MzY6IlwkZGF0YW1hc2lpPWRhdGVcKCJEIE0gZCwgWSBnOmkgYSJcKSI7aToxMTtzOjM0OiJcJGFkZGRhdGU9ZGF0ZVwoIkQgTSBkLCBZIGc6aSBhIlwpIjtpOjEyO3M6MTg6ImZ1Y2tccyt5b3VyXHMrbWFtYSI7aToxMztzOjUwOiJHb29nbGVib3RbJyJdezAsMX1ccypcKVwpe2VjaG9ccytmaWxlX2dldF9jb250ZW50cyI7aToxNDtzOjM3OiJbJyJdezAsMX0uYy5bJyJdezAsMX1cLnN1YnN0clwoXCR2YmcsIjtpOjE1O3M6Mjg6ImFycmF5XChcJGVuLFwkZXMsXCRlZixcJGVsXCkiO2k6MTY7czo0NjoibG9jXHMqPVxzKlsnIl17MCwxfTxcP2VjaG9ccytcJHJlZGlyZWN0O1xzKlw/PiI7aToxNztzOjE3OiJLYXphbi9pbmRleFwuaHRtbCI7aToxODtzOjE4OiI9PTBcKXtqc29uUXVpdFwoXCQiO2k6MTk7czo0MDoiQHN0cmVhbV9zb2NrZXRfY2xpZW50XChbJyJdezAsMX10Y3A6Ly9cJCI7aToyMDtzOjMwOiI6OlsnIl1cLnBocHZlcnNpb25cKFwpXC5bJyJdOjoiO2k6MjE7czozODoicHJlZ19yZXBsYWNlXChbJyJdLlVURlxcLTg6XCguXCpcKS5Vc2UiO2k6MjI7czoxMzoiIj0+XCR7XCR7IlxceCI7aToyMztzOjQyOiJmc29ja29wZW5cKFwkbVxbMFxdLFwkbVxbMTBcXSxcJF8sXCRfXyxcJG0iO2k6MjQ7czozMzoiZVZhTFwoXHMqdHJpbVwoXHMqYmFTZTY0X2RlQ29EZVwoIjtpOjI1O3M6NDY6ImVjaG9ccyptZDVcKFwkX1BPU1RcW1snIl17MCwxfWNoZWNrWyciXXswLDF9XF0iO2k6MjY7czoyNToiaW1nIHNyYz1bJyJdb3BlcmEwMDBcLnBuZyI7aToyNztzOjM3OiJmdW5jdGlvbiByZWxvYWRcKFwpe2hlYWRlclwoIkxvY2F0aW9uIjtpOjI4O3M6NDA6InN1YnN0cl9jb3VudFwoZ2V0ZW52XChcXFsnIl1IVFRQX1JFRkVSRVIiO2k6Mjk7czozMToid2ViaVwucnUvd2ViaV9maWxlcy9waHBfbGlibWFpbCI7aTozMDtzOjY1OiJjaHIyPVwoXChlbmMyJjE1XCk8PDRcKVx8XChlbmMzPj4yXCk7Y2hyMz1cKFwoZW5jMyYzXCk8PDZcKVx8ZW5jNCI7aTozMTtzOjEyOiJSRVJFRkVSX1BUVEgiO2k6MzI7czo5OiJ0c29oX3B0dGgiO2k6MzM7czoxNToidG5lZ2FfcmVzdV9wdHRoIjtpOjM0O3M6NDc6Im1tY3J5cHRcKFwkZGF0YSwgXCRrZXksIFwkaXYsIFwkZGVjcnlwdCA9IEZBTFNFIjtpOjM1O3M6MTM6ImZvcG9cLmNvbVwuYXIiO2k6MzY7czoyMDoic3ByYXZvY2huaWstbm9tZXJvdi0iO2k6Mzc7czoxODoiaWNxLWRseWEtdGVsZWZvbmEtIjtpOjM4O3M6MTc6InRlbGVmb25uYXlhLWJhemEtIjtpOjM5O3M6MjY6InNsZXNoXCtzbGVzaFwrZG9tZW5cK3BvaW50IjtpOjQwO3M6MjI6InNyYz0iZmlsZXNfc2l0ZS9qc1wuanMiO2k6NDE7czo5NToiXCR0PVwkcztccypcJG9ccyo9XHMqWyciXVsnIl07XHMqZm9yXChcJGk9MDtcJGk8c3RybGVuXChcJHRcKTtcJGlcK1wrXCl7XHMqXCRvXHMqXC49XHMqXCR0e1wkaX0iO2k6NDI7czo4MDoiV0JTX0RJUlxzKlwuXHMqWyciXXswLDF9dGVtcC9bJyJdezAsMX1ccypcLlxzKlwkYWN0aXZlRmlsZVxzKlwuXHMqWyciXXswLDF9XC50bXAiO2k6NDM7czo1MToiQCptYWlsXChcJG1vc0NvbmZpZ19tYWlsZnJvbSwgXCRtb3NDb25maWdfbGl2ZV9zaXRlIjtpOjQ0O3M6NjY6IlwkW2EtekEtWjAtOV9dKz8vXCouezEsMTB9XCovXHMqXC5ccypcJFthLXpBLVowLTlfXSs/L1wqLnsxLDEwfVwqLyI7aTo0NTtzOjE3OiJAXCRfUE9TVFxbXChjaHJcKCI7aTo0NjtzOjMzOiI8XD9waHBccytyZW5hbWVcKFsnIl13c29cLnBocFsnIl0iO2k6NDc7czo1MjoiXCRzdHI9WyciXXswLDF9PGgxPjQwM1xzK0ZvcmJpZGRlbjwvaDE+PCEtLVxzKnRva2VuOiI7aTo0ODtzOjUwOiJjaHVua19zcGxpdFwoYmFzZTY0X2VuY29kZVwoZnJlYWRcKFwke1wke1snIl17MCwxfSI7aTo0OTtzOjYwOiJpbmlfZ2V0XChbJyJdezAsMX1maWx0ZXJcLmRlZmF1bHRfZmxhZ3NbJyJdezAsMX1cKVwpe2ZvcmVhY2giO2k6NTA7czozODoiZmlsZV9nZXRfY29udGVudHNcKHRyaW1cKFwkZlxbXCRfR0VUXFsiO2k6NTE7czoxMzM6Im1haWxcKFwkYXJyXFtbJyJdezAsMX10b1snIl17MCwxfVxdLFwkYXJyXFtbJyJdezAsMX1zdWJqWyciXXswLDF9XF0sXCRhcnJcW1snIl17MCwxfW1zZ1snIl17MCwxfVxdLFwkYXJyXFtbJyJdezAsMX1oZWFkWyciXXswLDF9XF1cKTsiO2k6NTI7czo1NDoiaWZcKGlzc2V0XChcJF9QT1NUXFtbJyJdezAsMX1tc2dzdWJqZWN0WyciXXswLDF9XF1cKVwpIjtpOjUzO3M6MzU6ImJhc2U2NF9kZWNvZGVcKFwkX1BPU1RcW1snIl17MCwxfV8tIjtpOjU0O3M6NTM6InJlZ2lzdGVyX3NodXRkb3duX2Z1bmN0aW9uXChccypbJyJdezAsMX1yZWFkX2Fuc19jb2RlIjtpOjU1O3M6NzU6IlwkcGFyYW1ccyo9XHMqXCRwYXJhbVxzKnhccypcJG5cLnN1YnN0clxzKlwoXCRwYXJhbVxzKixccypsZW5ndGhcKFwkcGFyYW1cKSI7aTo1NjtzOjI0OiJiYXNlWyciXXswLDF9XC5cKDMyXCoyXCkiO2k6NTc7czo2NjoiaWZcKEBcJHZhcnNcKGdldF9tYWdpY19xdW90ZXNfZ3BjXChcKVxzKlw/XHMqc3RyaXBzbGFzaGVzXChcJHVyaVwpIjtpOjU4O3M6Mjk6IlwpXF07fWlmXChpc3NldFwoXCRfU0VSVkVSXFtfIjtpOjU5O3M6NDI6ImlmXChlbXB0eVwoXCRfQ09PS0lFXFtbJyJdeFsnIl1cXVwpXCl7ZWNobyI7aTo2MDtzOjUyOiJpc193cml0YWJsZVwoXCRkaXJcLlsnIl13cC1pbmNsdWRlcy92ZXJzaW9uXC5waHBbJyJdIjtpOjYxO3M6MjE6IkFwcGxlXHMrU3BBbVxzK1JlWnVsVCI7aTo2MjtzOjE3OiIjXHMqc3RlYWx0aFxzKmJvdCI7aTo2MztzOjIyOiIjXHMqc2VjdXJpdHlzcGFjZVwuY29tIjtpOjY0O3M6Mjg6IlVSTD08XD9lY2hvXHMrXCRpbmRleDtccytcPz4iO2k6NjU7czo5NToiPHNjcmlwdFxzK3R5cGU9WyciXXswLDF9dGV4dC9qYXZhc2NyaXB0WyciXXswLDF9XHMrc3JjPVsnIl17MCwxfWpxdWVyeS11XC5qc1snIl17MCwxfT48L3NjcmlwdD4iO2k6NjY7czo1NzoiY3JlYXRlX2Z1bmN0aW9uXChbJyJdWyciXSxccypcJG9wdFxbMVxdXHMqXC5ccypcJG9wdFxbNFxdIjtpOjY3O3M6NTA6ImZpbGVfcHV0X2NvbnRlbnRzXChTVkNfU0VMRlxzKlwuXHMqWyciXS9cLmh0YWNjZXNzIjtpOjY4O3M6NTE6IlwkYWxsZW1haWxzXHMqPVxzKkBzcGxpdFwoIlxcbiJccyosXHMqXCRlbWFpbGxpc3RcKSI7aTo2OTtzOjE4OiJKb29tbGFfYnJ1dGVfRm9yY2UiO2k6NzA7czozODoiXCRzeXNfcGFyYW1zXHMqPVxzKkAqZmlsZV9nZXRfY29udGVudHMiO2k6NzE7czozNToiZndyaXRlXHMqXChccypcJGZsd1xzKixccypcJGZsXHMqXCkiO2k6NzI7czo4NjoiZmlsZV9wdXRfY29udGVudHNccypcKFsnIl17MCwxfTFcLnR4dFsnIl17MCwxfVxzKixccypwcmludF9yXHMqXChccypcJF9QT1NUXHMqLFxzKnRydWUiO2k6NzM7czo4MDoiXCRoZWFkZXJzXHMqPVxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtbJyJdezAsMX1oZWFkZXJzWyciXXswLDF9XF0iO2k6NzQ7czo0NDoiY3JlYXRlX2Z1bmN0aW9uXHMqXChbJyJdWyciXVxzKixccypzdHJfcm90MTMiO2k6NzU7czozMzoiZGllXHMqXChccypQSFBfT1NccypcLlxzKmNoclxzKlwoIjtpOjc2O3M6NTU6ImlmXHMqXChtZDVcKHRyaW1cKFwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFsiO2k6Nzc7czo0NDoiZlxzKj1ccypcJHFccypcLlxzKlwkYVxzKlwuXHMqXCRiXHMqXC5ccypcJHgiO2k6Nzg7czo0MToiY29udGVudD1bJyJdezAsMX0xO1VSTD1jZ2ktYmluXC5odG1sXD9jbWQiO2k6Nzk7czo2MzoiXCR1cmxbJyJdezAsMX1ccypcLlxzKlwkc2Vzc2lvbl9pZFxzKlwuXHMqWyciXXswLDF9L2xvZ2luXC5odG1sIjtpOjgwO3M6NjQ6IlwkX1NFU1NJT05cW1snIl17MCwxfXNlc3Npb25fcGluWyciXXswLDF9XF1ccyo9XHMqWyciXXswLDF9XCRQSU4iO2k6ODE7czo0MjoiZnNvY2tvcGVuXHMqXChccypcJENvbm5lY3RBZGRyZXNzXHMqLFxzKjI1IjtpOjgyO3M6NDc6ImVjaG9ccytcJGlmdXBsb2FkPVsnIl17MCwxfVxzKkl0c09rXHMqWyciXXswLDF9IjtpOjgzO3M6Nzc6InByZWdfbWF0Y2hcKFsnIl0vXCh5YW5kZXhcfGdvb2dsZVx8Ym90XCkvaVsnIl0sXHMqZ2V0ZW52XChbJyJdSFRUUF9VU0VSX0FHRU5UIjtpOjg0O3M6NTI6IlwkbWFpbGVyXHMqPVxzKlwkX1BPU1RcW1snIl17MCwxfXhfbWFpbGVyWyciXXswLDF9XF0iO2k6ODU7czo1NzoiXCRPT08wTzBPMDA9X19GSUxFX187XHMqXCRPTzAwTzAwMDBccyo9XHMqMHgxYjU0MDtccypldmFsIjtpOjg2O3M6MTI6IkJ5XHMrV2ViUm9vVCI7aTo4NztzOjgwOiJoZWFkZXJcKFsnIl17MCwxfXM6XHMqWyciXXswLDF9XHMqXC5ccypwaHBfdW5hbWVccypcKFxzKlsnIl17MCwxfW5bJyJdezAsMX1ccypcKSI7aTo4ODtzOjczOiJtb3ZlX3VwbG9hZGVkX2ZpbGVcKFwkX0ZJTEVTXFtbJyJdezAsMX1lbGlmWyciXXswLDF9XF1cW1snIl17MCwxfXRtcF9uYW1lIjtpOjg5O3M6NjI6IlwkZ3ppcFxzKj1ccypAKmd6aW5mbGF0ZVxzKlwoXHMqQCpzdWJzdHJccypcKFxzKlwkZ3plbmNvZGVfYXJnIjtpOjkwO3M6ODM6ImlmXHMqXChccyptYWlsXHMqXChccypcJG1haWxzXFtcJGlcXVxzKixccypcJHRlbWFccyosXHMqYmFzZTY0X2VuY29kZVxzKlwoXHMqXCR0ZXh0IjtpOjkxO3M6ODQ6ImZ3cml0ZVxzKlwoXHMqXCRmaFxzKixccypzdHJpcHNsYXNoZXNccypcKFxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcWyI7aTo5MjtzOjk0OiJlY2hvXHMrZmlsZV9nZXRfY29udGVudHNccypcKFxzKmJhc2U2NF91cmxfZGVjb2RlXHMqXChccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpIjtpOjkzO3M6NjA6ImlmXHMqXChccypAKm1kNVxzKlwoXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcWyI7aTo5NDtzOjk5OiJjaHJccypcKFxzKjEwMVxzKlwpXHMqXC5ccypjaHJccypcKFxzKjExOFxzKlwpXHMqXC5ccypjaHJccypcKFxzKjk3XHMqXClccypcLlxzKmNoclxzKlwoXHMqMTA4XHMqXCkiO2k6OTU7czoxNTI6IlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtbJyJdezAsMX1bYS16QS1aMC05X10rP1snIl17MCwxfVxdXChccypcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbWyciXXswLDF9W2EtekEtWjAtOV9dKz9bJyJdezAsMX1cXVxzKlwpIjtpOjk2O3M6NzU6IlwkcmVzdWx0RlVMXHMqPVxzKnN0cmlwY3NsYXNoZXNccypcKFxzKlwkX1BPU1RcW1snIl17MCwxfXJlc3VsdEZVTFsnIl17MCwxfSI7aTo5NztzOjE1OiIvdXNyL3NiaW4vaHR0cGQiO2k6OTg7czozMjoiUFJJVk1TR1wuXCo6XC5vd25lclxcc1wrXChcLlwqXCkiO2k6OTk7czo4MzoicHJpbnRccytcJHNvY2tccytbJyJdezAsMX1OSUNLIFsnIl17MCwxfVxzK1wuXHMrXCRuaWNrXHMrXC5ccytbJyJdezAsMX1cXG5bJyJdezAsMX0iO2k6MTAwO3M6ODA6IlwkdXJsXHMqPVxzKlwkdXJsXHMqXC5ccypbJyJdezAsMX1cP1snIl17MCwxfVxzKlwuXHMqaHR0cF9idWlsZF9xdWVyeVwoXCRxdWVyeVwpIjtpOjEwMTtzOjEyMzoicHJlZ19tYXRjaF9hbGxcKFsnIl17MCwxfS88YSBocmVmPSJcXC91cmxcXFw/cT1cKFwuXCtcP1wpXFsmXHwiXF1cKy9pc1snIl17MCwxfSwgXCRwYWdlXFtbJyJdezAsMX1leGVbJyJdezAsMX1cXSwgXCRsaW5rc1wpIjtpOjEwMjtzOjEwMToiPHNjcmlwdFxzK2xhbmd1YWdlPVsnIl17MCwxfUphdmFTY3JpcHRbJyJdezAsMX0+XHMqcGFyZW50XC53aW5kb3dcLm9wZW5lclwubG9jYXRpb25ccyo9XHMqWyciXWh0dHA6Ly8iO2k6MTAzO3M6Nzc6IlwkcFxzKj1ccypzdHJwb3NccypcKFxzKlwkdHhccyosXHMqWyciXXswLDF9eyNbJyJdezAsMX1ccyosXHMqXCRwMlxzKlwrXHMqMlwpIjtpOjEwNDtzOjE1OiJcKG1zaWVcfG9wZXJhXCkiO2k6MTA1O3M6NDk6IlJld3JpdGVDb25kXHMqJXtIVFRQX1VTRVJfQUdFTlR9XHMqXC5cKm5kcm9pZFwuXCoiO2k6MTA2O3M6OTk6ImlmXHMqXChccyppc19kaXJccypcKFxzKlwkRnVsbFBhdGhccypcKVxzKlwpXHMqQWxsRGlyXHMqXChccypcJEZ1bGxQYXRoXHMqLFxzKlwkRmlsZXNccypcKTtccyp9XHMqfSI7aToxMDc7czoxNjc6IlsnIl17MCwxfUZyb206XHMqWyciXXswLDF9XC5cJF9QT1NUXFtbJyJdezAsMX1yZWFsbmFtZVsnIl17MCwxfVxdXC5bJyJdezAsMX0gWyciXXswLDF9XC5bJyJdezAsMX0gPFsnIl17MCwxfVwuXCRfUE9TVFxbWyciXXswLDF9ZnJvbVsnIl17MCwxfVxdXC5bJyJdezAsMX0+XFxuWyciXXswLDF9IjtpOjEwODtzOjUzOiI8IS0tI2V4ZWNccytjbWQ9WyciXXswLDF9XCRIVFRQX0FDQ0VQVFsnIl17MCwxfVxzKi0tPiI7aToxMDk7czoyNjoiXFstXF1ccytDb25uZWN0aW9uXHMrZmFpbGQiO2k6MTEwO3M6NjM6ImlmXCgvXF5cXDpcJG93bmVyIVwuXCpcXEBcLlwqUFJJVk1TR1wuXCo6XC5tc2dmbG9vZFwoXC5cKlwpL1wpeyI7aToxMTE7czozNDoicHJpbnRccypcJHNvY2sgIlBSSVZNU0cgIlwuXCRvd25lciI7aToxMTI7czo2NDoiXF09WyciXXswLDF9aXBbJyJdezAsMX1ccyo7XHMqaWZccypcKFxzKmlzc2V0XHMqXChccypcJF9TRVJWRVJcWyI7aToxMTM7czo1MToiXF1ccyp9XHMqPVxzKnRyaW1ccypcKFxzKmFycmF5X3BvcFxzKlwoXHMqXCR7XHMqXCR7IjtpOjExNDtzOjMwOiJwcmludFwoIiNccytpbmZvXHMrT0tcXG5cXG4iXCkiO2k6MTE1O3M6MTEyOiJcJHVzZXJfYWdlbnRccyo9XHMqcHJlZ19yZXBsYWNlXHMqXChccypbJyJdXHxVc2VyXFxcLkFnZW50XFw6XFtcXHMgXF1cP1x8aVsnIl1ccyosXHMqWyciXVsnIl1ccyosXHMqXCR1c2VyX2FnZW50IjtpOjExNjtzOjcxOiJcJHBccyo9XHMqc3RycG9zXChcJHR4XHMqLFxzKlsnIl17MCwxfXsjWyciXXswLDF9XHMqLFxzKlwkcDJccypcK1xzKjJcKSI7aToxMTc7czo5MjoiY3JlYXRlX2Z1bmN0aW9uXHMqXChccypbJyJdXCRtWyciXVxzKixccypbJyJdaWZccypcKFxzKlwkbVxzKlxbXHMqMHgwMVxzKlxdXHMqPT1ccypbJyJdTFsnIl0iO2k6MTE4O3M6ODk6IlwkbGV0dGVyXHMqPVxzKnN0cl9yZXBsYWNlXHMqXChccypcJEFSUkFZXFswXF1cW1wkalxdXHMqLFxzKlwkYXJyXFtcJGluZFxdXHMqLFxzKlwkbGV0dGVyIjtpOjExOTtzOjk6IklySXNUXC5JciI7aToxMjA7czo0NjoiaWZccypcKGRldGVjdF9tb2JpbGVfZGV2aWNlXChcKVwpXHMqe1xzKmhlYWRlciI7aToxMjE7czozMjoiXCRwb3N0XHMqPVxzKlsnIl1cXHg3N1xceDY3XFx4NjUiO2k6MTIyO3M6Mjc6ImVjaG9ccypbJyJdYW5zd2VyPWVycm9yWyciXSI7aToxMjM7czozNDoidXJsPTxcP3BocFxzKmVjaG9ccypcJHJhbmRfdXJsO1w/PiI7aToxMjQ7czo0NToiaWZcKENoZWNrSVBPcGVyYXRvclwoXClccyomJlxzKiFpc01vZGVtXChcKVwpIjtpOjEyNTtzOjU5OiJzdHJwb3NcKFwkdWEsXHMqWyciXXswLDF9eWFuZGV4Ym90WyciXXswLDF9XClccyohPT1ccypmYWxzZSI7aToxMjY7czoxMzQ6ImlmXHMqXChcJGtleVxzKiE9XHMqWyciXXswLDF9bWFpbF90b1snIl17MCwxfVxzKiYmXHMqXCRrZXlccyohPVxzKlsnIl17MCwxfXNtdHBfc2VydmVyWyciXXswLDF9XHMqJiZccypcJGtleVxzKiE9XHMqWyciXXswLDF9c210cF9wb3J0IjtpOjEyNztzOjUyOiJlY2hvWyciXXswLDF9PGNlbnRlcj48Yj5Eb25lXHMqPT0+XHMqXCR1c2VyZmlsZV9uYW1lIjtpOjEyODtzOjE1OiJbJyJdZS9cKlwuL1snIl0iO2k6MTI5O3M6Mjg6ImFzc2VydFxzKlwoXHMqQCpzdHJpcHNsYXNoZXMiO2k6MTMwO3M6NTE6IlwpXHMqXC5ccypzdWJzdHJccypcKFxzKm1kNVxzKlwoXHMqc3RycmV2XHMqXChccypcJCI7aToxMzE7czo2NToiXCRmbFxzKj1ccyoiPG1ldGEgaHR0cC1lcXVpdj1cXCJSZWZyZXNoXFwiXHMrY29udGVudD1cXCIwO1xzKlVSTD0iO2k6MTMyO3M6OTA6IixccyphcnJheVxzKlwoJ1wuJywnXC5cLicsJ1RodW1ic1wuZGInXClccypcKVxzKlwpXHMqe1xzKmNvbnRpbnVlO1xzKn1ccyppZlxzKlwoXHMqaXNfZmlsZSI7aToxMzM7czo4MzoiaWZccypcKFxzKlwkZGF0YVNpemVccyo8XHMqQk9UQ1JZUFRfTUFYX1NJWkVccypcKVxzKnJjNFxzKlwoXHMqXCRkYXRhLFxzKlwkY3J5cHRrZXkiO2k6MTM0O3M6MTc4OiJpZlxzKlwoXHMqXCRfUE9TVFxbXHMqWyciXXswLDF9cGF0aFsnIl17MCwxfVxzKlxdXHMqPT1ccypbJyJdezAsMX1bJyJdezAsMX1ccypcKVxzKntccypcJHVwbG9hZGZpbGVccyo9XHMqXCRfRklMRVNcW1xzKlsnIl17MCwxfWZpbGVbJyJdezAsMX1ccypcXVxbXHMqWyciXXswLDF9bmFtZVsnIl17MCwxfVxzKlxdIjtpOjEzNTtzOjk5OiJpZlxzKlwoXHMqZndyaXRlXHMqXChccypcJGhhbmRsZVxzKixccypmaWxlX2dldF9jb250ZW50c1xzKlwoXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MTM2O3M6ODk6ImFycmF5X2tleV9leGlzdHNccypcKFxzKlwkZmlsZVJhc1xzKixccypcJGZpbGVUeXBlXClccypcP1xzKlwkZmlsZVR5cGVcW1xzKlwkZmlsZVJhc1xzKlxdIjtpOjEzNztzOjY1OiJ1cmxlbmNvZGVcKHByaW50X3JcKGFycmF5XChcKSwxXClcKSw1LDFcKVwuY1wpLFwkY1wpO31ldmFsXChcJGRcKSI7aToxMzg7czo0NDoiaWZccypcKFxzKmZ1bmN0aW9uX2V4aXN0c1xzKlwoXHMqJ3BjbnRsX2ZvcmsiO2k6MTM5O3M6NDM6ImZpbmRccysvXHMrLXR5cGVccytmXHMrLXBlcm1ccystMDQwMDBccystbHMiO2k6MTQwO3M6NzE6ImV4ZWNsXChbJyJdL2Jpbi9zaFsnIl1ccyosXHMqWyciXS9iaW4vc2hbJyJdXHMqLFxzKlsnIl0taVsnIl1ccyosXHMqMFwpIjtpOjE0MTtzOjQxOiJmdW5jdGlvblxzK2luamVjdFwoXCRmaWxlLFxzKlwkaW5qZWN0aW9uPSI7aToxNDI7czozODoiZmNsb3NlXChcJGZcKTtccyplY2hvXHMqWyciXW9cLmtcLlsnIl0iO2k6MTQzO3M6OTI6InByZWdfcmVwbGFjZVxzKlwoXHMqXCRleGlmXFtccypcXFsnIl1NYWtlXFxbJyJdXHMqXF1ccyosXHMqXCRleGlmXFtccypcXFsnIl1Nb2RlbFxcWyciXVxzKlxdIjtpOjE0NDtzOjcyOiJcXmRvd25sb2Fkcy9cKFxbMC05XF1cKlwpL1woXFswLTlcXVwqXCkvXCRccytkb3dubG9hZHNcLnBocFw/Yz1cJDEmcD1cJDIiO2k6MTQ1O3M6ODE6IlwkcmVzPW15c3FsX3F1ZXJ5XChbJyJdezAsMX1TRUxFQ1RccytcKlxzK0ZST01ccytgd2F0Y2hkb2dfb2xkXzA1YFxzK1dIRVJFXHMrcGFnZSI7aToxNDY7czo1MjoiUmV3cml0ZVJ1bGVccytcLlwqXHMraW5kZXhcLnBocFw/dXJsPVwkMFxzK1xbTCxRU0FcXSI7aToxNDc7czozOToiZXZhbFxzKlwoKlxzKnN0cnJldlxzKlwoKlxzKnN0cl9yZXBsYWNlIjtpOjE0ODtzOjIxMzoiQCptb3ZlX3VwbG9hZGVkX2ZpbGVccypcKFxzKlwkX0ZJTEVTXFtccypbJyJdezAsMX1tZXNzYWdlWyciXXswLDF9XHMqXF1cW1xzKlsnIl17MCwxfXRtcF9uYW1lWyciXXswLDF9XHMqXF1ccyosXHMqXCRzZWN1cml0eV9jb2RlXHMqXC5ccyoiLyJccypcLlxzKlwkX0ZJTEVTXFtbJyJdezAsMX1tZXNzYWdlWyciXXswLDF9XF1cW1snIl17MCwxfW5hbWVbJyJdezAsMX1cXVwpIjtpOjE0OTtzOjgyOiJcJFVSTFxzKj1ccypcJHVybHNcW1xzKnJhbmRcKFxzKjBccyosXHMqY291bnRccypcKFxzKlwkdXJsc1xzKlwpXHMqLVxzKjFccypcKVxzKlxdIjtpOjE1MDtzOjIzMjoiaXNzZXRccypcKFxzKlwkX0ZJTEVTXFtccypbJyJdezAsMX14WyciXXswLDF9XHMqXF1ccypcKVxzKlw/XHMqXChccyppc191cGxvYWRlZF9maWxlXHMqXChccypcJF9GSUxFU1xbXHMqWyciXXswLDF9eFsnIl17MCwxfVxzKlxdXFtccypbJyJdezAsMX10bXBfbmFtZVsnIl17MCwxfVxzKlxdXHMqXClccypcP1xzKlwoXHMqY29weVxzKlwoXHMqXCRfRklMRVNcW1xzKlsnIl17MCwxfXhbJyJdezAsMX1ccypcXSI7aToxNTE7czo4NzoiaWZccypcKFxzKlwkaVxzKjxccypcKFxzKmNvdW50XHMqXChccypcJF9QT1NUXFtccypbJyJdezAsMX1xWyciXXswLDF9XHMqXF1ccypcKVxzKi1ccyoxIjtpOjE1MjtzOjcwOiJmaWxlX2dldF9jb250ZW50c1xzKlwoKlxzKkFETUlOX1JFRElSX1VSTFxzKixccypmYWxzZVxzKixccypcJGN0eFxzKlwpIjtpOjE1MztzOjEyOiJ0bWhhcGJ6Y2VyZmYiO2k6MTU0O3M6OTc6ImNvbnRlbnQ9WyciXXswLDF9bm8tY2FjaGVbJyJdezAsMX07XHMqXCRjb25maWdcW1snIl17MCwxfWRlc2NyaXB0aW9uWyciXXswLDF9XF1ccypcLj1ccypbJyJdezAsMX0iO2k6MTU1O3M6NzQ6ImNsZWFyc3RhdGNhY2hlXChccypcKTtccyppZlxzKlwoXHMqIWlzX2RpclxzKlwoXHMqXCRmbGRccypcKVxzKlwpXHMqcmV0dXJuIjtpOjE1NjtzOjk3OiJcJHJCdWZmTGVuXHMqPVxzKm9yZFxzKlwoXHMqVkNfRGVjcnlwdFxzKlwoXHMqZnJlYWRccypcKFxzKlwkaW5wdXQsXHMqMVxzKlwpXHMqXClccypcKVxzKlwqXHMqMjU2IjtpOjE1NztzOjk6IklyU2VjVGVhbSI7aToxNTg7czo3MzoiQGhlYWRlclwoWyciXUxvY2F0aW9uOlxzKlsnIl1cLlsnIl1oWyciXVwuWyciXXRbJyJdXC5bJyJddFsnIl1cLlsnIl1wWyciXSI7aToxNTk7czo2Nzoic2V0X3RpbWVfbGltaXRccypcKFxzKjBccypcKTtccyppZlxzKlwoIVNlY3JldFBhZ2VIYW5kbGVyOjpjaGVja0tleSI7aToxNjA7czoxMDY6InJldHVyblxzKlwoXHMqc3Ryc3RyXHMqXChccypcJHNccyosXHMqJ2VjaG8nXHMqXClccyo9PVxzKmZhbHNlXHMqXD9ccypcKFxzKnN0cnN0clxzKlwoXHMqXCRzXHMqLFxzKidwcmludCciO2k6MTYxO3M6NzU6InRpbWVcKFwpXHMqXCtccyoxMDAwMFxzKixccypbJyJdL1snIl1cKTtccyplY2hvXHMrXCRtX3p6O1xzKmV2YWxccypcKFwkbV96eiI7aToxNjI7czoxNDU6ImlmXCghZW1wdHlcKFwkX0ZJTEVTXFtbJyJdezAsMX1tZXNzYWdlWyciXXswLDF9XF1cW1snIl17MCwxfW5hbWVbJyJdezAsMX1cXVwpXHMrQU5EXHMrXChtZDVcKFwkX1BPU1RcW1snIl17MCwxfW5pY2tbJyJdezAsMX1cXVwpXHMqPT1ccypbJyJdezAsMX0iO2k6MTYzO3M6NDc6InN0cl9yb3QxM1xzKlwoXHMqZ3ppbmZsYXRlXHMqXChccypiYXNlNjRfZGVjb2RlIjtpOjE2NDtzOjUwOiJnenVuY29tcHJlc3NccypcKFxzKnN0cl9yb3QxM1xzKlwoXHMqYmFzZTY0X2RlY29kZSI7aToxNjU7czo1MDoiZ3p1bmNvbXByZXNzXHMqXChccypiYXNlNjRfZGVjb2RlXHMqXChccypzdHJfcm90MTMiO2k6MTY2O3M6NjE6Imd6aW5mbGF0ZVxzKlwoXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqc3RyX3JvdDEzXHMqXChccypzdHJyZXYiO2k6MTY3O3M6NjE6Imd6aW5mbGF0ZVxzKlwoXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqc3RycmV2XHMqXChccypzdHJfcm90MTMiO2k6MTY4O3M6NDQ6Imd6aW5mbGF0ZVxzKlwoXHMqYmFzZTY0X2RlY29kZVxzKlwoXHMqc3RycmV2IjtpOjE2OTtzOjY4OiJnemluZmxhdGVccypcKFxzKmJhc2U2NF9kZWNvZGVccypcKFxzKmJhc2U2NF9kZWNvZGVccypcKFxzKnN0cl9yb3QxMyI7aToxNzA7czo1NDoiYmFzZTY0X2RlY29kZVxzKlwoXHMqZ3p1bmNvbXByZXNzXHMqXChccypiYXNlNjRfZGVjb2RlIjtpOjE3MTtzOjQ3OiJnemluZmxhdGVccypcKFxzKmJhc2U2NF9kZWNvZGVccypcKFxzKnN0cl9yb3QxMyI7aToxNzI7czo0NzoiZ3ppbmZsYXRlXHMqXChccypzdHJfcm90MTNccypcKFxzKmJhc2U2NF9kZWNvZGUiO2k6MTczO3M6MTc6IkJyYXppbFxzK0hhY2tUZWFtIjtpOjE3NDtzOjYwOiJcJHRsZFxzKj1ccyphcnJheVxzKlwoXHMqWyciXWNvbVsnIl0sWyciXW9yZ1snIl0sWyciXW5ldFsnIl0iO2k6MTc1O3M6NDU6ImRlZmluZVxzKlwoKlxzKlsnIl1TQkNJRF9SRVFVRVNUX0ZJTEVbJyJdXHMqLCI7aToxNzY7czozNDoicHJlZ19yZXBsYWNlXHMqXCgqXHMqWyciXS9cLlwrL2VzaSI7aToxNzc7czoxNzoiTXlzdGVyaW91c1xzK1dpcmUiO2k6MTc4O3M6NTE6IlwkaGVhZGVyc1xzKlwuPVxzKlwkX1BPU1RcW1xzKlsnIl1lTWFpbEFkZFsnIl1ccypcXSI7aToxNzk7czozMzoiZGVmaW5lXHMqXChccypbJyJdREVGQ0FMTEJBQ0tNQUlMIjtpOjE4MDtzOjQ3OiJkZWZhdWx0X2FjdGlvblxzKj1ccypbJyJdezAsMX1GaWxlc01hblsnIl17MCwxfSI7aToxODE7czozODoiZWNob1xzK0BmaWxlX2dldF9jb250ZW50c1xzKlwoXHMqXCRnZXQiO2k6MTgyO3M6MTU2OiJpZlxzKlwoXHMqc3RyaXBvc1xzKlwoXHMqXCRfU0VSVkVSXFtbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1cXVxzKixccypbJyJdezAsMX1BbmRyb2lkWyciXXswLDF9XClccyohPT1mYWxzZVxzKiYmXHMqIVwkX0NPT0tJRVxbWyciXXswLDF9ZGxlX3VzZXJfaWQiO2k6MTgzO3M6NjA6ImhlYWRlclxzKlwoWyciXUxvY2F0aW9uOlxzKlsnIl1ccypcLlxzKlwkdG9ccypcLlxzKnVybGRlY29kZSI7aToxODQ7czoxMDoiRGMwUkhhWyciXSI7aToxODU7czozNjoiIXRvdWNoXChbJyJdezAsMX1cLlwuL1wuXC4vbGFuZ3VhZ2UvIjtpOjE4NjtzOjM4OiJldmFsXChccypzdHJpcHNsYXNoZXNcKFxzKlxcXCRfUkVRVUVTVCI7aToxODc7czo3ODoiZG9jdW1lbnRcLndyaXRlXHMqXChccypbJyJdezAsMX08c2NyaXB0XHMrc3JjPVsnIl17MCwxfWh0dHA6Ly88XD89XCRkb21haW5cPz4vIjtpOjE4ODtzOjg1OiJleGl0XHMqXChccypbJyJdezAsMX08c2NyaXB0PlxzKnNldFRpbWVvdXRccypcKFxzKlxcWyciXXswLDF9ZG9jdW1lbnRcLmxvY2F0aW9uXC5ocmVmIjtpOjE4OTtzOjI1OiJmdW5jdGlvblxzK3NxbDJfc2FmZVxzKlwoIjtpOjE5MDtzOjQxOiJcJHBvc3RSZXN1bHRccyo9XHMqY3VybF9leGVjXHMqXCgqXHMqXCRjaCI7aToxOTE7czo4NzoiJiZccypmdW5jdGlvbl9leGlzdHNccypcKCpccypbJyJdezAsMX1nZXRteHJyWyciXXswLDF9XClccypcKVxzKntccypAZ2V0bXhyclxzKlwoKlxzKlwkIjtpOjE5MjtzOjU3OiJpc19fd3JpdGFibGVccypcKCpccypcJHBhdGhccypcLlxzKnVuaXFpZFxzKlwoKlxzKm10X3JhbmQiO2k6MTkzO3M6Mjg6ImZpbGVfcHV0X2NvbnRlbnR6XHMqXCgqXHMqXCQiO2k6MTk0O3M6NTU6IkAqZ3ppbmZsYXRlXHMqXChccypAKmJhc2U2NF9kZWNvZGVccypcKFxzKkAqc3RyX3JlcGxhY2UiO2k6MTk1O3M6MTA1OiJmb3BlblxzKlwoKlxzKlsnIl1odHRwOi8vWyciXVxzKlwuXHMqXCRjaGVja19kb21haW5ccypcLlxzKlsnIl06ODBbJyJdXHMqXC5ccypcJGNoZWNrX2RvY1xzKixccypbJyJdclsnIl0iO2k6MTk2O3M6NDM6IkBcJF9DT09LSUVcW1snIl17MCwxfXN0YXRDb3VudGVyWyciXXswLDF9XF0iO2k6MTk3O3M6MzU6ImlmXHMqXCgqXHMqQCpwcmVnX21hdGNoXHMqXCgqXHMqc3RyIjtpOjE5ODtzOjk0OiJhcnJheV9wb3BccypcKCpccypcJHdvcmtSZXBsYWNlXHMqLFxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqLFxzKlwkY291bnRLZXlzTmV3IjtpOjE5OTtzOjU0OiIoR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxzKlxbXHMqWyciXV9fX1snIl1ccyoiO2k6MjAwO3M6MjM6IlwoXHMqWyciXUlOU0hFTExbJyJdXHMqIjtpOjIwMTtzOjQ3OiJcJGJccypcLlxzKlwkcFxzKlwuXHMqXCRoXHMqXC5ccypcJGtccypcLlxzKlwkdiI7aToyMDI7czo4ODoiPVxzKnByZWdfc3BsaXRccypcKFxzKlsnIl0vXFwsXChcXCBcK1wpXD8vWyciXSxccypAKmluaV9nZXRccypcKFxzKlsnIl1kaXNhYmxlX2Z1bmN0aW9ucyI7aToyMDM7czoxMDE6ImlmXHMqXCghZnVuY3Rpb25fZXhpc3RzXHMqXChccypbJyJdcG9zaXhfZ2V0cHd1aWRbJyJdXHMqXClccyomJlxzKiFpbl9hcnJheVxzKlwoXHMqWyciXXBvc2l4X2dldHB3dWlkIjtpOjIwNDtzOjEyMzoicHJlZ19yZXBsYWNlXHMqXChccypbJyJdL1xeXCh3d3dcfGZ0cFwpXFxcLi9pWyciXVxzKixccypbJyJdWyciXSxccypAXCRfU0VSVkVSXHMqXFtccypbJyJdezAsMX1IVFRQX0hPU1RbJyJdezAsMX1ccypcXVxzKlwpIjtpOjIwNTtzOjI2MToiaWZccypcKCpccyppc3NldFxzKlwoKlxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqXFtccypbJyJdezAsMX1bYS16QS1aXzAtOV0rWyciXXswLDF9XHMqXF1ccypcKSpccypcKVxzKntccypcJFthLXpBLVpfMC05XStccyo9XHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClccypcW1xzKlsnIl17MCwxfVthLXpBLVpfMC05XStbJyJdezAsMX1ccypcXTtccypldmFsXHMqXCgqXHMqXCRbYS16QS1aXzAtOV0rXHMqXCkqIjtpOjIwNjtzOjgxOiJldmFsXHMqXCgqXHMqc3RyaXBzbGFzaGVzXHMqXCgqXHMqYXJyYXlfcG9wXCgqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MjA3O3M6MTM5OiJpZlxzK1woXHMqc3RycG9zXHMqXChccypcJHVybFxzKixccypbJyJdanMvbW9vdG9vbHNcLmpzWyciXVxzKlwpXHMqPT09XHMqZmFsc2VccysmJlxzK3N0cnBvc1xzKlwoXHMqXCR1cmxccyosXHMqWyciXWpzL2NhcHRpb25cLmpzWyciXXswLDF9IjtpOjIwODtzOjY4OiJpZlxzK1woKlxzKm1haWxccypcKFxzKlwkcmVjcFxzKixccypcJHN1YmpccyosXHMqXCRzdHVudFxzKixccypcJGZybSI7aToyMDk7czo0MzoiPFw/cGhwXHMrXCRfRlxzKj1ccypfX0ZJTEVfX1xzKjtccypcJF9YXHMqPSI7aToyMTA7czo3OToiXCR4XGQrXHMqPVxzKlsnIl0uKz9bJyJdXHMqO1xzKlwkeFxkK1xzKj1ccypbJyJdLis/WyciXVxzKjtccypcJHhcZCtccyo9XHMqWyciXSI7aToyMTE7czoxMTU6IlwkYmVlY29kZVxzKj1AKmZpbGVfZ2V0X2NvbnRlbnRzXHMqXCgqWyciXXswLDF9XHMqXCR1cmxwdXJzXHMqWyciXXswLDF9XCkqXHMqO1xzKmVjaG9ccytbJyJdezAsMX1cJGJlZWNvZGVbJyJdezAsMX0iO2k6MjEyO3M6MTAxOiJcJEdMT0JBTFNcW1xzKlsnIl17MCwxfS4rP1snIl17MCwxfVxzKlxdXFtccypcZCtccypcXVwoXHMqXCRfXGQrXHMqLFxzKl9cZCtccypcKFxzKlxkK1xzKlwpXHMqXClccypcKSI7aToyMTM7czo3MzoicHJlZ19yZXBsYWNlXHMqXCgqXHMqWyciXXswLDF9L1wuXCpcWy4rP1xdXD8vZVsnIl17MCwxfVxzKixccypzdHJfcmVwbGFjZSI7aToyMTQ7czoxNDk6IlwkR0xPQkFMU1xbWyciXXswLDF9Lis/WyciXXswLDF9XF09QXJyYXlccypcKFxzKmJhc2U2NF9kZWNvZGVccypcKFxzKlsnIl17MCwxfS4rP1snIl17MCwxfVxzKlwpXHMqLFxzKmJhc2U2NF9kZWNvZGVccypcKFxzKlsnIl17MCwxfS4rP1snIl17MCwxfVxzKlwpIjtpOjIxNTtzOjIwMDoiVU5JT05ccytTRUxFQ1RccytbJyJdezAsMX0wWyciXXswLDF9XHMqLFxzKlsnIl17MCwxfTxcPyBzeXN0ZW1cKFxcXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcW2NwY1xdXCk7ZXhpdDtccypcPz5bJyJdezAsMX1ccyosXHMqMFxzKiwwXHMqLFxzKjBccyosXHMqMFxzK0lOVE9ccytPVVRGSUxFXHMrWyciXXswLDF9XCRbJyJdezAsMX0iO2k6MjE2O3M6NjY6Imlzc2V0XHMqXCgqXHMqXCRfUE9TVFxzKlxbXHMqWyciXXswLDF9ZXhlY2dhdGVbJyJdezAsMX1ccypcXVxzKlwpKiI7aToyMTc7czo3MToiZndyaXRlXHMqXCgqXHMqXCRmcHNldHZccyosXHMqZ2V0ZW52XHMqXChccypbJyJdSFRUUF9DT09LSUVbJyJdXHMqXClccyoiO2k6MjE4O3M6MjY6InN5bWxpbmtccypcKCpccypbJyJdL2hvbWUvIjtpOjIxOTtzOjcwOiJmdW5jdGlvblxzK3VybEdldENvbnRlbnRzXHMqXCgqXHMqXCR1cmxccyosXHMqXCR0aW1lb3V0XHMqPVxzKlxkK1xzKlwpIjtpOjIyMDtzOjQ5OiJzdHJyZXZcKCpccypbJyJdezAsMX1lZG9jZWRfNDZlc2FiWyciXXswLDF9XHMqXCkqIjtpOjIyMTtzOjQyOiJzdHJyZXZcKCpccypbJyJdezAsMX10cmVzc2FbJyJdezAsMX1ccypcKSoiO2k6MjIyO3M6MjA6ImV4ZWNccypcKFxzKlsnIl1pcGZ3IjtpOjIyMztzOjEzNjoid3BfcG9zdHNccytXSEVSRVxzK3Bvc3RfdHlwZVxzKj1ccypbJyJdezAsMX1wb3N0WyciXXswLDF9XHMrQU5EXHMrcG9zdF9zdGF0dXNccyo9XHMqWyciXXswLDF9cHVibGlzaFsnIl17MCwxfVxzK09SREVSXHMrQllccytgSURgXHMrREVTQyI7aToyMjQ7czoxMTI6ImZpbGVfZ2V0X2NvbnRlbnRzXHMqXCgqXHMqdHJpbVxzKlwoXHMqXCQuKz9cW1wkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtbJyJdezAsMX0uKz9bJyJdezAsMX1cXVxdXClcKTsiO2k6MjI1O3M6MjEzOiJpc19jYWxsYWJsZVxzKlwoKlxzKlsnIl17MCwxfShmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pWyciXXswLDF9XCkqXHMrYW5kXHMrIWluX2FycmF5XHMqXCgqXHMqWyciXXswLDF9KGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilbJyJdezAsMX1ccyosXHMqXCRkaXNhYmxlZnVuY3MiO2k6MjI2O3M6MjQ6IlwkR0xPQkFMU1xbWyciXXswLDF9X19fXyI7aToyMjc7czo0MzoiZm9wZW5ccypcKCpccypbJyJdezAsMX0vZXRjL3Bhc3N3ZFsnIl17MCwxfSI7aToyMjg7czo1OToiZXZhbFxzKlwoKkAqXHMqc3RyaXBzbGFzaGVzXHMqXCgqXHMqYXJyYXlfcG9wXHMqXCgqXHMqQCpcJF8iO2k6MjI5O3M6NDE6ImV2YWxccypcKCpAKlxzKnN0cmlwc2xhc2hlc1xzKlwoKlxzKkAqXCRfIjtpOjIzMDtzOjc0OiJAKnNldGNvb2tpZVxzKlwoKlxzKlsnIl17MCwxfWhpdFsnIl17MCwxfSxccyoxXHMqLFxzKnRpbWVccypcKCpccypcKSpccypcKyI7aToyMzE7czozNjoiZXZhbFxzKlwoKlxzKmZpbGVfZ2V0X2NvbnRlbnRzXHMqXCgqIjtpOjIzMjtzOjQ2OiJwcmVnX3JlcGxhY2VccypcKCpccypbJyJdezAsMX0vXC5cKi9lWyciXXswLDF9IjtpOjIzMztzOjgxOiJccyp7XHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClccypcW1xzKlsnIl17MCwxfXJvb3RbJyJdezAsMX1ccypcXVxzKn0iO2k6MjM0O3M6MTM1OiJbJyJdezAsMX1odHRwZFwuY29uZlsnIl17MCwxfVxzKixccypbJyJdezAsMX12aG9zdHNcLmNvbmZbJyJdezAsMX1ccyosXHMqWyciXXswLDF9Y2ZnXC5waHBbJyJdezAsMX1ccyosXHMqWyciXXswLDF9Y29uZmlnXC5waHBbJyJdezAsMX0iO2k6MjM1O3M6MzM6InByb2Nfb3BlblxzKlwoXHMqWyciXXswLDF9SUhTdGVhbSI7aToyMzY7czo4ODoiXCRpbmlccypcW1xzKlsnIl17MCwxfXVzZXJzWyciXXswLDF9XHMqXF1ccyo9XHMqYXJyYXlccypcKFxzKlsnIl17MCwxfXJvb3RbJyJdezAsMX1ccyo9PiI7aToyMzc7czo4ODoiY3VybF9zZXRvcHRccypcKFxzKlwkY2hccyosXHMqQ1VSTE9QVF9VUkxccyosXHMqWyciXXswLDF9aHR0cDovL1wkaG9zdDpcZCtbJyJdezAsMX1ccypcKSI7aToyMzg7czo0NToic3lzdGVtXHMqXCgqXHMqWyciXXswLDF9d2hvYW1pWyciXXswLDF9XHMqXCkqIjtpOjIzOTtzOjUyOiJmaW5kXHMrL1xzKy1uYW1lXHMrXC5zc2hccys+XHMrXCRkaXIvc3Noa2V5cy9zc2hrZXlzIjtpOjI0MDtzOjUyOiJhc3NlcnRccypcKCpccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpIjtpOjI0MTtzOjUwOiJldmFsXHMqXCgqXHMqQCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKSI7aToyNDI7czoyNToicGhwXHMrIlxzKlwuXHMqXCR3c29fcGF0aCI7aToyNDM7czo4OToiQCphc3NlcnRccypcKCpccypcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxzKlxbXHMqWyciXXswLDF9Lis/WyciXXswLDF9XHMqXF1ccyoiO2k6MjQ0O3M6MjE6ImV2YTFbYS16QS1aMC05X10rP1NpciI7aToyNDU7czo5MzoiXCRjbWRccyo9XHMqXChccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqXFtccypbJyJdezAsMX0uKz9bJyJdezAsMX1ccypcXVxzKlwpIjtpOjI0NjtzOjk2OiJcJGZ1bmN0aW9uXHMqXCgqXHMqQCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxzKlxbXHMqWyciXXswLDF9Y21kWyciXXswLDF9XHMqXF1ccypcKSoiO2k6MjQ3O3M6MjM6IlwkZmVcKCJcJGNtZFxzKzI+JjEiXCk7IjtpOjI0ODtzOjE0MToiKGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilcKFsnIl1cJGNtZFxzKzE+XHMqL3RtcC9jbWR0ZW1wXHMrMj4mMTtccypjYXRccysvdG1wL2NtZHRlbXA7XHMqcm1ccysvdG1wL2NtZHRlbXBbJyJdXCk7IjtpOjI0OTtzOjUzOiJzZXRjb29raWVcKCpccypbJyJdbXlzcWxfd2ViX2FkbWluX3VzZXJuYW1lWyciXVxzKlwpKiI7aToyNTA7czo4NjoiKGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilccypcKCpccypbJyJddW5hbWVccystYVsnIl1ccypcKSoiO2k6MjUxO3M6MTI0OiIoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVxzKlwoKlxzKkAqXCRfUE9TVFxzKlxbXHMqWyciXS4rP1snIl1ccypcXVxzKlwuXHMqIlxzKjJccyo+XHMqJjFccypbJyJdIjtpOjI1MjtzOjQ5OiIhQCpcJF9SRVFVRVNUXHMqXFtccypbJyJdYzk5c2hfc3VybFsnIl1ccypcXVxzKlwpIjtpOjI1MztzOjM3OiJcJGxvZ2luXHMqPVxzKkAqcG9zaXhfZ2V0dWlkXCgqXHMqXCkqIjtpOjI1NDtzOjMxOiJuY2Z0cHB1dFxzKi11XHMqXCRmdHBfdXNlcl9uYW1lIjtpOjI1NTtzOjgyOiJydW5jb21tYW5kXHMqXChccypbJyJdc2hlbGxoZWxwWyciXVxzKixccypbJyJdKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClbJyJdIjtpOjI1NjtzOjU1OiJ7XHMqXCRccyp7XHMqcGFzc3RocnVccypcKCpccypcJGNtZFxzKlwpXHMqfVxzKn1ccyo8YnI+IjtpOjI1NztzOjU4OiJwYXNzdGhydVxzKlwoKlxzKmdldGVudlxzKlwoKlxzKlxcWyciXUhUVFBfQUNDRVBUX0xBTkdVQUdFIjtpOjI1ODtzOjU2OiJwYXNzdGhydVxzKlwoKlxzKmdldGVudlxzKlwoKlxzKlsnIl1IVFRQX0FDQ0VQVF9MQU5HVUFHRSI7aToyNTk7czo4NzoiU0VMRUNUXHMrMVxzK0ZST01ccytteXNxbFwudXNlclxzK1dIRVJFXHMrY29uY2F0XChccypgdXNlcmBccyosXHMqJ0AnXHMqLFxzKmBob3N0YFxzKlwpIjtpOjI2MDtzOjk3OiJcJE1lc3NhZ2VTdWJqZWN0XHMqPVxzKmJhc2U2NF9kZWNvZGVccypcKFxzKlwkX1BPU1RccypcW1xzKlsnIl17MCwxfW1zZ3N1YmplY3RbJyJdezAsMX1ccypcXVxzKlwpIjtpOjI2MTtzOjQ3OiJyZW5hbWVccypcKFxzKlxzKlsnIl17MCwxfXdzb1wucGhwWyciXXswLDF9XHMqLCI7aToyNjI7czo3NDoiZmlsZXBhdGhccyo9XHMqQCpyZWFscGF0aFxzKlwoXHMqXCRfUE9TVFxzKlxbXHMqWyciXWZpbGVwYXRoWyciXVxzKlxdXHMqXCkiO2k6MjYzO3M6Nzg6ImZpbGVwYXRoXHMqPVxzKkAqcmVhbHBhdGhccypcKFxzKlwkX1BPU1RccypcW1xzKlxcWyciXWZpbGVwYXRoXFxbJyJdXHMqXF1ccypcKSI7aToyNjQ7czo0MDoiZXZhbFxzKlwoKlxzKmJhc2U2NF9kZWNvZGVccypcKCpccypAKlwkXyI7aToyNjU7czoxMDc6Indzb0V4XHMqXChccypcXFsnIl1ccyp0YXJccypjZnp2XHMqXFxbJyJdXHMqXC5ccyplc2NhcGVzaGVsbGFyZ1xzKlwoXHMqXCRfUE9TVFxbXHMqXFxbJyJdcDJcXFsnIl1ccypcXVxzKlwpIjtpOjI2NjtzOjc0OiJXU09zZXRjb29raWVccypcKFxzKm1kNVxzKlwoXHMqQCpcJF9TRVJWRVJcW1xzKlsnIl1IVFRQX0hPU1RbJyJdXHMqXF1ccypcKSI7aToyNjc7czo3ODoiV1NPc2V0Y29va2llXHMqXChccyptZDVccypcKFxzKkAqXCRfU0VSVkVSXFtccypcXFsnIl1IVFRQX0hPU1RcXFsnIl1ccypcXVxzKlwpIjtpOjI2ODtzOjE3MDoiXCRpbmZvIFwuPSBcKFwoXCRwZXJtc1xzKiZccyoweDAwNDBcKVxzKlw/XChcKFwkcGVybXNccyomXHMqMHgwODAwXClccypcP1xzKlxcWyciXXNcXFsnIl1ccyo6XHMqXFxbJyJdeFxcWyciXVxzKlwpXHMqOlwoXChcJHBlcm1zXHMqJlxzKjB4MDgwMFwpXHMqXD9ccyonUydccyo6XHMqJy0nXHMqXCkiO2k6MjY5O3M6MzU6ImRlZmF1bHRfYWN0aW9uXHMqPVxzKlxcWyciXUZpbGVzTWFuIjtpOjI3MDtzOjMzOiJzeXN0ZW1ccytmaWxlXHMrZG9ccytub3RccytkZWxldGUiO2k6MjcxO3M6MTk6ImhhY2tlZFxzK2J5XHMrSG1laTciO2k6MjcyO3M6MTE6ImJ5XHMrR3JpbmF5IjtpOjI3MztzOjIzOiJDYXB0YWluXHMrQ3J1bmNoXHMrVGVhbSI7aToyNzQ7czo5NjoiXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcW1xzKlsnIl17MCwxfXAyWyciXXswLDF9XHMqXF1ccyo9PVxzKlsnIl17MCwxfWNobW9kWyciXXswLDF9IjtpOjI3NTtzOjEwMDoiSU86OlNvY2tldDo6SU5FVC0+bmV3XChQcm90b1xzKj0+XHMqInRjcCJccyosXHMqTG9jYWxQb3J0XHMqPT5ccyozNjAwMFxzKixccypMaXN0ZW5ccyo9PlxzKlNPTUFYQ09OTiI7fQ=="));
$gX_FlexDBShe = unserialize(base64_decode("YToyNTg6e2k6MDtzOjM4OiI9PVxzKjBcKVxzKntccyplY2hvXHMqUEhQX09TXHMqXC5ccypcJCI7aToxO3M6NDk6ImlmXChccyp0cnVlXHMqJlxzKkBwcmVnX21hdGNoXChccypzdHJ0clwoXHMqWyciXS8iO2k6MjtzOjg0OiJpZlwoXHMqIWVtcHR5XChccypcJF9QT1NUXFtccypbJyJdezAsMX10cDJbJyJdezAsMX1ccypcXVwpXHMqYW5kXHMqaXNzZXRcKFxzKlwkX1BPU1QiO2k6MztzOjQ3OiJnenVuY29tcHJlc3NcKFxzKmZpbGVfZ2V0X2NvbnRlbnRzXChccypbJyJdaHR0cCI7aTo0O3M6MTk2OiIocGVyY29jZXR8YWRkZXJhbGx8dmlhZ3JhfGNpYWxpc3xsZXZpdHJhfGthdWZlbnxhbWJpZW58Ymx1ZVxzK3BpbGx8Y29jYWluZXxtYXJpanVhbmF8bGlwaXRvcnxwaGVudGVybWlufHByb1tzel1hY3xzYW5keWF1ZXJ8dHJhbWFkb2x8dHJveWhhbWJ5dWx0cmFtfHVuaWNhdWNhfHZhbGl1bXx2aWNvZGlufHhhbmF4fHlweGFpZW8pXHMrb25saW5lIjtpOjU7czoyMjoiZGlzYWJsZV9mdW5jdGlvbnM9Tk9ORSI7aTo2O3M6MjE6IiZfU0VTU0lPTlxbcGF5bG9hZFxdPSI7aTo3O3M6MjY6IjxcP1xzKj1AYFwkW2EtekEtWjAtOV9dKz9gIjtpOjg7czoxNjoiUEhQU0hFTExfVkVSU0lPTiI7aTo5O3M6Njk6InRvdWNoXChccypcJF9TRVJWRVJcW1xzKlsnIl1ET0NVTUVOVF9ST09UWyciXVxzKlxdXHMqXC5ccypbJyJdL2VuZ2luZSI7aToxMDtzOjgxOiJmaWxlX2dldF9jb250ZW50c1woXHMqXCRfU0VSVkVSXFtccypbJyJdRE9DVU1FTlRfUk9PVFsnIl1ccypcXVxzKlwuXHMqWyciXS9lbmdpbmUiO2k6MTE7czo1NjoiQFwkX1NFUlZFUlxbXHMqSFRUUF9IT1NUXHMqXF0+WyciXVxzKlwuXHMqWyciXVxcclxcblsnIl0iO2k6MTI7czo3MToidHJpbVwoXHMqXCRoZWFkZXJzXHMqXClccypcKVxzKmFzXHMqXCRoZWFkZXJccypcKVxzKmhlYWRlclwoXHMqXCRoZWFkZXIiO2k6MTM7czoxNjoiQ29kZWRccytieVxzK0VYRSI7aToxNDtzOjEyOiJCeVxzK1dlYlJvb1QiO2k6MTU7czoyMDoiaGVhZGVyXHMqXChccypfXGQrXCgiO2k6MTY7czo0MToiaWZccypcKGZ1bmN0aW9uX2V4aXN0c1woXHMqWyciXXBjbnRsX2ZvcmsiO2k6MTc7czoyOToiZG9fd29ya1woXHMqXCRpbmRleF9maWxlXHMqXCkiO2k6MTg7czo4MzoiXCRpZFxzKlwuXHMqWyciXVw/ZD1bJyJdXHMqXC5ccypiYXNlNjRfZW5jb2RlXChccypcJF9TRVJWRVJcW1xzKlsnIl1IVFRQX1VTRVJfQUdFTlQiO2k6MTk7czoyNToibmV3XHMrY29uZWN0QmFzZVwoWyciXWFIUiI7aToyMDtzOjkwOiJmaWxlX2dldF9jb250ZW50c1woUk9PVF9ESVJcLlsnIl0vdGVtcGxhdGVzL1snIl1cLlwkY29uZmlnXFtbJyJdc2tpblsnIl1cXVwuWyciXS9tYWluXC50cGwiO2k6MjE7czo1OToiJTwhLS1cXHNcKlwkbWFya2VyXFxzXCotLT5cLlwrXD88IS0tXFxzXCovXCRtYXJrZXJcXHNcKi0tPiUiO2k6MjI7czoyNDoiZnVuY3Rpb25ccytnZXRmaXJzdHNodGFnIjtpOjIzO3M6MTg6InJlc3VsdHNpZ25fd2FybmluZyI7aToyNDtzOjI5OiJmaWxlX2V4aXN0c1woXHMqXCRGaWxlQmF6YVRYVCI7aToyNTtzOjE5OiI9PVxzKlsnIl1jc2hlbGxbJyJdIjtpOjI2O3M6NjE6IlwkX1NFUlZFUlxbWyciXXswLDF9UkVNT1RFX0FERFJbJyJdezAsMX1cXTtpZlwoXChwcmVnX21hdGNoXCgiO2k6Mjc7czo2NzoiXCRmaWxlX2Zvcl90b3VjaFxzKj1ccypcJF9TRVJWRVJcW1snIl17MCwxfURPQ1VNRU5UX1JPT1RbJyJdezAsMX1cXSI7aToyODtzOjIzOiJcJGluZGV4X3BhdGhccyosXHMqMDQwNCI7aToyOTtzOjMwOiJyZWFkX2ZpbGVfbmV3XzJcKFwkcmVzdWx0X3BhdGgiO2k6MzA7czozODoiY2hyXChccypoZXhkZWNcKFxzKnN1YnN0clwoXHMqXCRtYWtldXAiO2k6MzE7czoyNzoiXGQrJkBwcmVnX21hdGNoXChccypzdHJ0clwoIjtpOjMyO3M6NzU6InZhbHVlPVsnIl08XD9ccysoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVwoWyciXSI7aTozMztzOjE4OiJBY2FkZW1pY29ccytSZXN1bHQiO2k6MzQ7czozMDoiU0VMRUNUXHMrXCpccytGUk9NXHMrZG9yX3BhZ2VzIjtpOjM1O3M6NDE6ImdfZGVsZXRlX29uX2V4aXRccyo9XHMqbmV3XHMrRGVsZXRlT25FeGl0IjtpOjM2O3M6NTI6ImlmXChwcmVnX21hdGNoXChbJyJdI3dvcmRwcmVzc19sb2dnZWRfaW5cfGFkbWluXHxwd2QiO2k6Mzc7czo1MDoiWyciXVwuWyciXVsnIl1cLlsnIl1bJyJdXC5bJyJdWyciXVwuWyciXVsnIl1cLlsnIl0iO2k6Mzg7czoyODoiXCk7ZnVuY3Rpb25ccytzdHJpbmdfY3B0XChcJCI7aTozOTtzOjI4OiJcJHNldGNvb2tcKTtzZXRjb29raWVcKFwkc2V0IjtpOjQwO3M6MzU6Ijxsb2M+PFw/cGhwXHMrZWNob1xzK1wkY3VycmVudF91cmw7IjtpOjQxO3M6NDA6IlwkYmFubmVkSVBccyo9XHMqYXJyYXlcKFxzKlsnIl1cXjY2XC4xMDIiO2k6NDI7czo2MjoiXCRyZXN1bHQ9c21hcnRDb3B5XChccypcJHNvdXJjZVxzKlwuXHMqWyciXS9bJyJdXHMqXC5ccypcJGZpbGUiO2k6NDM7czozODoiXCRmaWxsID0gXCRfQ09PS0lFXFtcXFsnIl1maWxsXFxbJyJdXF0iO2k6NDQ7czo4MzoiaWZcKFsnIl1zdWJzdHJfY291bnRcKFsnIl1cJF9TRVJWRVJcW1snIl1SRVFVRVNUX1VSSVsnIl1cXVxzKixccypbJyJdcXVlcnlcLnBocFsnIl0iO2k6NDU7czo4NToiaWZcKFxzKlwkX0dFVFxbXHMqWyciXWlkWyciXVxzKlxdIT1ccypbJyJdWyciXVxzKlwpXHMqXCRpZD1cJF9HRVRcW1xzKlsnIl1pZFsnIl1ccypcXSI7aTo0NjtzOjIyOiI8YVxzK2hyZWY9WyciXW9zaGlia2EtIjtpOjQ3O3M6NzY6IihmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXChccypbJyJdY2RccysvdG1wO3dnZXQiO2k6NDg7czo1NToiZ2V0cHJvdG9ieW5hbWVcKFxzKlsnIl10Y3BbJyJdXHMqXClccytcfFx8XHMrZGllXHMrc2hpdCI7aTo0OTtzOjQ3OiJmaWxlX3B1dF9jb250ZW50c1woXHMqXCRpbmRleF9wYXRoXHMqLFxzKlwkY29kZSI7aTo1MDtzOjY2OiIsXHMqWyciXS9pbmRleFxcXC5cKHBocFx8aHRtbFwpL2lbJyJdXHMqLFxzKlJlY3Vyc2l2ZVJlZ2V4SXRlcmF0b3IiO2k6NTE7czoxMzoiQU9MXHMrRGV0YWlscyI7aTo1MjtzOjIwOiJ0SEFOS3Nccyt0T1xzK1Nub3BweSI7aTo1MztzOjIwOiJNYXNyMVxzK0N5YjNyXHMrVGU0bSI7aTo1NDtzOjE4OiJVczNccytZMHVyXHMrYnI0MW4iO2k6NTU7czoyMDoiTWFzcmlccytDeWJlclxzK1RlYW0iO2k6NTY7czo0OToiZndyaXRlXChcJGZwXHMqLFxzKnN0cnJldlwoXHMqXCRjb250ZXh0XHMqXClccypcKSI7aTo1NztzOjk6Ii9wbXQvcmF2LyI7aTo1ODtzOjM0OiJmaWxlX2dldF9jb250ZW50c1woXHMqWyciXS92YXIvdG1wIjtpOjU5O3M6MjM6IlwkaW5fUGVybXNccysmXHMrMHg0MDAwIjtpOjYwO3M6NDM6ImZvcGVuXChccypcJHJvb3RfZGlyXHMqXC5ccypbJyJdL1wuaHRhY2Nlc3MiO2k6NjE7czo2MjoiaW50MzJcKFwoXChcJHpccyo+PlxzKjVccyomXHMqMHgwN2ZmZmZmZlwpXHMqXF5ccypcJHlccyo8PFxzKjIiO2k6NjI7czozNToiPGd1aWQ+PFw/cGhwXHMrZWNob1xzK1wkY3VycmVudF91cmwiO2k6NjM7czoxOToiLWtseWNoLWstaWdyZVwuaHRtbCI7aTo2NDtzOjY2OiI8ZGl2XHMraWQ9WyciXWxpbmsxWyciXT48YnV0dG9uIG9uY2xpY2s9WyciXXByb2Nlc3NUaW1lclwoXCk7WyciXT4iO2k6NjU7czoxMToic2NvcGJpblsnIl0iO2k6NjY7czoxNDoiLUFwcGxlX1Jlc3VsdC0iO2k6Njc7czo0NzoidGFyXHMrLWN6ZlxzKyJccypcLlxzKlwkRk9STXt0YXJ9XHMqXC5ccyoiXC50YXIiO2k6Njg7czoxNDoiQ1ZWMjpccypcJENWVjIiO2k6Njk7czo2MzoiXCRDVlYyQ1xzKj1ccypcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbXHMqWyciXUNWVjJDIjtpOjcwO3M6NzU6ImZ3cml0ZVwoXHMqXCRmXHMqLFxzKmdldF9kb3dubG9hZFwoXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcWyI7aTo3MTtzOjMzOiJcW1xdXHMqPVxzKlsnIl1SZXdyaXRlRW5naW5lXHMrb24iO2k6NzI7czo5ODoic3Vic3RyXChccypcJHN0cmluZzJccyosXHMqc3RybGVuXChccypcJHN0cmluZzJccypcKVxzKi1ccyo5XHMqLFxzKjlcKVxzKj09XHMqWyciXXswLDF9XFtsLHI9MzAyXF0iO2k6NzM7czoxMzoiPWJ5XHMrRFJBR09OPSI7aTo3NDtzOjQwOiJfX2ZpbGVfZ2V0X3VybF9jb250ZW50c1woXHMqXCRyZW1vdGVfdXJsIjtpOjc1O3M6ODI6IlwkVVJMXHMqPVxzKlwkdXJsc1xbXHMqcmFuZFwoXHMqMFxzKixccypjb3VudFwoXHMqXCR1cmxzXHMqXClccyotXHMqMVwpXHMqXF1cLnJhbmQiO2k6NzY7czo0OToibWFpbFwoXHMqXCRyZXRvcm5vXHMqLFxzKlwkYXN1bnRvXHMqLFxzKlwkbWVuc2FqZSI7aTo3NztzOjc4OiJjYWxsX3VzZXJfZnVuY1woXHMqWyciXWFjdGlvblsnIl1ccypcLlxzKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFsiO2k6Nzg7czozNToiZmlsZV9leGlzdHNcKFxzKlsnIl0vdG1wL3RtcC1zZXJ2ZXIiO2k6Nzk7czoyNzoiXChbJyJdXCR0bXBkaXIvc2Vzc19mY1wubG9nIjtpOjgwO3M6NTI6InRvdWNoXChccypbJyJdezAsMX1cJGJhc2VwYXRoL2NvbXBvbmVudHMvY29tX2NvbnRlbnQiO2k6ODE7czo0NjoiPVwkZmlsZVwoQCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKSI7aTo4MjtzOjcyOiJzZW5kX3NtdHBcKFxzKlwkZW1haWxcW1snIl17MCwxfWFkclsnIl17MCwxfVxdXHMqLFxzKlwkc3VialxzKixccypcJHRleHQiO2k6ODM7czozNDoiX19MSU5LX188YVxzK2hyZWY9WyciXXswLDF9aHR0cDovLyI7aTo4NDtzOjQ0OiJzY3JpcHRzXFtccypnenVuY29tcHJlc3NcKFxzKmJhc2U2NF9kZWNvZGVcKCI7aTo4NTtzOjc4OiIhZmlsZV9wdXRfY29udGVudHNcKFxzKlwkZGJuYW1lXHMqLFxzKlwkdGhpcy0+Z2V0SW1hZ2VFbmNvZGVkVGV4dFwoXHMqXCRkYm5hbWUiO2k6ODY7czoxMTc6IlwkY29udGVudFxzKj1ccypodHRwX3JlcXVlc3RcKFsnIl17MCwxfWh0dHA6Ly9bJyJdezAsMX1ccypcLlxzKlwkX1NFUlZFUlxbWyciXXswLDF9U0VSVkVSX05BTUVbJyJdezAsMX1cXVwuWyciXXswLDF9LyI7aTo4NztzOjYwOiJtYWlsXChccypcJE1haWxUb1xzKixccypcJE1lc3NhZ2VTdWJqZWN0XHMqLFxzKlwkTWVzc2FnZUJvZHkiO2k6ODg7czozNjoiZmlsZV9wdXRfY29udGVudHNcKFxzKlsnIl17MCwxfS9ob21lIjtpOjg5O3M6NzA6Im1haWxcKFxzKlwkYVxbXGQrXF1ccyosXHMqXCRhXFtcZCtcXVxzKixccypcJGFcW1xkK1xdXHMqLFxzKlwkYVxbXGQrXF0iO2k6OTA7czoyMzoiaXNfd3JpdGFibGU9aXNfd3JpdGFibGUiO2k6OTE7czoyMzoiZXhwbG9pdC1kYlwuY29tL3NlYXJjaC8iO2k6OTI7czoxNDoiRGF2aWRccypCbGFpbmUiO2k6OTM7czozMzoiY3JvbnRhYlxzKy1sXHxncmVwXHMrLXZccytjcm9udGFiIjtpOjk0O3M6ODA6IihmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXChccypbJyJdezAsMX1hdFxzK25vd1xzKy1mIjtpOjk1O3M6NjM6IiMhL2Jpbi9zaG5jZFxzK1snIl17MCwxfVsnIl17MCwxfVwuXCRTQ1BcLlsnIl17MCwxfVsnIl17MCwxfW5pZiI7aTo5NjtzOjQ0OiJmaWxlX3B1dF9jb250ZW50c1woWyciXXswLDF9XC4vbGlid29ya2VyXC5zbyI7aTo5NztzOjM2OiJcJHVzZXJfYWdlbnRfdG9fZmlsdGVyXHMqPVxzKmFycmF5XCgiO2k6OTg7czoyMDoiZm9wZW5cKFxzKlsnIl0vaG9tZS8iO2k6OTk7czoyMDoibWtkaXJcKFxzKlsnIl0vaG9tZS8iO2k6MTAwO3M6Mzk6IiNVc2VbJyJdezAsMX1ccyosXHMqZmlsZV9nZXRfY29udGVudHNcKCI7aToxMDE7czoyOToiZXJlZ2lcKFxzKnNxbF9yZWdjYXNlXChccypcJF8iO2k6MTAyO3M6NzE6IlwkX1xbXHMqXGQrXHMqXF1cKFxzKlwkX1xbXHMqXGQrXHMqXF1cKFwkX1xbXHMqXGQrXHMqXF1cKFxzKlwkX1xbXHMqXGQrIjtpOjEwMztzOjM2OiJldmFsXChccypcJFthLXpBLVowLTlfXSs/XChccypcJDxhbWMiO2k6MTA0O3M6MzM6IkBcJGZ1bmNcKFwkY2ZpbGUsIFwkY2RpclwuXCRjbmFtZSI7aToxMDU7czo2MjoidW5hbWVcXVsnIl17MCwxfVxzKlwuXHMqcGhwX3VuYW1lXChcKVxzKlwuXHMqWyciXXswLDF9XFsvdW5hbWUiO2k6MTA2O3M6NTQ6IlwkR0xPQkFMU1xbWyciXXswLDF9W2EtekEtWjAtOV9dKz9bJyJdezAsMX1cXVwoXHMqTlVMTCI7aToxMDc7czoyMzoiX191cmxfZ2V0X2NvbnRlbnRzXChcJGwiO2k6MTA4O3M6MjY6IlwkZG9yX2NvbnRlbnQ9cHJlZ19yZXBsYWNlIjtpOjEwOTtzOjczOiIoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVwoWyciXWxzXHMrL3Zhci9tYWlsIjtpOjExMDtzOjMwOiJoZWFkZXJcKFsnIl17MCwxfXI6XHMqbm9ccytjb20iO2k6MTExO3M6NDg6InByZWdfbWF0Y2hfYWxsXChccypbJyJdXHxcKFwuXCpcKTxcXCEtLSBqcy10b29scyI7aToxMTI7czozNzoiaWZccypcKFxzKmluaV9nZXRcKFsnIl17MCwxfXNhZmVfbW9kZSI7aToxMTM7czo0OToiQCpmaWxlX3B1dF9jb250ZW50c1woXHMqXCR0aGlzLT5maWxlXHMqLFxzKnN0cnJldiI7aToxMTQ7czo0MToiL3BsdWdpbnMvc2VhcmNoL3F1ZXJ5XC5waHBcP19fX19wZ2ZhPWh0dHAiO2k6MTE1O3M6OTE6Im1haWxcKFxzKnN0cmlwc2xhc2hlc1woXCR0b1wpXHMqLFxzKnN0cmlwc2xhc2hlc1woXCRzdWJqZWN0XClccyosXHMqc3RyaXBzbGFzaGVzXChcJG1lc3NhZ2UiO2k6MTE2O3M6ODU6IlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXFtbJyJdezAsMX11clsnIl17MCwxfVxdXClcKVxzKlwkbW9kZVxzKlx8PVxzKjA0MDAiO2k6MTE3O3M6ODI6ImVyZWdfcmVwbGFjZVwoWyciXXswLDF9JTVDJTIyWyciXXswLDF9XHMqLFxzKlsnIl17MCwxfSUyMlsnIl17MCwxfVxzKixccypcJG1lc3NhZ2UiO2k6MTE4O3M6ODg6ImZpbGVfcHV0X2NvbnRlbnRzXChccypcJG5hbWVccyosXHMqYmFzZTY0X2RlY29kZVwoXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MTE5O3M6MTIyOiJ3aW5kb3dcLmxvY2F0aW9uPWJ9XHMqXClcKFxzKm5hdmlnYXRvclwudXNlckFnZW50XHMqXHxcfFxzKm5hdmlnYXRvclwudmVuZG9yXHMqXHxcfFxzKndpbmRvd1wub3BlcmFccyosXHMqWyciXXswLDF9aHR0cDovLyI7aToxMjA7czo4OToiXCRzYXBlX29wdGlvblxbXHMqWyciXXswLDF9ZmV0Y2hfcmVtb3RlX3R5cGVbJyJdezAsMX1ccypcXVxzKj1ccypbJyJdezAsMX1zb2NrZXRbJyJdezAsMX0iO2k6MTIxO3M6MTA1OiJcJHBhdGhccyo9XHMqXCRfU0VSVkVSXFtccypbJyJdezAsMX1ET0NVTUVOVF9ST09UWyciXXswLDF9XHMqXF1ccypcLlxzKlsnIl17MCwxfS9pbWFnZXMvc3Rvcmllcy9bJyJdezAsMX0iO2k6MTIyO3M6ODI6IkAqYXJyYXlfZGlmZl91a2V5XChccypAKmFycmF5XChccypcKHN0cmluZ1wpXHMqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MTIzO3M6MjA6ImV2YWxccypcKFxzKlRQTF9GSUxFIjtpOjEyNDtzOjM4OiJKUmVzcG9uc2U6OnNldEJvZHlccypcKFxzKnByZWdfcmVwbGFjZSI7aToxMjU7czo0ODoiXHMqWyciXXswLDF9c2x1cnBbJyJdezAsMX1ccyosXHMqWyciXXswLDF9bXNuYm90IjtpOjEyNjtzOjU0OiJccypbJyJdezAsMX1yb29rZWVbJyJdezAsMX1ccyosXHMqWyciXXswLDF9d2ViZWZmZWN0b3IiO2k6MTI3O3M6MTE6IkNvdXBkZWdyYWNlIjtpOjEyODtzOjEyOiJTdWx0YW5IYWlrYWwiO2k6MTI5O3M6NjA6ImZpbGVfZ2V0X2NvbnRlbnRzXChiYXNlbmFtZVwoXCRfU0VSVkVSXFtbJyJdezAsMX1TQ1JJUFRfTkFNRSI7aToxMzA7czoyNzoiaHR0cHM6Ly9hcHBsZWlkXC5hcHBsZVwuY29tIjtpOjEzMTtzOjE5OiJcJGJrZXl3b3JkX2Jlej1bJyJdIjtpOjEzMjtzOjM0OiJjcmMzMlwoXHMqXCRfUE9TVFxbXHMqWyciXXswLDF9Y21kIjtpOjEzMztzOjE5OiJncmVwXHMrLXZccytjcm9udGFiIjtpOjEzNDtzOjI4OiJbJyJdWyciXVxzKlwuXHMqZ3pVbmNvTXByZVNzIjtpOjEzNTtzOjI5OiJbJyJdWyciXVxzKlwuXHMqQkFzZTY0X2RlQ29EZSI7aToxMzY7czozMjoiZXZhbFwoWyciXVw/PlsnIl1cLmJhc2U2NF9kZWNvZGUiO2k6MTM3O3M6Mjc6ImN1cmxfaW5pdFwoXHMqYmFzZTY0X2RlY29kZSI7aToxMzg7czoxMjoibWlsdzBybVwuY29tIjtpOjEzOTtzOjQ1OiJcJGZpbGVcKEAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MTQwO3M6MzY6InJldHVyblxzK2Jhc2U2NF9kZWNvZGVcKFwkYVxbXCRpXF1cKSI7aToxNDE7czo4OiJIYXJjaGFMaSI7aToxNDI7czo2MDoicGx1Z2lucy9zZWFyY2gvcXVlcnlcLnBocFw/X19fX3BnZmE9aHR0cCUzQSUyRiUyRnd3d1wuZ29vZ2xlIjtpOjE0MztzOjM2OiJjcmVhdGVfZnVuY3Rpb25cKHN1YnN0clwoMiwxXCksXCRzXCkiO2k6MTQ0O3M6ODE6InR5cGVvZlxzKlwoZGxlX2FkbWluXClccyo9PVxzKlsnIl17MCwxfXVuZGVmaW5lZFsnIl17MCwxfVxzKlx8XHxccypkbGVfYWRtaW5ccyo9PSI7aToxNDU7czozMjoiXFtcJG9cXVwpO1wkb1wrXCtcKXtpZlwoXCRvPDE2XCkiO2k6MTQ2O3M6MzI6IlwkU1xbXCRpXCtcK1xdXChcJFNcW1wkaVwrXCtcXVwoIjtpOjE0NztzOjM3OiJzZXRjb29raWVcKFxzKlwkelxbMFxdXHMqLFxzKlwkelxbMVxdIjtpOjE0ODtzOjg2OiIvaW5kZXhcLnBocFw/b3B0aW9uPWNvbV9qY2UmdGFzaz1wbHVnaW4mcGx1Z2luPWltZ21hbmFnZXImZmlsZT1pbWdtYW5hZ2VyJnZlcnNpb249MTU3NiI7aToxNDk7czoxNToiY2F0YXRhblxzK3NpdHVzIjtpOjE1MDtzOjQxOiJpZlwoXHMqaXNzZXRcKFxzKlwkX1JFUVVFU1RcW1snIl17MCwxfWNpZCI7aToxNTE7czo0MDoic3RyX3JlcGxhY2VccypcKFxzKlsnIl17MCwxfS9wdWJsaWNfaHRtbCI7aToxNTI7czo1MToiQGFycmF5XChccypcKHN0cmluZ1wpXHMqc3RyaXBzbGFzaGVzXChccypcJF9SRVFVRVNUIjtpOjE1MztzOjYwOiJpZlxzKlwoXHMqZmlsZV9wdXRfY29udGVudHNccypcKFxzKlwkaW5kZXhfcGF0aFxzKixccypcJGNvZGUiO2k6MTU0O3M6OTQ6ImlmXChpc19kaXJcKFwkcGF0aFwuWyciXXswLDF9L3dwLWNvbnRlbnRbJyJdezAsMX1cKVxzK0FORFxzK2lzX2RpclwoXCRwYXRoXC5bJyJdezAsMX0vd3AtYWRtaW4iO2k6MTU1O3M6Mjg6ImlmXChcJG88MTZcKXtcJGhcW1wkZVxbXCRvXF0iO2k6MTU2O3M6OToiYnlccytnMDBuIjtpOjE1NztzOjE1OiJBdXRvXHMqWHBsb2l0ZXIiO2k6MTU4O3M6MTAyOiIoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVwoWyciXXswLDF9XCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcWyIiO2k6MTU5O3M6NzI6IihmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXChbJyJdezAsMX1jbWRcLmV4ZSI7aToxNjA7czo5OiJCeVxzK0RaMjciO2k6MTYxO3M6Mjc6IkV0aG5pY1xzK0FsYmFuaWFuXHMrSGFja2VycyI7aToxNjI7czoyMDoiVm9sZ29ncmFkaW5kZXhcLmh0bWwiO2k6MTYzO3M6MzI6IlwkX1Bvc3RcW1snIl17MCwxfVNTTlsnIl17MCwxfVxdIjtpOjE2NDtzOjE1OiJwYWNrXHMrIlNuQTR4OCIiO2k6MTY1O3M6MTQ6IlsnIl17MCwxfURaZTFyIjtpOjE2NjtzOjEyOiJUZWFNXHMrTW9zVGEiO2k6MTY3O3M6NjM6ImlmXChtYWlsXChcJGVtYWlsXFtcJGlcXSxccypcJHN1YmplY3QsXHMqXCRtZXNzYWdlLFxzKlwkaGVhZGVycyI7aToxNjg7czozNjoicHJpbnRccytbJyJdezAsMX1kbGVfbnVsbGVkWyciXXswLDF9IjtpOjE2OTtzOjM5OiJpZlxzKlwoY2hlY2tfYWNjXChcJGxvZ2luLFwkcGFzcyxcJHNlcnYiO2k6MTcwO3M6Mzg6InByZWdfcmVwbGFjZVwoXCl7cmV0dXJuXHMrX19GVU5DVElPTl9fIjtpOjE3MTtzOjMzOiJcJG9wdFxzKj1ccypcJGZpbGVcKEAqXCRfQ09PS0lFXFsiO2k6MTcyO3M6MzY6ImlmXChAZnVuY3Rpb25fZXhpc3RzXChbJyJdezAsMX1mcmVhZCI7aToxNzM7czoxMDg6ImZvclwoXCRbYS16QS1aMC05X10rPz1cZCs7XCRbYS16QS1aMC05X10rPzxcZCs7XCRbYS16QS1aMC05X10rPy09XGQrXCl7aWZcKFwkW2EtekEtWjAtOV9dKz8hPVxkK1wpXHMqYnJlYWs7fSI7aToxNzQ7czozNToiXCRjb3VudGVyVXJsXHMqPVxzKlsnIl17MCwxfWh0dHA6Ly8iO2k6MTc1O3M6Njc6ImFycmF5XChccypbJyJdaFsnIl1ccyosXHMqWyciXXRbJyJdXHMqLFxzKlsnIl10WyciXVxzKixccypbJyJdcFsnIl0iO2k6MTc2O3M6NDI6ImlmXHMqXChmdW5jdGlvbl9leGlzdHNcKFsnIl1zY2FuX2RpcmVjdG9yeSI7aToxNzc7czo2MjoiXCRfU0VTU0lPTlxbWyciXXswLDF9ZGF0YV9hWyciXXswLDF9XF1cW1wkbmFtZVxdXHMqPVxzKlwkdmFsdWUiO2k6MTc4O3M6Mzg6IlplbmRccytPcHRpbWl6YXRpb25ccyt2ZXJccysxXC4wXC4wXC4xIjtpOjE3OTtzOjI2OiJpbmRleFwucGhwXD9pZD1cJDEmJXtRVUVSWSI7aToxODA7czo4NjoiQGluaV9zZXRccypcKFsnIl17MCwxfWluY2x1ZGVfcGF0aFsnIl17MCwxfSxbJyJdezAsMX1pbmlfZ2V0XHMqXChbJyJdezAsMX1pbmNsdWRlX3BhdGgiO2k6MTgxO3M6Mjg6ImlmXHMqXChAaXNfd3JpdGFibGVcKFwkaW5kZXgiO2k6MTgyO3M6Mjg6IlwkX1BPU1RcW1snIl17MCwxfXNtdHBfbG9naW4iO2k6MTgzO3M6Mzc6Il9bJyJdezAsMX1cXVxbMlxdXChbJyJdezAsMX1Mb2NhdGlvbjoiO2k6MTg0O3M6MzQ6ImlmXChAcHJlZ19tYXRjaFwoc3RydHJcKFsnIl17MCwxfS8iO2k6MTg1O3M6MTU6IjwhLS1ccytqcy10b29scyI7aToxODY7czo3OiJ1Z2djOi8vIjtpOjE4NztzOjQ3OiJpZiBcKGRhdGVcKFsnIl17MCwxfWpbJyJdezAsMX1cKVxzKi1ccypcJG5ld3NpZCI7aToxODg7czoxNjoiPERhdmlkXHMrQmxhaW5lPiI7aToxODk7czoyNToiXCRpc2V2YWxmdW5jdGlvbmF2YWlsYWJsZSI7aToxOTA7czo0MToiaWYgXCghc3RycG9zXChcJHN0cnNcWzBcXSxbJyJdezAsMX08XD9waHAiO2k6MTkxO3M6ODU6Ilwkc3RyaW5nXHMqPVxzKlwkX1NFU1NJT05cW1snIl17MCwxfWRhdGFfYVsnIl17MCwxfVxdXFtbJyJdezAsMX1udXR6ZXJuYW1lWyciXXswLDF9XF0iO2k6MTkyO3M6NTY6IndoaWxlXChjb3VudFwoXCRsaW5lc1wpPlwkY29sX3phcFwpIGFycmF5X3BvcFwoXCRsaW5lc1wpIjtpOjE5MztzOjEwNDoic2l0ZV9mcm9tPVsnIl17MCwxfVwuXCRfU0VSVkVSXFtbJyJdezAsMX1IVFRQX0hPU1RbJyJdezAsMX1cXVwuWyciXXswLDF9JnNpdGVfZm9sZGVyPVsnIl17MCwxfVwuXCRmXFsxXF0iO2k6MTk0O3M6MzE6IlwkZmlsZWJccyo9XHMqZmlsZV9nZXRfY29udGVudHMiO2k6MTk1O3M6MzM6InBvcnRsZXRzL2ZyYW1ld29yay9zZWN1cml0eS9sb2dpbiI7aToxOTY7czoyOToiXCRiXHMqPVxzKm1kNV9maWxlXChcJGZpbGViXCkiO2k6MTk3O3M6NTE6IlwkZGF0YVxzKj1ccyphcnJheVwoWyciXXswLDF9dGVybWluYWxbJyJdezAsMX1ccyo9PiI7aToxOTg7czo3MDoic3RycG9zXChcJF9TRVJWRVJcW1snIl17MCwxfUhUVFBfUkVGRVJFUlsnIl17MCwxfVxdLFxzKlsnIl17MCwxfWdvb2dsZSI7aToxOTk7czo3MDoic3RycG9zXChcJF9TRVJWRVJcW1snIl17MCwxfUhUVFBfUkVGRVJFUlsnIl17MCwxfVxdLFxzKlsnIl17MCwxfXlhbmRleCI7aToyMDA7czo3Nzoic3RyaXN0clwoXCRfU0VSVkVSXFtbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1cXSxccypbJyJdezAsMX1ZYW5kZXhCb3QiO2k6MjAxO3M6NTM6ImZvcGVuXChbJyJdezAsMX1cLlwuL1wuXC4vXC5cLi9bJyJdezAsMX1cLlwkZmlsZXBhdGhzIjtpOjIwMjtzOjM2OiJwcmVnX3JlcGxhY2VcKFxzKlsnIl1lWyciXSxbJyJdezAsMX0iO2k6MjAzO3M6NDA6IihbXlw/XHNdKVwoezAsMX1cLltcK1wqXVwpezAsMX1cMlthLXpdKmUiO2k6MjA0O3M6MTc6Im14MlwuaG90bWFpbFwuY29tIjtpOjIwNTtzOjM1OiJwaHBfWyciXVwuXCRleHRcLlsnIl1cLmRsbFsnIl17MCwxfSI7aToyMDY7czoyMDoiL2VbJyJdXHMqLFxzKlsnIl1cXHgiO2k6MjA3O3M6MzI6IjxoMT40MDMgRm9yYmlkZGVuPC9oMT48IS0tIHRva2VuIjtpOjIwODtzOjIzOiIvdmFyL3FtYWlsL2Jpbi9zZW5kbWFpbCI7aToyMDk7czo0NDoiYXJyYXlcKFxzKlsnIl1Hb29nbGVbJyJdXHMqLFxzKlsnIl1TbHVycFsnIl0iO2k6MjEwO3M6MTI6ImFuZGV4XHxvb2dsZSI7aToyMTE7czoyNDoicGFnZV9maWxlcy9zdHlsZTAwMFwuY3NzIjtpOjIxMjtzOjIxOiI9PVsnIl1cKVwpO3JldHVybjtcPz4iO2k6MjEzO3M6MTY6IlNwYW1ccytjb21wbGV0ZWQiO2k6MjE0O3M6MzU6ImVjaG9ccytbJyJdezAsMX1pbnN0YWxsX29rWyciXXswLDF9IjtpOjIxNTtzOjYwOiJcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbWyciXXswLDF9Y3Z2WyciXXswLDF9XF0iO2k6MjE2O3M6MTE6IkNWVjpccypcJGN2IjtpOjIxNztzOjMwOiJjdXJsXC5oYXh4XC5zZS9yZmMvY29va2llX3NwZWMiO2k6MjE4O3M6MTI6ImtpbGxhbGxccystOSI7aToyMTk7czo1NzoicHJlZ19yZXBsYWNlXHMqXChccypAKlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpIjtpOjIyMDtzOjU4OiJcJG1haWxlclxzKj1ccypcJF9QT1NUXFtccypbJyJdezAsMX14X21haWxlclsnIl17MCwxfVxzKlxdIjtpOjIyMTtzOjMwOiJwcmVnX3JlcGxhY2VccypcKFxzKlsnIl0vXC5cKi8iO2k6MjIyO3M6Mjk6IkVycm9yRG9jdW1lbnRccys0MDBccytodHRwOi8vIjtpOjIyMztzOjI5OiJFcnJvckRvY3VtZW50XHMrNTAwXHMraHR0cDovLyI7aToyMjQ7czoyODoiZ29vZ2xlXHx5YW5kZXhcfGJvdFx8cmFtYmxlciI7aToyMjU7czoyMToiZXZhbFxzKlwoXHMqc3RyX3JvdDEzIjtpOjIyNjtzOjM4OiJldmFsXHMqXChccypnemluZmxhdGVccypcKFxzKnN0cl9yb3QxMyI7aToyMjc7czo0ODoiZnVuY3Rpb25ccypjaG1vZF9SXHMqXChccypcJHBhdGhccyosXHMqXCRwZXJtXHMqIjtpOjIyODtzOjMzOiJzeW1iaWFuXHxtaWRwXHx3YXBcfHBob25lXHxwb2NrZXQiO2k6MjI5O3M6Mjg6ImVjaG9ccytbJyJdb1wua1wuWyciXTtccypcPz4iO2k6MjMwO3M6NzI6IkBzZXRjb29raWVcKFsnIl1tWyciXSxccypbJyJdW2EtekEtWjAtOV9dKz9bJyJdLFxzKnRpbWVcKFwpXHMqXCtccyo4NjQwMCI7aToyMzE7czo3MDoiKGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilccypcKCpccypbJyJdd2dldCI7aToyMzI7czozMzoiZ3p1bmNvbXByZXNzXHMqXChccypiYXNlNjRfZGVjb2RlIjtpOjIzMztzOjMwOiJnemluZmxhdGVccypcKFxzKmJhc2U2NF9kZWNvZGUiO2k6MjM0O3M6MjU6ImV2YWxccypcKFxzKmJhc2U2NF9kZWNvZGUiO2k6MjM1O3M6MzI6InN0cl9pcmVwbGFjZVxzKlwoKlxzKlsnIl08L2hlYWQ+IjtpOjIzNjtzOjM5OiJpZlxzKlwoXHMqcHJlZ19tYXRjaFxzKlwoXHMqWyciXSN5YW5kZXgiO2k6MjM3O3M6MzE6Ij1ccyphcnJheV9tYXBccypcKCpccypzdHJyZXZccyoiO2k6MjM4O3M6OToiXCRfX19ccyo9IjtpOjIzOTtzOjQ5OiJnenVuY29tcHJlc3NccypcKCpccypzdWJzdHJccypcKCpccypiYXNlNjRfZGVjb2RlIjtpOjI0MDtzOjIzOiJBZGRIYW5kbGVyXHMrY2dpLXNjcmlwdCI7aToyNDE7czoyMzoiQWRkSGFuZGxlclxzK3BocC1zY3JpcHQiO2k6MjQyO3M6MTQ1OiJcJFthLXpBLVowLTlfXSs/XHMqXChccypcZCtccypcXlxzKlxkK1xzKlwpXHMqXC5ccypcJFthLXpBLVowLTlfXSs/XHMqXChccypcZCtccypcXlxzKlxkK1xzKlwpXHMqXC5ccypcJFthLXpBLVowLTlfXSs/XHMqXChccypcZCtccypcXlxzKlxkK1xzKlwpIjtpOjI0MztzOjM4OiJzdHJlYW1fc29ja2V0X2NsaWVudFxzKlwoXHMqWyciXXRjcDovLyI7aToyNDQ7czo5NToiaXNzZXRcKFxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVClcW1snIl1bYS16QS1aMC05X10rP1snIl1cXVwpXHMqb3JccypkaWVcKCouKj9cKSoiO2k6MjQ1O3M6NTc6Ik9wdGlvbnNccytGb2xsb3dTeW1MaW5rc1xzK011bHRpVmlld3NccytJbmRleGVzXHMrRXhlY0NHSSI7aToyNDY7czozMjoiaXNfd3JpdGFibGVccypcKCpccypbJyJdL3Zhci90bXAiO2k6MjQ3O3M6OTU6ImFkZF9maWx0ZXJccypcKCpccypbJyJdezAsMX10aGVfY29udGVudFsnIl17MCwxfVxzKixccypbJyJdezAsMX1fYmxvZ2luZm9bJyJdezAsMX1ccyosXHMqLis/XCkqIjtpOjI0ODtzOjI5OiJldmFsXHMqXCgqXHMqZ2V0X29wdGlvblxzKlwoKiI7aToyNDk7czoxMDQ6IihmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXHMqXCgqXHMqQCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxzKlxbIjtpOjI1MDtzOjEwNzoiaWZccypcKFxzKmlzX2NhbGxhYmxlXHMqXCgqXHMqWyciXXswLDF9KGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilbJyJdezAsMX1ccypcKSoiO2k6MjUxO3M6MTE0OiJpZlxzKlwoXHMqZnVuY3Rpb25fZXhpc3RzXHMqXChccypbJyJdezAsMX0oZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVsnIl17MCwxfVxzKlwpXHMqXCkiO2k6MjUyO3M6NzQ6IihmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXHMqXCgqXHMqWyciXXJtXHMqLWZyIjtpOjI1MztzOjc0OiIoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVxzKlwoKlxzKlsnIl1ybVxzKi1yZiI7aToyNTQ7czo3ODoiKGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilccypcKCpccypbJyJdcm1ccyotclxzKi1mIjtpOjI1NTtzOjQwOiJldmFsXHMqXCgqXHMqZ3ppbmZsYXRlXHMqXCgqXHMqc3RyX3JvdDEzIjtpOjI1NjtzOjE5OiJyb3VuZFxzKlwoXHMqMFxzKlwrIjtpOjI1NztzOjE5OiJDb250ZW50LVR5cGU6XHMqXCRfIjt9"));
$gXX_FlexDBShe = unserialize(base64_decode("YToyNzE6e2k6MDtzOjI1OiJmdW5jdGlvblxzK2Vycm9yXzQwNFwoXCl7IjtpOjE7czo5NzoiXCRHTE9CQUxTXFtbJyJdW2EtekEtWjAtOV9dKz9bJyJdXF1cW1wkR0xPQkFMU1xbWyciXVthLXpBLVowLTlfXSs/WyciXVxdXFtcZCtcXVwocm91bmRcKFxkK1wpXClcXSI7aToyO3M6Mzg6IkBzaGVsbF9leGVjXChccypAdXJsZW5jb2RlXChccypcJF9QT1NUIjtpOjM7czozNToiZmlsZV9nZXRfY29udGVudHNcKFxzKl9fRklMRV9fXHMqXCkiO2k6NDtzOjQ4OiJcJGVjaG9fMVwuXCRlY2hvXzJcLlwkZWNob18zXC5cJGVjaG9fNFwuXCRlY2hvXzUiO2k6NTtzOjM3OiJpZlxzKlwoXHMqaXNfY3Jhd2xlcjFcKFxzKlwpXHMqXClccyp7IjtpOjY7czo4NDoiZXZhbFwoXHMqW2EtekEtWjAtOV9dKz9cKFxzKlwkW2EtekEtWjAtOV9dKz9ccyosXHMqXCRbYS16QS1aMC05X10rP1xzKlwpXHMqXCk7XHMqXD8+IjtpOjc7czozMToiPT5ccypAXCRmMlwoX19GSUxFX19ccyosXHMqXCRmMSI7aTo4O3M6MTEwOiJoZWFkZXJcKFxzKlsnIl1Db250ZW50LVR5cGU6XHMqaW1hZ2UvanBlZ1snIl1ccypcKTtccypyZWFkZmlsZVwoXHMqWyciXVthLXpBLVowLTlfXSs/WyciXVxzKlwpO1xzKmV4aXRcKFxzKlwpOyI7aTo5O3M6MjQ1OiJcJFthLXpBLVowLTlfXSs/XHMqPVxzKlwkW2EtekEtWjAtOV9dKz9cKFsnIl1bJyJdXHMqLFxzKlwkW2EtekEtWjAtOV9dKz9cKFxzKlwkW2EtekEtWjAtOV9dKz9cKFxzKlsnIl1bYS16QS1aMC05X10rP1snIl1ccyosXHMqWyciXVsnIl1ccyosXHMqXCRbYS16QS1aMC05X10rP1xzKlwuXHMqXCRbYS16QS1aMC05X10rP1xzKlwuXHMqXCRbYS16QS1aMC05X10rP1xzKlwuXHMqXCRbYS16QS1aMC05X10rP1xzKlwpXHMqXClccypcKSI7aToxMDtzOjYzOiJcJF9QT1NUXFtbJyJdezAsMX10cDJbJyJdezAsMX1cXVxzKlwpXHMqYW5kXHMqaXNzZXRcKFxzKlwkX1BPU1QiO2k6MTE7czo0MToiY2htb2RcKFwkZmlsZS0+Z2V0UGF0aG5hbWVcKFwpXHMqLFxzKjA3NzciO2k6MTI7czozODoiPVxzKmd6aW5mbGF0ZVwoXHMqYmFzZTY0X2RlY29kZVwoXHMqXCQiO2k6MTM7czo2NDoiXCRfUE9TVFxbWyciXXswLDF9YWN0aW9uWyciXXswLDF9XF1ccyo9PVxzKlsnIl1nZXRfYWxsX2xpbmtzWyciXSI7aToxNDtzOjc1OiJmdW5jdGlvbjxzcz5zbXRwX21haWxcKFwkdG9ccyosXHMqXCRzdWJqZWN0XHMqLFxzKlwkbWVzc2FnZVxzKixccypcJGhlYWRlcnMiO2k6MTU7czo2NzoiXCRnenBccyo9XHMqXCRiZ3pFeGlzdFxzKlw/XHMqQGd6b3BlblwoXCR0bXBmaWxlLFxzKlsnIl1yYlsnIl1ccypcKSI7aToxNjtzOjQzOiJcXVxzKlwpXHMqXC5ccypbJyJdXFxuXD8+WyciXVxzKlwpXHMqXClccyp7IjtpOjE3O3M6NDA6IkNvZGVNaXJyb3JcLmRlZmluZU1JTUVcKFxzKlsnIl10ZXh0L21pcmMiO2k6MTg7czoyODoiY2htb2RcKFxzKl9fRElSX19ccyosXHMqMDQwMCI7aToxOTtzOjQwOiJmcHV0c1woXCRmcCxccypbJyJdSVA6XHMqXCRpcFxzKi1ccypEQVRFIjtpOjIwO3M6NDQ6IlwkZmlsZV9kYXRhXHMqPVxzKlsnIl08c2NyaXB0XHMqc3JjPVsnIl1odHRwIjtpOjIxO3M6MTI6Im5ld1xzKk1DdXJsOyI7aToyMjtzOjI0OiJuc2xvb2t1cFwuZXhlXHMqLXR5cGU9TVgiO2k6MjM7czozNDoiZnVuY3Rpb25fZXhpc3RzXHMqXChccypbJyJdZ2V0bXhyciI7aToyNDtzOjMyOiJkbnNfZ2V0X3JlY29yZFwoXHMqXCRkb21haW5ccypcLiI7aToyNTtzOjExNjoibW92ZV91cGxvYWRlZF9maWxlXChccypcJF9GSUxFU1xbXHMqWyciXXswLDF9W2EtekEtWjAtOV9dKz9bJyJdezAsMX1ccypcXVxbWyciXXswLDF9dG1wX25hbWVbJyJdezAsMX1cXVxbXHMqXCRpXHMqXF0iO2k6MjY7czoxMDk6ImNvcHlcKFxzKlwkX0ZJTEVTXFtccypbJyJdezAsMX1bYS16QS1aMC05X10rP1snIl17MCwxfVxzKlxdXFtccypbJyJdezAsMX10bXBfbmFtZVsnIl17MCwxfVxzKlxdXHMqLFxzKlwkX1BPU1QiO2k6Mjc7czo4NjoiXCR1cmxccypcLj1ccypbJyJdXD9bYS16QS1aMC05X10rPz1bJyJdXHMqXC5ccypcJF9HRVRcW1xzKlsnIl1bYS16QS1aMC05X10rP1snIl1ccypcXTsiO2k6Mjg7czoyNjoiPFw/XHMqZWNob1xzKlwkY29udGVudDtcPz4iO2k6Mjk7czozODoiUmV3cml0ZUNvbmRccyole0hUVFBfUkVGRVJFUn1ccypnb29nbGUiO2k6MzA7czozODoiUmV3cml0ZUNvbmRccyole0hUVFBfUkVGRVJFUn1ccyp5YW5kZXgiO2k6MzE7czozNjoiaWZccypcKFxzKlwkX1BPU1RcW1snIl17MCwxfWNobW9kNzc3IjtpOjMyO3M6NDI6ImNvbm5ccyo9XHMqaHR0cGxpYlwuSFRUUENvbm5lY3Rpb25cKFxzKnVyaSI7aTozMztzOjMzOiJlY2hvXHMqXCRwcmV3dWVcLlwkbG9nXC5cJHBvc3R3dWUiO2k6MzQ7czo0NDoiaGVhZGVyXChccypbJyJdUmVmcmVzaDpccypcZCs7XHMqVVJMPWh0dHA6Ly8iO2k6MzU7czozNjoic2V0X3RpbWVfbGltaXRcKFxzKmludHZhbFwoXHMqXCRhcmd2IjtpOjM2O3M6Mzc6ImRpZVwoWyciXTxzY3JpcHQ+ZG9jdW1lbnRcLmxvY2F0aW9uXC4iO2k6Mzc7czozODoiZXhpdFwoWyciXTxzY3JpcHQ+ZG9jdW1lbnRcLmxvY2F0aW9uXC4iO2k6Mzg7czo5OiJHQUdBTDwvYj4iO2k6Mzk7czo5MDoiKGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilccypcKFxzKlsnIl1cJFthLXpBLVowLTlfXSs/WyciXVxzKlwpIjtpOjQwO3M6MTk6ImJ1ZGFrXHMqLVxzKmV4cGxvaXQiO2k6NDE7czoyMjoiYXJyYXlcKFxzKlsnIl0lMWh0bWwlMyI7aTo0MjtzOjU2OiJcJGNvZGU9WyciXSUxc2NyaXB0XHMqdHlwZT1cXFsnIl10ZXh0L2phdmFzY3JpcHRcXFsnIl0lMyI7aTo0MztzOjIzOiJlY2hvXChccypodG1sXChccyphcnJheSI7aTo0NDtzOjE1OiJAc3lzdGVtXChccyoiXCQiO2k6NDU7czoyMToiZnVuY3Rpb25ccypDdXJsQXR0YWNrIjtpOjQ2O3M6NDQ6IlJld3JpdGVSdWxlXHMqXF5cKFwuXCpcKVxzKmluZGV4XC5waHBcP209XCQxIjtpOjQ3O3M6NDU6IlJld3JpdGVSdWxlXHMqXF5cKFwuXCpcKVxzKmluZGV4XC5waHBcP2lkPVwkMSI7aTo0ODtzOjE1OiJIVFRQX0FDQ0VQVF9BU0UiO2k6NDk7czoyNDoiXClccyp7XHMqcGFzc3RocnVcKFxzKlwkIjtpOjUwO3M6MTg6IlJlZGlyZWN0XHMqaHR0cDovLyI7aTo1MTtzOjQyOiJSZXdyaXRlUnVsZVxzKlwoXC5cK1wpXHMqaW5kZXhcLnBocFw/cz1cJDAiO2k6NTI7czozMToiZXZhbFxzKlwoXHMqbWJfY29udmVydF9lbmNvZGluZyI7aTo1MztzOjQ4OiJwYXJzZV9xdWVyeV9zdHJpbmdcKFxzKlwkRU5We1xzKlsnIl1RVUVSWV9TVFJJTkciO2k6NTQ7czo0NDoiQFwkW2EtekEtWjAtOV9dKz9cKFxzKlwkW2EtekEtWjAtOV9dKz9ccypcKTsiO2k6NTU7czozOToiW2EtekEtWjAtOV9dKz9cKFxzKlthLXpBLVowLTlfXSs/PVxzKlwpIjtpOjU2O3M6MTI6IlsnIl1yaW55WyciXSI7aTo1NztzOjE0OiJbJyJdZmxmZ3J6WyciXSI7aTo1ODtzOjE1OiJbJyJdb2ZuaXBocFsnIl0iO2k6NTk7czoxNzoiWyciXTMxdG9yX3J0c1snIl0iO2k6NjA7czoxNDoiWyciXXRyZXNzYVsnIl0iO2k6NjE7czoxMzoiZWRvY2VkXzQ2ZXNhYiI7aTo2MjtzOjEyOiJzc2VycG1vY251emciO2k6NjM7czo5OiJldGFsZm5pemciO2k6NjQ7czoxMjoiWyciXXJpbnlbJyJdIjtpOjY1O3M6MTQ6IlsnIl1mbGZncnpbJyJdIjtpOjY2O3M6NzoiY3VjdmFzYiI7aTo2NztzOjk6ImZnZV9lYmcxMyI7aTo2ODtzOjE0OiJbJyJdbmZmcmVnWyciXSI7aTo2OTtzOjEzOiJvbmZyNjRfcXJwYnFyIjtpOjcwO3M6MTI6InRtaGFwYnpjZXJmZiI7aTo3MTtzOjk6InRtdmFzeW5nciI7aTo3MjtzOjQ4OiI8XD9ccypcJFthLXpBLVowLTlfXSs/XChccypcJFthLXpBLVowLTlfXSs/XHMqXCkiO2k6NzM7czoyMToiZGF0YTp0ZXh0L2h0bWw7YmFzZTY0IjtpOjc0O3M6MTM6Im51bGxfZXhwbG9pdHMiO2k6NzU7czoxMzA6ImlmXChpc3NldFwoXCRfUkVRVUVTVFxbWyciXVthLXpBLVowLTlfXSs/WyciXVxdXClcKVxzKntccypcJFthLXpBLVowLTlfXSs/XHMqPVxzKlwkX1JFUVVFU1RcW1snIl1bYS16QS1aMC05X10rP1snIl1cXTtccypleGl0XChcKTsiO2k6NzY7czo1NjoibWFpbFwoXHMqXCRhcnJcW1snIl10b1snIl1cXVxzKixccypcJGFyclxbWyciXXN1YmpbJyJdXF0iO2k6Nzc7czoyNDoidW5saW5rXChccypfX0ZJTEVfX1xzKlwpIjtpOjc4O3M6MjE6Ii1JL3Vzci9sb2NhbC9iYW5kbWFpbiI7aTo3OTtzOjQzOiJuYW1lPVsnIl11cGxvYWRlclsnIl1ccytpZD1bJyJddXBsb2FkZXJbJyJdIjtpOjgwO3M6MzE6ImVjaG9ccypbJyJdPGI+VXBsb2FkPHNzPlN1Y2Nlc3MiO2k6ODE7czozNzoiaGVhZGVyXChccypbJyJdTG9jYXRpb246XHMqXCRsaW5rWyciXSI7aTo4MjtzOjUxOiJ0eXBlPVsnIl1zdWJtaXRbJyJdXHMqdmFsdWU9WyciXVVwbG9hZCBmaWxlWyciXVxzKj4iO2k6ODM7czozMDoiZWxzZVxzKntccyplY2hvXHMqWyciXWZhaWxbJyJdIjtpOjg0O3M6NDQ6IlxzKj1ccyppbmlfZ2V0XChccypbJyJdZGlzYWJsZV9mdW5jdGlvbnNbJyJdIjtpOjg1O3M6NTc6IkBlcnJvcl9yZXBvcnRpbmdcKFxzKjBccypcKTtccyppZlxzKlwoXHMqIWlzc2V0XHMqXChccypcJCI7aTo4NjtzOjU4OiJyb3VuZFxzKlwoXHMqXChccypcJHBhY2tldHNccypcKlxzKjY1XClccyovXHMqMTAyNFxzKixccyoyIjtpOjg3O3M6MTI6Ilplcm9EYXlFeGlsZSI7aTo4ODtzOjExOiJTX1xdQF9cXlVcXiI7aTo4OTtzOjUwOiI8aW5wdXRccyt0eXBlPXN1Ym1pdFxzK3ZhbHVlPVVwbG9hZFxzKi8+XHMqPC9mb3JtPiI7aTo5MDtzOjEwODoiaWZcKFxzKiFzb2NrZXRfc2VuZHRvXChccypcJHNvY2tldFxzKixccypcJGRhdGFccyosXHMqc3RybGVuXChccypcJGRhdGFccypcKVxzKixccyowXHMqLFxzKlwkaXBccyosXHMqXCRwb3J0IjtpOjkxO3M6NTQ6InN1YnN0clwoXHMqXCRyZXNwb25zZVxzKixccypcJGluZm9cW1xzKlsnIl1oZWFkZXJfc2l6ZSI7aTo5MjtzOjE5OiJkaWVcKFxzKlsnIl1ubyBjdXJsIjtpOjkzO3M6NzQ6IlwkcmV0ID0gXCR0aGlzLT5fZGItPnVwZGF0ZU9iamVjdFwoIFwkdGhpcy0+X3RibCwgXCR0aGlzLCBcJHRoaXMtPl90Ymxfa2V5IjtpOjk0O3M6NDQ6Im9wZW5ccypcKFxzKk1ZRklMRVxzKixccypbJyJdXHMqPlxzKnRhclwudG1wIjtpOjk1O3M6MTg6Ii1cKi1ccypjb25mXHMqLVwqLSI7aTo5NjtzOjQ5OiJAdG91Y2hccypcKFxzKlwkY3VyZmlsZVxzKixccypcJHRpbWVccyosXHMqXCR0aW1lIjtpOjk3O3M6MzM6InRvdWNoXHMqXChccypkaXJuYW1lXChccypfX0ZJTEVfXyI7aTo5ODtzOjI3OiJcLlwuL1wuXC4vXC5cLi9cLlwuL21vZHVsZXMiO2k6OTk7czoyOToiZXhlY1woXHMqWyciXS9iaW4vc2hbJyJdXHMqXCkiO2k6MTAwO3M6MTU6Ii90bXAvXC5JQ0UtdW5peCI7aToxMDE7czoxNToiL3RtcC90bXAtc2VydmVyIjtpOjEwMjtzOjI2OiI9XHMqWyciXXNlbmRtYWlsXHMqLXRccyotZiI7aToxMDM7czoyNDoicHJvY19jbG9zZVwoXHMqXCRwcm9jZXNzIjtpOjEwNDtzOjE2OiI7XHMqL2Jpbi9zaFxzKi1pIjtpOjEwNTtzOjIzOiJbJyJdXHMqXHxccyovYmluL3NoWyciXSI7aToxMDY7czo0MjoiQHVtYXNrXChccyowNzc3XHMqJlxzKn5ccypcJGZpbGVwZXJtaXNzaW9uIjtpOjEwNztzOjUyOiJjaG1vZFwoXHMqXCRbXHMlXC5AXC1cK1woXCkvYS16QS1aMC05X10rP1xzKixccyowNzU1IjtpOjEwODtzOjUyOiJjaG1vZFwoXHMqXCRbXHMlXC5AXC1cK1woXCkvYS16QS1aMC05X10rP1xzKixccyowNDA0IjtpOjEwOTtzOjQ3OiJzdHJ0b2xvd2VyXChccypzdWJzdHJcKFxzKlwkdXNlcl9hZ2VudFxzKixccyowLCI7aToxMTA7czo5OiJMM1poY2k5M2QiO2k6MTExO3M6NTU6Ilwkb3V0XHMqXC49XHMqXCR0ZXh0e1xzKlwkaVxzKn1ccypcXlxzKlwka2V5e1xzKlwkalxzKn0iO2k6MTEyO3M6ODQ6Ii9pbmRleFwucGhwXD9vcHRpb249Y29tX2NvbnRlbnQmdmlldz1hcnRpY2xlJmlkPVsnIl1cLlwkcG9zdFxbWyciXXswLDF9aWRbJyJdezAsMX1cXSI7aToxMTM7czoyNzoiQGNoZGlyXChccypcJF9QT1NUXFtccypbJyJdIjtpOjExNDtzOjY0OiJpc3NldFwoXHMqXCRfQ09PS0lFXFtccyptZDVcKFxzKlwkX1NFUlZFUlxbXHMqWyciXXswLDF9SFRUUF9IT1NUIjtpOjExNTtzOjI3OiJzdHJsZW5cKFxzKlwkcGF0aFRvRG9yXHMqXCkiO2k6MTE2O3M6Mjk6ImZvcGVuXChccypbJyJdXC5cLi9cLmh0YWNjZXNzIjtpOjExNztzOjQzOiJcJF9QT1NUXFtccypbJyJdezAsMX1lTWFpbEFkZFsnIl17MCwxfVxzKlxdIjtpOjExODtzOjcyOiJtYWlsXChccypcJHJlY2lwaWVudFxzKixccypcJHN1YmplY3RccyosXHMqXCRtZXNzYWdlXHMqLFxzKlwkaGVhZGVyXHMqXCkiO2k6MTE5O3M6Njg6Im1haWxcKFxzKlwkc2VuZFxzKixccypcJHN1YmplY3RccyosXHMqXCRtZXNzYWdlXHMqLFxzKlwkaGVhZGVyc1xzKlwpIjtpOjEyMDtzOjUzOiJtYWlsXChccypcJHRvXHMqLFxzKlwkc3ViaixccypcJG1zZ1xzKixccypcJGZyb21ccypcKSI7aToxMjE7czo0MzoiY29udGVudD0iXGQrO1VSTD1odHRwczovL2RvY3NcLmdvb2dsZVwuY29tLyI7aToxMjI7czo0MjoiXCRrZXlccyo9XHMqXCRfR0VUXFtbJyJdezAsMX1xWyciXXswLDF9XF07IjtpOjEyMztzOjE5OiIvaW5zdHJ1a3RzaXlhLWRseWEtIjtpOjEyNDtzOjE0OiIvXD9kbz1vc2hpYmthLSI7aToxMjU7czoxNzoiL1w/ZG89a2FrLXVkYWxpdC0iO2k6MTI2O3M6MTU6Imd6aW5mbGF0ZVwoXChcKCI7aToxMjc7czoyMzoiMFxzKlwoXHMqZ3p1bmNvbXByZXNzXCgiO2k6MTI4O3M6MjA6IlwkX1JFUVVFU1RcW1snIl1sYWxhIjtpOjEyOTtzOjQzOiJzdHJwb3NcKFwkaW1ccyosXHMqWyciXTxcP1snIl1ccyosXHMqXCRpXCsxIjtpOjEzMDtzOjYzOiJodHRwOi8vd3d3XC5nb29nbGVcLmNvbS9zZWFyY2hcP3E9WyciXVwuXCRxdWVyeVwuWyciXSZobD1cJGxhbmciO2k6MTMxO3M6NDM6Imh0dHA6Ly9nb1wubWFpbFwucnUvc2VhcmNoXD9xPVsnIl1cLlwkcXVlcnkiO2k6MTMyO3M6NTA6Imh0dHA6Ly93d3dcLmJpbmdcLmNvbS9zZWFyY2hcP3E9XCRxdWVyeSZwcT1cJHF1ZXJ5IjtpOjEzMztzOjM4OiJzZXRUaW1lb3V0XChccypbJyJdbG9jYXRpb25cLnJlcGxhY2VcKCI7aToxMzQ7czoxMjA6IihpbmNsdWRlfGluY2x1ZGVfb25jZXxyZXF1aXJlfHJlcXVpcmVfb25jZSlccypcKCpccypbJyJdW1xzJVwuQFwtXCtcKFwpL2EtekEtWjAtOV9dKz8vW1xzJVwuQFwtXCtcKFwpL2EtekEtWjAtOV9dKz9cLmdpZiI7aToxMzU7czoxMjA6IihpbmNsdWRlfGluY2x1ZGVfb25jZXxyZXF1aXJlfHJlcXVpcmVfb25jZSlccypcKCpccypbJyJdW1xzJVwuQFwtXCtcKFwpL2EtekEtWjAtOV9dKz8vW1xzJVwuQFwtXCtcKFwpL2EtekEtWjAtOV9dKz9cLmpwZyI7aToxMzY7czoxMjA6IihpbmNsdWRlfGluY2x1ZGVfb25jZXxyZXF1aXJlfHJlcXVpcmVfb25jZSlccypcKCpccypbJyJdW1xzJVwuQFwtXCtcKFwpL2EtekEtWjAtOV9dKz8vW1xzJVwuQFwtXCtcKFwpL2EtekEtWjAtOV9dKz9cLnBuZyI7aToxMzc7czoxNDI6IihpbmNsdWRlfGluY2x1ZGVfb25jZXxyZXF1aXJlfHJlcXVpcmVfb25jZSlccypcKCpccypcJF9TRVJWRVJcW1snIl17MCwxfURPQ1VNRU5UX1JPT1RbJyJdezAsMX1cXVxzKlwuXHMqWyciXVtccyVcLkBcLVwrXChcKS9hLXpBLVowLTlfXSs/XC5wbmciO2k6MTM4O3M6MTQyOiIoaW5jbHVkZXxpbmNsdWRlX29uY2V8cmVxdWlyZXxyZXF1aXJlX29uY2UpXHMqXCgqXHMqXCRfU0VSVkVSXFtbJyJdezAsMX1ET0NVTUVOVF9ST09UWyciXXswLDF9XF1ccypcLlxzKlsnIl1bXHMlXC5AXC1cK1woXCkvYS16QS1aMC05X10rP1wuZ2lmIjtpOjEzOTtzOjE0MjoiKGluY2x1ZGV8aW5jbHVkZV9vbmNlfHJlcXVpcmV8cmVxdWlyZV9vbmNlKVxzKlwoKlxzKlwkX1NFUlZFUlxbWyciXXswLDF9RE9DVU1FTlRfUk9PVFsnIl17MCwxfVxdXHMqXC5ccypbJyJdW1xzJVwuQFwtXCtcKFwpL2EtekEtWjAtOV9dKz9cLmpwZyI7aToxNDA7czoxMDY6InVubGlua1woXHMqXCRfU0VSVkVSXFtccypbJyJdezAsMX1ET0NVTUVOVF9ST09UWyciXXswLDF9XF1ccypcLlxzKlsnIl17MCwxfS9hc3NldHMvY2FjaGUvdGVtcC9GaWxlU2V0dGluZ3MiO2k6MTQxO3M6NDg6ImlmXChccypzdHJwb3NcKFxzKlwkdmFsdWVccyosXHMqXCRtYXNrXHMqXClccypcKSI7aToxNDI7czo4OiJhYmFrby9BTyI7aToxNDM7czo1NToiXCovXHMqKGluY2x1ZGV8aW5jbHVkZV9vbmNlfHJlcXVpcmV8cmVxdWlyZV9vbmNlKVxzKi9cKiI7aToxNDQ7czozNDoiZ3JvdXBfY29uY2F0XCgweDIxN2UscGFzc3dvcmQsMHgzYSI7aToxNDU7czozNzoiY29uY2F0XCgweDIxN2UscGFzc3dvcmQsMHgzYSx1c2VybmFtZSI7aToxNDY7czoyMzoiXCt1bmlvblwrc2VsZWN0XCswLDAsMCwiO2k6MTQ3O3M6OToic2V4c2V4c2V4IjtpOjE0ODtzOjM1OiJcJGJhc2VfZG9tYWluXHMqPVxzKmdldF9iYXNlX2RvbWFpbiI7aToxNDk7czozMToiIWVyZWdcKFsnIl1cXlwodW5zYWZlX3Jhd1wpXD9cJCI7aToxNTA7czoxMDk6IlwkW2EtekEtWjAtOV9dKz9ccyo9XCRbYS16QS1aMC05X10rP1xzKlwoXCRbYS16QS1aMC05X10rP1xzKixccypcJFthLXpBLVowLTlfXSs/XHMqXChbJyJdXHMqe1wkW2EtekEtWjAtOV9dKz8iO2k6MTUxO3M6MTk6ImxtcF9jbGllbnRcKHN0cmNvZGUiO2k6MTUyO3M6MTY6ImV2YWxcKFsnIl1ccyovXCoiO2k6MTUzO3M6MTU6ImV2YWxcKFsnIl1ccyovLyI7aToxNTQ7czozNDoiXCRxdWVyeVxzKyxccytbJyJdZnJvbSUyMGpvc191c2VycyI7aToxNTU7czo3OToiXCRbYS16QS1aMC05X10rP1xbXCRbYS16QS1aMC05X10rP1xdXFtcJFthLXpBLVowLTlfXSs/XFtcZCtcXVwuXCRbYS16QS1aMC05X10rPyI7aToxNTY7czoyOToiXClcKSxQSFBfVkVSU0lPTixtZDVfZmlsZVwoXCQiO2k6MTU3O3M6ODM6IihmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXChbJyJdezAsMX1jdXJsXHMrLU9ccytodHRwOi8vIjtpOjE1ODtzOjE5OiJjb2Rlc1wubWFpbmxpbmtcLnJ1IjtpOjE1OTtzOjM2OiJjaG1vZFwoZGlybmFtZVwoX19GSUxFX19cKSxccyowNTExXCkiO2k6MTYwO3M6Mzk6ImxvY2F0aW9uXC5yZXBsYWNlXChcXFsnIl1cJHVybF9yZWRpcmVjdCI7aToxNjE7czoyODoiTW90aGVyWyciXXNccytNYWlkZW5ccytOYW1lOiI7aToxNjI7czo5MDoiKGZ0cF9leGVjfHN5c3RlbXxzaGVsbF9leGVjfHBhc3N0aHJ1fHBvcGVufHByb2Nfb3BlbilcKFsnIl1teXNxbGR1bXBccystaFxzK2xvY2FsaG9zdFxzKy11IjtpOjE2MztzOjc3OiJhcnJheV9tZXJnZVwoXCRleHRccyosXHMqYXJyYXlcKFsnIl13ZWJzdGF0WyciXSxbJyJdYXdzdGF0c1snIl0sWyciXXRlbXBvcmFyeSI7aToxNjQ7czozMzoiQ29tZmlybVxzK1RyYW5zYWN0aW9uXHMrUGFzc3dvcmQ6IjtpOjE2NTtzOjIyOiJ4cnVtZXJfc3BhbV9saW5rc1wudHh0IjtpOjE2NjtzOjY6IlNFb0RPUiI7aToxNjc7czo3MDoiPFw/cGhwXHMrKGluY2x1ZGV8aW5jbHVkZV9vbmNlfHJlcXVpcmV8cmVxdWlyZV9vbmNlKVxzKlwoXHMqWyciXS9ob21lLyI7aToxNjg7czoyMjoiLFsnIl08XD9waHBcXG5bJyJdXC5cJCI7aToxNjk7czo1MDoiPGlmcmFtZVxzK3NyYz1bJyJdaHR0cHM6Ly9kb2NzXC5nb29nbGVcLmNvbS9mb3Jtcy8iO2k6MTcwO3M6MzY6ImV4ZWNccyt7WyciXS9iaW4vc2hbJyJdfVxzK1snIl0tYmFzaCI7aToxNzE7czo0NToiaWZcKGZpbGVfcHV0X2NvbnRlbnRzXChcJGluZGV4X3BhdGgsXHMqXCRjb2RlIjtpOjE3MjtzOjMxOiI9XHMqbmV3XHMrRGlyZWN0b3J5SXRlcmF0b3JcKFwkIjtpOjE3MztzOjUzOiJcJFthLXpBLVowLTlfXSs/ID0gXCRbYS16QS1aMC05X10rP1woWyciXXswLDF9aHR0cDovLyI7aToxNzQ7czo1MjoiY1wubGVuZ3RoXCk7fXJldHVyblxzKlxcWyciXVxcWyciXTt9aWZcKCFnZXRDb29raWVcKCI7aToxNzU7czo4OiIjdPpJN/bf0CI7aToxNzY7czozMToic2VsZWN0IGxhbmd1YWdlc19pZCwgbmFtZSwgY29kZSI7aToxNzc7czo0NDoidXBkYXRlIGNvbmZpZ3VyYXRpb24gc2V0IGNvbmZpZ3VyYXRpb25fdmFsdWUiO2k6MTc4O3M6NjU6InNlbGVjdCBjb25maWd1cmF0aW9uX2lkLCBjb25maWd1cmF0aW9uX3RpdGxlLCBjb25maWd1cmF0aW9uX3ZhbHVlIjtpOjE3OTtzOjM2OiIvYWRtaW4vY29uZmlndXJhdGlvblwucGhwL2xvZ2luXC5waHAiO2k6MTgwO3M6MTAxOiJzdHJfcmVwbGFjZVwoWyciXS5bJyJdXHMqLFxzKlsnIl0uWyciXVxzKixccypzdHJfcmVwbGFjZVwoWyciXS5bJyJdXHMqLFxzKlsnIl0uWyciXVxzKixccypzdHJfcmVwbGFjZSI7aToxODE7czoxMjoiZG1sbGQwUmhkR0U9IjtpOjE4MjtzOjgxOiIoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVwoWyciXWx3cC1kb3dubG9hZFxzK2h0dHA6Ly8iO2k6MTgzO3M6NzE6IlwkW2EtekEtWjAtOV9dKz9ccypcKFxzKlsnIl1bJyJdXHMqLFxzKmV2YWxcKFwkW2EtekEtWjAtOV9dKz9ccypcKVxzKlwpIjtpOjE4NDtzOjczOiJcJFthLXpBLVowLTlfXSs/XHMqXChccypcJFthLXpBLVowLTlfXSs/XHMqXChccypcJFthLXpBLVowLTlfXSs/XHMqXClccyosIjtpOjE4NTtzOjUyOiJcJFthLXpBLVowLTlfXSs/XHMqXChccypcJFthLXpBLVowLTlfXSs/XHMqXChccypbJyJdIjtpOjE4NjtzOjY2OiJcJFthLXpBLVowLTlfXSs/XHMqXChccypcJFthLXpBLVowLTlfXSs/XHMqXChccypcJFthLXpBLVowLTlfXSs/XFsiO2k6MTg3O3M6NDU6IlwkW2EtekEtWjAtOV9dKz9ccypcKFxzKlwkW2EtekEtWjAtOV9dKz9ccypcWyI7aToxODg7czo1OToiXChccypcJHNlbmRccyosXHMqXCRzdWJqZWN0XHMqLFxzKlwkbWVzc2FnZVxzKixccypcJGhlYWRlcnMiO2k6MTg5O3M6MTc6Ij1ccypbJyJdL3Zhci90bXAvIjtpOjE5MDtzOjY1OiIoaW5jbHVkZXxpbmNsdWRlX29uY2V8cmVxdWlyZXxyZXF1aXJlX29uY2UpXHMqXCgqXHMqWyciXS92YXIvdG1wLyI7aToxOTE7czoyNjoiZXhpdFwoXCk6ZXhpdFwoXCk6ZXhpdFwoXCkiO2k6MTkyO3M6Mzg6IkFkZFR5cGVccythcHBsaWNhdGlvbi94LWh0dHBkLWNnaVxzK1wuIjtpOjE5MztzOjM4OiJAbW92ZV91cGxvYWRlZF9maWxlXChccypcJHVzZXJmaWxlX3RtcCI7aToxOTQ7czoyMjoiZGlzYWJsZV9mdW5jdGlvbnM9bm9uZSI7aToxOTU7czoxNTU6IlwkW2EtekEtWjAtOV9dKz9cW1xzKlwkW2EtekEtWjAtOV9dKz9ccypcXVxbXHMqXCRbYS16QS1aMC05X10rP1xbXHMqXGQrXHMqXF1ccypcLlxzKlwkW2EtekEtWjAtOV9dKz9cW1xzKlxkK1xzKlxdXHMqXC5ccypcJFthLXpBLVowLTlfXSs/XFtccypcZCtccypcXVxzKlwuIjtpOjE5NjtzOjIyMjoiXCRbYS16QS1aMC05X10rP1xbXHMqXGQrXHMqXF1ccypcLlxzKlwkW2EtekEtWjAtOV9dKz9cW1xzKlxkK1xzKlxdXHMqXC5ccypcJFthLXpBLVowLTlfXSs/XFtccypcZCtccypcXVxzKlwuXHMqXCRbYS16QS1aMC05X10rP1xbXHMqXGQrXHMqXF1ccypcLlxzKlwkW2EtekEtWjAtOV9dKz9cW1xzKlxkK1xzKlxdXHMqXC5ccypcJFthLXpBLVowLTlfXSs/XFtccypcZCtccypcXVxzKlwuXHMqIjtpOjE5NztzOjY2OiJcJFthLXpBLVowLTlfXSs/XHMqXChccypcJFthLXpBLVowLTlfXSs/XHMqXChccypcJFthLXpBLVowLTlfXSs/XCgiO2k6MTk4O3M6NDI6Ij1ccypjcmVhdGVfZnVuY3Rpb25cKFsnIl17MCwxfVwkYVsnIl17MCwxfSI7aToxOTk7czo5OiJcJGJcKFsnIl0iO2k6MjAwO3M6MzE6IlwkYlxzKj1ccypjcmVhdGVfZnVuY3Rpb25cKFsnIl0iO2k6MjAxO3M6MzY6IlgtTWFpbGVyOlxzKk1pY3Jvc29mdCBPZmZpY2UgT3V0bG9vayI7aToyMDI7czo1NjoiQCpmaWxlX3B1dF9jb250ZW50c1woXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MjAzO3M6MTk6IlsnIl0vXGQrL1xbYS16XF1cKmUiO2k6MjA0O3M6NjQ6IlwkXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpXHMqXFtccypbYS16QS1aMC05X10rP1xzKlxdXCgiO2k6MjA1O3M6MTM6IkBleHRyYWN0XHMqXCQiO2k6MjA2O3M6MTM6IkBleHRyYWN0XHMqXCgiO2k6MjA3O3M6Nzc6Im1haWxccypcKFwkZW1haWxccyosXHMqWyciXXswLDF9PVw/VVRGLThcP0JcP1snIl17MCwxfVwuYmFzZTY0X2VuY29kZVwoXCRmcm9tIjtpOjIwODtzOjgxOiJtYWlsXChcJF9QT1NUXFtbJyJdezAsMX1lbWFpbFsnIl17MCwxfVxdLFxzKlwkX1BPU1RcW1snIl17MCwxfXN1YmplY3RbJyJdezAsMX1cXSwiO2k6MjA5O3M6ODQ6Im1vdmVfdXBsb2FkZWRfZmlsZVxzKlwoXHMqXCRfRklMRVNcW1snIl1bYS16QS1aMC05X10rP1snIl1cXVxbWyciXXRtcF9uYW1lWyciXVxdXHMqLCI7aToyMTA7czo0NToiTW96aWxsYS81XC4wXHMqXChjb21wYXRpYmxlO1xzKkdvb2dsZWJvdC8yXC4xIjtpOjIxMTtzOjQzOiIoXFxbMC05XVswLTldWzAtOV18XFx4WzAtOWEtZl1bMC05YS1mXSl7Nyx9IjtpOjIxMjtzOjE3OiI8L2JvZHk+XHMqPHNjcmlwdCI7aToyMTM7czo0MzoiXCRbYS16QS1aMC05X10rP1xzKj1ccypbJyJdcHJlZ19yZXBsYWNlWyciXSI7aToyMTQ7czozNzoiXCRbYS16QS1aMC05X10rP1xzKj1ccypbJyJdYXNzZXJ0WyciXSI7aToyMTU7czo0NjoiXCRbYS16QS1aMC05X10rP1xzKj1ccypbJyJdY3JlYXRlX2Z1bmN0aW9uWyciXSI7aToyMTY7czo0NDoiXCRbYS16QS1aMC05X10rP1xzKj1ccypbJyJdYmFzZTY0X2RlY29kZVsnIl0iO2k6MjE3O3M6MzU6IlwkW2EtekEtWjAtOV9dKz9ccyo9XHMqWyciXWV2YWxbJyJdIjtpOjIxODtzOjI4OiJDcmVkaXRccypDYXJkXHMqVmVyaWZpY2F0aW9uIjtpOjIxOTtzOjY2OiJSZXdyaXRlQ29uZFxzKiV7SFRUUDpBY2NlcHQtTGFuZ3VhZ2V9XHMqXChydVx8cnUtcnVcfHVrXClccypcW05DXF0iO2k6MjIwO3M6NDI6IlJld3JpdGVDb25kXHMqJXtIVFRQOngtb3BlcmFtaW5pLXBob25lLXVhfSI7aToyMjE7czozNDoiUmV3cml0ZUNvbmRccyole0hUVFA6eC13YXAtcHJvZmlsZSI7aToyMjI7czoyMjoiZXZhbFxzKlwoXHMqZ2V0X29wdGlvbiI7aToyMjM7czoyOToiZWNob1xzK1snIl17MCwxfWdvb2RbJyJdezAsMX0iO2k6MjI0O3M6NTE6IkNVUkxPUFRfUkVGRVJFUixccypbJyJdezAsMX1odHRwczovL3d3d1wuZ29vZ2xlXC5jbyI7aToyMjU7czoxNToiXCRhdXRoX3Bhc3Nccyo9IjtpOjIyNjtzOjY0OiI9XHMqXCRHTE9CQUxTXFtccypbJyJdXyhHRVR8UE9TVHxTRVJWRVJ8Q09PS0lFfFJFUVVFU1QpWyciXVxzKlxdIjtpOjIyNztzOjY0OiJlY2hvXHMrc3RyaXBzbGFzaGVzXHMqXChccypcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKVxbIjtpOjIyODtzOjIyOiI8aDE+TG9hZGluZ1wuXC5cLjwvaDE+IjtpOjIyOTtzOjEyOiJwaHBpbmZvXChcKTsiO2k6MjMwO3M6MTg3OiIoZXZhbHxiYXNlNjRfZGVjb2RlfGd6aW5mbGF0ZXxnenVuY29tcHJlc3N8c3RyX3JvdDEzfG1kNSlccypcKFxzKihldmFsfGJhc2U2NF9kZWNvZGV8Z3ppbmZsYXRlfGd6dW5jb21wcmVzc3xzdHJfcm90MTN8bWQ1KVxzKlwoXHMqKGV2YWx8YmFzZTY0X2RlY29kZXxnemluZmxhdGV8Z3p1bmNvbXByZXNzfHN0cl9yb3QxM3xtZDUpIjtpOjIzMTtzOjExOiJIYWNrZWRccytCeSI7aToyMzI7czoxNToiWyciXS9cLlwqL2VbJyJdIjtpOjIzMztzOjI4OiJlY2hvXHMqXCgqXHMqWyciXU5PIEZJTEVbJyJdIjtpOjIzNDtzOjE5MDoibW92ZV91cGxvYWRlZF9maWxlXHMqXCgqXHMqXCRfRklMRVNcW1xzKlsnIl17MCwxfWZpbGVuYW1lWyciXXswLDF9XHMqXF1cW1xzKlsnIl17MCwxfXRtcF9uYW1lWyciXXswLDF9XHMqXF1ccyosXHMqXCRfRklMRVNcW1xzKlsnIl17MCwxfWZpbGVuYW1lWyciXXswLDF9XHMqXF1cW1xzKlsnIl17MCwxfW5hbWVbJyJdezAsMX1ccypcXSI7aToyMzU7czoyMzoiY29weVxzKlwoXHMqWyciXWh0dHA6Ly8iO2k6MjM2O3M6ODI6IjxtZXRhXHMraHR0cC1lcXVpdj1bJyJdezAsMX1SZWZyZXNoWyciXXswLDF9XHMrY29udGVudD1bJyJdezAsMX1cZCs7XHMqVVJMPWh0dHA6Ly8iO2k6MjM3O3M6ODE6IjxtZXRhXHMraHR0cC1lcXVpdj1bJyJdezAsMX1yZWZyZXNoWyciXXswLDF9XHMrY29udGVudD1bJyJdezAsMX1cZCs7XHMqdXJsPTxcP3BocCI7aToyMzg7czoxMDoiWyciXWFIUjBjRCI7aToyMzk7czo2Nzoic3RyY2hyXHMqXCgqXHMqXCRfU0VSVkVSXFtccypbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1ccypcXSI7aToyNDA7czo2Nzoic3Ryc3RyXHMqXCgqXHMqXCRfU0VSVkVSXFtccypbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1ccypcXSI7aToyNDE7czo2Nzoic3RycG9zXHMqXCgqXHMqXCRfU0VSVkVSXFtccypbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1ccypcXSI7aToyNDI7czozMzoiQWRkVHlwZVxzK2FwcGxpY2F0aW9uL3gtaHR0cGQtcGhwIjtpOjI0MztzOjEwOiJwY250bF9leGVjIjtpOjI0NDtzOjY5OiIoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVwoKlsnIl1jZFxzKy90bXAiO2k6MjQ1O3M6Mjc6IlwkT09PLis/PVxzKnVybGRlY29kZVxzKlwoKiI7aToyNDY7czoxMjoicm1ccystZlxzKy1yIjtpOjI0NztzOjEyOiJybVxzKy1yXHMrLWYiO2k6MjQ4O3M6ODoicm1ccystZnIiO2k6MjQ5O3M6ODoicm1ccystcmYiO2k6MjUwO3M6Njk6IihmdHBfZXhlY3xzeXN0ZW18c2hlbGxfZXhlY3xwYXNzdGhydXxwb3Blbnxwcm9jX29wZW4pXHMqXChAKnVybGVuY29kZSI7aToyNTE7czo2MzoiKGluY2x1ZGV8aW5jbHVkZV9vbmNlfHJlcXVpcmV8cmVxdWlyZV9vbmNlKVxzKlwoKlxzKlsnIl1pbWFnZXMvIjtpOjI1MjtzOjg5OiIoaW5jbHVkZXxpbmNsdWRlX29uY2V8cmVxdWlyZXxyZXF1aXJlX29uY2UpXHMqXCgqXHMqQCpcJF8oR0VUfFBPU1R8U0VSVkVSfENPT0tJRXxSRVFVRVNUKSI7aToyNTM7czo1OToiYmFzZTY0X2RlY29kZVxzKlwoKlxzKkAqXCRfKEdFVHxQT1NUfFNFUlZFUnxDT09LSUV8UkVRVUVTVCkiO2k6MjU0O3M6NTE6ImRvY3VtZW50XC53cml0ZVxzKlwoXHMqdW5lc2NhcGVccypcKFxzKlsnIl17MCwxfSUzQyI7aToyNTU7czo4OiIvL05PbmFNRSI7aToyNTY7czo4OiJsc1xzKy1sYSI7aToyNTc7czozNzoiaW5pX3NldFwoXHMqWyciXXswLDF9bWFnaWNfcXVvdGVzX2dwYyI7aToyNTg7czoyODoiYW5kcm9pZFx8YXZhbnRnb1x8YmxhY2tiZXJyeSI7aToyNTk7czo0MToiZmluZFxzKy9ccystdHlwZVxzK2ZccystbmFtZVxzK1wuaHRwYXNzd2QiO2k6MjYwO3M6Mzc6ImZpbmRccysvXHMrLXR5cGVccytmXHMrLXBlcm1ccystMDIwMDAiO2k6MjYxO3M6Mzc6ImZpbmRccysvXHMrLXR5cGVccytmXHMrLXBlcm1ccystMDQwMDAiO2k6MjYyO3M6NToieENlZHoiO2k6MjYzO3M6OToiXCRwYXNzX3VwIjtpOjI2NDtzOjU6Ik9uZXQ3IjtpOjI2NTtzOjU6IkpUZXJtIjtpOjI2NjtzOjE4OiI9PVxzKlsnIl05MVwuMjQzXC4iO2k6MjY3O3M6MTg6Ij09XHMqWyciXTQ2XC4yMjlcLiI7aToyNjg7czoxNToiMTA5XC4yMzhcLjI0MlwuIjtpOjI2OTtzOjEzOiI4OVwuMjQ5XC4yMVwuIjtpOjI3MDtzOjYzOiJcJF9TRVJWRVJcW1xzKlsnIl1IVFRQX1JFRkVSRVJbJyJdXHMqXF1ccyosXHMqWyciXXRydXN0bGlua1wucnUiO30="));
$g_ExceptFlex = unserialize(base64_decode("YToxMTM6e2k6MDtzOjM3OiJlY2hvICI8c2NyaXB0PiBhbGVydFwoJyJcLlwkZGItPmdldEVyIjtpOjE7czo0MDoiZWNobyAiPHNjcmlwdD4gYWxlcnRcKCciXC5cJG1vZGVsLT5nZXRFciI7aToyO3M6ODoic29ydFwoXCkiO2k6MztzOjEwOiJtdXN0LXJldmFsIjtpOjQ7czo2OiJyaWV2YWwiO2k6NTtzOjk6ImRvdWJsZXZhbCI7aTo2O3M6NjY6InJlcXVpcmVccypcKCpccypcJF9TRVJWRVJcW1xzKlsnIl17MCwxfURPQ1VNRU5UX1JPT1RbJyJdezAsMX1ccypcXSI7aTo3O3M6NzE6InJlcXVpcmVfb25jZVxzKlwoKlxzKlwkX1NFUlZFUlxbXHMqWyciXXswLDF9RE9DVU1FTlRfUk9PVFsnIl17MCwxfVxzKlxdIjtpOjg7czo2NjoiaW5jbHVkZVxzKlwoKlxzKlwkX1NFUlZFUlxbXHMqWyciXXswLDF9RE9DVU1FTlRfUk9PVFsnIl17MCwxfVxzKlxdIjtpOjk7czo3MToiaW5jbHVkZV9vbmNlXHMqXCgqXHMqXCRfU0VSVkVSXFtccypbJyJdezAsMX1ET0NVTUVOVF9ST09UWyciXXswLDF9XHMqXF0iO2k6MTA7czoxNzoiXCRzbWFydHktPl9ldmFsXCgiO2k6MTE7czozMDoicHJlcFxzK3JtXHMrLXJmXHMrJXtidWlsZHJvb3R9IjtpOjEyO3M6MjI6IlRPRE86XHMrcm1ccystcmZccyt0aGUiO2k6MTM7czoyNzoia3Jzb3J0XChcJHdwc21pbGllc3RyYW5zXCk7IjtpOjE0O3M6NjM6ImRvY3VtZW50XC53cml0ZVwodW5lc2NhcGVcKCIlM0NzY3JpcHQgc3JjPSciIFwrIGdhSnNIb3N0IFwrICJnbyI7aToxNTtzOjY6IlwuZXhlYyI7aToxNjtzOjg6ImV4ZWNcKFwpIjtpOjE3O3M6MjQ6IlwkeDEgPSBcJHRoaXMtPncgLSBcJHgxOyI7aToxODtzOjMxOiJhc29ydFwoXCRDYWNoZURpck9sZEZpbGVzQWdlXCk7IjtpOjE5O3M6MTM6IlwoJ3I1N3NoZWxsJywiO2k6MjA7czoyNToiZXZhbFwoImxpc3RlbmVyID0gIlwrbGlzdCI7aToyMTtzOjg6ImV2YWxcKFwpIjtpOjIyO3M6MzM6InByZWdfcmVwbGFjZV9jYWxsYmFja1woJy9cXHtcKGltYSI7aToyMztzOjIxOiJldmFsIFwoX2N0TWVudUluaXRTdHIiO2k6MjQ7czoyOToiYmFzZTY0X2RlY29kZVwoXCRhY2NvdW50S2V5XCkiO2k6MjU7czozOToiYmFzZTY0X2RlY29kZVwoXCRkYXRhXClcKTsgXCRhcGktPnNldFJlIjtpOjI2O3M6NDg6InJlcXVpcmVcKFwkX1NFUlZFUlxbXFwiRE9DVU1FTlRfUk9PVFxcIlxdXC5cXCIvYiI7aToyNztzOjY1OiJiYXNlNjRfZGVjb2RlXChcJF9SRVFVRVNUXFsncGFyYW1ldGVycydcXVwpOyBpZlwoQ2hlY2tTZXJpYWxpemVkRCI7aToyODtzOjYzOiJwY250bF9leGVjJyA9PiBBcnJheVwoQXJyYXlcKDFcKSwgXCRhclJlc3VsdFxbJ1NFQ1VSSU5HX0ZVTkNUSU8iO2k6Mjk7czozOToiZWNobyAiPHNjcmlwdD5hbGVydFwoJyJcLkNVdGlsOjpKU0VzY2FwIjtpOjMwO3M6Njg6ImJhc2U2NF9kZWNvZGVcKFwkX1JFUVVFU1RcWyd0aXRsZV9jaGFuZ2VyX2xpbmsnXF1cKTsgaWYgXChzdHJsZW5cKFwkIjtpOjMxO3M6NTE6ImV2YWxcKCdcJGhleGR0aW1lID0gIicgXC4gXCRoZXhkdGltZSBcLiAnIjsnXCk7IFwkZiI7aTozMjtzOjUyOiJlY2hvICI8c2NyaXB0PmFsZXJ0XCgnXCRyb3ctPnRpdGxlIC0gIlwuX01PRFVMRV9JU19FIjtpOjMzO3M6Mzc6ImVjaG8gIjxzY3JpcHQ+YWxlcnRcKCdcJGNpZHMgIlwuX0NBTk4iO2k6MzQ7czo0MToiaWZcKDFcKSB7IFwkdl9ob3VyID0gXChcJHBfaGVhZGVyXFsnbXRpbWUiO2k6MzU7czo3MDoiZG9jdW1lbnRcLndyaXRlXCh1bmVzY2FwZVwoIiUzQ3NjcmlwdCUyMHNyYz0lMjJodHRwIiBcKyBcKFwoImh0dHBzOiIgPSI7aTozNjtzOjU3OiJkb2N1bWVudFwud3JpdGVcKHVuZXNjYXBlXCgiJTNDc2NyaXB0IHNyYz0nIiBcKyBwa0Jhc2VVUkwiO2k6Mzc7czozMjoiZWNobyAiPHNjcmlwdD5hbGVydFwoJyJcLkpUZXh0OjoiO2k6Mzg7czoyNToiJ2ZpbGVuYW1lJ1wpLCBcKCdyNTdzaGVsbCI7aTozOTtzOjQzOiJlY2hvICI8c2NyaXB0PmFsZXJ0XCgnIiBcLiBcJGVyck1zZyBcLiAiJ1wpIjtpOjQwO3M6NDI6ImVjaG8gIjxzY3JpcHQ+YWxlcnRcKFxcIkVycm9yIHdoZW4gbG9hZGluZyI7aTo0MTtzOjQzOiJlY2hvICI8c2NyaXB0PmFsZXJ0XCgnIlwuSlRleHQ6Ol9cKCdWQUxJRF9FIjtpOjQyO3M6ODoiZXZhbFwoXCkiO2k6NDM7czo4OiInc3lzdGVtJyI7aTo0NDtzOjY6IidldmFsJyI7aTo0NTtzOjY6IiJldmFsIiI7aTo0NjtzOjc6Il9zeXN0ZW0iO2k6NDc7czo5OiJzYXZlMmNvcHkiO2k6NDg7czoxMDoiZmlsZXN5c3RlbSI7aTo0OTtzOjg6InNlbmRtYWlsIjtpOjUwO3M6ODoiY2FuQ2htb2QiO2k6NTE7czoxMzoiL2V0Yy9wYXNzd2RcKSI7aTo1MjtzOjI0OiJ1ZHA6Ly8nXC5zZWxmOjpcJF9jX2FkZHIiO2k6NTM7czozNDoiZWRvY2VkXzQ2ZXNhYlwoJydcfCJcKVxcXCknLCAncmVnZSI7aTo1NDtzOjk6ImRvdWJsZXZhbCI7aTo1NTtzOjE2OiJvcGVyYXRpbmcgc3lzdGVtIjtpOjU2O3M6MTA6Imdsb2JhbGV2YWwiO2k6NTc7czoyMToid2l0aCAwLzAvMCBpZiBcKDFcKSB7IjtpOjU4O3M6NDg6IlwkeDIgPSBcJHBhcmFtXFtbJyJdezAsMX14WyciXXswLDF9XF0gXCsgXCR3aWR0aCI7aTo1OTtzOjExOiJzcGVjaWFsaXNlZCI7aTo2MDtzOjE5OiJ3cF9nZXRfY3VycmVudF91c2VyIjtpOjYxO3M6NzoiLT5jaG1vZCI7aTo2MjtzOjc6Il9tYWlsXCgiO2k6NjM7czo3OiJfY29weVwoIjtpOjY0O3M6NDY6InN0cnBvc1woXCRfU0VSVkVSXFsnSFRUUF9VU0VSX0FHRU5UJ1xdLCAnRHJ1cGEiO2k6NjU7czo0NToic3RycG9zXChcJF9TRVJWRVJcWydIVFRQX1VTRVJfQUdFTlQnXF0sICdNU0lFIjtpOjY2O3M6NDU6InN0cnBvc1woXCRfU0VSVkVSXFsiSFRUUF9VU0VSX0FHRU5UIlxdLCAnTVNJRSI7aTo2NztzOjE3OiJldmFsIFwoY2xhc3NTdHJcKSI7aTo2ODtzOjMxOiJmdW5jdGlvbl9leGlzdHNcKCdiYXNlNjRfZGVjb2RlIjtpOjY5O3M6NDQ6ImVjaG8gIjxzY3JpcHQ+YWxlcnRcKCciXC5KVGV4dDo6X1woJ1ZBTElEX0VNIjtpOjcwO3M6NTI6IlwkeDEgPSBcJG1pbl94OyBcJHgyID0gXCRtYXhfeDsgXCR5MSA9IFwkbWluX3k7IFwkeTIiO2k6NzE7czo1NToiXCRjdG1cWydhJ1xdXClcKSB7IFwkeCA9IFwkeCBcKiBcJHRoaXMtPms7IFwkeSA9IFwoXCR0aCI7aTo3MjtzOjYwOiJbJyJdezAsMX1jcmVhdGVfZnVuY3Rpb25bJyJdezAsMX0sIFsnIl17MCwxfWdldF9yZXNvdXJjZV90eXAiO2k6NzM7czo0OToiWyciXXswLDF9Y3JlYXRlX2Z1bmN0aW9uWyciXXswLDF9LCBbJyJdezAsMX1jcnlwdCI7aTo3NDtzOjY5OiJzdHJwb3NcKFwkX1NFUlZFUlxbWyciXXswLDF9SFRUUF9VU0VSX0FHRU5UWyciXXswLDF9XF0sIFsnIl17MCwxfUx5bngiO2k6NzU7czo2ODoic3Ryc3RyXChcJF9TRVJWRVJcW1snIl17MCwxfUhUVFBfVVNFUl9BR0VOVFsnIl17MCwxfVxdLCBbJyJdezAsMX1NU0kiO2k6NzY7czoyNToic29ydFwoXCREaXN0cmlidXRpb25cW1wkayI7aTo3NztzOjI1OiJzb3J0XChmdW5jdGlvblwoYSxiXCl7cmV0IjtpOjc4O3M6MjU6Imh0dHA6Ly93d3dcLmZhY2Vib29rXC5jb20iO2k6Nzk7czoyNToiaHR0cDovL21hcHNcLmdvb2dsZVwuY29tLyI7aTo4MDtzOjUyOiJ1ZHA6Ly8nXC5zZWxmOjpcJGNfYWRkciwgODAsIFwkZXJybm8sIFwkZXJyc3RyLCAxNTAwIjtpOjgxO3M6MjA6IlwoXC5cKlwodmlld1wpXD9cLlwqIjtpOjgyO3M6NDQ6ImVjaG8gWyciXXswLDF9PHNjcmlwdD5hbGVydFwoWyciXXswLDF9XCR0ZXh0IjtpOjgzO3M6MTc6InNvcnRcKFwkdl9saXN0XCk7IjtpOjg0O3M6Nzc6Im1vdmVfdXBsb2FkZWRfZmlsZVwoIFwkX0ZJTEVTXFsndXBsb2FkZWRfcGFja2FnZSdcXVxbJ3RtcF9uYW1lJ1xdLCBcJG1vc0NvbmZpIjtpOjg1O3M6MzE6IkNyZWRpdCBDYXJkIFZlcmlmaWNhdGlvbiBDb2RlJzsiO2k6ODY7czoxMjoiZmFsc2VcKSBcKTsjIjtpOjg3O3M6MTU6Im5jeV9uYW1lYCcgXCk7IyI7aTo4ODtzOjQ3OiJzdHJwb3NcKFwkX1NFUlZFUlxbJ0hUVFBfVVNFUl9BR0VOVCdcXSwgJ01hYyBPUyI7aTo4OTtzOjIwOiIvL25vbmFtZTogJzxcPz1DVXRpbCI7aTo5MDtzOjUwOiJkb2N1bWVudFwud3JpdGVcKHVuZXNjYXBlXCgiJTNDc2NyaXB0IHNyYz0nL2JpdHJpeCI7aTo5MTtzOjI1OiJcJF9TRVJWRVIgXFsiUkVNT1RFX0FERFIiIjtpOjkyO3M6MTc6ImFIUjBjRG92TDJOeWJETXVaIjtpOjkzO3M6NTU6IkpSZXNwb25zZTo6c2V0Qm9keVwocHJlZ19yZXBsYWNlXChcJHBhdHRlcm5zLCBcJHJlcGxhY2UiO2k6OTQ7czo0MDoiXFx4MWZcXHg4YlxceDA4XFx4MDBcXHgwMFxceDAwXFx4MDBcXHgwMCI7aTo5NTtzOjQwOiJcXHg1MFxceDRiXFx4MDVcXHgwNlxceDAwXFx4MDBcXHgwMFxceDAwIjtpOjk2O3M6NDY6IlxceDA5XFx4MEFcXHgwQlxceDBDXFx4MERcXHgyMFxceDJGXFx4M0VcXVxbXF4iO2k6OTc7czo0MDoiXFx4ODlcXHg1MFxceDRFXFx4NDdcXHgwRFxceDBBXFx4MUFcXHgwQSI7aTo5ODtzOjEwOiJcKTsjaScsICcmIjtpOjk5O3M6MTc6IlwpOyNtaXMnLCAnICcsIFwkIjtpOjEwMDtzOjIwOiJcKTsjaScsIFwkZGF0YSwgXCRtYSI7aToxMDE7czozNToiXCRmdW5jXCggXCRwYXJhbXNcW1wkdHlwZVxdLT5wYXJhbXMiO2k6MTAyO3M6NDA6IlxceDFmXFx4OGJcXHgwOFxceDAwXFx4MDBcXHgwMFxceDAwXFx4MDAiO2k6MTAzO3M6NDU6IlxceDAwXFx4MDFcXHgwMlxceDAzXFx4MDRcXHgwNVxceDA2XFx4MDdcXHgwOCI7aToxMDQ7czo0MDoiXFx4MjFcXHgyM1xceDI0XFx4MjVcXHgyNlxceDI3XFx4MmFcXHgyYiI7aToxMDU7czozNToiXFx4ODNcXHg4QlxceDhEXFx4OUJcXHg5RVxceDlGXFx4QTEiO2k6MTA2O3M6MzA6IlxceDA5XFx4MEFcXHgwQlxceDBDXFx4MERcXHgyMCI7aToxMDc7czozMzoiXC5cLi9cLlwuL1wuXC4vXC5cLi9tb2R1bGVzL21vZF9tIjtpOjEwODtzOjMwOiJcJGRlY29yYXRvclwoXCRtYXRjaGVzXFsxXF1cWzAiO2k6MTA5O3M6MjI6IlwkZGVjb2RlZnVuY1woIFwkZFxbXCQiO2k6MTEwO3M6MTc6Il9cLlwrX2FiYnJldmlhdGlvIjtpOjExMTtzOjQ4OiJzdHJlYW1fc29ja2V0X2NsaWVudFwoICd0Y3A6Ly8nIFwuIFwkcHJveHktPmhvc3QiO2k6MTEyO3M6Mjc6ImV2YWxcKGZ1bmN0aW9uXChwLGEsYyxrLGUsZCI7fQ=="));
$g_SusDB = unserialize(base64_decode("YToxMzE6e2k6MDtzOjE0OiJAKmV4dHJhY3RccypcKCI7aToxO3M6MTQ6IkAqZXh0cmFjdFxzKlwkIjtpOjI7czoxMjoiWyciXWV2YWxbJyJdIjtpOjM7czoyMToiWyciXWJhc2U2NF9kZWNvZGVbJyJdIjtpOjQ7czoyMzoiWyciXWNyZWF0ZV9mdW5jdGlvblsnIl0iO2k6NTtzOjE0OiJbJyJdYXNzZXJ0WyciXSI7aTo2O3M6NDM6ImZvcmVhY2hccypcKFxzKlwkZW1haWxzXHMrYXNccytcJGVtYWlsXHMqXCkiO2k6NztzOjc6IlNwYW1tZXIiO2k6ODtzOjE1OiJldmFsXHMqWyciXChcJF0iO2k6OTtzOjE3OiJhc3NlcnRccypbJyJcKFwkXSI7aToxMDtzOjI4OiJzcnBhdGg6Ly9cLlwuL1wuXC4vXC5cLi9cLlwuIjtpOjExO3M6MTI6InBocGluZm9ccypcKCI7aToxMjtzOjE2OiJTSE9XXHMrREFUQUJBU0VTIjtpOjEzO3M6MTI6IlxicG9wZW5ccypcKCI7aToxNDtzOjk6ImV4ZWNccypcKCI7aToxNTtzOjEzOiJcYnN5c3RlbVxzKlwoIjtpOjE2O3M6MTU6IlxicGFzc3RocnVccypcKCI7aToxNztzOjE2OiJcYnByb2Nfb3BlblxzKlwoIjtpOjE4O3M6MTU6InNoZWxsX2V4ZWNccypcKCI7aToxOTtzOjE2OiJpbmlfcmVzdG9yZVxzKlwoIjtpOjIwO3M6OToiXGJkbFxzKlwoIjtpOjIxO3M6MTQ6Ilxic3ltbGlua1xzKlwoIjtpOjIyO3M6MTI6IlxiY2hncnBccypcKCI7aToyMztzOjE0OiJcYmluaV9zZXRccypcKCI7aToyNDtzOjEzOiJcYnB1dGVudlxzKlwoIjtpOjI1O3M6MTM6ImdldG15dWlkXHMqXCgiO2k6MjY7czoxNDoiZnNvY2tvcGVuXHMqXCgiO2k6Mjc7czoxNzoicG9zaXhfc2V0dWlkXHMqXCgiO2k6Mjg7czoxNzoicG9zaXhfc2V0c2lkXHMqXCgiO2k6Mjk7czoxODoicG9zaXhfc2V0cGdpZFxzKlwoIjtpOjMwO3M6MTU6InBvc2l4X2tpbGxccypcKCI7aTozMTtzOjI3OiJhcGFjaGVfY2hpbGRfdGVybWluYXRlXHMqXCgiO2k6MzI7czoxMjoiXGJjaG1vZFxzKlwoIjtpOjMzO3M6MTI6IlxiY2hkaXJccypcKCI7aTozNDtzOjE1OiJwY250bF9leGVjXHMqXCgiO2k6MzU7czoxNDoiXGJ2aXJ0dWFsXHMqXCgiO2k6MzY7czoxNToicHJvY19jbG9zZVxzKlwoIjtpOjM3O3M6MjA6InByb2NfZ2V0X3N0YXR1c1xzKlwoIjtpOjM4O3M6MTk6InByb2NfdGVybWluYXRlXHMqXCgiO2k6Mzk7czoxNDoicHJvY19uaWNlXHMqXCgiO2k6NDA7czoxMzoiZ2V0bXlnaWRccypcKCI7aTo0MTtzOjE5OiJwcm9jX2dldHN0YXR1c1xzKlwoIjtpOjQyO3M6MTU6InByb2NfY2xvc2VccypcKCI7aTo0MztzOjE5OiJlc2NhcGVzaGVsbGNtZFxzKlwoIjtpOjQ0O3M6MTk6ImVzY2FwZXNoZWxsYXJnXHMqXCgiO2k6NDU7czoxNjoic2hvd19zb3VyY2VccypcKCI7aTo0NjtzOjEzOiJcYnBjbG9zZVxzKlwoIjtpOjQ3O3M6MTM6InNhZmVfZGlyXHMqXCgiO2k6NDg7czoxNjoiaW5pX3Jlc3RvcmVccypcKCI7aTo0OTtzOjEwOiJjaG93blxzKlwoIjtpOjUwO3M6MTA6ImNoZ3JwXHMqXCgiO2k6NTE7czoxNzoic2hvd25fc291cmNlXHMqXCgiO2k6NTI7czoxOToibXlzcWxfbGlzdF9kYnNccypcKCI7aTo1MztzOjIxOiJnZXRfY3VycmVudF91c2VyXHMqXCgiO2k6NTQ7czoxMjoiZ2V0bXlpZFxzKlwoIjtpOjU1O3M6MTE6IlxibGVha1xzKlwoIjtpOjU2O3M6MTU6InBmc29ja29wZW5ccypcKCI7aTo1NztzOjIxOiJnZXRfY3VycmVudF91c2VyXHMqXCgiO2k6NTg7czoxMToic3lzbG9nXHMqXCgiO2k6NTk7czoxODoiXCRkZWZhdWx0X3VzZV9hamF4IjtpOjYwO3M6MjE6ImV2YWxccypcKCpccyp1bmVzY2FwZSI7aTo2MTtzOjc6IkZMb29kZVIiO2k6NjI7czozMToiZG9jdW1lbnRcLndyaXRlXHMqXChccyp1bmVzY2FwZSI7aTo2MztzOjExOiJcYmNvcHlccypcKCI7aTo2NDtzOjIzOiJtb3ZlX3VwbG9hZGVkX2ZpbGVccypcKCI7aTo2NTtzOjg6IlwuMzMzMzMzIjtpOjY2O3M6ODoiXC42NjY2NjYiO2k6Njc7czoyMToicm91bmRccypcKCpccyowXHMqXCkqIjtpOjY4O3M6MjQ6Im1vdmVfdXBsb2FkZWRfZmlsZXNccypcKCI7aTo2OTtzOjUwOiJpbmlfZ2V0XHMqXChccypbJyJdezAsMX1kaXNhYmxlX2Z1bmN0aW9uc1snIl17MCwxfSI7aTo3MDtzOjM2OiJVTklPTlxzK1NFTEVDVFxzK1snIl17MCwxfTBbJyJdezAsMX0iO2k6NzE7czoxMDoiMlxzKj5ccyomMSI7aTo3MjtzOjU3OiJlY2hvXHMqXCgqXHMqXCRfU0VSVkVSXFtbJyJdezAsMX1ET0NVTUVOVF9ST09UWyciXXswLDF9XF0iO2k6NzM7czozNzoiPVxzKkFycmF5XHMqXCgqXHMqYmFzZTY0X2RlY29kZVxzKlwoKiI7aTo3NDtzOjE0OiJraWxsYWxsXHMrLVxkKyI7aTo3NTtzOjc6ImVyaXVxZXIiO2k6NzY7czoxMDoidG91Y2hccypcKCI7aTo3NztzOjc6InNzaGtleXMiO2k6Nzg7czo4OiJAaW5jbHVkZSI7aTo3OTtzOjg6IkByZXF1aXJlIjtpOjgwO3M6NjI6ImlmXHMqXChtYWlsXHMqXChccypcJHRvLFxzKlwkc3ViamVjdCxccypcJG1lc3NhZ2UsXHMqXCRoZWFkZXJzIjtpOjgxO3M6Mzg6IkBpbmlfc2V0XHMqXCgqWyciXXswLDF9YWxsb3dfdXJsX2ZvcGVuIjtpOjgyO3M6MTg6IkBmaWxlX2dldF9jb250ZW50cyI7aTo4MztzOjE3OiJmaWxlX3B1dF9jb250ZW50cyI7aTo4NDtzOjQ2OiJhbmRyb2lkXHMqXHxccyptaWRwXHMqXHxccypqMm1lXHMqXHxccypzeW1iaWFuIjtpOjg1O3M6Mjg6IkBzZXRjb29raWVccypcKCpbJyJdezAsMX1oaXQiO2k6ODY7czoxMDoiQGZpbGVvd25lciI7aTo4NztzOjY6IjxrdWt1PiI7aTo4ODtzOjU6InN5cGV4IjtpOjg5O3M6OToiXCRiZWVjb2RlIjtpOjkwO3M6MTQ6InJvb3RAbG9jYWxob3N0IjtpOjkxO3M6ODoiQmFja2Rvb3IiO2k6OTI7czoxNDoicGhwX3VuYW1lXHMqXCgiO2k6OTM7czo1NToibWFpbFxzKlwoKlxzKlwkdG9ccyosXHMqXCRzdWJqXHMqLFxzKlwkbXNnXHMqLFxzKlwkZnJvbSI7aTo5NDtzOjI5OiJlY2hvXHMqWyciXTxzY3JpcHQ+XHMqYWxlcnRcKCI7aTo5NTtzOjY3OiJtYWlsXHMqXCgqXHMqXCRzZW5kXHMqLFxzKlwkc3ViamVjdFxzKixccypcJGhlYWRlcnNccyosXHMqXCRtZXNzYWdlIjtpOjk2O3M6NjU6Im1haWxccypcKCpccypcJHRvXHMqLFxzKlwkc3ViamVjdFxzKixccypcJG1lc3NhZ2VccyosXHMqXCRoZWFkZXJzIjtpOjk3O3M6MTIwOiJzdHJwb3NccypcKCpccypcJG5hbWVccyosXHMqWyciXXswLDF9SFRUUF9bJyJdezAsMX1ccypcKSpccyohPT1ccyowXHMqJiZccypzdHJwb3NccypcKCpccypcJG5hbWVccyosXHMqWyciXXswLDF9UkVRVUVTVF8iO2k6OTg7czo1MzoiaXNfZnVuY3Rpb25fZW5hYmxlZFxzKlwoXHMqWyciXXswLDF9aWdub3JlX3VzZXJfYWJvcnQiO2k6OTk7czozMDoiZWNob1xzKlwoKlxzKmZpbGVfZ2V0X2NvbnRlbnRzIjtpOjEwMDtzOjI2OiJlY2hvXHMqXCgqWyciXXswLDF9PHNjcmlwdCI7aToxMDE7czozMToicHJpbnRccypcKCpccypmaWxlX2dldF9jb250ZW50cyI7aToxMDI7czoyNzoicHJpbnRccypcKCpbJyJdezAsMX08c2NyaXB0IjtpOjEwMztzOjg1OiI8bWFycXVlZVxzK3N0eWxlXHMqPVxzKlsnIl17MCwxfXBvc2l0aW9uXHMqOlxzKmFic29sdXRlXHMqO1xzKndpZHRoXHMqOlxzKlxkK1xzKnB4XHMqIjtpOjEwNDtzOjQyOiI9XHMqWyciXXswLDF9XC5cLi9cLlwuL1wuXC4vd3AtY29uZmlnXC5waHAiO2k6MTA1O3M6NzoiZWdnZHJvcCI7aToxMDY7czo5OiJyd3hyd3hyd3giO2k6MTA3O3M6MTU6ImVycm9yX3JlcG9ydGluZyI7aToxMDg7czoxNzoiXGJjcmVhdGVfZnVuY3Rpb24iO2k6MTA5O3M6NDM6Intccypwb3NpdGlvblxzKjpccyphYnNvbHV0ZTtccypsZWZ0XHMqOlxzKi0iO2k6MTEwO3M6MTU6IjxzY3JpcHRccythc3luYyI7aToxMTE7czo2NjoiX1snIl17MCwxfVxzKlxdXHMqPVxzKkFycmF5XHMqXChccypiYXNlNjRfZGVjb2RlXHMqXCgqXHMqWyciXXswLDF9IjtpOjExMjtzOjMzOiJBZGRUeXBlXHMrYXBwbGljYXRpb24veC1odHRwZC1jZ2kiO2k6MTEzO3M6NDQ6ImdldGVudlxzKlwoKlxzKlsnIl17MCwxfUhUVFBfQ09PS0lFWyciXXswLDF9IjtpOjExNDtzOjQ1OiJpZ25vcmVfdXNlcl9hYm9ydFxzKlwoKlxzKlsnIl17MCwxfTFbJyJdezAsMX0iO2k6MTE1O3M6MjE6IlwkX1JFUVVFU1RccypcW1xzKiUyMiI7aToxMTY7czo1MToidXJsXHMqXChbJyJdezAsMX1kYXRhXHMqOlxzKmltYWdlL3BuZztccypiYXNlNjRccyosIjtpOjExNztzOjUxOiJ1cmxccypcKFsnIl17MCwxfWRhdGFccyo6XHMqaW1hZ2UvZ2lmO1xzKmJhc2U2NFxzKiwiO2k6MTE4O3M6MzA6Ijpccyp1cmxccypcKFxzKlsnIl17MCwxfTxcP3BocCI7aToxMTk7czoxNzoiPC9odG1sPi4rPzxzY3JpcHQiO2k6MTIwO3M6MTc6IjwvaHRtbD4uKz88aWZyYW1lIjtpOjEyMTtzOjY0OiIoZnRwX2V4ZWN8c3lzdGVtfHNoZWxsX2V4ZWN8cGFzc3RocnV8cG9wZW58cHJvY19vcGVuKVxzKlsnIlwoXCRdIjtpOjEyMjtzOjExOiJcYm1haWxccypcKCI7aToxMjM7czo0NjoiZmlsZV9nZXRfY29udGVudHNccypcKCpccypbJyJdezAsMX1waHA6Ly9pbnB1dCI7aToxMjQ7czoxMTg6IjxtZXRhXHMraHR0cC1lcXVpdj1bJyJdezAsMX1Db250ZW50LXR5cGVbJyJdezAsMX1ccytjb250ZW50PVsnIl17MCwxfXRleHQvaHRtbDtccypjaGFyc2V0PXdpbmRvd3MtMTI1MVsnIl17MCwxfT48Ym9keT4iO2k6MTI1O3M6NjI6Ij1ccypkb2N1bWVudFwuY3JlYXRlRWxlbWVudFwoXHMqWyciXXswLDF9c2NyaXB0WyciXXswLDF9XHMqXCk7IjtpOjEyNjtzOjY5OiJkb2N1bWVudFwuYm9keVwuaW5zZXJ0QmVmb3JlXChkaXYsXHMqZG9jdW1lbnRcLmJvZHlcLmNoaWxkcmVuXFswXF1cKTsiO2k6MTI3O3M6Nzc6IjxzY3JpcHRccyt0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiXHMrc3JjPSJodHRwOi8vW2EtekEtWjAtOV9dKz9cLnBocCI+PC9zY3JpcHQ+IjtpOjEyODtzOjI3OiJlY2hvXHMrWyciXXswLDF9b2tbJyJdezAsMX0iO2k6MTI5O3M6MTg6Ii91c3Ivc2Jpbi9zZW5kbWFpbCI7aToxMzA7czoyMzoiL3Zhci9xbWFpbC9iaW4vc2VuZG1haWwiO30="));
$g_SusDBPrio = unserialize(base64_decode("YToxMjE6e2k6MDtpOjA7aToxO2k6MDtpOjI7aTowO2k6MztpOjA7aTo0O2k6MDtpOjU7aTowO2k6NjtpOjA7aTo3O2k6MDtpOjg7aToxO2k6OTtpOjE7aToxMDtpOjA7aToxMTtpOjA7aToxMjtpOjA7aToxMztpOjA7aToxNDtpOjA7aToxNTtpOjA7aToxNjtpOjA7aToxNztpOjA7aToxODtpOjA7aToxOTtpOjA7aToyMDtpOjA7aToyMTtpOjA7aToyMjtpOjA7aToyMztpOjA7aToyNDtpOjA7aToyNTtpOjA7aToyNjtpOjA7aToyNztpOjA7aToyODtpOjA7aToyOTtpOjE7aTozMDtpOjE7aTozMTtpOjA7aTozMjtpOjA7aTozMztpOjA7aTozNDtpOjA7aTozNTtpOjA7aTozNjtpOjA7aTozNztpOjA7aTozODtpOjA7aTozOTtpOjA7aTo0MDtpOjA7aTo0MTtpOjA7aTo0MjtpOjA7aTo0MztpOjA7aTo0NDtpOjA7aTo0NTtpOjA7aTo0NjtpOjA7aTo0NztpOjA7aTo0ODtpOjA7aTo0OTtpOjA7aTo1MDtpOjA7aTo1MTtpOjA7aTo1MjtpOjA7aTo1MztpOjA7aTo1NDtpOjA7aTo1NTtpOjA7aTo1NjtpOjE7aTo1NztpOjA7aTo1ODtpOjA7aTo1OTtpOjI7aTo2MDtpOjE7aTo2MTtpOjA7aTo2MjtpOjA7aTo2MztpOjA7aTo2NDtpOjI7aTo2NTtpOjA7aTo2NjtpOjA7aTo2NztpOjA7aTo2ODtpOjI7aTo2OTtpOjE7aTo3MDtpOjA7aTo3MTtpOjA7aTo3MjtpOjE7aTo3MztpOjA7aTo3NDtpOjE7aTo3NTtpOjE7aTo3NjtpOjI7aTo3NztpOjE7aTo3ODtpOjM7aTo3OTtpOjI7aTo4MDtpOjA7aTo4MTtpOjI7aTo4MjtpOjA7aTo4MztpOjA7aTo4NDtpOjI7aTo4NTtpOjA7aTo4NjtpOjA7aTo4NztpOjA7aTo4ODtpOjA7aTo4OTtpOjE7aTo5MDtpOjE7aTo5MTtpOjE7aTo5MjtpOjE7aTo5MztpOjA7aTo5NDtpOjI7aTo5NTtpOjI7aTo5NjtpOjI7aTo5NztpOjI7aTo5ODtpOjI7aTo5OTtpOjE7aToxMDA7aToxO2k6MTAxO2k6MztpOjEwMjtpOjM7aToxMDM7aToxO2k6MTA0O2k6MztpOjEwNTtpOjM7aToxMDY7aToyO2k6MTA3O2k6MDtpOjEwODtpOjM7aToxMDk7aToxO2k6MTEwO2k6MTtpOjExMTtpOjM7aToxMTI7aTozO2k6MTEzO2k6MztpOjExNDtpOjE7aToxMTU7aToxO2k6MTE2O2k6MTtpOjExNztpOjQ7aToxMTg7aToxO2k6MTE5O2k6MztpOjEyMDtpOjA7fQ=="));
$g_AdwareSig = unserialize(base64_decode("YTozMzp7aTowO3M6MTk6Il9fbGlua2ZlZWRfcm9ib3RzX18iO2k6MTtzOjEzOiJMSU5LRkVFRF9VU0VSIjtpOjI7czoxNDoiTGlua2ZlZWRDbGllbnQiO2k6MztzOjE4OiJfX3NhcGVfZGVsaW1pdGVyX18iO2k6NDtzOjI5OiJkaXNwZW5zZXJcLmFydGljbGVzXC5zYXBlXC5ydSI7aTo1O3M6MTE6IkxFTktfY2xpZW50IjtpOjY7czoxMToiU0FQRV9jbGllbnQiO2k6NztzOjE2OiJfX2xpbmtmZWVkX2VuZF9fIjtpOjg7czoxNjoiU0xBcnRpY2xlc0NsaWVudCI7aTo5O3M6MTc6Ii0+R2V0TGlua3NccypcKFwpIjtpOjEwO3M6MTc6ImRiXC50cnVzdGxpbmtcLnJ1IjtpOjExO3M6Mzc6ImNsYXNzXHMrQ01fY2xpZW50XHMrZXh0ZW5kc1xzKkNNX2Jhc2UiO2k6MTI7czoxOToibmV3XHMrQ01fY2xpZW50XChcKSI7aToxMztzOjE2OiJ0bF9saW5rc19kYl9maWxlIjtpOjE0O3M6MjA6ImNsYXNzXHMrbG1wX2Jhc2Vccyt7IjtpOjE1O3M6MTU6IlRydXN0bGlua0NsaWVudCI7aToxNjtzOjEzOiItPlxzKlNMQ2xpZW50IjtpOjE3O3M6MTY2OiJpc3NldFxzKlwoKlxzKlwkX1NFUlZFUlxzKlxbXHMqWyciXXswLDF9SFRUUF9VU0VSX0FHRU5UWyciXXswLDF9XHMqXF1ccypcKVxzKiYmXHMqXCgqXHMqXCRfU0VSVkVSXHMqXFtccypbJyJdezAsMX1IVFRQX1VTRVJfQUdFTlRbJyJdezAsMX1cXVxzKj09XHMqWyciXXswLDF9TE1QX1JvYm90IjtpOjE4O3M6NDM6IlwkbGlua3MtPlxzKnJldHVybl9saW5rc1xzKlwoKlxzKlwkbGliX3BhdGgiO2k6MTk7czo0NDoiXCRsaW5rc19jbGFzc1xzKj1ccypuZXdccytHZXRfbGlua3NccypcKCpccyoiO2k6MjA7czo1MjoiWyciXXswLDF9XHMqLFxzKlsnIl17MCwxfVwuWyciXXswLDF9XHMqXCkqXHMqO1xzKlw/PiI7aToyMTtzOjc6Imxldml0cmEiO2k6MjI7czoxMDoiZGFwb3hldGluZSI7aToyMztzOjY6InZpYWdyYSI7aToyNDtzOjY6ImNpYWxpcyI7aToyNTtzOjg6InByb3ZpZ2lsIjtpOjI2O3M6MTk6ImNsYXNzXHMrVFdlZmZDbGllbnQiO2k6Mjc7czoxODoibmV3XHMrU0xDbGllbnRcKFwpIjtpOjI4O3M6MjQ6Il9fbGlua2ZlZWRfYmVmb3JlX3RleHRfXyI7aToyOTtzOjE2OiJfX3Rlc3RfdGxfbGlua19fIjtpOjMwO3M6MTg6InM6MTE6ImxtcF9jaGFyc2V0IiI7aTozMTtzOjIwOiI9XHMrbmV3XHMrTUxDbGllbnRcKCI7aTozMjtzOjQ3OiJlbHNlXHMraWZccypcKFxzKlwoXHMqc3RycG9zXChccypcJGxpbmtzX2lwXHMqLCI7fQ=="));
$g_JSVirSig = unserialize(base64_decode("YToxMTU6e2k6MDtzOjMyOiJDbGlja1VuZGVyY29va2llXHMqPVxzKkdldENvb2tpZSI7aToxO3M6NzA6InVzZXJBZ2VudFx8cHBcfGh0dHBcfGRhemFseXpbJyJdezAsMX1cLnNwbGl0XChbJyJdezAsMX1cfFsnIl17MCwxfVwpLDAiO2k6MjtzOjQxOiJmPSdmJ1wrJ3InXCsnbydcKydtJ1wrJ0NoJ1wrJ2FyQydcKydvZGUnOyI7aTozO3M6MjI6IlwucHJvdG90eXBlXC5hfWNhdGNoXCgiO2k6NDtzOjM3OiJ0cnl7Qm9vbGVhblwoXClcLnByb3RvdHlwZVwucX1jYXRjaFwoIjtpOjU7czozNDoiaWZcKFJlZlwuaW5kZXhPZlwoJ1wuZ29vZ2xlXC4nXCkhPSI7aTo2O3M6ODY6ImluZGV4T2ZcfGlmXHxyY1x8bGVuZ3RoXHxtc25cfHlhaG9vXHxyZWZlcnJlclx8YWx0YXZpc3RhXHxvZ29cfGJpXHxocFx8dmFyXHxhb2xcfHF1ZXJ5IjtpOjc7czo1NDoiQXJyYXlcLnByb3RvdHlwZVwuc2xpY2VcLmNhbGxcKGFyZ3VtZW50c1wpXC5qb2luXCgiIlwpIjtpOjg7czo4MjoicT1kb2N1bWVudFwuY3JlYXRlRWxlbWVudFwoImQiXCsiaSJcKyJ2IlwpO3FcLmFwcGVuZENoaWxkXChxXCsiIlwpO31jYXRjaFwocXdcKXtoPSI7aTo5O3M6Nzk6Ilwreno7c3M9XFtcXTtmPSdmcidcKydvbSdcKydDaCc7ZlwrPSdhckMnO2ZcKz0nb2RlJzt3PXRoaXM7ZT13XFtmXFsic3Vic3RyIlxdXCgiO2k6MTA7czoxMTU6InM1XChxNVwpe3JldHVybiBcK1wrcTU7fWZ1bmN0aW9uIHlmXChzZix3ZVwpe3JldHVybiBzZlwuc3Vic3RyXCh3ZSwxXCk7fWZ1bmN0aW9uIHkxXCh3Ylwpe2lmXCh3Yj09MTY4XCl3Yj0xMDI1O2Vsc2UiO2k6MTE7czo2NDoiaWZcKG5hdmlnYXRvclwudXNlckFnZW50XC5tYXRjaFwoL1woYW5kcm9pZFx8bWlkcFx8ajJtZVx8c3ltYmlhbiI7aToxMjtzOjEwNjoiZG9jdW1lbnRcLndyaXRlXCgnPHNjcmlwdCBsYW5ndWFnZT0iSmF2YVNjcmlwdCIgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBzcmM9IidcK2RvbWFpblwrJyI+PC9zY3InXCsnaXB0PidcKSI7aToxMztzOjMxOiJodHRwOi8vcGhzcFwucnUvXy9nb1wucGhwXD9zaWQ9IjtpOjE0O3M6MTc6IjwvaHRtbD5ccyo8c2NyaXB0IjtpOjE1O3M6MTc6IjwvaHRtbD5ccyo8aWZyYW1lIjtpOjE2O3M6NjY6Ij1uYXZpZ2F0b3JcW2FwcFZlcnNpb25fdmFyXF1cLmluZGV4T2ZcKCJNU0lFIlwpIT0tMVw/JzxpZnJhbWUgbmFtZSI7aToxNztzOjc6IlxceDY1QXQiO2k6MTg7czo5OiJcXHg2MXJDb2QiO2k6MTk7czoyMjoiImZyIlwrIm9tQyJcKyJoYXJDb2RlIiI7aToyMDtzOjExOiI9ImV2IlwrImFsIiI7aToyMTtzOjc4OiJcW1woXChlXClcPyJzIjoiIlwpXCsicCJcKyJsaXQiXF1cKCJhXCQiXFtcKFwoZVwpXD8ic3UiOiIiXClcKyJic3RyIlxdXCgxXClcKTsiO2k6MjI7czozOToiZj0nZnInXCsnb20nXCsnQ2gnO2ZcKz0nYXJDJztmXCs9J29kZSc7IjtpOjIzO3M6MjA6ImZcKz1cKGhcKVw/J29kZSc6IiI7IjtpOjI0O3M6NDE6ImY9J2YnXCsncidcKydvJ1wrJ20nXCsnQ2gnXCsnYXJDJ1wrJ29kZSc7IjtpOjI1O3M6NTA6ImY9J2Zyb21DaCc7ZlwrPSdhckMnO2ZcKz0ncWdvZGUnXFsic3Vic3RyIlxdXCgyXCk7IjtpOjI2O3M6MTY6InZhclxzK2Rpdl9jb2xvcnMiO2k6Mjc7czo5OiJ2YXJccytfMHgiO2k6Mjg7czoyMDoiQ29yZUxpYnJhcmllc0hhbmRsZXIiO2k6Mjk7czo3OiJwaW5nbm93IjtpOjMwO3M6ODoic2VyY2hib3QiO2k6MzE7czoxMDoia20wYWU5Z3I2bSI7aTozMjtzOjY6ImMzMjg0ZCI7aTozMztzOjg6IlxceDY4YXJDIjtpOjM0O3M6ODoiXFx4NmRDaGEiO2k6MzU7czo3OiJcXHg2ZmRlIjtpOjM2O3M6NzoiXFx4NmZkZSI7aTozNztzOjg6IlxceDQzb2RlIjtpOjM4O3M6NzoiXFx4NzJvbSI7aTozOTtzOjc6IlxceDQzaGEiO2k6NDA7czo3OiJcXHg3MkNvIjtpOjQxO3M6ODoiXFx4NDNvZGUiO2k6NDI7czoxMDoiXC5keW5kbnNcLiI7aTo0MztzOjk6IlwuZHluZG5zLSI7aTo0NDtzOjc5OiJ9XHMqZWxzZVxzKntccypkb2N1bWVudFwud3JpdGVccypcKFxzKlsnIl17MCwxfVwuWyciXXswLDF9XClccyp9XHMqfVxzKlJcKFxzKlwpIjtpOjQ1O3M6NDU6ImRvY3VtZW50XC53cml0ZVwodW5lc2NhcGVcKCclM0NkaXYlMjBpZCUzRCUyMiI7aTo0NjtzOjE4OiJcLmJpdGNvaW5wbHVzXC5jb20iO2k6NDc7czo0MToiXC5zcGxpdFwoIiYmIlwpO2g9MjtzPSIiO2lmXChtXClmb3JcKGk9MDsiO2k6NDg7czo0MToiPGlmcmFtZVxzK3NyYz0iaHR0cDovL2RlbHV4ZXNjbGlja3NcLnByby8iO2k6NDk7czo0NToiM0Jmb3JcfGZyb21DaGFyQ29kZVx8MkMyN1x8M0RcfDJDODhcfHVuZXNjYXBlIjtpOjUwO3M6NTg6Ijtccypkb2N1bWVudFwud3JpdGVcKFsnIl17MCwxfTxpZnJhbWVccypzcmM9Imh0dHA6Ly95YVwucnUiO2k6NTE7czoxMTA6IndcLmRvY3VtZW50XC5ib2R5XC5hcHBlbmRDaGlsZFwoc2NyaXB0XCk7XHMqY2xlYXJJbnRlcnZhbFwoaVwpO1xzKn1ccyp9XHMqLFxzKlxkK1xzKlwpXHMqO1xzKn1ccypcKVwoXHMqd2luZG93IjtpOjUyO3M6MTEwOiJpZlwoIWdcKFwpJiZ3aW5kb3dcLm5hdmlnYXRvclwuY29va2llRW5hYmxlZFwpe2RvY3VtZW50XC5jb29raWU9IjE9MTtleHBpcmVzPSJcK2VcLnRvR01UU3RyaW5nXChcKVwrIjtwYXRoPS8iOyI7aTo1MztzOjcwOiJubl9wYXJhbV9wcmVsb2FkZXJfY29udGFpbmVyXHw1MDAxXHxoaWRkZW5cfGlubmVySFRNTFx8aW5qZWN0XHx2aXNpYmxlIjtpOjU0O3M6MzA6IjwhLS1bYS16QS1aMC05X10rP1x8XHxzdGF0IC0tPiI7aTo1NTtzOjg1OiImcGFyYW1ldGVyPVwka2V5d29yZCZzZT1cJHNlJnVyPTEmSFRUUF9SRUZFUkVSPSdcK2VuY29kZVVSSUNvbXBvbmVudFwoZG9jdW1lbnRcLlVSTFwpIjtpOjU2O3M6NDg6IndpbmRvd3NcfHNlcmllc1x8NjBcfHN5bWJvc1x8Y2VcfG1vYmlsZVx8c3ltYmlhbiI7aTo1NztzOjM1OiJcW1snIl1ldmFsWyciXVxdXChzXCk7fX19fTwvc2NyaXB0PiI7aTo1ODtzOjU5OiJrQzcwRk1ibHlKa0ZXWm9kQ0tsMVdZT2RXWVVsblF6Um5ibDFXWnNWRWRsZG1MMDVXWnRWM1l2UkdJOSI7aTo1OTtzOjU1OiJ7az1pO3M9c1wuY29uY2F0XChzc1woZXZhbFwoYXNxXChcKVwpLTFcKVwpO316PXM7ZXZhbFwoIjtpOjYwO3M6MTMwOiJkb2N1bWVudFwuY29va2llXC5tYXRjaFwobmV3XHMrUmVnRXhwXChccyoiXChcPzpcXlx8OyBcKSJccypcK1xzKm5hbWVcLnJlcGxhY2VcKC9cKFxbXFxcLlwkXD9cKlx8e31cXFwoXFxcKVxcXFtcXFxdXFwvXFxcK1xeXF1cKS9nIjtpOjYxO3M6ODY6InNldENvb2tpZVxzKlwoKlxzKiJhcnhfdHQiXHMqLFxzKjFccyosXHMqZHRcLnRvR01UU3RyaW5nXChcKVxzKixccypbJyJdezAsMX0vWyciXXswLDF9IjtpOjYyO3M6MTQ0OiJkb2N1bWVudFwuY29va2llXC5tYXRjaFxzKlwoXHMqbmV3XHMrUmVnRXhwXHMqXChccyoiXChcPzpcXlx8O1xzKlwpIlxzKlwrXHMqbmFtZVwucmVwbGFjZVxzKlwoL1woXFtcXFwuXCRcP1wqXHx7fVxcXChcXFwpXFxcW1xcXF1cXC9cXFwrXF5cXVwpL2ciO2k6NjM7czo5ODoidmFyXHMrZHRccys9XHMrbmV3XHMrRGF0ZVwoXCksXHMrZXhwaXJ5VGltZVxzKz1ccytkdFwuc2V0VGltZVwoXHMrZHRcLmdldFRpbWVcKFwpXHMrXCtccys5MDAwMDAwMDAiO2k6NjQ7czoxMDU6ImlmXHMqXChccypudW1ccyo9PT1ccyowXHMqXClccyp7XHMqcmV0dXJuXHMqMTtccyp9XHMqZWxzZVxzKntccypyZXR1cm5ccytudW1ccypcKlxzKnJGYWN0XChccypudW1ccyotXHMqMSI7aTo2NTtzOjQxOiJcKz1TdHJpbmdcLmZyb21DaGFyQ29kZVwocGFyc2VJbnRcKDBcKyd4JyI7aTo2NjtzOjgzOiI8c2NyaXB0XHMrbGFuZ3VhZ2U9IkphdmFTY3JpcHQiPlxzKnBhcmVudFwud2luZG93XC5vcGVuZXJcLmxvY2F0aW9uPSJodHRwOi8vdmtcLmNvbSI7aTo2NztzOjQ0OiJsb2NhdGlvblwucmVwbGFjZVwoWyciXXswLDF9aHR0cDovL3Y1azQ1XC5ydSI7aTo2ODtzOjEyOToiO3RyeXtcK1wrZG9jdW1lbnRcLmJvZHl9Y2F0Y2hcKHFcKXthYT1mdW5jdGlvblwoZmZcKXtmb3JcKGk9MDtpPHpcLmxlbmd0aDtpXCtcK1wpe3phXCs9U3RyaW5nXFtmZlxdXChlXCh2XCtcKHpcW2lcXVwpXCktMTJcKTt9fTt9IjtpOjY5O3M6MTQyOiJkb2N1bWVudFwud3JpdGVccypcKFsnIl17MCwxfTxbJyJdezAsMX1ccypcK1xzKnhcWzBcXVxzKlwrXHMqWyciXXswLDF9IFsnIl17MCwxfVxzKlwrXHMqeFxbNFxdXHMqXCtccypbJyJdezAsMX0+XC5bJyJdezAsMX1ccypcK3hccypcWzJcXVxzKlwrIjtpOjcwO3M6NjA6ImlmXCh0XC5sZW5ndGg9PTJcKXt6XCs9U3RyaW5nXC5mcm9tQ2hhckNvZGVcKHBhcnNlSW50XCh0XClcKyI7aTo3MTtzOjc0OiJ3aW5kb3dcLm9ubG9hZFxzKj1ccypmdW5jdGlvblwoXClccyp7XHMqaWZccypcKGRvY3VtZW50XC5jb29raWVcLmluZGV4T2ZcKCI7aTo3MjtzOjk3OiJcLnN0eWxlXC5oZWlnaHRccyo9XHMqWyciXXswLDF9MHB4WyciXXswLDF9O3dpbmRvd1wub25sb2FkXHMqPVxzKmZ1bmN0aW9uXChcKVxzKntkb2N1bWVudFwuY29va2llIjtpOjczO3M6MTIyOiJcLnNyYz1cKFsnIl17MCwxfWh0cHM6WyciXXswLDF9PT1kb2N1bWVudFwubG9jYXRpb25cLnByb3RvY29sXD9bJyJdezAsMX1odHRwczovL3NzbFsnIl17MCwxfTpbJyJdezAsMX1odHRwOi8vWyciXXswLDF9XClcKyI7aTo3NDtzOjMwOiI0MDRcLnBocFsnIl17MCwxfT5ccyo8L3NjcmlwdD4iO2k6NzU7czo3NjoicHJlZ19tYXRjaFwoWyciXXswLDF9L3NhcGUvaVsnIl17MCwxfVxzKixccypcJF9TRVJWRVJcW1snIl17MCwxfUhUVFBfUkVGRVJFUiI7aTo3NjtzOjc0OiJkaXZcLmlubmVySFRNTFxzKlwrPVxzKlsnIl17MCwxfTxlbWJlZFxzK2lkPSJkdW1teTIiXHMrbmFtZT0iZHVtbXkyIlxzK3NyYyI7aTo3NztzOjczOiJzZXRUaW1lb3V0XChbJyJdezAsMX1hZGROZXdPYmplY3RcKFwpWyciXXswLDF9LFxkK1wpO319fTthZGROZXdPYmplY3RcKFwpIjtpOjc4O3M6NTE6IlwoYj1kb2N1bWVudFwpXC5oZWFkXC5hcHBlbmRDaGlsZFwoYlwuY3JlYXRlRWxlbWVudCI7aTo3OTtzOjMwOiJDaHJvbWVcfGlQYWRcfGlQaG9uZVx8SUVNb2JpbGUiO2k6ODA7czoxOToiXCQ6XCh7fVwrIiJcKVxbXCRcXSI7aTo4MTtzOjUzOiJ7cG9zaXRpb246YWJzb2x1dGU7dG9wOi05OTk5cHg7fTwvc3R5bGU+PGRpdlxzK2NsYXNzPSI7aTo4MjtzOjEyODoiaWZccypcKFwodWFcLmluZGV4T2ZcKFsnIl17MCwxfWNocm9tZVsnIl17MCwxfVwpXHMqPT1ccyotMVxzKiYmXHMqdWFcLmluZGV4T2ZcKCJ3aW4iXClccyohPVxzKi0xXClccyomJlxzKm5hdmlnYXRvclwuamF2YUVuYWJsZWQiO2k6ODM7czo1ODoicGFyZW50XC53aW5kb3dcLm9wZW5lclwubG9jYXRpb249WyciXXswLDF9aHR0cDovL3ZrXC5jb21cLiI7aTo4NDtzOjQxOiJcXVwuc3Vic3RyXCgwLDFcKVwpO319cmV0dXJuIHRoaXM7fSxcXHUwMCI7aTo4NTtzOjY4OiJqYXZhc2NyaXB0XHxoZWFkXHx0b0xvd2VyQ2FzZVx8Y2hyb21lXHx3aW5cfGphdmFFbmFibGVkXHxhcHBlbmRDaGlsZCI7aTo4NjtzOjIxOiJsb2FkUE5HRGF0YVwoc3RyRmlsZSwiO2k6ODc7czoyMDoiXCk7aWZcKCF+XChbJyJdezAsMX0iO2k6ODg7czoyMzoiLy9ccypTb21lXC5kZXZpY2VzXC5hcmUiO2k6ODk7czo1NToic3RyaXBvc1xzKlwoXHMqZl9oYXlzdGFja1xzKixccypmX25lZWRsZVxzKixccypmX29mZnNldCI7aTo5MDtzOjMyOiJ3aW5kb3dcLm9uZXJyb3Jccyo9XHMqa2lsbGVycm9ycyI7aTo5MTtzOjEwNToiY2hlY2tfdXNlcl9hZ2VudD1cW1xzKlsnIl17MCwxfUx1bmFzY2FwZVsnIl17MCwxfVxzKixccypbJyJdezAsMX1pUGhvbmVbJyJdezAsMX1ccyosXHMqWyciXXswLDF9TWFjaW50b3NoIjtpOjkyO3M6MTUzOiJkb2N1bWVudFwud3JpdGVcKFsnIl17MCwxfTxbJyJdezAsMX1cK1snIl17MCwxfWlbJyJdezAsMX1cK1snIl17MCwxfWZbJyJdezAsMX1cK1snIl17MCwxfXJbJyJdezAsMX1cK1snIl17MCwxfWFbJyJdezAsMX1cK1snIl17MCwxfW1bJyJdezAsMX1cK1snIl17MCwxfWUiO2k6OTM7czoxNzoic2V4ZnJvbWluZGlhXC5jb20iO2k6OTQ7czoxMToiZmlsZWt4XC5jb20iO2k6OTU7czoxMzoic3R1bW1hbm5cLm5ldCI7aTo5NjtzOjE0OiJodHRwOi8veHp4XC5wbSI7aTo5NztzOjE4OiJcLmhvcHRvXC5tZS9qcXVlcnkiO2k6OTg7czoxMToibW9iaS1nb1wuaW4iO2k6OTk7czoxODoiYmFua29mYW1lcmljYVwuY29tIjtpOjEwMDtzOjE2OiJteWZpbGVzdG9yZVwuY29tIjtpOjEwMTtzOjE3OiJmaWxlc3RvcmU3MlwuaW5mbyI7aToxMDI7czoxNjoiZmlsZTJzdG9yZVwuaW5mbyI7aToxMDM7czoxNToidXJsMnNob3J0XC5pbmZvIjtpOjEwNDtzOjE4OiJmaWxlc3RvcmUxMjNcLmluZm8iO2k6MTA1O3M6MTI6InVybDEyM1wuaW5mbyI7aToxMDY7czoxNDoiZG9sbGFyYWRlXC5jb20iO2k6MTA3O3M6MTE6InNlY2NsaWtcLnJ1IjtpOjEwODtzOjExOiJtb2J5LWFhXC5ydSI7aToxMDk7czoxMjoic2VydmxvYWRcLnJ1IjtpOjExMDtzOjQ4OiJzdHJpcG9zXChuYXZpZ2F0b3JcLnVzZXJBZ2VudFxzKixccypsaXN0X2RhdGFcW2kiO2k6MTExO3M6MjY6ImlmXHMqXCghc2VlX3VzZXJfYWdlbnRcKFwpIjtpOjExMjtzOjQ2OiJjXC5sZW5ndGhcKTt9cmV0dXJuXHMqWyciXVsnIl07fWlmXCghZ2V0Q29va2llIjtpOjExMztzOjcwOiI8c2NyaXB0XHMqdHlwZT1bJyJdezAsMX10ZXh0L2phdmFzY3JpcHRbJyJdezAsMX1ccypzcmM9WyciXXswLDF9ZnRwOi8vIjtpOjExNDtzOjQ4OiJpZlxzKlwoZG9jdW1lbnRcLmNvb2tpZVwuaW5kZXhPZlwoWyciXXswLDF9c2FicmkiO30="));
$gX_JSVirSig = unserialize(base64_decode("YToxODp7aTowO3M6NDg6ImRvY3VtZW50XC53cml0ZVxzKlwoXHMqdW5lc2NhcGVccypcKFsnIl17MCwxfSUzYyI7aToxO3M6Njk6ImRvY3VtZW50XC5nZXRFbGVtZW50c0J5VGFnTmFtZVwoWyciXWhlYWRbJyJdXClcWzBcXVwuYXBwZW5kQ2hpbGRcKGFcKSI7aToyO3M6Mjg6ImlwXChob25lXHxvZFwpXHxpcmlzXHxraW5kbGUiO2k6MztzOjQ4OiJzbWFydHBob25lXHxibGFja2JlcnJ5XHxtdGtcfGJhZGFcfHdpbmRvd3MgcGhvbmUiO2k6NDtzOjQwOiJwb3NpdGlvbjphYnNvbHV0ZTtsZWZ0Oi1cZCtweDt0b3A6LVxkK3B4IjtpOjU7czozMDoiY29tcGFsXHxlbGFpbmVcfGZlbm5lY1x8aGlwdG9wIjtpOjY7czo1NjoiO2M9MX07d2hpbGVcKGMtLVwpe2lmXChrXFtjXF1cKXtwPXBcLnJlcGxhY2VcKG5ldyBSZWdFeHAiO2k6NztzOjM3OiJkb2N1bWVudFwud3JpdGVcKFsnIl08c2NyWyciXVwrWyciXWlwIjtpOjg7czo0OToiaWZyYW1lXC5zdHlsZVwud2lkdGhccyo9XHMqWyciXXswLDF9MHB4WyciXXswLDF9OyI7aTo5O3M6MTAxOiJkb2N1bWVudFwuY2FwdGlvbj1udWxsO3dpbmRvd1wuYWRkRXZlbnRcKFsnIl17MCwxfWxvYWRbJyJdezAsMX0sZnVuY3Rpb25cKFwpe3ZhciBjYXB0aW9uPW5ldyBKQ2FwdGlvbiI7aToxMDtzOjEyOiJodHRwOi8vZnRwXC4iO2k6MTE7czo3OiJubm5cLnBtIjtpOjEyO3M6Nzoibm5tXC5wbSI7aToxMztzOjE2OiJ0b3Atd2VicGlsbFwuY29tIjtpOjE0O3M6Nzg6IjxzY3JpcHRccyp0eXBlPVsnIl17MCwxfXRleHQvamF2YXNjcmlwdFsnIl17MCwxfVxzKnNyYz1bJyJdezAsMX1odHRwOi8vZ29vXC5nbCI7aToxNTtzOjY3OiIiXHMqXCtccypuZXcgRGF0ZVwoXClcLmdldFRpbWVcKFwpO1xzKmRvY3VtZW50XC5ib2R5XC5hcHBlbmRDaGlsZFwoIjtpOjE2O3M6MzQ6IlwuaW5kZXhPZlwoXHMqWyciXUlCcm93c2VbJyJdXHMqXCkiO2k6MTc7czo4NzoiPWRvY3VtZW50XC5yZWZlcnJlcjtccypbYS16QS1aMC05X10rPz11bmVzY2FwZVwoXHMqW2EtekEtWjAtOV9dKz9ccypcKTtccyp2YXJccytFeHBEYXRlIjt9"));
$g_PhishingSig = unserialize(base64_decode("YTozNzp7aTowO3M6MTM6IkludmFsaWRccytUVk4iO2k6MTtzOjExOiJJbnZhbGlkIFJWTiI7aToyO3M6NDA6ImRlZmF1bHRTdGF0dXNccyo9XHMqWyciXUludGVybmV0IEJhbmtpbmciO2k6MztzOjI4OiI8dGl0bGU+XHMqQ2FwaXRlY1xzK0ludGVybmV0IjtpOjQ7czoyNzoiPHRpdGxlPlxzKkludmVzdGVjXHMrT25saW5lIjtpOjU7czozOToiaW50ZXJuZXRccytQSU5ccytudW1iZXJccytpc1xzK3JlcXVpcmVkIjtpOjY7czoxMToiPHRpdGxlPlNhcnMiO2k6NztzOjEzOiI8YnI+QVRNXHMrUElOIjtpOjg7czoxODoiQ29uZmlybWF0aW9uXHMrT1RQIjtpOjk7czoyNToiPHRpdGxlPlxzKkFic2FccytJbnRlcm5ldCI7aToxMDtzOjIxOiItXHMqUGF5UGFsXHMqPC90aXRsZT4iO2k6MTE7czoxOToiPHRpdGxlPlxzKlBheVxzKlBhbCI7aToxMjtzOjIyOiItXHMqUHJpdmF0aVxzKjwvdGl0bGU+IjtpOjEzO3M6MTk6Ijx0aXRsZT5ccypVbmlDcmVkaXQiO2k6MTQ7czoxOToiQmFua1xzK29mXHMrQW1lcmljYSI7aToxNTtzOjI1OiJBbGliYWJhJm5ic3A7TWFudWZhY3R1cmVyIjtpOjE2O3M6MjA6IlZlcmlmaWVkXHMrYnlccytWaXNhIjtpOjE3O3M6MjE6IkhvbmdccytMZW9uZ1xzK09ubGluZSI7aToxODtzOjMwOiJZb3VyXHMrYWNjb3VudFxzK1x8XHMrTG9nXHMraW4iO2k6MTk7czoyNDoiPHRpdGxlPlxzKk9ubGluZSBCYW5raW5nIjtpOjIwO3M6MjQ6Ijx0aXRsZT5ccypPbmxpbmUtQmFua2luZyI7aToyMTtzOjIyOiJTaWduXHMraW5ccyt0b1xzK1lhaG9vIjtpOjIyO3M6MTE6IkJBTkNPTE9NQklBIjtpOjIzO3M6MTY6Ijx0aXRsZT5ccypBbWF6b24iO2k6MjQ7czoxNToiPHRpdGxlPlxzKkFwcGxlIjtpOjI1O3M6MjU6Ijx0aXRsZT5ccypHb29nbGVccytTZWN1cmUiO2k6MjY7czozMToiPHRpdGxlPlxzKk1lcmFrXHMrTWFpbFxzK1NlcnZlciI7aToyNztzOjI2OiI8dGl0bGU+XHMqU29ja2V0XHMrV2VibWFpbCI7aToyODtzOjIxOiI8dGl0bGU+XHMqXFtMX1FVRVJZXF0iO2k6Mjk7czozNDoiPHRpdGxlPlxzKkFOWlxzK0ludGVybmV0XHMrQmFua2luZyI7aTozMDtzOjMzOiJjb21cLndlYnN0ZXJiYW5rXC5zZXJ2bGV0c1wuTG9naW4iO2k6MzE7czoxNToiPHRpdGxlPlxzKkdtYWlsIjtpOjMyO3M6MTg6Ijx0aXRsZT5ccypGYWNlYm9vayI7aTozMztzOjM2OiJcZCs7VVJMPWh0dHBzOi8vd3d3XC53ZWxsc2ZhcmdvXC5jb20iO2k6MzQ7czoyMzoiPHRpdGxlPlxzKldlbGxzXHMqRmFyZ28iO2k6MzU7czo0OToicHJvcGVydHk9Im9nOnNpdGVfbmFtZSJccypjb250ZW50PSJGYWNlYm9vayJccyovPiI7aTozNjtzOjIyOiJBZXNcLkN0clwuZGVjcnlwdFxzKlwoIjt9"));

//var_dump($g_FlexDBShe);
//exit;


$g_UnsafeFilesArray = array('t\d*\.php', 'a{1,}\.php', 'z\d*\.php', '123\.php', 'test\d*.php', 'asd\.php', 'info\.php', 'CHANGELOG\.php', 
                           'COPYRIGHT\.php', 'CREDITS\.php', 'LICENSE\.php', 'LICENSES\.php', 'backup.+?\.zip', 
                           'backup.+?\.tar\.gz', 'backup.+?\.tgz', 
                           'phpinfo\.php', 'changelog\.txt', 'readme\.txt', 'INSTALLATION\.php', 'dump\.sql', 'changelog\.log');

$g_UnsafeDirArray = array('install', 'backup', 'webalizer', 'awstats');

////////////////////////////////////////////////////////////////////////////
if (!isCli() && !isset($_SERVER['HTTP_USER_AGENT'])) {
  echo "#####################################################\n";
  echo "# Error: cannot run on php-cgi. Requires php as cli #\n";
  echo "#                                                   #\n";
  echo "# See FAQ: http://revisium.com/ai/faq.php           #\n";
  echo "#####################################################\n";
  exit;
}

define('AI_VERSION', '20141013');

define('INFO_M', base64_decode('PGZvbnQgY29sb3I9I0UwNjA2MD7QotC+0LvRjNC60L4g0LTQu9GPINC90LXQutC+0LzQvNC10YDRh9C10YHQutC+0LPQviDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjRjyE8L2ZvbnQ+PC9oNT4='));


////////////////////////////////////////////////////////////////////////////

$l_Res = '';

$g_Structure = array();
$g_Counter = 0;

$g_NotRead = array();
$g_FileInfo = array();
$g_Iframer = array();
$g_PHPCodeInside = array();
$g_CriticalJS = array();
$g_Phishing = array();
$g_HeuristicDetected = array();
$g_HeuristicType = array();
$g_UnixExec = array();
$g_SkippedFolders = array();
$g_UnsafeFilesFound = array();
$g_CMS = array();
$g_SymLinks = array();

$g_TotalFolder = 0;
$g_TotalFiles = 0;

$g_FoundTotalDirs = 0;
$g_FoundTotalFiles = 0;

if (!isCli()) {
   $defaults['site_url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/'; 
}

define('CRC32_LIMIT', pow(2, 31) - 1);
define('CRC32_DIFF', CRC32_LIMIT * 2 -2);

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
srand(time());

set_time_limit(0);
ini_set('max_execution_time', '90000');
ini_set('memory_limit','256M');
ini_set('realpath_cache_size','16M');
ini_set('realpath_cache_ttl','1200');

if (!function_exists('stripos')) {
	function stripos($par_Str, $par_Entry, $Offset = 0) {
		return strpos(strtolower($par_Str), strtolower($par_Entry), $Offset);
	}
}

define('CMS_BITRIX', 'Bitrix');
define('CMS_WORDPRESS', 'Wordpress');
define('CMS_JOOMLA', 'Joomla');
define('CMS_DLE', 'Data Life Engine');
define('CMS_IPB', 'Invision Power Board');
define('CMS_WEBASYST', 'WebAsyst');
define('CMS_OSCOMMERCE', 'OsCommerce');
define('CMS_DRUPAL', 'Drupal');
define('CMS_MODX', 'MODX');
define('CMS_INSTANTCMS', 'Instant CMS');
define('CMS_PHPBB', 'PhpBB');
define('CMS_VBULLETIN', 'vBulletin');
define('CMS_SHOPSCRIPT', 'PHP ShopScript Premium');

define('CMS_VERSION_UNDEFINED', '0.0');

class CmsVersionDetector {
    private $root_path;
    private $versions;
    private $types;

    public function __construct($root_path = '.') {

        $this->root_path = $root_path;
        $this->versions = array();
        $this->types = array();

        $version = '';

        if ($this->checkBitrix($version)) {
           $this->addCms(CMS_BITRIX, $version);
        }

        if ($this->checkWordpress($version)) {
           $this->addCms(CMS_WORDPRESS, $version);
        }

        if ($this->checkJoomla($version)) {
           $this->addCms(CMS_JOOMLA, $version);
        }

        if ($this->checkDle($version)) {
           $this->addCms(CMS_DLE, $version);
        }

        if ($this->checkIpb($version)) {
           $this->addCms(CMS_IPB, $version);
        }

        if ($this->checkWebAsyst($version)) {
           $this->addCms(CMS_WEBASYST, $version);
        }

        if ($this->checkOsCommerce($version)) {
           $this->addCms(CMS_OSCOMMERCE, $version);
        }

        if ($this->checkDrupal($version)) {
           $this->addCms(CMS_DRUPAL, $version);
        }

        if ($this->checkMODX($version)) {
           $this->addCms(CMS_MODX, $version);
        }

        if ($this->checkInstantCms($version)) {
           $this->addCms(CMS_INSTANTCMS, $version);
        }

        if ($this->checkPhpBb($version)) {
           $this->addCms(CMS_PHPBB, $version);
        }

        if ($this->checkVBulletin($version)) {
           $this->addCms(CMS_VBULLETIN, $version);
        }

        if ($this->checkPhpShopScript($version)) {
           $this->addCms(CMS_SHOPSCRIPT, $version);
        }

    }

    function getCmsList() {
      return $this->types;
    }

    function getCmsVersions() {
      return $this->versions;
    }

    function getCmsNumber() {
      return count($this->types);
    }

    function getCmsName($index = 0) {
      return $this->types[$index];
    }

    function getCmsVersion($index = 0) {
      return $this->versions[$index];
    }

    private function addCms($type, $version) {
       $this->types[] = $type;
       $this->versions[] = $version;
    }

    private function checkBitrix(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/bitrix')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/bitrix/modules/main/classes/general/version.php'));
          if (preg_match('|define\("SM_VERSION","(.+?)"\)|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkWordpress(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/wp-admin')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/wp-includes/version.php'));
          if (preg_match('|\$wp_version\s*=\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }
       }

       return $res;
    }

    private function checkJoomla(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/libraries/joomla')) {
          $res = true;

          // for 1.5.x
          $tmp_content = @implode('', @file($this->root_path .'/libraries/joomla/version.php'));
          if (preg_match('|var\s+\$RELEASE\s*=\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];

             if (preg_match('|var\s+\$DEV_LEVEL\s*=\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
                $version .= '.' . $tmp_ver[1];
             }
          }

          // for 1.7.x
          $tmp_content = @implode('', @file($this->root_path .'/includes/version.php'));
          if (preg_match('|public\s+\$RELEASE\s*=\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];

             if (preg_match('|public\s+\$DEV_LEVEL\s*=\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
                $version .= '.' . $tmp_ver[1];
             }
          }

          // for 2.5.x and 3.x
          $tmp_content = @implode('', @file($this->root_path .'/libraries/cms/version/version.php'));
          if (preg_match('|public\s+\$RELEASE\s*=\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];

             if (preg_match('|public\s+\$DEV_LEVEL\s*=\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
                $version .= '.' . $tmp_ver[1];
             }
          }

       }

       return $res;
    }

    private function checkDle(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/engine/engine.php')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/engine/data/config.php'));
          if (preg_match('|\'version_id\'\s*=>\s*"(.+?)"|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

          $tmp_content = @implode('', @file($this->root_path .'/install.php'));
          if (preg_match('|\'version_id\'\s*=>\s*"(.+?)"|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkIpb(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/ips_kernel')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/ips_kernel/class_xml.php'));
          if (preg_match('|IP.Board\s+v([0-9\.]+)|si', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkWebAsyst(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/wbs/installer')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/license.txt'));
          if (preg_match('|v([0-9\.]+)|si', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkOsCommerce(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/includes/version.php')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/includes/version.php'));
          if (preg_match('|([0-9\.]+)|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkDrupal(&$version) {
    $version = CMS_VERSION_UNDEFINED;
    $res = false;

    if (file_exists($this->root_path . '/sites/all')) {
      $res = true;

      if (file_exists($this->root_path . '/modules/system/system.module') || file_exists('/includes/bootstrap.inc')) {
        //получение версии для drupal 7
        $content = file($this->root_path . '/includes/bootstrap.inc');
        foreach ($content as $line) {
          if (preg_match("/define\('VERSION',.*\;/i", $line, $matches)) {
            $druver_temp = explode("'", $matches[0]);
            $druver = $druver_temp[3];
          }
        }
        //если не drupal7, получение версии для drupal 6
        if (!$druver) {
          $content = file($this->root_path . '/modules/system/system.module');
          foreach ($content as $line) {
            if (preg_match("/define\('VERSION',.*\;/i", $line, $matches)) {
              $druver_temp = explode("'", $matches[0]);
              $druver = $druver_temp[3];
            }
          }
        }
      }
      //если не drupal 7 и не drupal 6, получение версии для drupal 8
      if (!$druver) {
        if (file_exists($this->root_path . '/core/modules/system/system.info.yml')) {
          $content = file($this->root_path . '/core/modules/system/system.info.yml');
          foreach ($content as $line) {
            if (preg_match("/^version: '.*'/i", $line, $matches)) {
              $druver_temp = explode("'", $matches[0]);
              $druver = $druver_temp[1];
            }
          }
        }
      }
      $version = $druver;
    }

    return $res;
  }

    private function checkMODX(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/manager/assets')) {
          $res = true;

          // no way to pick up version
       }

       return $res;
    }

    private function checkInstantCms(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/plugins/p_usertab')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/index.php'));
          if (preg_match('|InstantCMS\s+v([0-9\.]+)|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkPhpBb(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/includes/acp')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/config.php'));
          if (preg_match('|phpBB\s+([0-9\.x]+)|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkVBulletin(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/core/admincp')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/core/api.php'));
          if (preg_match('|vBulletin\s+([0-9\.x]+)|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }

    private function checkPhpShopScript(&$version) {
       $version = CMS_VERSION_UNDEFINED;
       $res = false;

       if (file_exists($this->root_path .'/install/consts.php')) {
          $res = true;

          $tmp_content = @implode('', @file($this->root_path .'/install/consts.php'));
          if (preg_match('|STRING_VERSION\',\s*\'(.+?)\'|smi', $tmp_content, $tmp_ver)) {
             $version = $tmp_ver[1];
          }

       }

       return $res;
    }
}

/**
 * Print file
*/
function printFile() {
	$l_FileName = $_GET['fn'];
	$l_CRC = isset($_GET['c']) ? (int)$_GET['c'] : 0;
	$l_Content = implode('', file($l_FileName));
	$l_FileCRC = realCRC($l_Content);
	if ($l_FileCRC != $l_CRC) {
		echo 'Доступ запрещен.';
		exit;
	}
	
	echo '<pre>' . htmlspecialchars($l_Content) . '</pre>';
}

/**
 *
 */
function realCRC($str_in, $full = false)
{
        $in = crc32( $full ? normal($str_in) : $str_in );
        return ($in > CRC32_LIMIT) ? ($in - CRC32_DIFF) : $in;
}


/**
 * Determine php script is called from the command line interface
 * @return bool
 */
function isCli()
{
	return php_sapi_name() == 'cli';
}

function myCheckSum($str) {
  return str_replace('-', 'x', crc32($str));
}

/*
 *
 */
function shanonEntropy($par_Str)
{
    $dic = array();

    $len = strlen($par_Str);
    for ($i = 0; $i < $len; $i++) {
        $dic[$par_Str[$i]]++;
    } 

    $result = 0.0;
    $frequency = 0.0;
    foreach ($dic as $item)
    {
        $frequency = (float)$item / (float)$len;
        $result -= $frequency * (log($frequency) / log(2));
    }

    return $result;
}

 function generatePassword ($length = 9)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
  
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }
	
    // set up a counter for how many characters are in the password so far
    $i = 0; 
    
    // add random characters to $password until $length is reached
    while ($i < $length) { 

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
      // have we already used this character in $password?
      if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }

/**
 * Print to console
 * @param mixed $text
 * @param bool $add_lb Add line break
 * @return void
 */
function stdOut($text, $add_lb = true)
{
	global $BOOL_RESULT;

	if (!isCli())
		return;
		
	if (is_bool($text))
	{
		$text = $text ? 'true' : 'false';
	}
	else if (is_null($text))
	{
		$text = 'null';
	}
	if (!is_scalar($text))
	{
		$text = print_r($text, true);
	}

 	if (!$BOOL_RESULT)
 	{
 		@fwrite(STDOUT, $text . ($add_lb ? "\n" : ''));
 	}
}

/**
 * Print progress
 * @param int $num Current file
 */
function printProgress($num, &$par_File)
{
	global $g_CriticalPHP, $g_Base64, $g_Phishing, $g_CriticalJS, $g_Iframer;
	$total_files = $GLOBALS['g_FoundTotalFiles'];
	$elapsed_time = microtime(true) - START_TIME;
	$stat = '';
	if ($elapsed_time >= 1)
	{
		$elapsed_seconds = round($elapsed_time, 0);
		$fs = floor($num / $elapsed_seconds);
		$left_files = $total_files - $num;
		if ($fs > 0) 
		{
		   $left_time = ($left_files / $fs); //ceil($left_files / $fs);
		   $stat = '. [Avg: ' . round($fs,2) . ' files/s' . ($left_time > 0  ? ' Left: ' . seconds2Human($left_time) : '') . '] [Mlw:' . (count($g_CriticalPHP) + count($g_Base64))  . '|' . (count($g_CriticalJS) + count($g_Iframer) + count($g_Phishing)) . ']';
        }
	}

	$l_FN = substr($par_File, -60);

	$text = "[$l_FN] $num of {$total_files}" . $stat;
	$text = str_pad($text, 160, ' ', STR_PAD_RIGHT);
	stdOut(str_repeat(chr(8), 160) . $text, false);
}

/**
 * Seconds to human readable
 * @param int $seconds
 * @return string
 */
function seconds2Human($seconds)
{
	$r = '';
	$_seconds = floor($seconds);
	$ms = $seconds - $_seconds;
	$seconds = $_seconds;
	if ($hours = floor($seconds / 3600))
	{
		$r .= $hours . (isCli() ? ' h ' : ' час ');
		$seconds = $seconds % 3600;
	}

	if ($minutes = floor($seconds / 60))
	{
		$r .= $minutes . (isCli() ? ' m ' : ' мин ');
		$seconds = $seconds % 60;
	}

	if ($minutes<3) $r .= ' ' . $seconds + ($ms > 0 ? round($ms, 5) : 0) . (isCli() ? ' s' : ' сек'); //' сек' - not good for shell

	return $r;
}

if (isCli())
{

	$cli_options = array(
		'm:' => 'memory:',
		's:' => 'size:',
		'a' => 'all',
		'd:' => 'delay:',
		'l:' => 'list:',
		'r:' => 'report:',
		'f' => 'fast',
		'j:' => 'file',
		'p:' => 'path:',
		'q' => 'quite',
		'h' => 'help'
	);

	$options = getopt(implode('', array_keys($cli_options)), array_values($cli_options));

	if (isset($options['h']) OR isset($options['help']))
	{
		$memory_limit = ini_get('memory_limit');
		echo <<<HELP
AI-Bolit - Script to search for shells and other malicious software.

Usage: php {$_SERVER['PHP_SELF']} [OPTIONS] [PATH]
Current default path is: {$defaults['path']}

  -j, --file=FILE      Specified path and filename to scan the only file
  -l, --list=FILE      Full path and filename to create plain text file with a list of found malware
  -p, --path=PATH      Directory path to scan, by default the file directory is used
                       Current path: {$defaults['path']}
  -m, --memory=SIZE    Maximum amount of memory a script may consume. Current value: $memory_limit
                       Can take shorthand byte values (1M, 1G...)
  -s, --size=SIZE      Scan files are smaller than SIZE. 0 - All files. Current value: {$defaults['max_size_to_scan']}
  -a, --all            Scan all files (by default scan. js,. php,. html,. htaccess)
  -d, --delay=INT      delay in milliseconds when scanning files to reduce load on the file system (Default: 1)
  -r, --report=PATH/EMAILS
                       Full path to create report or email address to send report to.
                       You can also specify multiple email separated by commas.
  -q, 		       Use only with -j. Quiet result check of file, 1=Infected 
      --help           Display this help and exit

* Mandatory arguments listed below are required for both full and short way of usage.

HELP;
		exit;
	}

	$l_FastCli = false;
	
	if (
		(isset($options['memory']) AND !empty($options['memory']) AND ($memory = $options['memory']))
		OR (isset($options['m']) AND !empty($options['m']) AND ($memory = $options['m']))
	)
	{
		$memory = getBytes($memory);
		if ($memory > 0)
		{
			$defaults['memory_limit'] = $memory;
		}
	}

	if (
		(isset($options['file']) AND !empty($options['file']) AND ($file = $options['file']) !== false)
		OR (isset($options['j']) AND !empty($options['j']) AND ($file = $options['j']) !== false)
	)
	{
		define('SCAN_FILE', $file);
	}


	if (
		(isset($options['list']) AND !empty($options['list']) AND ($file = $options['list']) !== false)
		OR (isset($options['l']) AND !empty($options['l']) AND ($file = $options['l']) !== false)
	)
	{

		define('PLAIN_FILE', $file);
	}
	if (
		(isset($options['size']) AND !empty($options['size']) AND ($size = $options['size']) !== false)
		OR (isset($options['s']) AND !empty($options['s']) AND ($size = $options['s']) !== false)
	)
	{
		$size = getBytes($size);
		$defaults['max_size_to_scan'] = $size > 0 ? $size : 0;
	}

 	if (
 		(isset($options['file']) AND !empty($options['file']) AND ($file = $options['file']) !== false)
 		OR (isset($options['j']) AND !empty($options['j']) AND ($file = $options['j']) !== false)
 		AND (isset($options['q'])) 
 	
 	)
 	{
 		$BOOL_RESULT = true;
 	}
 
	if (isset($options['f'])) 
	 {
	   $l_FastCli = true;
	 }
		
	if (
		(isset($options['delay']) AND !empty($options['delay']) AND ($delay = $options['delay']) !== false)
		OR (isset($options['d']) AND !empty($options['d']) AND ($delay = $options['d']) !== false)
	)
	{
		$delay = (int) $delay;
		if (!($delay < 0))
		{
			$defaults['scan_delay'] = $delay;
		}
	}

	if (isset($options['all']) OR isset($options['a']))
	{
		$defaults['scan_all_files'] = 1;
	}



	if (
		(isset($options['report']) AND ($report = $options['report']) !== false)
		OR (isset($options['r']) AND ($report = $options['r']) !== false)
	)
	{
		define('REPORT', $report);
	}

	defined('REPORT') OR define('REPORT', 'AI-BOLIT-REPORT-' . date('d-m-Y_H-i') . '-' . rand(1, 999999) . '.html');

	$last_arg = max(1, sizeof($_SERVER['argv']) - 1);
	if (isset($_SERVER['argv'][$last_arg]))
	{
		$path = $_SERVER['argv'][$last_arg];
		if (
			substr($path, 0, 1) != '-'
			AND (substr($_SERVER['argv'][$last_arg - 1], 0, 1) != '-' OR array_key_exists(substr($_SERVER['argv'][$last_arg - 1], -1), $cli_options)))
		{
			$defaults['path'] = $path;
		}
	}	
	
	if (
		(isset($options['path']) AND !empty($options['path']) AND ($path = $options['path']) !== false)
		OR (isset($options['p']) AND !empty($options['p']) AND ($path = $options['p']) !== false)
	)
	{
		$defaults['path'] = $path;
	}

}

if (!defined('PLAIN_FILE')) { define('PLAIN_FILE', ''); }

// Init
define('MAX_ALLOWED_PHP_HTML_IN_DIR', 100);
define('BASE64_LENGTH', 69);
define('MAX_PREVIEW_LEN', 80);
define('MAX_EXT_LINKS', 1001);

// Perform full scan when running from command line
if (isCli() || isset($_GET['full'])) {
  $defaults['scan_all_files'] = 0;
}

if ($l_FastCli) {
  $defaults['scan_all_files'] = 0; 
}

define('SCAN_ALL_FILES', (bool) $defaults['scan_all_files']);
define('SCAN_DELAY', (int) $defaults['scan_delay']);
define('MAX_SIZE_TO_SCAN', getBytes($defaults['max_size_to_scan']));

if ($defaults['memory_limit'] AND ($defaults['memory_limit'] = getBytes($defaults['memory_limit'])) > 0)
	ini_set('memory_limit', $defaults['memory_limit']);

define('START_TIME', microtime(true));

define('ROOT_PATH', realpath($defaults['path']));

if (!ROOT_PATH)
{
        if (isCli())  {
		die(stdOut("Directory '{$defaults['path']}' not found!"));
	}
}
elseif(!is_readable(ROOT_PATH))
{
        if (isCli())  {
		die(stdOut("Cannot read directory '" . ROOT_PATH . "'!"));
	}
}

define('CURRENT_DIR', getcwd());
chdir(ROOT_PATH);

// Проверяем отчет
if (isCli() AND REPORT !== '' AND !getEmails(REPORT))
{
	$report = str_replace('\\', '/', REPORT);
	$abs = strpos($report, '/') === 0 ? DIR_SEPARATOR : '';
	$report = array_values(array_filter(explode('/', $report)));
	$report_file = array_pop($report);
	$report_path = realpath($abs . implode(DIR_SEPARATOR, $report));

	define('REPORT_FILE', $report_file);
	define('REPORT_PATH', $report_path);

	if (REPORT_FILE AND REPORT_PATH AND is_file(REPORT_PATH . DIR_SEPARATOR . REPORT_FILE))
	{
		@unlink(REPORT_PATH . DIR_SEPARATOR . REPORT_FILE);
	}
}


if (function_exists('phpinfo')) {
   ob_start();
   phpinfo();
   $l_PhpInfo = ob_get_contents();
   ob_end_clean();

   $l_PhpInfo = str_replace('border: 1px', '', $l_PhpInfo);
   preg_match('|<body>(.*)</body>|smi', $l_PhpInfo, $l_PhpInfoBody);
}

$l_Result =<<<MAIN_PAGE

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
<style type="text/css" title="currentStyle">
	@import "http://www.revisium.com/extra/media/css/demo_page.css";
	@import "http://www.revisium.com/extra/media/css/jquery.dataTables.css";
</style>


<script type="text/javascript" language="javascript" src="http://yandex.st/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="https://datatables.net/download/build/jquery.dataTables.js"></script>

<style type="text/css">
 body {
   font-family: Georgia;
   color: #303030;
   background: #FFFFF0;
   font-size: 12px;
   margin: 20px;
   padding: 0;
 }

.hidd {
display: none;
}

 h3 {
   font-size: 27px;
   margin: 0 0;
 }

 .sec {
  font-size: 25px;
  margin-bottom: 10px;
 }


 .warn {
   color: #FF4C00;
   margin: 0 0 20px 0;
 }

 .warn .it {
   color: #FF4C00;
 }

 .warn2 {
   color: #42ADFF;
   margin: 0 0 20px 0;
 }

 .warn2 .it {
   color: #42ADFF;
 }

 .ok {
   color: #007F0E;
   margin: 0 0 20px 0;
 }

 .vir {
    color: #A00000;
    margin: 0 0 20px 0;
  }

 .vir .it {
    color: #A00000;
 }

 .disclaimer {
   font-size: 11px;
   font-family: Arial;
   color: #505050;
   margin: 10px 0 10px 0;
 }

 .thanx {
  border: 1px solid #F0F0F0;
   padding: 20px 20px 10px 20px;
  font-size: 12px;
  font-family: Arial;
  background: #FBFFBA;
 }

 .footer {
  margin: 40px 0 0 0;
 }

 .rep {
   margin: 10px 0 20px 0;
   font-size: 11px;
   font-family: Arial;
 }

 .php_ok
 {
  color: #007F0E; 
 }

 .php_bad
 {
  color: #A00000; 
 }

 .notice
 {
  border: 1px solid cornflowerblue;
  padding: 10px;
  font-size: 12px;
  font-family: Arial;
  background: #E8F8F8;
 }

 .offer {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 20px;
   top: 54px;
   background: #E06060;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 15px 20px 10px 20px;

 }

  .offer2 {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 100px;
   top: 100px;
   background: #30A030;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 20px 20px 10px 20px;

 }

 
 .offer A, .offer2 A {
   color: yellow;
 }

 .update {
   color: red;
   font-size: 12px;
   font-family: Arial;
   margin: 0 0 20px 0;
 }

.updateinfo {
   color: blue;
   font-size: 12px;
   font-family: Arial;
   margin: 0 0 20px 0;
 }


 .tbg0 {
 }

 .tbg1 {
   background: #F0F0F0;
 }

 .it {
    font-size: 12px;
    font-family: Arial;
 }

 .ctd {
    font-size: 12px;
    font-family: Arial;
    color: #909090;
 }

 .flist {
   margin: 10px 0 30px 0;
 }

 .tbgh {
   background: #E0E0E0;
 }

 TH {
   text-align: left;
   font-size: 12px;
   font-family: Arial;
   color: #909090;
 }

 .details {
  font-size: 9px;
  font-family: Arial;
  color: #303030;
 }

 .marker
 {
    color: #FF0000;
    font-size: 16px;
    font-weight: 700;
 }

</style>

<script language="javascript">
  function addToIgnore(par_Lnk, par_FN, par_CRC) {
	var o = document.getElementById('igid');
	var ta = document.forms.ignore.list;
	
	ta.value = ta.value + par_FN + String.fromCharCode(09) + par_CRC + String.fromCharCode(10);
	
	par_Lnk.innerHTML = 'Добавлено'; 
	o.style.display = 'block';
  }

function hsig(id) {
  var divs = document.getElementsByTagName("tr");
  for(var i = 0; i < divs.length; i++){
     
     if (divs[i].getAttribute('o') == id) {
        divs[i].innerHTML = '';
     }
  }

  return false;
}

</script>

</head>
<body>
<noindex>
MAIN_PAGE;

////////////////////////////////////////////////////////////////////////////

$l_Result .= sprintf(AI_STR_001, AI_VERSION, INFO_M); 

$l_CreationTime = filemtime(__FILE__);
if (time() - $l_CreationTime > 86400 * 7) {
  $l_Result .= AI_STR_002;
}

$l_Result .= '<div class="update" style="margin: 20px 0 20px 0; padding: 20px; width: 500px; border: 1px solid #400000"><b>' . AI_STR_003 . '</b></div>';

if (AI_EXPERT == 0) {
   $l_Result .= '<div class="updateinfo">' . AI_STR_057 . '</div>'; 
} else {
   $l_Result .= '<div style="font-size: 8px; color: #909090; margin: 10px 0 10px 0;">MODE=' . AI_EXPERT . '</div>'; 
}

define('QCR_INDEX_FILENAME', 'fn');
define('QCR_INDEX_TYPE', 'type');
define('QCR_INDEX_WRITABLE', 'wr');
define('QCR_SVALUE_FILE', '1');
define('QCR_SVALUE_FOLDER', '0');

/**
 * Extract emails from the string
 * @param string $email
 * @return array of strings with emails or false on error
 */
function getEmails($email)
{
	$email = preg_split('#[,\s;]#', $email, -1, PREG_SPLIT_NO_EMPTY);
	$r = array();
	for ($i = 0, $size = sizeof($email); $i < $size; $i++)
	{
	        if (function_exists('filter_var')) {
   		   if (filter_var($email[$i], FILTER_VALIDATE_EMAIL))
   		   {
   		   	$r[] = $email[$i];
    		   }
                } else {
                   // for PHP4
                   if (strpos($email[$i], '@') !== false) {
   		   	$r[] = $email[$i];
                   }
                }
	}
	return empty($r) ? false : $r;
}

/**
 * Get bytes from shorthand byte values (1M, 1G...)
 * @param int|string $val
 * @return int
 */
function getBytes($val)
{
	$val = trim($val);
	$last = strtolower($val{strlen($val) - 1});
	switch($last) {
		case 't':
			$val *= 1024;
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return intval($val);
}

/**
 * Format bytes to human readable
 * @param int $bites
 * @return string
 */
function bytes2Human($bites)
{
	if ($bites < 1024)
	{
		return $bites . ' b';
	}
	elseif (($kb = $bites / 1024) < 1024)
	{
		return number_format($kb, 2) . ' Kb';
	}
	elseif (($mb = $kb / 1024) < 1024)
	{
		return number_format($mb, 2) . ' Mb';
	}
	elseif (($gb = $mb / 1024) < 1024)
	{
		return number_format($gb, 2) . ' Gb';
	}
	else
	{
		return number_format($gb / 1024, 2) . 'Tb';
	}
}

///////////////////////////////////////////////////////////////////////////
function needIgnore($par_FN, $par_CRC) {
  global $g_IgnoreList;
  
  for ($i = 0; $i < count($g_IgnoreList); $i++) {
     if (strpos($par_FN, $g_IgnoreList[$i][0]) !== false) {
		if ($par_CRC == $g_IgnoreList[$i][1]) {
			return true;
		}
	 }
  }
  
  return false;
}

///////////////////////////////////////////////////////////////////////////
function printList($par_List, $par_Details = null, $par_NeedIgnore = false, $par_SigId = null, $par_TableName = null) {
  global $g_Structure;
  
  if ($par_TableName == null) {
     $par_TableName = 'table_' . rand(1000000,9000000);
  }

  $l_Result = '';
  $l_Result .= "<div class=\"flist\"><table cellspacing=1 cellpadding=4 border=0 id=\"" . $par_TableName . "\">";

  $l_Result .= "<thead><tr class=\"tbgh" . ( $i % 2 ). "\">";
  $l_Result .= "<th>" . AI_STR_004 . "</th>";
  $l_Result .= "<th>" . AI_STR_005 . "</th>";
  $l_Result .= "<th>" . AI_STR_006 . "</th>";
  $l_Result .= "<th width=90>" . AI_STR_007 . "</th>";
  $l_Result .= "<th width=90>CRC32</th>";
  $l_Result .= "<th width=0></th>";
  $l_Result .= "<th width=0></th>";
  $l_Result .= "<th width=0></th>";
  
  $l_Result .= "</tr></thead><tbody>";

  for ($i = 0; $i < count($par_List); $i++) {
    if ($par_SigId != null) {
       $l_SigId = 'id_' . $par_SigId[$i];
    } else {
       $l_SigId = 'id_z' . rand(1000000,9000000);
    }
    
    $l_Pos = $par_List[$i];
        if ($par_NeedIgnore) {
         	if (needIgnore($g_Structure['n'][$par_List[$i]], $g_Structure['crc'][$l_Pos])) {
         		continue;
         	}
        }
  
     $l_Creat = $g_Structure['c'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['c'][$l_Pos]) : '-';
     $l_Modif = $g_Structure['m'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['m'][$l_Pos]) : '-';
     $l_Size = $g_Structure['s'][$l_Pos] > 0 ? bytes2Human($g_Structure['s'][$l_Pos]) : '-';

     if ($par_Details != null) {
        $l_WithMarker = preg_replace('|@AI_MARKER@|smi', '<span class="marker">|</span>', $par_Details[$i]);
        $l_Body = '<div class="details">';

        if ($par_SigId != null) {
           $l_Body .= '<a href="#" onclick="return hsig(\'' . $l_SigId . '\')">[x]</a> ';
        }

        $l_Body .= $l_WithMarker . '</div>';
     } else {
        $l_Body = '';
     }

     $l_Result .= '<tr class="tbg' . ( $i % 2 ). '" o="' . $l_SigId .'">';
	 
	 if (is_file($g_Structure['n'][$l_Pos])) {
		$l_Result .= '<td><div class="it"><a  class="it" target="_blank" href="'. $defaults['site_url'] . 'ai-bolit.php?fn=' .
	              $g_Structure['n'][$l_Pos] . '&ph=' . realCRC(PASS) . '&c=' . $g_Structure['crc'][$l_Pos] . '">' . $g_Structure['n'][$l_Pos] . '</a></div>' . $l_Body . '</td>';
	 } else {
		$l_Result .= '<td><div class="it">' . $g_Structure['n'][$par_List[$i]] . '</div></td>';
	 }
	 
     $l_Result .= '<td><div class="ctd">' . $l_Creat . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Modif . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Size . '</div></td>';
     $l_Result .= '<td><div class="ctd"><a href="#" onclick="addToIgnore(this, \'' . $g_Structure['n'][$l_Pos] . '\',\'' . $g_Structure['crc'][$l_Pos] . '\');return false;">' . $g_Structure['crc'][$l_Pos] . '</a></div></td>';
     $l_Result .= '<td class="hidd"><div class="hidd">' . $g_Structure['c'][$l_Pos] . '</div></td>';
     $l_Result .= '<td class="hidd"><div class="hidd">' . $g_Structure['m'][$l_Pos] . '</div></td>';
     $l_Result .= '<td class="hidd"><div class="hidd">' . $l_SigId . '</div></td>';
     $l_Result .= '</tr>';

  }

  $l_Result .= "</tbody></table></div>";

  return $l_Result;
}

///////////////////////////////////////////////////////////////////////////
function printPlainList($par_List, $par_Details = null, $par_NeedIgnore = false, $par_SigId = null, $par_TableName = null) {
  global $g_Structure;
  
//  $l_Result = "\n#\n";

  $l_Src = array('&quot;', '&lt;', '&gt;', '&amp;');
  $l_Dst = array('"',      '<',    '>',    '&');

  for ($i = 0; $i < count($par_List); $i++) {
    $l_Pos = $par_List[$i];
        if ($par_NeedIgnore) {
         	if (needIgnore($g_Structure['n'][$par_List[$i]], $g_Structure['crc'][$l_Pos])) {
         		continue;
         	}                      
        }
  

     if ($par_Details != null) {
        $l_Body = preg_replace('|(L\d+).+@AI_MARKER@|smi', '$1: ...', $par_Details[$i]);
        $l_Body = preg_replace('/[^\x21-\x7F]/', '.', $l_Body);
        $l_Body = str_replace($l_Src, $l_Dst, $l_Body);

     } else {
        $l_Body = '';
     }

	 if (is_file($g_Structure['n'][$l_Pos])) {
		$l_Result .= $g_Structure['n'][$l_Pos] . "\t\t\t" . $l_Body . "\n";
	 } else {
		$l_Result .= $g_Structure['n'][$par_List[$i]] . "\n";
	 }
	 
  }

  return $l_Result;
}

///////////////////////////////////////////////////////////////////////////
function extractValue(&$par_Str, $par_Name) {
  if (preg_match('|<tr><td class="e">\s*'.$par_Name.'\s*</td><td class="v">(.+?)</td>|sm', $par_Str, $l_Result)) {
     return str_replace('no value', '', strip_tags($l_Result[1]));
  }
}

///////////////////////////////////////////////////////////////////////////
function QCR_ExtractInfo($par_Str) {
   $l_PhpInfoSystem = extractValue($par_Str, 'System');
   $l_PhpPHPAPI = extractValue($par_Str, 'Server API');
   $l_AllowUrlFOpen = extractValue($par_Str, 'allow_url_fopen');
   $l_AllowUrlInclude = extractValue($par_Str, 'allow_url_include');
   $l_DisabledFunction = extractValue($par_Str, 'disable_functions');
   $l_DisplayErrors = extractValue($par_Str, 'display_errors');
   $l_ErrorReporting = extractValue($par_Str, 'error_reporting');
   $l_ExposePHP = extractValue($par_Str, 'expose_php');
   $l_LogErrors = extractValue($par_Str, 'log_errors');
   $l_MQGPC = extractValue($par_Str, 'magic_quotes_gpc');
   $l_MQRT = extractValue($par_Str, 'magic_quotes_runtime');
   $l_OpenBaseDir = extractValue($par_Str, 'open_basedir');
   $l_RegisterGlobals = extractValue($par_Str, 'register_globals');
   $l_SafeMode = extractValue($par_Str, 'safe_mode');


   $l_DisabledFunction = ($l_DisabledFunction == '' ? '-?-' : $l_DisabledFunction);
   $l_OpenBaseDir = ($l_OpenBaseDir == '' ? '-?-' : $l_OpenBaseDir);

   $l_Result = '<div class="sec">' . AI_STR_008 . ': ' . phpversion() . '</div>';
   $l_Result .= 'System Version: <span class="php_ok">' . $l_PhpInfoSystem . '</span><br/>';
   $l_Result .= 'PHP API: <span class="php_ok">' . $l_PhpPHPAPI. '</span><br/>';
   $l_Result .= 'allow_url_fopen: <span class="php_' . ($l_AllowUrlFOpen == 'On' ? 'bad' : 'ok') . '">' . $l_AllowUrlFOpen. '</span><br/>';
   $l_Result .= 'allow_url_include: <span class="php_' . ($l_AllowUrlInclude == 'On' ? 'bad' : 'ok') . '">' . $l_AllowUrlInclude. '</span><br/>';
   $l_Result .= 'disable_functions: <span class="php_' . ($l_DisabledFunction == '-?-' ? 'bad' : 'ok') . '">' . $l_DisabledFunction. '</span><br/>';
   $l_Result .= 'display_errors: <span class="php_' . ($l_DisplayErrors == 'On' ? 'ok' : 'bad') . '">' . $l_DisplayErrors. '</span><br/>';
   $l_Result .= 'error_reporting: <span class="php_ok">' . $l_ErrorReporting. '</span><br/>';
   $l_Result .= 'expose_php: <span class="php_' . ($l_ExposePHP == 'On' ? 'bad' : 'ok') . '">' . $l_ExposePHP. '</span><br/>';
   $l_Result .= 'log_errors: <span class="php_' . ($l_LogErrors == 'On' ? 'ok' : 'bad') . '">' . $l_LogErrors . '</span><br/>';
   $l_Result .= 'magic_quotes_gpc: <span class="php_' . ($l_MQGPC == 'On' ? 'ok' : 'bad') . '">' . $l_MQGPC. '</span><br/>';
   $l_Result .= 'magic_quotes_runtime: <span class="php_' . ($l_MQRT == 'On' ? 'bad' : 'ok') . '">' . $l_MQRT. '</span><br/>';
   $l_Result .= 'register_globals: <span class="php_' . ($l_RegisterGlobals == 'On' ? 'bad' : 'ok') . '">' . $l_RegisterGlobals . '</span><br/>';
   $l_Result .= 'open_basedir: <span class="php_' . ($l_OpenBaseDir == '-?-' ? 'bad' : 'ok') . '">' . $l_OpenBaseDir . '</span><br/>';
   
   if (phpversion() < '5.3.0') {
      $l_Result .= 'safe_mode (PHP < 5.3.0): <span class="php_' . ($l_SafeMode == 'On' ? 'ok' : 'bad') . '">' . $l_SafeMode. '</span><br/>';
   }

   return $l_Result . '<p>';
}

///////////////////////////////////////////////////////////////////////////
function QCR_Debug($par_Str) {
  if (!DEBUG_MODE) {
     return;
  }

  $l_MemInfo = ' ';  
  if (function_exists('memory_get_usage')) {
     $l_MemInfo .= ' curmem=' .  bytes2Human(memory_get_usage());
  }

  if (function_exists('memory_get_peak_usage')) {
     $l_MemInfo .= ' maxmem=' .  bytes2Human(memory_get_peak_usage());
  }

  stdOut("\n" . date('H:i:s') . ': ' . $par_Str . $l_MemInfo . "\n");
}


///////////////////////////////////////////////////////////////////////////
function QCR_ScanDirectories($l_RootDir)
{
	global $g_Structure, $g_Counter, $g_Doorway, $g_FoundTotalFiles, $g_FoundTotalDirs, 
			$defaults, $g_SkippedFolders, $g_UrlIgnoreList, $g_DirIgnoreList, $g_UnsafeFilesArray, $g_UnsafeDirArray, 
                        $g_UnsafeFilesFound, $g_SymLinks;

	$l_DirCounter = 0;
	$l_DoorwayFilesCounter = 0;
	$l_SourceDirIndex = $g_Counter - 1;

	QCR_Debug('Scan ' . $l_RootDir);

        $l_QuotedSeparator = quotemeta(DIR_SEPARATOR); 
        $l_NeedCheckCandi = ($defaults['report_mask'] & REPORT_MASK_CANDI) == REPORT_MASK_CANDI;

	if ($l_DIRH = @opendir($l_RootDir))
	{
		while (($l_FileName = readdir($l_DIRH)) !== false)
		{
			if ($l_FileName == '.' || $l_FileName == '..') continue;

                        if (is_link($l_FileName)) 
                        {
                            $g_SymLinks[] = $l_FileName;
                            continue;
                        }

			$l_FileName = $l_RootDir . DIR_SEPARATOR . $l_FileName;

			$l_Ext = substr($l_FileName, strrpos($l_FileName, '.') + 1);

			$l_IsDir = is_dir($l_FileName);

			// which files should be scanned
			$l_NeedToScan = SCAN_ALL_FILES || (in_array($l_Ext, array(
				'js', 'php', 'php3','php4', 'php5', 'htaccess'
			)));


			if ($l_IsDir)
			{
				// if folder in ignore list
				$l_Skip = false;
				for ($dr = 0; $dr < count($g_DirIgnoreList); $dr++) {
					if (($g_DirIgnoreList[$dr] != '') &&
						preg_match('#' . $g_DirIgnoreList[$dr] . '#', $l_FileName, $l_Found)) {
						$l_Skip = true;
					}
				}
			
				// skip on ignore
				if ($l_Skip) {
					$g_SkippedFolders[] = $l_FileName;
					continue;
				}
				
				$g_Structure['d'][$g_Counter] = $l_IsDir;
				$g_Structure['n'][$g_Counter] = $l_FileName;

				$l_DirCounter++;


                                if ($l_NeedCheckCandi) {
         				for ($j = 0; $j < count($g_UnsafeDirArray); $j++) {
         				    if (preg_match('|' . $l_QuotedSeparator . $g_UnsafeDirArray[$j] . '$|i', $l_FileName, $l_Found)) {
                                                $g_UnsafeFilesFound[] = $g_Counter;
                                                break;
                                             }
         				}
     				}

				if ($l_DirCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
				{
					$g_Doorway[] = $l_SourceDirIndex;
					$l_DirCounter = -655360;
				}

				$g_Counter++;
				$g_FoundTotalDirs++;

				QCR_ScanDirectories($l_FileName);

			} else
			{
				if ($l_NeedToScan)
				{
					$g_FoundTotalFiles++;
					if (in_array($l_Ext, array(
						'php', 'php3',
						'php4', 'php5'
					))
					)
					{
						$l_DoorwayFilesCounter++;
						
						if ($l_DoorwayFilesCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
						{
							$g_Doorway[] = $l_SourceDirIndex;
							$l_DoorwayFilesCounter = -655360;
						}
					}


					$l_Stat = stat($l_FileName);

					$g_Structure['d'][$g_Counter] = $l_IsDir;
					$g_Structure['n'][$g_Counter] = $l_FileName;
					$g_Structure['s'][$g_Counter] = $l_Stat['size'];
					$g_Structure['c'][$g_Counter] = $l_Stat['ctime'];
					$g_Structure['m'][$g_Counter] = $l_Stat['mtime'];

                                        if ($l_NeedCheckCandi) {
          					for ($j = 0; $j < count($g_UnsafeFilesArray); $j++) {
         					    if (preg_match('|' . $l_QuotedSeparator . $g_UnsafeFilesArray[$j] . '|i', $l_FileName, $l_Found)) {
                                                        $g_UnsafeFilesFound[] = $g_Counter;
                                                        break;
                                                     }
         					}
         				}

					$g_Counter++;
				}
			}
		}

		closedir($l_DIRH);
	}

	return $g_Structure;
}


///////////////////////////////////////////////////////////////////////////
function QCR_ScanFile($l_TheFile)
{
	global $g_Structure, $g_Counter, $g_Doorway, $g_FoundTotalFiles, $g_FoundTotalDirs, 
			$defaults, $g_SkippedFolders, $g_UrlIgnoreList, $g_DirIgnoreList, $g_UnsafeFilesArray, $g_UnsafeDirArray, 
                        $g_UnsafeFilesFound, $g_SymLinks;

	QCR_Debug('Scan file ' . $l_TheFile);

      	$l_Stat = stat($l_TheFile);

      	$g_Structure['d'][$g_Counter] = false;
      	$g_Structure['n'][$g_Counter] = $l_TheFile;
      	$g_Structure['s'][$g_Counter] = $l_Stat['size'];
      	$g_Structure['c'][$g_Counter] = $l_Stat['ctime'];
      	$g_Structure['m'][$g_Counter] = $l_Stat['mtime'];

      	$g_Counter++;

	return $g_Structure;
}



///////////////////////////////////////////////////////////////////////////
function getFragment($par_Content, $par_Pos) {
  $l_MaxChars = MAX_PREVIEW_LEN;
  $l_MaxLen = strlen($par_Content);
  $l_RightPos = min($par_Pos + $l_MaxChars, $l_MaxLen); 
  $l_MinPos = max(0, $par_Pos - $l_MaxChars);

  $l_FoundStart = substr($par_Content, 0, $par_Pos);
  $l_FoundStart = str_replace("\r", '', $l_FoundStart);
  $l_LineNo = strlen($l_FoundStart) - strlen(str_replace("\n", '', $l_FoundStart)) + 1;

  $l_Res = 'L' . $l_LineNo . "  " . ($l_MinPos > 0 ? '...' : '') . substr($par_Content, $l_MinPos, $par_Pos - $l_MinPos) . 
           '@AI_MARKER@' . 
           substr($par_Content, $par_Pos, $l_RightPos - $par_Pos - 1);

  return htmlspecialchars($l_Res);
}

///////////////////////////////////////////////////////////////////////////
function _utf8_decode($string)
{
  $tmp = $string;
  $count = 0;

  while (detect_utf_encoding($tmp) !== false )
  {
    $tmp = utf8_decode($tmp);
    $count++;
  }
  
  for ($i = 0; $i < $count-1 ; $i++)
  {
    $string = utf8_decode($string);
    
  }

  return $string;
 
}

///////////////////////////////////////////////////////////////////////////
function escapedHexToHex($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(hexdec($escaped[1])); }
function escapedOctDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(octdec($escaped[1])); }
function escapedDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr($escaped[1]); }

///////////////////////////////////////////////////////////////////////////
if (!defined('T_ML_COMMENT')) {
   define('T_ML_COMMENT', T_COMMENT);
} else {
   define('T_DOC_COMMENT', T_ML_COMMENT);
}

function UnwrapObfu($par_Content) {
  $GLOBALS['g_EncObfu'] = 0;

  $par_Content = preg_replace_callback('/\\\\x([a-fA-F0-9]{1,2})/i','escapedHexToHex', $par_Content);
  $par_Content = preg_replace_callback('/\\\\([0-9]{1,3})/i','escapedOctDec', $par_Content);
//  $par_Content = preg_replace_callback('/\\\\([0-9]{2})/i','escapedDec', $par_Content);

  $par_Content = preg_replace('/[\'"]\s*?\.+\s*?[\'"]/smi', '', $par_Content);

  return $par_Content;
}


///////////////////////////////////////////////////////////////////////////
// Unicode BOM is U+FEFF, but after encoded, it will look like this.
define ('UTF32_BIG_ENDIAN_BOM'   , chr(0x00) . chr(0x00) . chr(0xFE) . chr(0xFF));
define ('UTF32_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE) . chr(0x00) . chr(0x00));
define ('UTF16_BIG_ENDIAN_BOM'   , chr(0xFE) . chr(0xFF));
define ('UTF16_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE));
define ('UTF8_BOM'               , chr(0xEF) . chr(0xBB) . chr(0xBF));

function detect_utf_encoding($text) {
    $first2 = substr($text, 0, 2);
    $first3 = substr($text, 0, 3);
    $first4 = substr($text, 0, 3);
    
    if ($first3 == UTF8_BOM) return 'UTF-8';
    elseif ($first4 == UTF32_BIG_ENDIAN_BOM) return 'UTF-32BE';
    elseif ($first4 == UTF32_LITTLE_ENDIAN_BOM) return 'UTF-32LE';
    elseif ($first2 == UTF16_BIG_ENDIAN_BOM) return 'UTF-16BE';
    elseif ($first2 == UTF16_LITTLE_ENDIAN_BOM) return 'UTF-16LE';

    return false;
}

///////////////////////////////////////////////////////////////////////////
function QCR_SearchPHP($src)
{
  if (preg_match("/(<\?php[\w\s]{5,})/smi", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
	  return $l_Found[0][1];
  }

  if (preg_match("/(<script[^>]*language\s*=\s*)('|\"|)php('|\"|)([^>]*>)/i", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
    return $l_Found[0][1];
  }

  return false;
}


///////////////////////////////////////////////////////////////////////////
function knowUrl($par_URL) {
  global $g_UrlIgnoreList;

  for ($jk = 0; $jk < count($g_UrlIgnoreList); $jk++) {
     if  ((stripos($par_URL, $g_UrlIgnoreList[$jk]) !== false)) {
     	return true;
     }
  }

  return false;
}


///////////////////////////////////////////////////////////////////////////
function QCR_GoScan($par_Offset)
{
	global $g_IframerFragment, $g_Iframer, $g_SuspDir, $g_Redirect, $g_Doorway, $g_EmptyLink, $g_Structure, $g_Counter, 
		   $g_HeuristicType, $g_HeuristicDetected, $g_TotalFolder, $g_TotalFiles, $g_WarningPHP, $g_AdwareList,
		   $g_CriticalPHP, $g_Phishing, $g_CriticalJS, $g_UrlIgnoreList, $g_CriticalJSFragment, $g_PHPCodeInside, $g_PHPCodeInsideFragment, 
		   $g_NotRead, $g_WarningPHPFragment, $g_WarningPHPSig, $g_BigFiles, $g_RedirectPHPFragment, $g_EmptyLinkSrc, $g_CriticalPHPSig, $g_CriticalPHPFragment, 
           $g_Base64Fragment, $g_UnixExec, $g_PhishingSigFragment, $g_PhishingFragment, $g_PhishingSig, $g_CriticalJSSig, $g_IframerFragment, $g_CMS, $defaults, $g_AdwareListFragment, $g_KnownList;

	static $_files_and_ignored = 0;

        QCR_Debug('QCR_GoScan ' . $par_Offset);


	for ($i = $par_Offset; $i < $g_Counter; $i++)
	{
		$l_Filename = $g_Structure['n'][$i];

 	        QCR_Debug('Check ' . $l_Filename);

		if ($g_Structure['d'][$i])
		{
			// FOLDER
			$g_TotalFolder++;

		}
		else
		{

			// FILE
			if ((MAX_SIZE_TO_SCAN > 0 AND $g_Structure['s'][$i] > MAX_SIZE_TO_SCAN) || ($g_Structure['s'][$i] < 0))
			{
				$g_BigFiles[] = $i;
			}
			else
			{
				$g_TotalFiles++;

                $l_Content = @implode('', file($l_Filename));
                if (($l_Content == '') && ($g_Structure['s'][$i] > 0)) {
                   $g_NotRead[] = $i;
                }

				$g_Structure['crc'][$i] = realCRC($l_Content);

                                $l_KnownCRC = $g_Structure['crc'][$i] + realCRC(basename($l_Filename));
                                if (in_array($l_KnownCRC, $g_KnownList)) {
	        		   printProgress(++$_files_and_ignored, $l_Filename);
                                   continue;
                                }

				$l_Unwrapped = UnwrapObfu($l_Content);
				if (detect_utf_encoding($l_Content) !== false) {
       				   if (function_exists('mb_convert_encoding')) {
                                      $l_Unwrapped = mb_convert_encoding($l_Unwrapped, "CP1251");
                                   } else {
                                      $g_NotRead[] = $i;
				   }
                                }

                          

				// ignore itself
				if (strpos($l_Content, 'OI875476869868769876JW') !== false) {
					continue;
				}

				// warnings
				$l_Pos = '';
				if (WarningPHP($l_Filename, $l_Unwrapped, $l_Pos, $l_SigId))
				{       $l_Prio = 1;
				        if (strpos($l_Filename, '.php') !== false) {
				       	   $l_Prio = 0;
					}

					$g_WarningPHP[$l_Prio][] = $i;
					$g_WarningPHPFragment[$l_Prio][] = getFragment($l_Content, $l_Pos);
					$g_WarningPHPSig[] = $l_SigId;
				}

				// adware
				if (Adware($l_Filename, $l_Unwrapped, $l_Pos))
				{
					$g_AdwareList[] = $i;
					$g_AdwareListFragment[] = getFragment($l_Unwrapped, $l_Pos);
				}

				// critical
				$g_SkipNextCheck = false;
				if (CriticalPHP($l_Filename, $i, $l_Unwrapped, $l_Pos, $l_SigId))
				{
					$g_CriticalPHP[] = $i;
					$g_CriticalPHPFragment[] = getFragment($l_Unwrapped, $l_Pos);
					$g_CriticalPHPSig[] = $l_SigId;
					$g_SkipNextCheck = true;
				} else {
         				if (CriticalPHP($l_Filename, $i, $l_Content, $l_Pos, $l_SigId))
         				{
         					$g_CriticalPHP[] = $i;
         					$g_CriticalPHPFragment[] = getFragment($l_Content, $l_Pos);
						$g_CriticalPHPSig[] = $l_SigId;
         					$g_SkipNextCheck = true;
         				}
				}

				
				// critical without comments
				$l_NoComments = preg_replace('|/\*.*?\*/|smiu', '', $l_Unwrapped);
				if ($l_NoComments == $l_Unwrapped) {
                                   $g_SkipNextCheck = true;
                                }
				     
				if ((!$g_SkipNextCheck) && CriticalPHP($l_Filename, $i, $l_NoComments, $l_Pos, $l_SigId))
				{
					$g_CriticalPHP[] = $i;
					$g_CriticalPHPFragment[] = getFragment($l_Unwrapped, $l_Pos);
					$g_CriticalPHPSig[] = $l_SigId;
				}			

				$l_TypeDe = 0;
			    if (HeuristicChecker($l_Content, $l_TypeDe, $l_Filename)) {
					$g_HeuristicDetected[] = $i;
					$g_HeuristicType[] = $l_TypeDe;
				}

				// critical JS
				$l_Pos = CriticalJS($l_Filename, $i, $l_Unwrapped, $l_SigId);
				if ($l_Pos !== false)
				{
					$g_CriticalJS[] = $i;
					$g_CriticalJSFragment[] = getFragment($l_Unwrapped, $l_Pos);
					$g_CriticalJSSig[] = $l_SigId;
				}

				// phishing
				$l_Pos = Phishing($l_Filename, $i, $l_Unwrapped, $l_SigId);
				if ($l_Pos !== false)
				{
					$g_Phishing[] = $i;
					$g_PhishingFragment[] = getFragment($l_Unwrapped, $l_Pos);
					$g_PhishingSigFragment[] = $l_SigId;
				}

				if
				(stripos($l_Filename, 'index.php') ||
					stripos($l_Filename, 'index.htm') ||
					SCAN_ALL_FILES
				)
				{
					// check iframes
					if (preg_match_all('|<iframe[^>]+src.+?>|smi', $l_Unwrapped, $l_Found, PREG_SET_ORDER)) 
					{
						for ($kk = 0; $kk < count($l_Found); $kk++) {
						        $l_Pos = stripos($l_Found[$kk][0], 'http://');
							if  (($l_Pos !== false) && (!knowUrl($l_Found[$kk][0]))) {
         							$g_Iframer[] = $i;
         							$g_IframerFragment[] = getFragment($l_Found[$kk][0], $l_Pos);
							}
						}
					}

					// check empty links
					if (preg_match_all('|<a[^>]+href([^>]+?)>(.*?)</a>|smi', $l_Unwrapped, $l_Found, PREG_SET_ORDER))
					{
						for ($kk = 0; $kk < count($l_Found); $kk++) {
							if  ((stripos($l_Found[$kk][1], 'http://') !== false) &&
                                                            (trim(strip_tags($l_Found[$kk][2])) == '')) {

								$l_NeedToAdd = true;

							    if  ((stripos($l_Found[$kk][1], $default['site_url']) !== false)
                                                                 || knowUrl($l_Found[$kk][1])) {
										$l_NeedToAdd = false;
								}
								
								if ($l_NeedToAdd && (count($g_EmptyLink) < MAX_EXT_LINKS)) {
									$g_EmptyLink[] = $i;
									$g_EmptyLinkSrc[$i][] = substr($l_Found[$kk][0], 0, MAX_PREVIEW_LEN);
								}
							}
						}
					}
				}

				// check for PHP code inside any type of file
				if ((stripos($l_Filename, '.php') === false) && 
				    (stripos($l_Filename, '.phtml') === false))
				{
					$l_Pos = QCR_SearchPHP($l_Content);
					if ($l_Pos !== false)
					{
						$g_PHPCodeInside[] = $i;
						$g_PHPCodeInsideFragment[] = getFragment($l_Unwrapped, $l_Pos);
					}
				}

				// articles
				if (stripos($l_Filename, 'article_index'))
				{
					$g_AdwareSig[] = $i;
				}

				// unix executables
				if (strpos($l_Content, chr(127) . 'ELF') !== false) 
				{
                    $g_UnixExec[] = $i;
                }
				
				// htaccess
				if (stripos($l_Filename, '.htaccess'))
				{
				
				if (stripos($l_Content, 'index.php?name=$1') !== false ||
						stripos($l_Content, 'index.php?m=1') !== false
					)
					{
						$g_SuspDir[] = $i;
					}

					$l_Pos = stripos($l_Content, '^(%2d|-)[^=]+$');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					$l_Pos = stripos($l_Content, '%{HTTP_USER_AGENT}');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}


					if (
						preg_match_all('|(RewriteCond\s+%\{HTTP_HOST\}/%1 \!\^\[w\.\]\*\(\[\^/\]\+\)/\\\1\$\s+\[NC\])|smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)
					   )
					{
						$g_Redirect[] = $i;
                        			$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Found[0][1]);
					}
//

					$l_HTAContent = preg_replace('|^\s*#.+$|m', '', $l_Content);

					if (
						preg_match_all("|RewriteRule\s+.+?\s+http://(.+?)/.+\s+\[.*R=\d+.*\]|smi", $l_HTAContent, $l_Found, PREG_SET_ORDER)
					)
					{
						$l_Host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
						for ($j = 0; $j < sizeof($l_Found); $j++)
						{
							$l_Found[$j][1] = str_replace('www.', '', $l_Found[$j][1]);
							if ($l_Found[$j][1] != $l_Host)
							{
								$g_Redirect[] = $i;
								break;
							}
						}
					}

					unset($l_HTAContent);
					
					$l_Pos = stripos($l_Content, 'auto_prepend_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}
					$l_Pos = stripos($l_Content, 'auto_append_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					if (preg_match("|RewriteRule\s+\^\(\.\*\)\$\s+-\s+\[\s*F\s*,\s*L\s*\]|smi", $l_Content, $l_Found)) {
						$g_Redirect[] = $i;
					}
				}
			}
			
			unset($l_Unwrapped);
			unset($l_Content);
			
			printProgress(++$_files_and_ignored, $l_Filename);
		} // end of if (file)

		usleep(SCAN_DELAY * 1000);

	} // end of for

}

///////////////////////////////////////////////////////////////////////////
function WarningPHP($l_FN, $l_Content, &$l_Pos, &$l_SigId)
{
  global $g_SusDB;

  $l_Res = false;

  foreach ($g_SusDB as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           $l_SigId = myCheckSum($l_Item);
           return true;
       }
    }
  }

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function Adware($l_FN, $l_Content, &$l_Pos)
{
  global $g_AdwareSig;

  $l_Res = false;

  foreach ($g_AdwareSig as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           return true;
       }
    }
  }

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function CheckException(&$l_Content, &$l_Found) {
  global $g_ExceptFlex, $gX_FlexDBShe, $gXX_FlexDBShe, $g_FlexDBShe, $gX_DBShe, $g_DBShe, $g_Base64, $g_Base64Fragment;
   $l_FoundStrPlus = substr($l_Content, max($l_Found[0][1] - 10, 0), 70);

   foreach ($g_ExceptFlex as $l_ExceptItem) {
      if (preg_match('#(' . $l_ExceptItem . ')#smi', $l_FoundStrPlus, $l_Detected)) {
         $l_Exception = true;
         return true;
      }
   }

   return false;
}

///////////////////////////////////////////////////////////////////////////
function Phishing($l_FN, $l_Index, $l_Content, &$l_SigId)
{
  global $g_PhishingSig;

  $l_Res = false;

  foreach ($g_PhishingSig as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           $l_SigId = myCheckSum($l_Item);

           if (DEBUG_MODE) {
              echo "Phis: $l_FN matched [$l_Item] in $l_Pos\n";
           }

           return $l_Pos;
       }
    }
  }

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function CriticalJS($l_FN, $l_Index, $l_Content, &$l_SigId)
{
  global $g_JSVirSig, $gX_JSVirSig;

  $l_Res = false;

  foreach ($g_JSVirSig as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           $l_SigId = myCheckSum($l_Item);

           if (DEBUG_MODE) {
              echo "JS: $l_FN matched [$l_Item] in $l_Pos\n";
           }

           return $l_Pos;
       }
    }
  }

if (AI_EXPERT > 1) {
  foreach ($gX_JSVirSig as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           $l_SigId = myCheckSum($l_Item);

           if (DEBUG_MODE) {
              echo "JS PARA: $l_FN matched [$l_Item] in $l_Pos\n";
           }

           return $l_Pos;
       }
    }
  }
}

  return $l_Res;
}


///////////////////////////////////////////////////////////////////////////
  function get_descr_heur($type) {
     $msg = '';
     switch ($type) {
	    case 1: $msg = AI_STR_053;
		        break;
	    case 2: $msg = AI_STR_054;
		        break;
	    case 3: $msg = AI_STR_055;
		        break;
	    case 4: $msg = AI_STR_056;
		        break;
	 }
	 
	 return $msg;
  }

  function HeuristicChecker($content, &$type, $filename) {
     $res = false;

     return false;
  }

///////////////////////////////////////////////////////////////////////////
function CriticalPHP($l_FN, $l_Index, $l_Content, &$l_Pos, &$l_SigId)
{
  global $g_ExceptFlex, $gXX_FlexDBShe, $gX_FlexDBShe, $g_FlexDBShe, $gX_DBShe, $g_DBShe, $g_Base64, $g_Base64Fragment;

  // OI875476869868769876JW

  foreach ($g_FlexDBShe as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           $l_SigId = myCheckSum($l_Item);

           if (DEBUG_MODE) {
              echo "CRIT 1: $l_FN matched [$l_Item] in $l_Pos\n";
           }

           return true;
       }
    }
  }

if (AI_EXPERT > 1) {
  foreach ($gXX_FlexDBShe as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           $l_SigId = myCheckSum($l_Item);

           if (DEBUG_MODE) {
              echo "CRIT 2: $l_FN matched [$l_Item] in $l_Pos\n";
           }

           return true;
       }
    }
  }
}

if (AI_EXPERT > 0) {
  foreach ($gX_FlexDBShe as $l_Item) {
    if (preg_match('#(' . $l_Item . ')#smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE)) {
       if (!CheckException($l_Content, $l_Found)) {
           $l_Pos = $l_Found[0][1];
           $l_SigId = myCheckSum($l_Item);

           if (DEBUG_MODE) {
              echo "CRIT 3: $l_FN matched [$l_Item] in $l_Pos\n";
           }

           return true;
       }
    }
  }
}

  foreach ($g_DBShe as $l_Item) {
    $l_Pos = stripos($l_Content, $l_Item);
    if ($l_Pos !== false) {
       $l_SigId = myCheckSum($l_Item);

       if (DEBUG_MODE) {
          echo "CRIT 4: $l_FN matched [$l_Item] in $l_Pos\n";
       }

       return true;
    }
  }

if (AI_EXPERT) {
  foreach ($gX_DBShe as $l_Item) {
    $l_Pos = stripos($l_Content, $l_Item);
    if ($l_Pos !== false) {
       $l_SigId = myCheckSum($l_Item);

       if (DEBUG_MODE) {
          echo "CRIT 5: $l_FN matched [$l_Item] in $l_Pos\n";
       }

       return true;
    }
  }

  if ((strpos($l_FN, '.ph') !== false) && (AI_EXPERT > 1)) {
     // for php only
     $g_Specials = array(');#');

     foreach ($g_Specials as $l_Item) {
       $l_Pos = stripos($l_Content, $l_Item);
       if ($l_Pos !== false) {
          $l_SigId = myCheckSum($l_Item);
          return true;
       }
     }
  }

}

  if ((strpos($l_Content, 'GIF89') === 0) && (strpos($l_FN, '.php') !== false )) {
     $l_Pos = 0;

     if (DEBUG_MODE) {
          echo "CRIT 6: $l_FN matched [$l_Item] in $l_Pos\n";
     }

     return true;
  }

  // detect uploaders / droppers
if (AI_EXPERT > 1) {
  $l_Found = null;
  if (
     (filesize($l_FN) < 1024) &&
     (strpos($l_FN, '.ph') !== false) &&
     (
       (($l_Pos = strpos($l_Content, 'multipart/form-data')) > 0) || 
       (($l_Pos = strpos($l_Content, '$_FILE[') > 0)) ||
       (($l_Pos = strpos($l_Content, 'move_uploaded_file')) > 0) ||
       (preg_match('|\bcopy\s*\(|smi', $l_Content, $l_Found, PREG_OFFSET_CAPTURE))
     )
     ) {
       if ($l_Found != null) {
          $l_Pos = $l_Found[0][1];
       } 
     if (DEBUG_MODE) {
          echo "CRIT 7: $l_FN matched [$l_Item] in $l_Pos\n";
     }

     return true;
  }
}

  if (strpos($l_FN, '.php.') !== false ) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = '".php."';
     $l_Pos = 0;

     if (DEBUG_MODE) {
          echo "CRIT 7: $l_FN matched [$l_Item] in $l_Pos\n";
     }

     return false;
  }

  // count number of base64_decode entries
  $l_Count = substr_count($l_Content, 'base64_decode');
  if ($l_Count > 10) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Content, stripos($l_Content, 'base64_decode'));

     if (DEBUG_MODE) {
        echo "CRIT 10: $l_FN matched\n";
     }
  }

  return false;
}

///////////////////////////////////////////////////////////////////////////
if (!isCli()) {
   header('Content-type: text/html; charset=utf-8');
}

if (!isCli()) {

  $l_PassOK = false;
  if (strlen(PASS) > 8) {
     $l_PassOK = true;   
  } 

  if ($l_PassOK && preg_match('|[0-9]|', PASS, $l_Found) && preg_match('|[A-Z]|', PASS, $l_Found) && preg_match('|[a-z]|', PASS, $l_Found) ) {
     $l_PassOK = true;   
  }
  
  if (!$l_PassOK) {  
    echo sprintf(AI_STR_009, generatePassword());
    exit;
  }

  if (isset($_GET['fn']) && ($_GET['ph'] == crc32(PASS))) {
     printFile();
     exit;
  }

  if ($_GET['p'] != PASS) {
    echo sprintf(AI_STR_010, generatePassword());
    exit;
  }
}

if (!is_readable(ROOT_PATH)) {
  echo AI_STR_011;
  exit;
}

if (isCli()) {
	if (defined('REPORT_PATH') AND REPORT_PATH)
	{
		if (!is_writable(REPORT_PATH))
		{
			die("\nCannot write report. Report dir " . REPORT_PATH . " is not writable.");
		}

		else if (!REPORT_FILE)
		{
			die("\nCannot write report. Report filename is empty.");
		}

		else if (($file = REPORT_PATH . DIR_SEPARATOR . REPORT_FILE) AND is_file($file) AND !is_writable($file))
		{
			die("\nCannot write report. Report file '$file' exists but is not writable.");
		}
	}
}


$g_IgnoreList = array();
$g_DirIgnoreList = array();
$g_UrlIgnoreList = array();
$g_KnownList = array();

$g_AiBolitAbsolutePath = dirname(__FILE__);

$l_IgnoreFilename = $g_AiBolitAbsolutePath . '/.aignore';
$l_DirIgnoreFilename = $g_AiBolitAbsolutePath . '/.adirignore';
$l_UrlIgnoreFilename = $g_AiBolitAbsolutePath . '/.aurlignore';
$l_KnownFilename = '.aknown';

if (file_exists($l_IgnoreFilename)) {
    $l_IgnoreListRaw = file($l_IgnoreFilename);
    for ($i = 0; $i < count($l_IgnoreListRaw); $i++) 
    {
    	$g_IgnoreList[] = explode("\t", trim($l_IgnoreListRaw[$i]));
    }
    unset($l_IgnoreListRaw);
}

if (file_exists($l_DirIgnoreFilename)) {
    $g_DirIgnoreList = file($l_DirIgnoreFilename);
	
	for ($i = 0; $i < count($g_DirIgnoreList); $i++) {
		$g_DirIgnoreList[$i] = trim($g_DirIgnoreList[$i]);
	}
}

if (file_exists($l_UrlIgnoreFilename)) {
    $g_UrlIgnoreList = file($l_UrlIgnoreFilename);
	
	for ($i = 0; $i < count($g_UrlIgnoreList); $i++) {
		$g_UrlIgnoreList[$i] = trim($g_UrlIgnoreList[$i]);
	}
}


$g_AiBolitAbsolutePathKnownFiles = dirname($g_AiBolitAbsolutePath) . '/known_files';
$g_AiBolitKnownFilesDirs = array('.');

if ($l_DIRH = opendir($g_AiBolitAbsolutePathKnownFiles))
{
    while (($l_FileName = readdir($l_DIRH)) !== false)
    {
	if ($l_FileName == '.' || $l_FileName == '..') continue;
        array_push($g_AiBolitKnownFilesDirs, $l_FileName);
    }

    closedir($l_DIRH);
}


foreach ($g_AiBolitKnownFilesDirs as $l_PathKnownFiles)
{
    if ($l_PathKnownFiles != '.') {
       $l_AbsolutePathKnownFiles = $g_AiBolitAbsolutePathKnownFiles . '/' . $l_PathKnownFiles;
    } else {
      $l_AbsolutePathKnownFiles = $l_PathKnownFiles;
    }

    if ($l_DIRH = opendir($l_AbsolutePathKnownFiles))
    {
        while (($l_FileName = readdir($l_DIRH)) !== false)
        {
            if ($l_FileName == '.' || $l_FileName == '..') continue;
               if (strpos($l_FileName, $l_KnownFilename) !== false) {
                           $g_KnownListTmp = file($l_AbsolutePathKnownFiles . '/' . $l_FileName);
                            for ($i = 0; $i < count($g_KnownListTmp); $i++) {
                                $g_KnownListTmp[$i] = trim($g_KnownListTmp[$i]);
                            }

                            $g_KnownList = array_merge($g_KnownListTmp, $g_KnownList);
                       }
        }
        closedir($l_DIRH);
    }
}

stdOut("Loaded " . count($g_KnownList) . ' known files');

QCR_Debug();

// scan single file
if (defined('SCAN_FILE')) {
   if (file_exists(SCAN_FILE) && is_file(SCAN_FILE) && is_readable(SCAN_FILE)) {
       stdOut("Start scanning file '" . SCAN_FILE . "'.");
       QCR_ScanFile(SCAN_FILE); 
   } else { 
       stdOut("Error:" . SCAN_FILE . " either is not a file or readable");
   }
} else {
      // scan whole file system
      stdOut("Start scanning '" . ROOT_PATH . "'.");
      QCR_ScanDirectories(ROOT_PATH);
}

$g_FoundTotalFiles = count($g_Structure['n']);

QCR_Debug();

stdOut("Found $g_FoundTotalFiles files in $g_FoundTotalDirs directories.");
stdOut(str_repeat(' ', 160),false);

$g_FoundTotalFiles = count($g_Structure['n']);

// detect version CMS
$l_CmsListDetector = new CmsVersionDetector('.');
$l_CmsDetectedNum = $l_CmsListDetector->getCmsNumber();
for ($tt = 0; $tt < $l_CmsDetectedNum; $tt++) {
    $g_CMS[] = $l_CmsListDetector->getCmsName($tt) . ' v' . $l_CmsListDetector->getCmsVersion($tt);
}

QCR_GoScan(0);

QCR_Debug();


////////////////////////////////////////////////////////////////////////////
 if ($BOOL_RESULT) {
  if ((count($g_CriticalPHP) > 0) OR (count($g_CriticalJS) > 0) OR (count($g_Base64) > 0) OR (count($g_SuspDir) > 0) OR  (count($g_Iframer) > 0) OR  (count($g_UnixExec) > 0))
  {
  echo "1\n";
  exit(0);
  }
 }
////////////////////////////////////////////////////////////////////////////

$l_Result .= "<div class=\"sec\"><b>" . AI_STR_051 . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : realpath('.')) . "</b></div>";

$time_tacked = seconds2Human(microtime(true) - START_TIME);

$l_Result .= sprintf(AI_STR_013, $g_TotalFolder, $g_TotalFiles);

$l_Result .= AI_STR_015;

$l_ShowOffer = false;

stdOut("\nBuilding report\n");


////////////////////////////////////////////////////////////////////////////

stdOut("Building list of shells " . count($g_CriticalPHP));

if (function_exists("gethostname") && is_callable("gethostname")) {
  $l_HostName = gethostname();
} else {
  $l_HostName = '???';
}

$l_PlainResult = "# Malware list detected by AI-Bolit (http://revisium.com/ai/) on " . date("d/m/Y H:i:s", time()) . " " . $l_HostName .  "\n\n";

if (count($g_CriticalPHP) > 0) {
  $l_Result .= '<div class="vir"><b>' . AI_STR_016 . '</b> (' . count($g_CriticalPHP) . ')';
  $l_Result .= printList($g_CriticalPHP, $g_CriticalPHPFragment, true, $g_CriticalPHPSig, 'table_crit');
  $l_PlainResult .= printPlainList($g_CriticalPHP, $g_CriticalPHPFragment, true, $g_CriticalPHPSig, 'table_crit');
  $l_Result .= '</div>';

  $l_ShowOffer = true;
} else {
  $l_Result .= '<div class="ok"><b>' . AI_STR_017. '</b></div>';
}

stdOut("Building list of js " . count($g_CriticalJS));

if (count($g_CriticalJS) > 0) {
  $l_Result .= '<div class="vir"><b>' . AI_STR_018 . '</b> (' . count($g_CriticalJS) . ')';
  $l_Result .= printList($g_CriticalJS, $g_CriticalJSFragment, true, $g_CriticalJSSig, 'table_vir');
  $l_PlainResult .= printPlainList($g_CriticalJS, $g_CriticalJSFragment, true, $g_CriticalJSSig, 'table_vir');
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building phishing pages " . count($g_Phishing));

if (count($g_Phishing) > 0) {
  $l_Result .= '<div class="vir"><b>' . AI_STR_058 . '</b> (' . count($g_Phishing) . ')';
  $l_Result .= printList($g_Phishing, $g_PhishingFragment, true, $g_PhishingSigFragment, 'table_vir');
  $l_PlainResult .= printPlainList($g_Phishing, $g_PhishingFragment, true, $g_PhishingSigFragment, 'table_vir');
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of unix executables " . count($g_UnixExec));

if (count($g_UnixExec) > 0) {
  $l_Result .= "<div class=\"vir\"><b>". AI_STR_019 ."</b> (" . count($g_UnixExec) . ')';
  $l_Result .= printList($g_UnixExec, '', true);
  $l_PlainResult .= printPlainList($g_UnixExec, '', true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of iframes " . count($g_Iframer));

if (count($g_Iframer) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"vir\"><b>" . AI_STR_021 . "</b> (" . count($g_Iframer) . ')';
  $l_Result .= printList($g_Iframer, $g_IframerFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of base64s " . count($g_Base64));

if (count($g_Base64) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_020 ."</b> (" . count($g_Base64) . ')';
  $l_Result .= printList($g_Base64, $g_Base64Fragment, true);
  $l_PlainResult .= printPlainList($g_Base64, $g_Base64Fragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of heuristics " . count($g_HeuristicDetected));

if (count($g_HeuristicDetected) > 0) {
  $l_Result .= '<div class="warn"><b>' . AI_STR_052 . '</b><ul>';
  for ($i = 0; $i < count($g_HeuristicDetected); $i++) {
	   $l_Result .= '<li>' . $g_Structure['n'][$g_HeuristicDetected[$i]] . ' (' . get_descr_heur($g_HeuristicType[$i]) . ')</li>';
  }
  
  $l_Result .= '</ul></div>';

  $l_ShowOffer = true;
}

stdOut("Building list of unread files " . count($g_NotRead));

if (count($g_NotRead) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"vir\"><b>" . AI_STR_030 . ":</b>";
  $l_Result .= printList($g_NotRead);
  $l_Result .= "</div>";

}

stdOut("Building list of symlinks " . count($g_SymLinks));

if (count($g_SymLinks) > 0) {

  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_022 . "</b> (" . count($g_SymLinks) .")<br>";
  $l_Result .= implode("<br>", $g_SymLinks);
  $l_Result .= "</div>";

}


stdOut("Building list of susp dirs " . count($g_SuspDir));

if (count($g_SuspDir) > 0) {

  $l_Result .= "<div class=\"vir\"><b>" . AI_STR_024 . "</b><br>";
  $l_Result .= printList($g_SuspDir);
  $l_Result .= "</div>";

} else {

  $l_Result .= '<div class="ok"><b>' . AI_STR_025 . '</b></div>';

}
 

stdOut("Building list of redirects " . count($g_Redirect));

$l_Result .= "<div class=\"sec\">" . AI_STR_026 . "</div>";

if (count($g_Redirect) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_027 . "</b>";
  $l_Result .= printList($g_Redirect, $g_RedirectPHPFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of php inj " . count($g_PHPCodeInside));

if ((count($g_PHPCodeInside) > 0) && (($defaults['report_mask'] & REPORT_MASK_PHPSIGN) == REPORT_MASK_PHPSIGN)) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_028 . "</b>";
  $l_Result .= printList($g_PHPCodeInside, $g_PHPCodeInsideFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of adware " . count($g_AdwareList));

if (count($g_AdwareList) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_029 . "</b>";
  $l_Result .= printList($g_AdwareList, $g_AdwareListFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of empty links " . count($g_EmptyLink));
if ((count($g_EmptyLink) > 0) && (($defaults['report_mask'] & REPORT_MASK_SPAMLINKS) == REPORT_MASK_SPAMLINKS)) {
  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>" . AI_STR_031 . "</b>";
  $l_Result .= printList($g_EmptyLink, '', true);

  $l_Result .= AI_STR_032 . '<br/>';
  
  if (count($g_EmptyLink) == MAX_EXT_LINKS) {
      $l_Result .= '(' . AI_STR_033 . MAX_EXT_LINKS . ')<br/>';
    }
   
  for ($i = 0; $i < count($g_EmptyLink); $i++) {
	$l_Idx = $g_EmptyLink[$i];
    for ($j = 0; $j < count($g_EmptyLinkSrc[$l_Idx]); $j++) {
      $l_Result .= '<span class="details">' . $g_Structure['n'][$g_EmptyLink[$i]] . ' &rarr; ' . htmlspecialchars($g_EmptyLinkSrc[$l_Idx][$j]) . '</span><br/>';
	}
  }

  $l_Result .= "</div>";

}


stdOut("Building list of php warnings " . (count($g_WarningPHP[0]) + count($g_WarningPHP[1])));

if (($defaults['report_mask'] & REPORT_MASK_SUSP) == REPORT_MASK_SUSP) {
   if ((count($g_WarningPHP[0]) + count($g_WarningPHP[1])) > 0) {
     $l_ShowOffer = true;

     $l_Result .= "<div class=\"warn\"><b>" . AI_STR_035 . "</b>";

     for ($i = 0; $i < count($g_WarningPHP); $i++) {
         if (count($g_WarningPHP[$i]) > 0) 
            $l_Result .= printList($g_WarningPHP[$i], $g_WarningPHPFragment[$i], true, $g_WarningPHPSig, 'table_warn');
     }                                                                                                                    
     $l_Result .= "</div>";

   } 
}

stdOut("Building list of skipped dirs " . count($g_SkippedFolders));
if (count($g_SkippedFolders) > 0) {
     $l_Result .= "<div class=\"warn2\"><b>" . AI_STR_036 . "</b><br/>";
     $l_Result .= implode("<br>", $g_SkippedFolders);
     $l_Result .= "</div>";
 }


if (count($g_CMS) > 0) {
     $l_Result .= "<div class=\"warn2\"><b>" . AI_STR_037 . "</b><br/>";
     $l_Result .= implode("<br>", $g_CMS);
     $l_Result .= "</div>";
}

if (!isCli()) {
   $l_Result .= QCR_ExtractInfo($l_PhpInfoBody[1]);
}

$max_size_to_scan = getBytes(MAX_SIZE_TO_SCAN);
$max_size_to_scan = $max_size_to_scan > 0 ? $max_size_to_scan : getBytes('1m');

stdOut("Building list of bigfiles " . count($g_BigFiles));

if (count($g_BigFiles) > 0) {

  $l_Result .= "<div class=\"warn2\"><b>" . sprintf(AI_STR_038, bytes2Human($max_size_to_scan)) . "</b>";
  $l_Result .= printList($g_BigFiles);
  $l_Result .= "</div>";

} else {
  if (SCAN_ALL_FILES) {
	$l_Result .= '<div class="ok"><b>' . sprintf(AI_STR_039, bytes2Human($max_size_to_scan)) . '</b></div>';
  }
}

stdOut("Building list of sensitive files " . count($g_UnsafeFilesFound) . "\n");

if ((count($g_UnsafeFilesFound) > 0) && (($defaults['report_mask'] & REPORT_MASK_CANDI) == REPORT_MASK_CANDI)) {
  $l_Result .= "<div class=\"warn2\"><b>" . AI_STR_040 . "</b>";
  $l_Result .= printList($g_UnsafeFilesFound);
  $l_Result .= "</div>";
}


if (function_exists('memory_get_peak_usage')) {
  $l_Result .= AI_STR_043 . bytes2Human(memory_get_peak_usage()) . '<p>';
}

$l_Result .= AI_STR_044;

if (!SCAN_ALL_FILES) {
  $l_Result .= AI_STR_045;
}

$l_Result .= sprintf(AI_STR_012, count($g_DBShe) + count($gX_DBShe) + count($g_FlexDBShe), (count($g_SusDB) + count($g_AdwareSig ) + count($g_JSVirSig)), $time_tacked, date('d-m-Y в H:i:s', floor(START_TIME)) , date('d-m-Y в H:i:s'));

$l_Result .= '<div class="footer"><div class="disclaimer"><span class="vir">[!]</span> ' . AI_STR_049 . '</div>';
$l_Result .= '<div class="thanx">' . AI_STR_050 . '</div>';
$l_Result .= '</div>';

$l_OfferVK = AI_STR_048;
              
if ($l_ShowOffer) {
  $l_Result .= AI_STR_047 .
        '<p><a href="#" onclick="document.getElementById(\'ofr\').style.display=\'none\'" style="color: #303030">' . AI_STR_046 . '</a></p>' .
        '</div>';
} else {
  $l_Result .= '<div class="offer2" id="ofr2">' . $l_OfferVK .
        '<p><a href="#" onclick="document.getElementById(\'ofr2\').style.display=\'none\'" style="color: #303030">' . AI_STR_046 .'</a></p>' .
        '</div>';
}

$l_Result .=<<<ENDING
</body> 
<script language="javascript">

$(document).ready(function(){
    $('#table_crit').dataTable({
       "aLengthMenu": [[100 , 500, -1], [100, 500, "All"]],
       "aoColumns": [
                                     {"iDataSort": 7},
                                     {"iDataSort": 5},
                                     {"iDataSort": 6},
                                     {"bSortable": true},
                                     {"bSortable": true},
                                     {"bVisible": false},
                                     {"bVisible": false},
                                     {"bVisible": false}
                     ],
       "iDisplayLength": 500,
		"oLanguage": {
			"sLengthMenu": "Отображать по _MENU_ записей",
			"sZeroRecords": "Ничего не найдено",
			"sInfo": "Отображается c _START_ по _END_ из _TOTAL_ файлов",
			"sInfoEmpty": "Нет файлов",
			"sInfoFiltered": "(всего записей _MAX_)",
			"sSearch":       "Поиск:",
			"sUrl":          "",
			"oPaginate": {
				"sFirst": "Первая",
				"sPrevious": "Предыдущая",
				"sNext": "Следующая",
				"sLast": "Последняя"
			},
			"oAria": {
				"sSortAscending":  ": активировать для сортировки столбца по возрастанию",
				"sSortDescending": ": активировать для сортировки столбцов по убыванию"			
			}
		}

     } );

});

$(document).ready(function(){
    $('#table_vir').dataTable({
       "aLengthMenu": [[100 , 500, -1], [100, 500, "All"]],
       "aoColumns": [
                                     {"iDataSort": 7},
                                     {"iDataSort": 5},
                                     {"iDataSort": 6},
                                     {"bSortable": true},
                                     {"bSortable": true},
                                     {"bVisible": false},
                                     {"bVisible": false},
                                     {"bVisible": false}
                     ],
       "iDisplayLength": 500,
		"oLanguage": {
			"sLengthMenu": "Отображать по _MENU_ записей",
			"sZeroRecords": "Ничего не найдено",
			"sInfo": "Отображается c _START_ по _END_ из _TOTAL_ файлов",
			"sInfoEmpty": "Нет файлов",
			"sInfoFiltered": "(всего записей _MAX_)",
			"sSearch":       "Поиск:",
			"sUrl":          "",
			"oPaginate": {
				"sFirst": "Первая",
				"sPrevious": "Предыдущая",
				"sNext": "Следующая",
				"sLast": "Последняя"
			},
			"oAria": {
				"sSortAscending":  ": активировать для сортировки столбца по возрастанию",
				"sSortDescending": ": активировать для сортировки столбцов по убыванию"			
			}
		},

     } );

});


    $('#table_warn').dataTable({
       "aLengthMenu": [[100 , 500, -1], [100, 500, "All"]],
       "aoColumns": [
                                     {"iDataSort": 7},
                                     {"iDataSort": 5},
                                     {"iDataSort": 6},
                                     {"bSortable": true},
                                     {"bSortable": true},
                                     {"bVisible": false},
                                     {"bVisible": false},
                                     {"bVisible": false}
                     ],
       "iDisplayLength": 500,
		"oLanguage": {
			"sLengthMenu": "Отображать по _MENU_ записей",
			"sZeroRecords": "Ничего не найдено",
			"sInfo": "Отображается c _START_ по _END_ из _TOTAL_ файлов",
			"sInfoEmpty": "Нет файлов",
			"sInfoFiltered": "(всего записей _MAX_)",
			"sSearch":       "Поиск:",
			"sUrl":          "",
			"oPaginate": {
				"sFirst": "Первая",
				"sPrevious": "Предыдущая",
				"sNext": "Следующая",
				"sLast": "Последняя"
			},
			"oAria": {
				"sSortAscending":  ": активировать для сортировки столбца по возрастанию",
				"sSortDescending": ": активировать для сортировки столбцов по убыванию"			
			}
		}

     } );

</script>

</html>
ENDING;

////////////////////////////////////////////////////////////////////////////
if (!isCli())
{
	echo $l_Result;
	exit;
}

if (!defined('REPORT') OR REPORT === '')
{
	die('Report not written.');
}
 
// write plain text result
if (PLAIN_FILE != '') {
   if ($l_FH = fopen(PLAIN_FILE, "w")) {
      fputs($l_FH, $l_PlainResult);
      fclose($l_FH);
   }
}

$emails = getEmails(REPORT);

if (!$emails) {
	if ($l_FH = fopen($file, "w")) {
	   fputs($l_FH, $l_Result);
	   fclose($l_FH);
	   stdOut("\nReport written to '$file'.");
	} else {
		stdOut("\nCannot create '$file'.");
	}
}	else	{
		$headers = array(
			'MIME-Version: 1.0',
			'Content-type: text/html; charset=UTF-8',
			'From: ' . ($defaults['email_from'] ? $defaults['email_from'] : 'AI-Bolit@myhost')
		);

		for ($i = 0, $size = sizeof($emails); $i < $size; $i++)
		{
			mail($emails[$i], 'AI-Bolit Report ' . date("d/m/Y H:i", time()), $l_Result, implode("\r\n", $headers));
		}

		stdOut("\nReport sended to " . implode(', ', $emails));
}


$time_taken = microtime(true) - START_TIME;
$time_taken = number_format($time_taken, 5);

stdOut("Scanning complete! Time taken: " . seconds2Human($time_taken));

QCR_Debug();

?>

