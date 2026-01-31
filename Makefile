SHELL := /bin/bash
.DEFAULT_GOAL := help

# ============================================================
# Asylummade — Nightforge Image + Local Dev
# ============================================================

REGISTRY ?= ghcr.io
ORG      ?= bageera
IMAGE    := nightforge-sites/asylummade

GIT_SHA     ?= $(shell git rev-parse --short=12 HEAD 2>/dev/null || echo "dev")
BUILD_DATE  := $(shell date -u +%Y%m%d-%H%M%S)
GIT_URL     := $(shell git config --get remote.origin.url)

TAG_SHA     := $(REGISTRY)/$(ORG)/$(IMAGE):$(GIT_SHA)
TAG_DATE    := $(REGISTRY)/$(ORG)/$(IMAGE):$(BUILD_DATE)
TAG_LATEST  := $(REGISTRY)/$(ORG)/$(IMAGE):latest

DOCKERFILE  := docker/nightforge/Dockerfile
PLATFORMS   := linux/amd64,linux/arm64

# ============================================================
# Help
# ============================================================
.PHONY: help
help:
	@echo "asylummade — Nightforge + Local Dev"
	@echo ""
	@echo "Nightforge:"
	@echo "  build        Build Nightforge image locally"
	@echo "  push         Build & push multi-arch image"
	@echo "  publish      Alias for push"
	@echo ""
	@echo "Local Dev:"
	@echo "  up           Start local dev environment"
	@echo "  down         Stop local dev environment"
	@echo "  logs         Tail app logs"
	@echo "  shell        Shell into app container"
	@echo "  artisan      Run artisan command (cmd=...)"
	@echo "  composer     Run composer command (cmd=...)"

# ============================================================
# Nightforge Build
# ============================================================
.PHONY: build
build:
	@echo "→ Building Nightforge image"
	docker build \
		-f $(DOCKERFILE) \
		-t $(TAG_SHA) \
		-t $(TAG_DATE) \
		-t $(TAG_LATEST) \
		--label org.opencontainers.image.title="asylummade.com" \
		--label org.opencontainers.image.revision="$(GIT_SHA)" \
		--label org.opencontainers.image.created="$(BUILD_DATE)" \
		--label org.opencontainers.image.source="$(GIT_URL)" \
		.
	@echo "✓ Built $(TAG_LATEST)"

.PHONY: push
push:
	@echo "→ Building & pushing Nightforge image"
	docker buildx build \
		--platform $(PLATFORMS) \
		-f $(DOCKERFILE) \
		-t $(TAG_SHA) \
		-t $(TAG_DATE) \
		-t $(TAG_LATEST) \
		--label org.opencontainers.image.title="asylummade.com" \
		--label org.opencontainers.image.revision="$(GIT_SHA)" \
		--label org.opencontainers.image.created="$(BUILD_DATE)" \
		--label org.opencontainers.image.source="$(GIT_URL)" \
		--push \
		.

.PHONY: publish
publish: push

# ============================================================
# Local Development (docker-compose)
# ============================================================
.PHONY: up down logs shell artisan composer

up:
	@echo "→ Starting local dev environment"
	docker compose up -d --build
	@echo "✓ App available at http://localhost:9000"

down:
	@echo "→ Stopping local dev environment"
	docker compose down

logs:
	docker compose logs -f app

shell:
	docker compose exec app sh

artisan:
	docker compose exec app php artisan $(cmd)

composer:
	docker compose exec app composer $(cmd)
