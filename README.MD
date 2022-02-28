## Jak spustit projekt
1. Nainstalovat composer [click](https://getcomposer.org/download/)
2. Otevřít projekt, a spustit v terminálu/kozoli příkaz: 
> composer update
3. Soubor .env změnit na vlastní data
3.1 Vytvořit databázi - (např. Adresar) a udělat migrace:
> php bin/console make:migration

> php bin/console doctrine:migrations:migrate