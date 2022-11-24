# cafeterias-knta

## Instalación - Versión 0.3

1) Ajustar el archivo (httpd.conf) para simular un hosvirtual.

```bash
Listen 80
<VirtualHost *:80>
  ServerName cafeterias-knta.com
  ServerAlias cafeterias-knta.com
  DocumentRoot "${INSTALL_DIR}/www/cafeterias-knta.com/public"
  <Directory "${INSTALL_DIR}/www/cafeterias-knta.com/public">
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
