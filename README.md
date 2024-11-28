# Proyecto de Gestión para Salón de Belleza

Este proyecto está diseñado para la gestión de un **salón de belleza** y abarca funcionalidades como la gestión de usuarios, clientes, servicios, productos (con categorías), reservas de citas, ventas de servicios y productos, generación de reportes y gestión documental.

**IMPORTANTE:**  
Los cambios deben hacerse siempre en la rama **`ramaPrueba`** del proyecto.

---

## 🔧 **Ambiente de Trabajo**

- **XAMPP** (preferentemente) con **MySQL**
- **PHP 8.2.18**  
- Editor de código recomendado: **VSCode**
- **Base de datos**: Importar el archivo `sandra1.sql` para la base de datos (db/ sandra1.sql)
- **Debugging**: Usar **Firefox** para depuración, pero **priorizar la compatibilidad con Chrome y Safari**
- Uso de **Composer** y, en el futuro, **Laravel** para migraciones

---

## 🖥️ **Estructura del Proyecto**

El proyecto sigue el patrón de diseño **MVC** (Modelo-Vista-Controlador) con **PHP puro**.

Partes clave:

### **Enrutador - `index.php`**
El archivo `index.php` se encarga de **redirigir** las solicitudes al controlador correspondiente y gestionar la vista y los modelos que se necesiten.

---

### **Modelo (`models/`)**

- **Responsabilidad**: Realiza las consultas a la base de datos.
- **Función**: Unifica tablas y columnas según la necesidad de la solicitud, utilizando sentencias SQL.
- **Ejemplo**: Si se necesita obtener una lista de servicios disponibles, el modelo realiza la consulta correspondiente y la retorna al controlador.

---

### **Vista (`views/`)**

- **Responsabilidad**: Muestra el contenido de las páginas web.
- **Función**: Una vez que el controlador ha gestionado la solicitud, la vista se encarga de presentar los datos al usuario.
- **Ejemplo**: `layout.php` es la estructura principal que se utiliza como "marco" y `home.php` es la página principal de inicio.

---

### **Controlador (`controllers/`)**

- **Responsabilidad**: Maneja la lógica del flujo de la aplicación.
- **Función**: Cada controlador tiene métodos que procesan las solicitudes del usuario, se comunican con el modelo y envían los datos a la vista.
- **Ejemplo**: `WelcomeController.php` gestiona la verificación de la sesión y luego entrega las vistas de `layout.php` y `home.php`.

---

## 📁 **Estructura de Carpetas**

### **`db/` (base de datos)**

- **`database.php`**: Contiene la conexión a la base de datos. Este proyecto está diseñado para ser ejecutado en **XAMPP** con **MySQL**. Apache maneja las solicitudes HTTP.

---

### **`ajax/`**

- **Función**: Maneja el código **AJAX** para hacer que la experiencia del usuario sea dinámica.
- **Propósito**: Se utiliza para el manejo de formularios, modales y consultas JSON para una manipulación sencilla de los datos sin recargar la página.

---

### **`assets/` (Recursos estáticos)**

- **Contenido**: Aquí se almacenan todos los **complementos**, **gráficos** (imágenes) y **librerías** como:
  - **Modernizr**  
  - **jQuery**  
  - **Bootstrap**
- Los estilos CSS se incluyen en esta carpeta.
- En la carpeta **`pages/`** se encuentran archivos **JavaScript** que contienen la lógica de las librerías, descargados para trabajarlos de manera local.
  - **Archivo clave**: `jquery.calendar.js` — Maneja toda la lógica de **FullCalendar**, el calendario de citas.

---

### **`plugins/`**

- **Función**: Almacena el código necesario para las librerías y otros **assets**. 
- **Nota**: No se deben realizar cambios aquí.

---

### **`uploads/`**

- **Función**: Contiene los archivos subidos por **clientes** y **empleados**.
  - Los archivos se almacenan por **ID**, lo que asegura que estén asociados con el correspondiente cliente o empleado.

---

### **`vendor/`**

- **Contenido**: Aquí se almacenan las dependencias de **Composer** y sus librerías.
  - Uso de **mypdf** para generar reportes en formato **PDF**.
- **Nota**: Se debe modificar esta carpeta solo cuando se complete correctamente el módulo de ventas.

---

## 📅 **Notas Adicionales**

1. **Desarrollo del módulo de ventas**: Se integrará el módulo de ventas completo para permitir la venta de productos y servicios, lo que incluirá la modificación de ajaxVentas.js del proyecto, permitiendo un formulario de venta dinamico.
2. **Compatibilidad de Navegadores**: Aunque se recomienda hacer pruebas en **Firefox**, se debe priorizar la compatibilidad con **Chrome** y **Safari**, ya que son los navegadores más utilizados.

---
## 📅 **CREDENCIAL DE ACCESO**

user: juan.peraza@donmaiz.com
pass: 1000240844

Toca resolver tambien que al crear un  uveo empleado (usuario) este le permita en el form elegir su contraseña, y que esta se hashee al hacer el insert en la base de datos.



**¡Solo el que codea gana billete!**  
¡La buena y a programar!
