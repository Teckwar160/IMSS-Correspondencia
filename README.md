# 📌 IMSS Correspondencia

---

## 🛠️ Software necesario

- **Ubuntu 24.04**
- **Apache 2.4.58**
- **MySQL 8.0.41**
- **PHP 7.4**

---

## 🚀 Pasos para levantar el aplicativo

### 1. Ingresar como usuario root
```
su
```

### 2. Actualizar el sistema
```
apt update && apt upgrade -y
```

### 3. Instalar Apache
```
apt install -y apache2
```

### 4. Instalar MySQL
```
apt install -y mysql-server
```

### 5. Configurar contraseña del usuario root en MySQL
```
sudo mysql -u root -p
```
```
use mysql;
```
```
update user set plugin='mysql_native_password' where user='root';
```
```
flush privileges;
```
```
exit;
```

### 6. Instalar PHP y MySQLi

Agregamos el repositorio de PHP
```
sudo add-apt-repository ppa:ondrej/php -y
```
```
sudo apt update

```


```
sudo apt install php7.4 php7.4-mysqli -y
```

### 7. Descargar el código fuente del repositorio
```
git clone https://github.com/Teckwar160/IMSS-Correspondencia.git
```

### 8. Crear la base de datos del aplicativo
```
mysql -u root -p
```
```
CREATE DATABASE correspondencia;
```
```
EXIT;
```

📂 Ubicarse dentro de la carpeta descargada del repositorio.
```
cd IMSS-Correspondencia/
```

📥 Ahora cargamos la estructura de la base con algunos datos:
```
mysql -u root -p correspondencia < Dump20250214.sql
```

### 9. Montar el aplicativo en Apache
📂 Copiar el contenido de la carpeta `código` a `/var/www/html/correspondencia`:
```
cp -r Código/ /var/www/html/correspondencia
```

### 10. Reiniciar Apache
```
systemctl restart apache2
```

### 11. Visualizar el aplicativo
🌐 Abrir un navegador y acceder al aplicativo mediante la IP del servidor o, si se está en la misma máquina, usar:
```
localhost/correspondencia
