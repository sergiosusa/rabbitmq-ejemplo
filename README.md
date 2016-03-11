Aprendiendo RabbitMQ
====================

Para todos los desarrolladores en PHP que queráis incursionar en el uso de RabbitMQ y no sabéis por dónde empezar, os dejo un este proyecto sencillo con algunos ejemplos del uso del RabbitMqBundle.

Contiene los siguientes ejemplos: 

**EJEMPLO 1** 

Simulación de envío (con todos los posibles resultados) y recepción de mensajes a un exchange con una cola y el uso de un dead letter en caso de rechazar el mensaje.

*Producer:*  Example1Producer
*Consumers:* Example1Consumer y Example1DeadLetterConsumer

Publishers:

    app/console send:example1 <respuesta> <numero de mensajes>
    
donde los posibles valores de respuesta son: 

*   ack ( aceptado )
*   nack_requeue ( no aceptado reencolado )
*   reject_requeue ( rechazado y reencolado )
*   reject (rechazado )

Consumers:

    app/console rabbitmq:consumer example1
    app/console rabbitmq:consumer example1_dead_letter

Para evitar que los estados que reencolan queden en un bucle infinito he puesto TTL a los mensajes en la cola para que expiren luego de unos segundos.

[Explicación detallada](http://sergiosusa.com/blog)

**EJEMPLO 2**

Reencolamiento de mensajes usando la cola del dead letter.

*Producer:* Example2Producer
*Consumer:* Example2Consumer y Example2DeadLetterRequeueConsumer

Publishers:

    app/console send:example1 <respuesta> <numero de mensajes>


donde los posibles valores de respuesta son: 

*   ack ( aceptado )
*   nack_requeue ( no aceptado reencolado )
*   reject_requeue ( rechazado y reencolado )
*   reject (rechazado )

Consumers:

    app/console rabbitmq:consumer example2
    app/console rabbitmq:consumer example2_dead_letter

[Explicación detallada](http://sergiosusa.com/blog)

**EJEMPLO 3**

Como manejar el uso de la llegada de mensajes usando QoS (Quality of Services).

Publishers:

    app/console send:example3 <respuesta> <numero de mensajes>

Consumers:

    app/console rabbitmq:consumer example3
    app/console rabbitmq:consumer example3_low

[Explicación detallada](http://sergiosusa.com/blog)

**nota:** todos los ejemplos contienen además algunas configuraciones adicionales para ponerle un poco más de emoción a la práctica.

Pre-requisitos
--------------
*   PHP 5.4+
*   Composer
*   RabbitMQ

Instalación y Ejecución
-----------------------

1.  Clona el repositorio en tu maquina. 
2.  Ejecuta composer install.
3.  Ejecuta los consumers del ejemplo.
4.  Ejecuta los publishers de cada ejemplo y ver como se comportan los ejemplos. ( app/consola send:example1,  app/consola send:example2, ...,  app/consola send:exampleN )

Paquetes contiene este proyecto
-------------------------------

Symfony 2:  
[https://github.com/symfony/symfony](https://github.com/symfony/symfony)

RabbitMqBundle:  
[https://github.com/videlalvaro/rabbitmqbundle](https://github.com/videlalvaro/rabbitmqbundle)  

Documentación Recomendada
-------------------------------

[Sitio Oficial de RabbitMQ](https://www.rabbitmq.com/)  
[Mi Blog](http://sergiosusa.com/blog)
