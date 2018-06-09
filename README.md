Gra buduj budynki i tworz miasto

** krok 1 :  composer update
** krok 2 :  npm install
** krok 3 :  npm run dev        -  generowanie plików js,css


Przydatne komendy:

* stworz tabele poprzez konsole
php bin/console make:entity

* wygeneruj tabele z bazy danych
 php bin/console doctrine:mapping:import App/Entity annotation --path=src/Entity

* migracja tabel entity do bazy danych
- php bin/console make:migration
- php bin/console doctrine:migrations:migrate

* zregeneruj gettery i settery w entity
- php bin/console make:entity --regenerate App

* pobierz dane z bazy danych
- php bin/console doctrine:query:sql 'SELECT * FROM user'