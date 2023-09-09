# AA_ONLINESHOP_PHP
Actividad de Aprendizaje de la asignatura Desarrollo de Interfaces
**TIENDA ONLINE**

Se ha realizado un prototipo de tienda online retro en el cual 
hay varios puntos que se han tenido en cuenta durante el desarrollo del proyecto.

El proyecto contiene 4 entidades o tablas:

* Client: Clientes que están registrados en la plataforma
* Product: Los productos que se encuentran,o no, en la tienda online
* Category: Indica los productos por un tipo específico
* Sale: las ventas realizadas en la tienda

En cuanto a funcionalidades:
* Contiene un apartado de LOGIN y REGISTRO, donde el acceso será tratado en función de si el usuario es ADMIN o USUARIO
* El Admin podrá ver todas las tablas, y el User normal solo podrá ver los productos y categorias.
* Se han utilizado Clases (POO) y PDO para conexión con la base de datos
* El proyecto sigue una Arquitectura MVC
* Hay control de inyección SQL con funciones como prepare() o execute()
* Hay control de errores try-catch
* Al registrar un usuario e introducir una contraseña determinada por el usuario, está se encifra a traves de un hash
* El ADMIN puede realizar un CRUD completo de cada tabla
