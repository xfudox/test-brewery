# Struttura
Per la crezione del progetto sono stati utilizzati i seguenti package:
 - Sail in modo da utilizzare Docker per lo sviluppo locale
 - Breeze come starter kit con VueJS per il frontend e lo scaffolding delle pagine necessarie
 - Sanctum per la parte di autenticazione alle API
 - Dusk per i test in browser

# Bootstrap del progetto
 1. Varibaili d'ambiente: rinominare `.env.example` in `.env`

 2. Installare le dipendenze di Composer
    ```shell
    composer install
    ```

 3. Avviare i container tramite Sail:
    ```shell
    ./vendor/bin/sail up -d
    ```

 4. Preparazione del DB
    Da dentro il container `app`:
    ```shell
    php artisan migrate
    php artisan db:seed
    ```

 5. Build del frontend
    Da dentro il container `app`:
    ```shell
    npm install
    npm run build
    ```

# Accesso all'applicazione
Accedere a `localhost` ed effettuare il login come root con le credenziali:
- email: `test@example`
- password: `password`


# Esecuzione dei test
## unit/feature test
```shell
./vendor/bin/sail test
```

## browser test
```shell
./vendor/bin/sail dusk
```