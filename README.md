
# Vertaal API Project

Dit project biedt een API die JSON-bestanden vertaalt naar een opgegeven doeltaal met behulp van de OpenAI API. De applicatie maakt gebruik van Laravel voor de backend, met authenticatie via Laravel Sanctum.

## Inhoudsopgave

1. [Installatie](#installatie)
2. [Configuratie](#configuratie)
3. [Gebruik](#gebruik)
4. [API Endpoints](#api-endpoints)
5. [Swagger json](#swagger-json)
6. [Conclusie](#conclusie)


## Installatie

Volg deze stappen om het project lokaal op te zetten:

1. **Kloon de repository:**

   git clone https://github.com/OmarNassar1127/translate.git

2. **Installeer de vereisten:**

   Zorg ervoor dat je [Composer](https://getcomposer.org/) en [npm](https://www.npmjs.com/) hebt geïnstalleerd.

   composer install
   npm install

3. **Maak een `.env` bestand:**

   Kopieer het voorbeeld `.env` bestand en vul het in met de juiste gegevens.

   cp .env.example .env

4. **Genereer de applicatiesleutel:**

   php artisan key:generate

5. **Voer de database migraties uit:**

   php artisan migrate

6. **Maak een storage-symlink aan:**

   Dit zorgt ervoor dat de opgeslagen vertaalde bestanden toegankelijk zijn via de browser.

   php artisan storage:link

7. **Start de ontwikkelingsserver:**

   php artisan serve

## Configuratie

Zorg ervoor dat je de juiste API keys hebt ingesteld in je `.env` bestand.

- **OpenAI API Key:**

  Voeg je OpenAI API sleutel toe aan het `.env` bestand:

  OPENAI_API_KEY=YOUR_OWN_KEY

- **Filesystem Configuratie:**

  Zorg ervoor dat je het bestandssysteem op `public` hebt ingesteld.

  ```env
  FILESYSTEM_DRIVER=public
  ```

## Gebruik

### Registreren

Om een account aan te maken, ga naar de `/register` pagina en vul de vereiste gegevens in. Na succesvolle registratie wordt je Bearer Token opgeslagen in de `localStorage`.

### Inloggen

Log in via de `/login` pagina. Bij succesvolle login wordt het Bearer Token ook opgeslagen in `localStorage` en heb je toegang tot de vertaalfunctionaliteit.

### Vertalen

Navigeer naar `/translate` om een JSON-bestand te uploaden, een doeltaal te selecteren en de vertaling te starten. Je moet ingelogd zijn om toegang te krijgen tot deze pagina.

## API Endpoints

De details van de API endpoints zijn beschikbaar in JSON formaat. Raadpleeg het Swagger-bestand (`swagger.json`) voor de volledige documentatie en voorbeeldverzoeken.

## Swagger json

Je kan de swagger info in een json format vinden in de root map onder het swagger mapje.

# Conclusie
Dit project biedt een flexibele oplossing voor het vertalen van JSON-bestanden naar een opgegeven doeltaal. Je kunt het project op twee manieren gebruiken:

Via Endpoints: Maak gebruik van de API endpoints rechtstreeks om vertalingen te automatiseren en te integreren in andere applicaties of workflows.

Via de User Interface: Gebruik de eenvoudige en gebruiksvriendelijke interface om handmatig JSON-bestanden te uploaden, een doeltaal te kiezen en direct de vertaalde bestanden te downloaden.

Met deze twee opties kun je het project aanpassen aan jouw specifieke behoeften en workflows. Veel succes met het gebruik van de Vertaal API!