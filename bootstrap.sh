# --------------------------------------------------
# Laravel project initialization (safe for non-empty repo)
# --------------------------------------------------
if [ ! -f artisan ]; then
  echo "📦 Laravel not detected — initializing via temp directory"

  TMP_DIR=".laravel-tmp"

  rm -rf "$TMP_DIR"

  docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$PWD:/app" \
    -w /app \
    composer:2 \
    composer create-project laravel/laravel "$TMP_DIR" --no-interaction

  echo "📂 Copying Laravel framework into project root"
  rsync -a "$TMP_DIR"/ ./

  rm -rf "$TMP_DIR"
else
  echo "✅ Laravel already present"
fi

