# idic
Desafio IDIC

#
Sistema desafio-idic:
Server por defecto port 8000
* Con respecto al a la gestion de Usuarios y Permisos asociados, si bien existe una api, el cual pueda crear usuarios, no se implemento en el front,
pero si la mantencion de usuarios, el cual debe ser ingreso con el usuario admin@example.com passwortd: 1234, el cual podra visualizar a los usuarios registrados en la base de datos, y manejar editar si es necesario el rol de cada uno de ellos.
* Como mencanismo de autenticacion, se utilizo HASH al momento de crear el usuario y poder guardar de forma segura la contraseña, como tambien se utilizo el metodo para descifrar el hash y validar las credenciales.
* permite hacer logout y quitar token.

sistema desafio-idic-front
Server port 8888
* Sistema mediante credenciales de usuarios, segun el rol puede visualizar y hacer modificaciones por ejemplo Admin, puede editar datos y eliminar clientes, 
  el rol usuario solo podra visualizar los clientes.
* Si las credenciales son correctas, se otorgara un token guardado en session, para futuras peticiones se utilizo JWT.
* El usuario rol, puede crear clientes, editar y eliminar mediante un crud.
* si no cuenta con credenciales no puede hacer ingreso al sistema, y el rol usuario solamente puede visualizar clientes.

***** PREGUNTAS *****
Si un cliente tiene además de su casa matriz, sucursales, bodegas y oficinas, ¿Cómo le agregaría
estas direcciones al sistema? ¿Qué cambios necesita hacer a nivel de base de datos, código e interfaz
de usuario para lograrlo?

Con respecto a estas preguntas, donde solicita elaboracion propia, personal o con mis propias palabras, mi respuesta es la siguiente:
R:// Mediante lo que he trabajado con Oracle Databe, existen proceure y funciones, que permiten el manejo de procedimientos o funciones dentro de la base de datos, por lo que a nivel de base de datos, crearia una tabla distinta en el cual se relacion el usuario mediante una primary key, que podriamos usar el rut, ya que es un dato unico, y el cual tenga parametros tanto de sucursal, bodegas, etc. Por lo que para la interfaz si el usuario (admin, supervisor o quien pueda gestionar los clientes), necesitan agregar mas direcciones a un usuario,  agregaria un mantenedor a la vista de quienes tengan esta facultad de agregar direcciones y les permitiria poder mediante un select, que tipo de direccion desea agregar, por ejemplo si selecciona bodega, agregue la direccion y guarde, lo cual mediante backend, haria mencion a un metodo X que reciba estos datos y llame a un procedimiento almacenado en la base de datos que segun el tipo de (bodega,sucursal,etc) agregue la direccion a la tabla correspondiente, creando la logica en la base de datos, incluso podriamos crear validaciones y respuestas para menejar posibles mensajes al usuario, como el status, o por ejemplo si el dato esta duplicado o lo que se pida. Si bien quiero recalcar que esta forma de trabajo lo he visto y manejado en Oracle Database, se que en MySQL tambien se puede realizar, si bien las consultas SQL son similares (Oracle tiene cosas distintas), el metodo de trabajo para procedimientos o funciones son distintas.


********* NOTA ***********
Me he fijado para probar los roles en la vista front, si entra con un usuario administrador y vuelve a entrar como cliente, es necesario quizas eliminar el cache.

usuario admin:
admin@example.com clave: 1234
usuario usuario:
npagut@gmail.com clave: 1234
