composer install 
&& npm install 
&& npm run dev 
&& npm run build 
&& symfony console doctrine:database:drop
&& symfony console doctrine:database:create
&& symfony console doctrine:migrations:migrate