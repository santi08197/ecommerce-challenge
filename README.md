ECOMMERCE CHALLENGE SANTIAGO GONZALEZ

-clonar proyecto

-ejecutar $ composer install

-ejecutar $ php artisan migrate

- ejecutar $ php artisan serve

Siguiendo esos pasos el proyecto deberia estar listo para usarse!

Para poder ingresar al sistema necesitamos crear usuarios.
Para hacer eso vamos a ejecutar el siguiente comando:

    php artisan app:fetch-random-users

Esto hace que se genere un usuario en nuestra base de datos. Si queremos mas de uno le podemos pasar el número deseado por parametro:

    php artisan app:fetch-random-users 4

El comando imprime un mensaje por terminal donde nos muestra el email y contraseña de los usuarios creados.