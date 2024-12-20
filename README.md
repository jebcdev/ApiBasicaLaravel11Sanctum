# ✨ Api Básica Laravel 11 - Sanctum ✨

## 🤔 ¿Qué es una API?
Una **API** (Application Programming Interface) es un conjunto de reglas y protocolos que permiten que diferentes aplicaciones se comuniquen entre sí. En términos simples, una API actúa como un intermediario que facilita el intercambio de datos entre sistemas. 

Con **Laravel 11** y **Sanctum**, construiremos una API moderna que permita a los usuarios autenticarse, gestionar datos y controlar permisos de acceso de manera eficiente. ¡Prepárate para aprender y divertirte en el proceso! 🚀📂

---

## 🌐 1. Crear un Proyecto Nuevo Usando Laravel Installer ✅
Comencemos desde cero creando nuestro proyecto con **Laravel Installer**. Este comando nos prepara el entorno inicial con todos los archivos necesarios. 🌟

---

## 🔄 2. Instalar Rutas API y Sanctum ✅
En este paso instalaremos las dependencias y configuraremos las rutas iniciales para la API. **Sanctum** será la herramienta clave para manejar la autenticación basada en tokens. 🔐

---

## 🔧 3. Modificar el Modelo y Migración de User ✅

En este punto:
1. Actualizaremos el modelo `User` para que soporte **API Tokens**.
2. Añadiremos un campo extra para identificar a los usuarios **administradores**.

Esto nos dará la base para manejar permisos y roles. 🏛️

---

## 💡 4. Crear un Controlador de Raíz para la API y una Clase ApiResources ✅
Diseñaremos un controlador base para manejar las respuestas generales de la API y establecer una clase con un formato consistente en nuestras respuestas. 🌐

---

## 🔒 5. Crear el Controlador de Autenticación  ✅

Este controlador se encargará de manejar la autenticación de usuarios. Las acciones incluyen:

- **Register**: Permite a nuevos usuarios registrarse. 🔑 ✅
- **Login**: Inicio de sesión para usuarios existentes. 🚪 ✅
- **Profile**: Devuelve la información del usuario autenticado. 👤 ✅
- **Logout**: Cierra la sesión de un usuario. 🚫 ✅

---

## 💧 6. Modelos, Migraciones, Seeders, Form Requests y Controladores ✅

Crearemos la estructura de datos y lógica para los siguientes recursos:

### ✅ **Category**  ✅
Gestionaremos las categorías con funcionalidades completas (CRUD).

### 🔄 **Status** ✅
Implementaremos un sistema para manejar los estados de las tareas.

### 🛠️ **Task**  ✅
Este será el recurso principal de nuestra API, donde los usuarios podrán interactuar con tareas según sus permisos.

---

## 🛡️ 7. Crear Grupo de Rutas Protegidas por Sanctum  ✅

Organizaremos nuestras rutas en grupos para:

1. Rutas públicas.
2. Rutas protegidas por **Sanctum**.
3. Rutas exclusivas para **administradores**.

Esto mejorará la seguridad y el orden del proyecto. 🔒

---

## 🔨 8. Crear Middleware de Admin y Grupo de Rutas Protegidas para Admin  ✅

Implementaremos un middleware personalizado para verificar si un usuario es administrador. Las rutas protegidas serán accesibles solo para estos usuarios con privilegios especiales. 🔑

---

## 📁 9. CRUD de Categorías Solo para Admin  ✅
Los administradores podrán gestionar las categorías mediante un CRUD completo:

- Crear 🌱
- Leer 📃
- Actualizar 🌄
- Eliminar 🗑️

---

## 📁 10. CRUD de Estados Solo para Admin  ✅

Los estados también serán gestionados exclusivamente por administradores mediante un CRUD completo. 📊

---

## 🔑 11. CRUD de Tareas (Admin Registrados)  ✅
Los administradores tendrán el control total sobre las tareas, incluyendo todas las acciones de un CRUD. 📂

---

## 🔧 12. CRUD de Usuarios Desde Admin  ✅

El administrador podrá gestionar a los usuarios del sistema:
- Registrar nuevos usuarios.
- Consultar información.
- Editar perfiles.
- Eliminar usuarios si es necesario. 🏛️

---

## 🔧 13. CRUD de Tareas (Usuarios Registrados)   ✅
Los usuarios registrados podrán:

- Crear sus propias tareas. 📝
- Consultar sus tareas asignadas. 🔄
- Editar detalles de las tareas. 🔧
- Eliminar tareas que ya no necesiten. 🗑️

---

¡Con esto hemos completado los pasos fundamentales para crear nuestra API! ¡Manos a la obra! 🚀🔄

