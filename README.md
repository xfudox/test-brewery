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
    ```shell
    docker exec app php artisan migrate
    docker exec app php artisan db:seed
    ```

 5. Build del frontend
    ```shell
    docker exec app npm install
    docker exec app npm run build
    ```

# Accesso all'applicazione
Accedere a `localhost/login` ed effettuare il login come root con le credenziali:
- email: `test@example.com`
- password: `password`

# Autenticazione via Sanctum
## SPA e CSRF
Sanctum richiede una prima chiamata `POST` a `/sanctum/csrf-cookie` per inizializzare la protezione CSRF della SPA: in questo modo viene settato un cookie `XSRF-TOKEN` che deve essere poi passato tramite l'header `X-XSRF-TOKEN` nelle successive chiamate.
E' stato utilizzato il client Axios che riconosce automaticamente questo processo e salva il token per riutilizzarlo nel modo richiesto per le successive chiamate senza bisogno di configurazioni.

## Login utente
Dopo aver impostato la protezione CSRF bisogna effettuare una chiamata `POST` a `/login` in modo da autenticare l'utente tramite il cookie di sessione: questa chiamata viene già effettuata dalla pagina di login di Breeze senza bisogno di una implementazione manuale.

## API
Sanctum permette di verificare l'autenticazione dell'utente per l'accesso alle API tramite il middleware `auth:sanctum`che effettua un check dell'header `Authorization`.

# Esecuzione dei test
## unit/feature test
```shell
./vendor/bin/sail test
```

## browser test
Al momento l'esecuzione dei browser test in locale tramite Dusk effettua un refresh del database rendendo l'applicazione inutilizzabile al termine dei test.
```shell
./vendor/bin/sail dusk
```