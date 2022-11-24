# transportes-acme 

## Instalación - Versión 0.3

1) Ajustar el archivo (httpd.conf) para simular un hosvirtual.

```bash
Listen 80
<VirtualHost *:80>
  ServerName transportes-acme.com
  ServerAlias transportes-acme.com
  DocumentRoot "${INSTALL_DIR}/www/transportes-acme/public"
  <Directory "${INSTALL_DIR}/www/transportes-acme/public">
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
```

1) Ajustar el archivo (C:\Windows\System32\drivers\etc\hosts) para agregar la siguiente Linea
```bash
127.0.0.1 cafeterias-knta
```
