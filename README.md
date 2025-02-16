# 📌 IMSS Correspondencia

---

## 🛠️ Software necesario

- **Ubuntu 24.04**
- **Apache 2.4.58**
- **MySQL 8.0.41**
- **PHP 8.3.6**

---

## 🚀 Pasos para levantar el aplicativo

### 1. Ingresar como usuario root
```bash
su
```

### 2. Actualizar el sistema
```bash
apt update && apt upgrade -y
```

### 3. Instalar Apache
```bash
apt install -y apache2
```

### 4. Instalar MySQL
```bash
apt install -y mysql-server
```

### 5. Configurar contraseña del usuario root en MySQL
```bash
sudo mysql -u root -p
use mysql;
update user set plugin='mysql_native_password' where user='root';
flush privileges;
exit;
```

### 6. Instalar PHP
```bash
apt-get install php
```

### 7. Instalar MySQLi
```bash
apt install php-mysqli
```

### 8. Descargar el código fuente del repositorio
```bash
git clone "repo"
```

### 9. Crear la base de datos del aplicativo
```bash
mysql -u root -p
CREATE DATABASE correspondencia;
EXIT;
```
📥 Ahora cargamos la estructura de la base con algunos datos:
```bash
mysql -u root -p correspondencia < Dump20250214.sql
```

### 10. Montar el aplicativo en Apache
📂 Ubicarse dentro de la carpeta descargada del repositorio y copiar el contenido de la carpeta `código` a `/var/www/html/correspondencia`:
```bash
cp -r código/ /var/www/html/correspondencia
```

### 11. Reiniciar Apache
```bash
systemctl restart apache2
```

### 12. Visualizar el aplicativo
🌐 Abrir un navegador y acceder al aplicativo mediante la IP del servidor o, si se está en la misma máquina, usar:
```bash
localhost/correspondencia
