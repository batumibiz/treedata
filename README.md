# TreeData
Данный проект используется исключительно с целью эксперимента.
Из имеющихся шаблонов хранения деревовидных структур, необходимо было
подобрать наиболее подходящий вариант для создания иерархической структуры сайта.

### Исходные задачи:
- Выборка всего дерева (используется для карты сайта).
- Выборка всех потомков указанного узла (используется для меню навигации).
- Выборка всех предков указанного узла (используется для BreadCrumb меню).
- Выборка соседей с общим предком (навигация в пределах раздела).

### Условия:
- **ЗАПРЕЩЕНО** использование в запросах двух и более параметров. Доступ к любому узлу дерева исключительно по **ID** данного узла.
- Нежелательно использование рекурсивных запросов.

### Итог
В результате эксперимента удалось установить следующее: наилучшим (быстрым и удобным)
вариантом является одноразовое получение всего отсортированного дерева данных, хранимого с помощью Ajacency List,
с дальнейшим помещением результата в кэш. В последствии, для всех вышеуказанных
задач используется только кэш, доступ к базе данных вообще не требуется.

## Установка
- Клонировать, или скачать и распаковать репозиторий
- Установить папку с репозиторием как виртуальный хост Apache
- Создать базу данных
- Импортировать в созданную базу файл `/install/install.sql`
- Скопировать файл `/config.php.dist` в `/config.php`
- Записать в скопированный файл реквизиты доступа к базе данных

Все готово. Если в браузере перейти по адресу созданного виртуального хоста, то будет видна страница с примерами.
