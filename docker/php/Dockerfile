FROM php:8.2-fpm

# =========================
# ARGs para UID/GID (WSL)
# =========================
ARG UID=1000
ARG GID=1000

# =========================
# Cria usuário compatível com o host
# =========================
RUN groupadd -g ${GID} laravel \
    && useradd -u ${UID} -g laravel -m laravel

# =========================
# Dependências do sistema e extensões PHP
# =========================
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    libicu-dev \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# =========================
# Composer
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# Diretório de trabalho
# =========================
WORKDIR /var/www

# =========================
# EntryPoint
# =========================
COPY docker/scripts/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# =========================
# Ajusta permissões (IMPORTANTE)
# =========================
RUN chown -R laravel:laravel /var/www

# =========================
# Troca para o usuário correto (CRÍTICO)
# =========================
USER laravel

ENTRYPOINT ["entrypoint.sh"]