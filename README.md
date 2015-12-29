Aprendiendo RabbitMQ
====================

Para todos los desarrolladores en PHP que queráis incursionar en el uso de RabbitMQ y no sabéis por dónde empezar, os dejo un este proyecto sencillo con algunos ejemplos del uso del RabbitMqBundle.

Contiene los siguientes ejemplos: 

**EJEMPLO 1** 

Simulación de envío (con todos los posibles resultados) y recepción de mensajes a un exchange con una cola y el uso de un dead letter en caso de rechazar el mensaje.

*Producer:*  HelloWorldProducer   
*Consumers:* HelloWorldConsumer y HelloWorldDeadLetterConsumer

Controlador: 

    http://127.0.0.1:8000/response/<respuesta>
    
donde los posibles valores de respuesta son: 

*   ack ( aceptado )
*   nack_requeue ( no aceptado reencolado )
*   reject_requeue ( rechazado y reencolado )
*   reject (rechazado )
 
Para evitar que los estados que reencolan queden en un bucle infinito he puesto TTL a los mensajes en la cola para que expiren luego de unos segundos.
    
**EJEMPLO 2**

Reencolamiento de mensajes usando la cola del dead letter.

*Producer:* HelloWorld2Producer    
*Consumer:* HelloWorld2Consumer y HelloWorldDeadLetterRequeueConsumer

Controlador: 

    http://127.0.0.1:8000/requeue/<respuesta>


donde los posibles valores de respuesta son: 

*   ack ( aceptado )
*   nack_requeue ( no aceptado reencolado )
*   reject_requeue ( rechazado y reencolado )
*   reject (rechazado )


**nota:** todos los ejemplos contienen además algunas configuraciones adicionales para ponerle un poco más de emoción a la práctica.

Pre-requisitos
--------------
*   RabbitMQ
*   Composer

Instalación y Ejecución
-----------------------

1.  Clona el repositorio en tu maquina. 
2.  Ejecuta composer install.
3.  Ejecutar el servidor local (app/console server:run) 
4.  Ejecuta los consumers del ejemplo (para el ejemplo 1: app/console rabbitmq:consumer  "hello_world" y "dead_letter")   
    
En este punto ya solo necesitas empezar a enviar mensajes usando los controladres descritos en cada ejemplo y seguir su comportamiento en la consola.     
 

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





