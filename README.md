1. Clone the repo
2. Run:
   <p>composer install</p>
   <p>php artisan migrate --seed</p>
   <p>php artisan serve</p>
3. Test API via Postman with the token: Bearer <strong>secrettesttoken123</strong>
4. Available routes to test:
   <ul>
       <li>http://localhost:8888/api/translations (GET) (To get all the list of translations)</li>
       <li>http://localhost:8888/api/translations (POST) (To add new translations)
       <br>
           <strong>request body sample:
           {
              "key": "hello",
              "locale": "en",
              "content": "Hello world page",
              "tags": ["web", "homepage"]
            }</strong>
       </li>
       <li>http://localhost:8888/api/translations/1 (PUT) (To update a translation) <br>
           <strong>
         request body sample:
    {
      "content": "Some text to update in translation",
      "tags": ["web","new tag"]
    }          
           </strong>
     
   </li>
   <li>
       http://localhost:8888/api/export/en (GET) (To export translation in json)

   </li>
   </ul>
       
   
   
   
