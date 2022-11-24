# transportes-acme 

## Instalación - Versión 0.3

1) Ajustar el archivo (httpd.conf) para hacer un hosvirtual simular un servidor web localmente.

```bash
Listen 80
<VirtualHost *:80>
  ServerName transportes-acme.com
  ServerAlias transportes-acme.com
  DocumentRoot "${INSTALL_DIR}/www/transportes-acme/public"
  <Directory "${INSTALL_DIR}/www/transportes-acme/public">
    AllowOverride All
    #Require local
  </Directory>
</VirtualHost>
```
