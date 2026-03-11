# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added - 2026-03-11

#### User Authentication & Profile
- **Social Login Fields**: `google_id`, `facebook_id`, `avatar` columns for OAuth integration
- **Profile Fields**: `date_of_birth`, `address`, `city`, `state`, `zip` for complete user profiles
- **Profile Settings Page**: `/profile` route for users to update their information
- **User Dashboard**: `/dashboard` landing page after login with role badges and quick access
- **Navigation**: Login/logout button in navbar, role-based admin links

#### Role System Update
- **New Role**: `super_user` added above `admin` in hierarchy
- **Updated Hierarchy**: `super_user` > `admin` > `official` > `team_owner` > `driver`
- **Role Badges**: Color-coded badges in dashboard (Super User=danger, Admin=primary, Official=info, Team Owner=success, Driver=secondary)

#### Admin CRUD Complete
- **Events**: Full CRUD with vehicle class selection, timing, admission prices
- **Seasons**: Full CRUD for season management
- **Teams**: Full CRUD with team profile management
- **Users**: Full CRUD with role assignment
- **Sponsors**: Full CRUD with tier system (Bronze/Silver/Gold/Platinum) and event sponsorship
- **Waiver Templates**: Full CRUD for liability waivers with versioning and signed waiver tracking

#### Sponsor Management System
- **Sponsor Model**: Tier-based sponsorship (1-4: Bronze/Platinum)
- **Event Sponsorship**: Pivot table for event-specific sponsorships
- **Sponsorship Types**: general, heat, feature, trophy
- **Admin Views**: Index, create, edit with logo upload support

#### Waiver Management System
- **WaiverTemplate Model**: Reusable waiver templates with versioning
- **Waiver Model**: Signed waivers with signature capture, IP tracking, expiry
- **Features**: Parent signature for minors, validity period, CSV export
- **Admin Views**: Index, create, edit, signed waivers list

#### Media Storage System
- **Media Model**: Polymorphic file attachments (`mediable`)
- **Collections**: profile, logo, gallery, sponsor, document
- **Features**: Image dimensions metadata, file size tracking, S3/local disk support

#### Payment Integration (Stripe Ready)
- **Payment Model**: Payment records with Stripe integration hooks
- **PaymentMethod Model**: Saved payment methods for users
- **Refund Model**: Payment refund tracking
- **Status Flow**: pending → processing → succeeded/failed/refunded
- **Polymorphic Payable**: Payments can be attached to any model

#### Notification System
- **NotificationTemplate Model**: Email/notification templates with variables
- **NotificationSetting Model**: User preferences per channel/type
- **Notification Model**: Database notifications with channel support

#### Public Routes
- **Schedule**: Event schedule with registration status
- **Results**: Race results by event and class
- **Standings**: Championship standings

#### Database Migrations
- `create_sponsors_table` — Sponsor management with tier system
- `create_waivers_table` — Waiver templates + signed waivers
- `create_media_table` — Polymorphic media attachments
- `create_payments_table` — Payment + PaymentMethod + Refund
- `add_social_fields_to_users` — Social login + profile fields
- `create_notifications_table` — Notification templates + settings
- `add_super_user_role` — Super user role migration

#### Testing
- **Unit Tests**: SponsorTest, PaymentTest, WaiverTest, MediaTest
- **Feature Tests**: AdminSponsorTest (authorization + CRUD)
- **Factories**: SponsorFactory, WaiverTemplateFactory with states

### Changed - 2026-03-11

#### Role Migration Fix
- Removed duplicate `create_registrations_table` migration
- Fixed `User::registrations()` relationship to use `driver_id` instead of `user_id`

#### Styling Updates
- **Profile Page**: Converted from Tailwind CSS to Bootstrap 5
- **Dashboard Page**: Updated to Bootstrap 5 with site-consistent styling
- **Admin Views**: All admin CRUD views use Bootstrap 5 components

#### Admin Routes
- Updated team routes from `team_manager` to `team_owner` role

### Database Schema (Updated)

```
users (extended with social login + profile fields)
├── teams (owner_id → users)
│   └── drivers (team_id → teams)
│       └── registrations (driver_id → drivers)
│           └── results (registration_id → registrations)
│
├── payment_methods (user_id → users)
├── payments (user_id → users, payable polymorphic)
│   └── refunds (payment_id → payments)
├── media (mediable polymorphic)
├── waivers (user_id → users, waiver_template_id → templates)
│   └── waiver_templates
├── notification_settings (user_id → users)
└── notifications (notifiable polymorphic)

sponsors (tier-based)
└── event_sponsor (pivot: event_id, sponsor_id)

seasons
└── events (season_id → seasons)
    ├── event_sponsor (sponsor_id → sponsors)
    ├── event_classes (event_id, vehicle_class_id)
    │   └── results (event_id, vehicle_class_id)
    └── registrations (event_id → events)
        └── results (registration_id → registrations)

vehicle_classes (standalone)
└── event_classes (vehicle_class_id → vehicle_classes)
```

---

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
- `VehicleClassSeeder` — Creates 18 track & field events (sprints, distance, hurdles, jumps, throws, relays)
- `DemoDataSeeder` — Creates sample meets with events

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

---

## [0.1.0] - 2026-03-07

### Added
- Initial Laravel 12 project setup
- Blade-only static pages (home, schedule, rules, services, registration, about, contact)
- Docker configuration (Nightforge image)
- Makefile for build commands
- Basic routing with legacy redirects