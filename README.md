# Il progetto è stato inizializzato usando Laravel Sail
 - Installare le dipendenze di Composer
    ```shell
    composer install
    ```

 - Avviare i container tramite Sail:
    ```shell
    ./vendor/bin/sail up -d
    ```

 - Preparazione del DB
    Da dentro il container `app`:
    ```shell
    php artisan migrate
    php artisan db:seed
    npm install
    npm run build
    ```

 - Accesso all'applicazione
    Accedere a `localhost` ed effettuare il login come root con le credenziali:
    - email: `test@example`
    - password: `password`


 - Esecuzione dei test
    ```shell
    # unit/feature test
    ./vendor/bin/sail test

    # browser test using laravel Dusk
    ./vendor/bin/sail dusk
    ```