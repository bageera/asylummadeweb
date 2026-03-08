# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added - 2026-03-07

#### Track League Domain Model
- **Models**: Season, Event, VehicleClass, EventClass, Team, Driver, Registration, Result, PointsStanding
- **Migrations**: 10 new database migrations for track league entities
- **Relationships**: Full Eloquent relationships between all entities
- **Scopes**: Query scopes for filtering by season, class, status, etc.

#### User Roles & Authentication
- Extended User model with roles: `admin`, `official`, `team_manager`, `driver`
- Added phone, emergency_contact, emergency_phone fields
- Role helper methods: `isAdmin()`, `isOfficial()`, `isTeamManager()`, `isDriver()`
- Middleware: `CheckRole`, `EnsureTeamOwnership`

#### Route Structure
- `routes/public.php` — Public routes (schedule, results, standings, teams, drivers)
- `routes/admin.php` — Admin portal (full CRUD for all entities)
- `routes/team.php` — Team portal (manage drivers, register for events)
- `routes/driver.php` — Driver portal (profile, history, standings)
- Updated `routes/web.php` to include all route files

#### Configuration
- `config/racing.php` — Points systems (standard, F1, NASCAR), bonus points, drop weeks

#### Seeders
- `AdminUserSeeder` — Creates default admin user
- `SeasonSeeder` — Creates 2026 season
- `VehicleClassSeeder` — Creates 8 race classes (Street Stock, Pure Stock, Modified, etc.)
- `DemoDataSeeder` — Creates sample events with classes

#### CI/CD Pipeline
- **`.github/workflows/ci.yml`** — Main CI pipeline
  - PHP lint (Laravel Pint)
  - Static analysis (PHPStan)
  - Frontend lint (ESLint + Prettier)
  - Security scan (Composer audit + Psalm + Trivy)
  - SAST (Semgrep with OWASP/secrets/Laravel rules)
  - Dependency scan (Trivy)
  - Tests (PHPUnit with MySQL)
  - Docker build & push to GHCR (multi-arch)

- **`.github/workflows/security.yml`** — Weekly security scans
  - Trivy vulnerability scan (SARIF to GitHub Security)
  - CodeQL analysis (JS/Python)
  - Dependency review (PRs)
  - GitLeaks secret scanning
  - OpenSSF Scorecard

#### Developer Tooling
- `phpstan.neon` — PHPStan configuration (level 5)
- `psalm.xml` — Psalm configuration with Laravel plugin
- `.eslintrc.json` — ESLint configuration
- `.prettierrc` — Prettier configuration
- `.trivyignore` — Trivy vulnerability ignores
- `.semgrepignore` — Semgrep ignore patterns

#### Composer Scripts
- `composer lint` — Run Pint + PHPStan
- `composer lint:fix` — Auto-fix Pint issues
- `composer security` — Run audit + Psalm

#### NPM Scripts
- `npm run lint` — ESLint check
- `npm run format` — Prettier format
- `npm run format:check` — Prettier check

#### Documentation
- `docs/architecture.md` — Full system architecture documentation

### Changed
- Updated `composer.json` with new dev dependencies (phpstan, psalm)
- Updated `package.json` with ESLint + Prettier
- Updated `.gitignore` with security scan outputs

### UI Design - 2026-03-07

#### Color Scheme (Warm Racing Palette)
- **Primary**: Sunset Orange (`#D45500`) - Energy, Florida warmth
- **Secondary**: Deep Navy (`#1E3A5F`) - Professional, trust
- **Accent**: Amber/Gold (`#F59E0B`) - Highlights, achievements
- **Surfaces**: Warm whites and creams (`#FFFBF5`, `#FEF7ED`)
- **Status**: Racing-inspired colors for success, warning, danger

#### Visual Elements
- Racing stripe gradient accents
- Warm gradient hero sections
- Card hover animations
- Speed line decorations
- Track oval imagery
- Checkered flag patterns

#### Typography
- Improved letter-spacing for headings
- Text gradient utility for emphasis
- Stat number styling for metrics

#### Hero Images (SVG)
- `/assets/images/hero/track-sunset.svg` - Main hero image
- `/assets/images/hero/racing-action.svg` - Action shot
- `/assets/images/hero/pit-area.svg` - Pit scene

#### Icons (SVG)
- `/assets/images/icons/logo.svg` - Brand logo
- `/assets/images/icons/favicon.svg` - Favicon

#### Page Updates
- **Home page**: Complete redesign with stats, classes, CTAs
- **Navigation**: Updated with new color scheme and logo
- **Footer**: Dark navy theme with racing stripe accent

### Database Schema

```
users (extended with role, phone, emergency fields)
├── teams (owner_id → users)
│   └── drivers (team_id → teams)
│       └── registrations (driver_id → drivers)
│           └── results (registration_id → registrations)
│
└── seasons
    └── events (season_id → seasons)
        └── event_classes (event_id, vehicle_class_id)
            └── results (event_id, vehicle_class_id)
                └── points_standings (season_id, vehicle_class_id, driver_id)
```

---

## [0.1.0] - 2026-03-07

### Added
- Initial Laravel 12 project setup
- Blade-only static pages (home, schedule, rules, services, registration, about, contact)
- Docker configuration (Nightforge image)
- Makefile for build commands
- Basic routing with legacy redirects