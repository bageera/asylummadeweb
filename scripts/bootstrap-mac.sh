#!/usr/bin/env bash
set -e

echo "🏁 asylummadetrack — macOS bootstrap"
echo "-----------------------------------"

# --------------------------------------------------
# Check OS
# --------------------------------------------------
if [[ "$(uname)" != "Darwin" ]]; then
  echo "❌ This bootstrap script is for macOS only."
  exit 1
fi

# --------------------------------------------------
# Check Homebrew
# --------------------------------------------------
if ! command -v brew >/dev/null 2>&1; then
  echo "🍺 Homebrew not found. Install from https://brew.sh"
  exit 1
fi

echo "✅ Homebrew detected"

# --------------------------------------------------
# Install Docker (if needed)
# --------------------------------------------------
if ! command -v docker >/dev/null 2>&1; then
  echo "🐳 Installing Docker Desktop"
  brew install --cask docker
  echo "⚠️ Please start Docker Desktop and re-run this script."
  exit 0
fi

echo "✅ Docker detected"

# --------------------------------------------------
# Verify Docker is running
# --------------------------------------------------
if ! docker info >/dev/null 2>&1; then
  echo "⚠️ Docker is installed but not running."
  echo "Please start Docker Desktop and re-run this script."
  exit 1
fi

echo "✅ Docker is running"

# --------------------------------------------------
# Laravel sanity check
# --------------------------------------------------
if [ ! -f artisan ]; then
  echo "❌ Laravel not detected (artisan missing)."
  echo "Run this script from the project root."
  exit 1
fi

echo "✅ Laravel project detected"

# --------------------------------------------------
# Environment file
# --------------------------------------------------
if [ ! -f .env ]; then
  echo "📝 Creating .env from .env.example"
  cp .env.example .env
fi

# --------------------------------------------------
# Start local dev environment
# --------------------------------------------------
echo "🚀 Starting local development environment"
docker compose up -d --build

echo ""
echo "✅ Bootstrap complete"
echo "-----------------------------------"
echo "🌐 Local site: http://localhost:9000"
echo ""
echo "Common commands:"
echo "  make up"
echo "  make logs"
echo "  make artisan cmd=\"route:list\""
echo ""
