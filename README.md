# Телефонный справочник
Веб-приложение "Телефонный справочник" позволяет пользователю добавлять, просматривать, редактировать и удалять контакты. Написано на чистом PHP, без использования фреймворков.

## Содержание
- [Технологии](#технологии)
- [Описание](#описание)
- [Использование](#использование)
    - [Требования](#требования) 
    - [Установка](#установка)

## Технологии
- PHP 8.1
- MySQL 8.0
- HTML5
- CSS3
- Composer 2.7

## Описание
Данное приложение позволяет создавать, редактировать, удалять контакты, а также просматривать их полный список.

Если введенные данные не позволяют создать/обновить контакт таким образом, чтобы он был уникальным, то программа предупредит о существовании такого контакта и не создаст дублирующую запись.
Кроме того, предусмотрена проверка на существование при отправке прямого запроса для редактирования и удаления. 

Для хранения данных контактов предусмотрено две реализации: с помощью JSON-файла и Базы Данных. Выбор реализации происходит в env-файле с помощью переменной STORAGE_TYPE (=database или json).
Работа с БД осуществляется с помощью расширения PDO.

Приложение написано с использованием ООП и имитирует структуру проектов, написанных с использованием фреймворков. 
- В директории config хранятся файлы с конфигурациями в виде массивов.
- В директории public располагаются файлы публичной части. В этой папке находится файл index.php, который является точкой входа в приложение.
- В директории src находятся основные классы приложения (контроллеры, модели, контракты, репозитории, ...).
- В templates - шаблоны страниц и их компоненты.

При реализации маршрутизации был использован компонент HttpFoundation фреймворка Symfony, а именно: базовый класс запроса (Request), ответа (Response, RedirectResponse) и сессии (Session).
Для управления зависимостями в проекте используется сервис-контейнер в виде компонента illuminate\container фреймворка Laravel. Для работы с контейнером создан отдельный файл bootstrap.php, который позволяет получать объект контейнера в любом месте приложения.

Сессии используются для показа сообщений об успешном выполнении какого-то процесса или возникновении ошибки (flash-сообщения).

Создание нескольких пользователей и привязка контактов к ним не предусмотрены.

## Использование
### Требования
Для установки и запуска проекта необходим PHP v8.1+, MySQL v8.0+ и Composer v2.

### Установка
1. Для установки зависимостей выполните команду: 
```sh
composer install
```
2. Создайте env-файл в соответсвии с env-example (прописать переменные для подключения к БД и выбрать тип хранения данных).

3. Для работы с Базой Данных (БД) создайте БД и импортируйте в нее файл, который создаст необходимые таблицы (dump.sql). Для этого необходимо запустить следующую команду:
```sh
mysql -u[user_name] -p[user_password] -h[host_name] [database_name] < dymp.sql
```

4. В качестве сервера будет достаточно использовать встроенный веб-сервер PHP, который можно запустить с помощью следующей команды: 
```sh
cd public
php -S localhost:8000
```

Вместо `php` может потребоваться прописать путь, по которому у Вас находится PHP (вида `C:\\php81\php.exe`).

5. Откройте в браузере страницу `localhost:8000`.

Можно начинать пользоваться приложением.
