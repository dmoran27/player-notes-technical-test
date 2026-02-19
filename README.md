# **Prueba Técnica: Player Notes Module (Laravel + Livewire)**
Este proyecto implementa un sistema de notas internas para agentes de soporte, permitiendo gestionar observaciones sobre jugadores de forma reactiva y estructurada.

## **Tecnologías Utilizadas**
Laravel 12 (PHP 8.2+)

Livewire 4.1 (Componentes reactivos)

Spatie Laravel Permission (Gestión de roles y permisos)

MySQL (Base de Datos)

## **Características principales**
- **Interfaz unificada:** Formulario de creación y tabla de historial en un solo componente reactivo.
- **RBAC (Control de Acceso Basado en Roles):** Tres niveles de acceso configurados (Agente, Visualizador y Jugador).
- **Pruebas Automatizadas:** Tests de integración para validar la seguridad y persistencia.

---

## **Instalación**

1. **Clonar el repositorio:**

```bash
git clone <tu-url-del-repositorio>
cd player-notes
```

2. **Instalar dependencias:**

```bash
composer install
npm install && npm run dev
```

3. **Configurar el entorno:**

Copia el archivo .env.example a .env.

4. **Configura tu conexión a base de datos MySQL en el .env.**

5. **Generar clave y ejecutar migraciones con Seeders:**

```bash
php artisan key:generate
php artisan migrate --seed
```

____

### **Credenciales de Prueba (Seeder)**

#### **Crear y ver todas las notas.**
- Nombre: Support Agent	
- Correo: support@test.com	
- Clave: password	

#### **Solo ver el historial**
- Nombre: Support Viewer	
- Correo: viewer@test.com	password
- Clave: password	

#### **Acceso restringido (Mensaje de advertencia).**
- Nombre: Player 	
- Correo: player1@test.com
- Clave: password	

____

### **Ejecución de Tests**
El proyecto incluye pruebas de integración (Feature Tests) para validar la creación de notas y las restricciones de seguridad por roles.

### Configuración del Entorno de Pruebas:

- **Base de Datos:** Los tests están configurados en `phpunit.xml` para utilizar **MySQL**. Esto evita errores de compatibilidad con drivers como SQLite y asegura que las pruebas reflejen el comportamiento real del servidor.

- **Aislamiento de Datos:** Se utiliza el trait `RefreshDatabase`.

  > **⚠️ Advertencia:** Al ejecutar los tests, la base de datos se reseteará (migraciones y seeders se ejecutarán de nuevo). Se recomienda usar una base de datos dedicada o realizar un respaldo si tiene datos manuales importantes.

Para ejecutar las pruebas:
```bash
php artisan test
```
