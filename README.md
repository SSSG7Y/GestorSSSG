# GestorPro - Sistema de Gestión de Proyectos Colaborativos

## 1. Información General
Este proyecto es el entregable final de la asignatura INF560 - Desarrollo Web Backend de la carrera de Ingeniería Informática de la Universidad Autónoma Tomás Frías (UATF). Es una aplicación web monolítica construida con Laravel 13 para la gestión de proyectos, tareas y equipos colaborativos.

## 2. Stack Tecnológico
- Framework: Laravel 13 (PHP 8.3)
- Base de datos: SQLite
- Control de Acceso: spatie/laravel-permission (RBAC)
- Diseño: Blade con enfoque Responsive/Mobile-First

## 3. Instrucciones de Instalación
1. Clonación: git clone <https://github.com/SSSG7Y/GestorSSSG>
2. Dependencias: composer install
3. Entorno: Copia .env.example a .env. Asegúrate de que DB_CONNECTION=sqlite esté activo.
4. Base de Datos: Genera la estructura y carga los datos de prueba (roles, usuarios, permisos):
   php artisan migrate --seed
5. Ejecución: php artisan serve

## 4. Usuarios de Prueba (Seeders)
Para evaluar los niveles de acceso, usa estas credenciales:
- Administrador: admin@test.com / password
- Líder: leader@test.com / password
- Miembro: member@test.com / password
- Invitado: guest@test.com / password

## 5. Matriz de Roles y Permisos
- Administrador: Gestiona proyectos, miembros, tareas, comentarios y panel de administración total.
- Líder: Gestiona proyectos, miembros y tareas de su equipo, además de comentar.
- Miembro: Gestiona tareas asignadas y comentarios.
- Invitado: Acceso de lectura y comentarios.

## 6. Características Técnicas (Fase 5 - Calidad y UX)
- Paginación Robusta: Uso de paginate(10) con withQueryString() para persistencia de filtros.
- Buscador Dinámico: Filtros de búsqueda y estados insensibles a mayúsculas.
- Control de Errores: Centralización de manejo de excepciones mediante vistas personalizadas (403, 404).
- Validación: Uso estricto de Form Requests para integridad de datos.
- Registro de Actividad: Seguimiento automático de cambios en proyectos.
- UX Adaptable: Interfaz optimizada para dispositivos móviles, tablets y escritorio.

## 7. Historial de Desarrollo (Fases Git)
- v0.1: Estructura de base de datos, modelos y migraciones.
- v0.2: Sistema de autenticación de usuarios.
- v0.3: Implementación de Roles y Permisos (RBAC).
- v0.4: CRUD completo (Proyectos, Tareas, Miembros, Comentarios).
- v1.0: Calidad, UX, Filtros, Paginación y entrega final.

---
Desarrollado por: Saulo Sergio Segura Garnica
Materia: INF560 - Desarrollo Web Backend
Docente: M. Sc. Huáscar Fedor Gonzales Guzmán
Universidad: Universidad Autónoma Tomás Frías (UATF)