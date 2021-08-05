# evaluacion_tipo_1

La siguiente evaluación tiene como objetivo medir las competencias asociadas al dominio de los siguientes tópicos:

- Programación orientada a objetos
- Symfony framework u otro framework validado 
- Resolución de problemas informáticos


## Ejercicio
Implementar una herramienta que permita lo siguiente:

- Registrar las IPs de los usuarios que se conectan al sistema considerando fecha y hora. Para simplificar este proceso, se puede implementar el registro al acceder a una url en particular (Ej: http://localhost/registro).
- Debe mostrar el listado ordenado de los registros en otra página.
- Este listado debe permitir buscar por IP.
- El registro de IPs se debe poder modificar para agregar una bandera (boolean) de "bloqueado", una Categoría (Definidas en una tabla) y un comentario.
- Implementar un mantenedor (CRUD) de categorías.


## Requisitos mínimos
El proyecto Symfony debe tener como mínimo:

- Entity
- Repository
- Controllers
- Routing
- Forms

En caso de otro framework debe tener sus equivalentes

## Recepción de la evaluación

- Dispones de 4 horas para realizar este ejercicio.
- Dentro de ese período debes hacer un fork del proyecto, trabajarlo en tu propio repositorio y finalmente enviar un pull request a una nueva rama con tu nombre.


## Observaciones importantes

- Dentro de la evaluación debes incluir un dump de la base de datos y crear un archivo de referencia para las variables de entorno (parameters.yml).
- Ante cualquier consulta dentro del tiempo disponible, puedes comunicarte sin problemas vía correo electrónico a rmoreno@sensolabs.cl.

## Adicionales a considerar
- Implementar PWA
- Propuesta de escalabilidad
- Propuesta y/o implementación de mejoras con sus supuestos
