1: należy ustawić w `.env` użytkownika/hasło/nazwę bazy itp.

2a:

    php bin\console doctrine:migrations:migrate

2b: 

    php bin\console doctrine:database:create
    php bin\console doctrine:schema:update --force

3: `php bin\console doctrine:fixtures:load`

4: `symfony server:start` albo jakikolwiek stos AMP
