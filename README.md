# Start up docker
```shell
    docker compose up --build -d
```

# Inizializzazione Laravel
Da dentro il container `app`:
```shell
php artisan migrate
php artisan db:seed
npm install
npm run build
```

# Accesso all'applicazione
Accedere a `localhost` ed effettuare il login come root con le credenziali:
 - email: `test@example`
 - password: `password`
