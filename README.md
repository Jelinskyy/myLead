# Zadanie rekrutacyjne MyLead
Zadanie rekrutacyjne na stanowisko Backend Developer (Laravel)

## Instalacja
1. Pobierz repozytorium
```bash
    git clone https://github.com/Jelinskyy/myLead.git
```
2. zainstaluj zależności
```bash
    composer install
```
3. Skonfiguruj plik .env
```bash
    cp .env.example .env
```
4. Wygeneruj klucz aplikacji
```bash
    php artisan key:generate
```
5. Utwórz na serwerze lokalnym bazę danych zgodną z .env
6. Wykonaj migrację
```bash
    php artisan migrate
```
7. Podłącz storage do public Dir
```bash
    php artisan storage:link
```
8. Uruchom server localhost
```bash
	php artisan serve
```