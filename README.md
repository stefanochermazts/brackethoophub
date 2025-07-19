# File: README.md

````markdown
# Gestione Tornei di Pallacanestro

**Descrizione**: Applicazione Laravel TALL per la gestione di piccoli tornei di pallacanestro con calendari, statistiche giocatori, multilingua e accessibilità WCAG 2.1 AA.

**Tecnologie**:
- **Backend**: Laravel 10
- **Frontend**: TALL Stack (Tailwind CSS, Alpine.js, Livewire, Blade)
- **Database**: MySQL 8+
- **Caching**: Redis
- **i18n**: spatie/laravel-translatable
- **Accessibilità**: WCAG 2.1 AA
- **CI/CD**: GitHub Actions

## Prerequisiti locali
- PHP ≥ 8.1 con estensioni PDO, BCMath, Ctype, JSON, Mbstring, OpenSSL, Tokenizer, XML
- Composer
- Node.js ≥ 16 e npm
- MySQL 8+
- Redis (locale o servizio gestito)

## Installazione
1. Clona il repository
   ```bash
   git clone git@github.com:tuo-org/tornei-basket.git
   cd tornei-basket
````

2. Installa dipendenze PHP e JS

   ```bash
   composer install
   npm install
   npm run build
   ```
3. Configura variabili d'ambiente

   ```bash
   cp .env.example .env
   php artisan key:generate
   # Controlla APP_URL
   # Configura DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
   ```
4. Avvia servizi locali

   * Assicurati che MySQL e Redis siano in esecuzione (es. `brew services start mysql redis` o servizio di sistema)
5. Migra il database e seed

   ```bash
   php artisan migrate --seed
   ```
6. Avvia il server

   ```bash
   php artisan serve
   ```

## Funzionalità

* Creazione e gestione tornei
* Calendario partite con generazione automatica
* Inserimento e visualizzazione statistiche giocatori
* Dashboard per allenatori e admin
* Supporto multilingua (it/en)
* Conformità accessibilità WCAG 2.1 AA
* API REST documentate con Scribe

````

---

# File: cursor.config.json
```json
{
  "projectName": "tornei-basket",
  "description": "Software Laravel TALL per gestione tornei di pallacanestro, calendari, statistiche, multilingua e WCAG AA.",
  "stack": {
    "backend": "Laravel 10",
    "frontend": "TALL (Tailwind, Alpine.js, Livewire, Blade)",
    "database": "MySQL 8+",
    "cache": "Redis",
    "i18n": "spatie/laravel-translatable",
    "accessibility": "WCAG 2.1 AA"
  },
  "services": [
    "app",
    "db",
    "redis"
  ],
  "entrypoint": "php artisan serve",
  "tasks": [
    {
      "name": "Setup Environment",
      "run": [
        "composer install",
        "npm install",
        "npm run build",
        "cp .env.example .env",
        "php artisan key:generate"
      ]
    },
    {
      "name": "Database Migration",
      "run": [
        "php artisan migrate --seed"
      ]
    }
  ]
}
````

---

# File: .env.example

```ini
APP_NAME=TorneiBasket
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tornei
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# i18n default locale
APP_LOCALE=it
APP_FALLBACK_LOCALE=en
```
