FROM php:8.4-apache

# Instala extensões essenciais para conexão com MariaDB/MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ativa o mod_rewrite do Apache (essencial para rotas de APIs e frameworks)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Altera apenas o DocumentRoot no arquivo padrão do VirtualHost do Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite

# Adiciona o ServerName globalmente para calar o aviso do Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia todo o conteúdo do repositório para dentro do container
COPY . /var/www/html/

# Ajusta permissões de leitura/escrita para o usuário do servidor web
RUN chown -R www-data:www-data /var/www/html