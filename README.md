Aprendiendo RabbitMQ
====================

Para todos los desarrolladores en PHP que queráis incursionar en el uso de RabbitMQ y no sabéis por dónde empezar, os dejo un este proyecto sencillo con algunos ejemplos del uso del RabbitMqBundle.

Contiene un ejemplo de Producer (HelloWorldProducer) y dos Consumers (HelloWorldConsumer y HelloWorldDeadLetterConsumer), además incluye algunas configuraciones adicionales para ponerle un poco más de emoción a la práctica.

Pre-requisitos
--------------
*   RabbitMQ
*   Composer

Instalación y Ejecución
-----------------------

1.  Clona el repositorio en tu maquina. 
2.  Ejecuta composer install.
3.  Ejecutar el servidor local (app/console server:run) 
4.  Ejecuta los dos consumer (app/console rabbitmq:consumer  "hello_world" y "dead_letter")   
    
En este punto ya solo necesitas empezar a enviar mensajes, he creado un controlador dentro del proyecto para que podáis enviar mensajes con la respuesta que queráis del consumer:     
 
Si has usado el servidor que levanta el propio Symfony puedes acceder de la siguiente forma: 

    http://127.0.0.1:8000/response/<respuesta>

donde los posibles valores de respuesta son: 

*   ack ( aceptado )
*   nack_requeue ( no aceptado reencolado )
*   reject_requeue ( rechazado y reencolado )
*   reject (rechazado )

Para evitar que los estados que reencolan queden en un bucle infinito he puesto TTL a los mensajes en la cola para que expiren luego de unos segundos.

Paquetes contiene este proyecto
-------------------------------

Symfony 2:  
[https://github.com/symfony/symfony](https://github.com/symfony/symfony)

RabbitMqBundle:  
[https://github.com/videlalvaro/rabbitmqbundle](https://github.com/videlalvaro/rabbitmqbundle)  



