1. Clone the repo
2. Run:
   composer install
   php artisan migrate --seed
   php artisan serve
3. Test API via Postman with the token: Bearer secrettesttoken123
4. Available routes to test:
   a. http://localhost:8888/api/translations (GET) (To get all the list of translations)
   b. http://localhost:8888/api/translations (POST) (To add new translations)
   request body sample:
   {
      "key": "hello",
      "locale": "en",
      "content": "Hello world page",
      "tags": ["web", "homepage"]
    }
   c. http://localhost:8888/api/translations/1 (PUT) (To update a translation)
     request body sample:
    {
      "content": "Some text to update in translation",
      "tags": ["web","new tag"]
    }
   d. http://localhost:8888/api/export/en (GET) (To export translation in json)
