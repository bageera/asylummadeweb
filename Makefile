SHELL := /bin/bash
.DEFAULT_GOAL := help

# ============================================================
# Asylummade.com — Nightforge Site Image
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
	@echo "asylummade.com — Nightforge Site Image"
	@echo ""
	@echo "Targets:"
	@echo "  build      Build image locally"
	@echo "  push       Build & push multi-arch image"
	@echo "  publish    Alias for push"
	@echo "  inspect    Inspect built image metadata"
	@echo "  clean      Remove local images"

# ============================================================
# Build (local, single-arch)
# ============================================================
.PHONY: build
build:
	@echo "→ Building Nightforge image (local)"
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

# ============================================================
# Push (Nightforge / CI)
# ============================================================
.PHONY: push
push:
	@echo "→ Building & pushing multi-arch Nightforge image"
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

# ============================================================
# Publish (alias)
# ============================================================
.PHONY: publish
publish: push

# ============================================================
# Inspect
# ============================================================
.PHONY: inspect
inspect:
	docker image inspect $(TAG_LATEST) | jq '.[0].Config.Labels'

# ============================================================
# Clean
# ============================================================
.PHONY: clean
clean:
	@echo "→ Removing local images"
	@docker rmi -f $(TAG_SHA) $(TAG_DATE) $(TAG_LATEST) 2>/dev/null || true
	@echo "✓ Done"
