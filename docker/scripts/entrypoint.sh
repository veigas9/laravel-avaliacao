#!/bin/sh

set -e

DB_FILE="/var/www/database/database.sqlite"
VENDOR_AUTOLOAD="/var/www/vendor/autoload.php"

echo "🔍 Verificando banco SQLite..."

if [ ! -f "$DB_FILE" ]; then
    echo "📦 Criando banco SQLite..."
    mkdir -p /var/www/database
    touch $DB_FILE
    chown www-data:www-data $DB_FILE
else
    echo "✅ Banco SQLite já existe."
fi

if [ ! -f "$VENDOR_AUTOLOAD" ]; then
    echo "📦 Instalando dependencias PHP (composer install)..."
    composer install --no-interaction --prefer-dist
else
    echo "✅ Dependencias PHP ja estao instaladas."
fi

echo "🚀 Iniciando Laravel..."
exec "$@"
