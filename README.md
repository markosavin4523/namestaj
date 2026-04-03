# Namestaj Shop - Online Prodavnica (Laravel Projekat)

Ovaj projekat predstavlja web prodavnicu nameštaja sa admin panelom, razvijenu kao deo predispitnih obaveza na smeru Internet tehnologije.

**Autor:** Marko Savin  
**Indeks:** 45/23  
**Škola:** Visoka ICT škola, Beograd

---

## Uputstvo za pokretanje projekta

Pratite ove korake nakon kloniranja repozitorijuma kako bi aplikacija ispravno radila na lokalnom serveru:

### 1. Instalacija PHP zavisnosti
```bash
composer install
```
### 2. Podesavanje .env fajla
```bash
cp .env.example .env
php artisan key:generate
```
### 3. Konfiguracija baze podataka
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=namestaj
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Migracije i seederi
```bash
php artisan migrate
php artisan db:seed
```
### 4. Za frontend instalacija i build npm
```bash
npm install
npm run dev
```
### 4. Pokretanje servera
```bash
php artisan serve
```
## Test nalozi
### Admin nalog: 
email: admin@gmail.com   
password: admin123
### User nalog:
email: pera@gmail.com   
password: pera123

## Funkcionalnosti
### Neulogovani korisnici
Neulogovani korinici na sajtu pored mogucnosti registracije i prijave imaju mogucnost
pretrage, filtriranja proizvoda i njihovih recenzija.
Imaju mogucnost iako su neulogovani da sacuvaju proizvod, da ga dodaju u korpu i da kreiraju porudzbinu sa unetim podacima.
Mogu da posalju upi adminu sajta preko kontakt stranice.

### Uloga 'korisnik' (user) 
Korisnici sa 'user' ulogom mogu dodatno da upravljaju kompletnim svojim nalogom
(dodavanje, izmena i brisanje licnih podataka, adresa stanovanja, broja telefona, lozinke itd.),
Ima uvid u svoje porudzbine koje jos nisu dostavljene na kucnu adresu na stranici "moje porudzbine" i da ih prate,
a zavrsene porudzbine (istorija poruzbina) na stranici "istorija porudzbina".

### Uloga 'admin'
Administratori sajta imaju pristup admin panelu.
Admin panel pruza sledece funkcionalnosti:  
-Pregled i pretraga kljucnih aktivnosti korisnika    
-Pregled upita sa kontakt forme od korisnika  
-Pregled i pretraga porudzbina      
-Izmena statusa porudzbine      
-Pregled i pretraga korisnika sajta     
-Izmena uloge i statusa korisnika
-Pretraga, izmena, kreiranje proizvoda i kategorija
-Dodavanje i brisanje gradova
-Dodavanje statusa poruzbina









