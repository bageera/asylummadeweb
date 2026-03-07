# AsylumMadeWeb — Track League Architecture

## Overview

Track league management system for Riverview, FL. Supports:
- Season and event management
- Driver and team registration
- Race results and points tracking
- Admin portal for league operations
- Team portal for self-service management

---

## Domain Models

### Core Entities

| Model | Purpose | Relationships |
|-------|---------|---------------|
| `Season` | League year/season | HasMany: Events, Points |
| `Event` | Individual race event | BelongsTo: Season, HasMany: Registrations, Results |
| `VehicleClass` | Race class (e.g., Street Stock, Modified) | HasMany: Registrations, Results |
| `Team` | Racing team | HasMany: Drivers, BelongsToMany: Events |
| `Driver` | Individual driver | BelongsTo: Team (optional), HasMany: Registrations, Results |
| `Registration` | Event signup (driver + car) | BelongsTo: Event, Driver, VehicleClass |
| `Result` | Race finish position | BelongsTo: Event, Driver, VehicleClass |
| `Points` | Championship standings entry | BelongsTo: Season, Driver, VehicleClass |

### User Roles

| Role | Capabilities |
|------|--------------|
| `admin` | Full system access, manage all entities |
| `official` | Enter results, manage events, view registrations |
| `team_manager` | Manage team profile, register drivers for events |
| `driver` | View own results, standings, profile |

---

## Database Schema

### Users (extended)

```sql
ALTER TABLE users ADD COLUMN role ENUM('admin', 'official', 'team_manager', 'driver') DEFAULT 'driver';
ALTER TABLE users ADD COLUMN phone VARCHAR(20) NULL;
ALTER TABLE users ADD COLUMN emergency_contact VARCHAR(100) NULL;
ALTER TABLE users ADD COLUMN emergency_phone VARCHAR(20) NULL;
```

### Teams

```sql
CREATE TABLE teams (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    owner_id BIGINT NULL, -- User who manages the team
    city VARCHAR(100) NULL,
    state VARCHAR(2) NULL,
    established_year INT NULL,
    primary_contact_email VARCHAR(255) NULL,
    primary_contact_phone VARCHAR(20) NULL,
    logo_path VARCHAR(255) NULL,
    bio TEXT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE SET NULL
);
```

### Drivers

```sql
CREATE TABLE drivers (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NULL, -- Link to user account
    team_id BIGINT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    nickname VARCHAR(50) NULL,
    hometown VARCHAR(100) NULL,
    license_number VARCHAR(50) NULL,
    license_expires DATE NULL,
    medical_expires DATE NULL,
    bio TEXT NULL,
    profile_photo_path VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
);
```

### Seasons

```sql
CREATE TABLE seasons (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL, -- "2026 Season"
    slug VARCHAR(50) UNIQUE NOT NULL, -- "2026"
    year INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    is_current BOOLEAN DEFAULT FALSE,
    points_system VARCHAR(50) DEFAULT 'standard', -- standard, f1, custom
    status ENUM('upcoming', 'active', 'completed') DEFAULT 'upcoming',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Vehicle Classes

```sql
CREATE TABLE vehicle_classes (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) UNIQUE NOT NULL,
    description TEXT NULL,
    rules_url VARCHAR(255) NULL,
    min_weight_lbs INT NULL,
    engine_rules TEXT NULL,
    safety_requirements TEXT NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Events

```sql
CREATE TABLE events (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    season_id BIGINT NOT NULL,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NULL,
    event_date DATE NOT NULL,
    gates_open_time TIME NULL,
    practice_start_time TIME NULL,
    racing_start_time TIME NULL,
    admission_general DECIMAL(8,2) NULL,
    admission_pit DECIMAL(8,2) NULL,
    admission_kids DECIMAL(8,2) NULL,
    track_condition VARCHAR(50) NULL,
    weather_notes TEXT NULL,
    special_notes TEXT NULL,
    status ENUM('scheduled', 'registration_open', 'registration_closed', 'in_progress', 'completed', 'cancelled', 'postponed') DEFAULT 'scheduled',
    results_posted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (season_id) REFERENCES seasons(id) ON DELETE CASCADE
);
```

### Event Classes (Pivot)

```sql
CREATE TABLE event_classes (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    event_id BIGINT NOT NULL,
    vehicle_class_id BIGINT NOT NULL,
    laps INT DEFAULT 20,
    purse DECIMAL(10,2) NULL,
    entry_fee DECIMAL(8,2) DEFAULT 0,
    heat_race BOOLEAN DEFAULT FALSE,
    feature_laps INT NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_class_id) REFERENCES vehicle_classes(id) ON DELETE CASCADE,
    UNIQUE(event_id, vehicle_class_id)
);
```

### Registrations

```sql
CREATE TABLE registrations (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    event_id BIGINT NOT NULL,
    driver_id BIGINT NOT NULL,
    vehicle_class_id BIGINT NOT NULL,
    team_id BIGINT NULL,
    car_number INT NOT NULL,
    car_make VARCHAR(50) NULL,
    car_model VARCHAR(50) NULL,
    car_year INT NULL,
    car_color VARCHAR(30) NULL,
    transponder_id VARCHAR(50) NULL,
    pit_pass_number VARCHAR(50) NULL,
    checked_in BOOLEAN DEFAULT FALSE,
    check_in_time TIMESTAMP NULL,
    paid BOOLEAN DEFAULT FALSE,
    payment_method VARCHAR(20) NULL,
    payment_reference VARCHAR(100) NULL,
    withdrawal_reason TEXT NULL,
    status ENUM('registered', 'checked_in', 'withdrawn', 'no_show') DEFAULT 'registered',
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_class_id) REFERENCES vehicle_classes(id),
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL,
    UNIQUE(event_id, driver_id, vehicle_class_id)
);
```

### Results

```sql
CREATE TABLE results (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    event_id BIGINT NOT NULL,
    vehicle_class_id BIGINT NOT NULL,
    driver_id BIGINT NOT NULL,
    registration_id BIGINT NULL,
    finish_position INT NOT NULL,
    starting_position INT NULL,
    laps_completed INT NULL,
    laps_led INT NULL,
    finishing_time VARCHAR(20) NULL,
    interval_ahead VARCHAR(20) NULL,
    interval_leader VARCHAR(20) NULL,
    best_lap_time VARCHAR(20) NULL,
    best_lap_number INT NULL,
    average_speed DECIMAL(6,2) NULL,
    points_awarded INT DEFAULT 0,
    bonus_points INT DEFAULT 0,
    penalty_points INT DEFAULT 0,
    total_points INT DEFAULT 0,
    finish_status ENUM('running', 'finished', 'dnf', 'dns', 'dq') DEFAULT 'finished',
    dnq BOOLEAN DEFAULT FALSE,
    disqualification_reason TEXT NULL,
    notes TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_class_id) REFERENCES vehicle_classes(id),
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE CASCADE,
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE SET NULL
);
```

### Points Standings

```sql
CREATE TABLE points_standings (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    season_id BIGINT NOT NULL,
    vehicle_class_id BIGINT NOT NULL,
    driver_id BIGINT NOT NULL,
    events_participated INT DEFAULT 0,
    events_counted INT DEFAULT 0, -- For drop weeks
    wins INT DEFAULT 0,
    top5 INT DEFAULT 0,
    top10 INT DEFAULT 0,
    poles INT DEFAULT 0,
    laps_led INT DEFAULT 0,
    total_points INT DEFAULT 0,
    adjusted_points INT DEFAULT 0, -- After drops
    position INT DEFAULT 0,
    previous_position INT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (season_id) REFERENCES seasons(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_class_id) REFERENCES vehicle_classes(id),
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE CASCADE,
    UNIQUE(season_id, vehicle_class_id, driver_id)
);
```

---

## Routes

### Public Routes

```
GET  /                          → Home
GET  /schedule                  → Event list (all seasons)
GET  /schedule/{season}         → Event list for season
GET  /event/{slug}              → Event detail
GET  /results                   → Results archive
GET  /results/{season}          → Season results
GET  /results/{season}/{event}  → Event results
GET  /standings                 → Current season standings
GET  /standings/{season}        → Season standings
GET  /standings/{season}/{class}→ Class standings
GET  /rules                     → Rules overview
GET  /rules/{class}             → Class-specific rules
GET  /teams                     → Team directory
GET  /teams/{slug}              → Team profile
GET  /drivers                   → Driver directory
GET  /drivers/{id}              → Driver profile
GET  /registration              → Registration info
GET  /about                     → About page
GET  /contact                   → Contact info
```

### Admin Routes (prefix: `/admin`)

```
# Dashboard
GET  /admin                     → Admin dashboard

# Seasons
GET  /admin/seasons             → Season list
GET  /admin/seasons/create      → Create season form
POST /admin/seasons             → Store season
GET  /admin/seasons/{id}/edit   → Edit season form
PUT  /admin/seasons/{id}        → Update season
DELETE /admin/seasons/{id}      → Delete season

# Events
GET  /admin/events              → Event list
GET  /admin/events/create       → Create event form
POST /admin/events              → Store event
GET  /admin/events/{id}/edit    → Edit event form
PUT  /admin/events/{id}         → Update event
DELETE /admin/events/{id}       → Delete event
GET  /admin/events/{id}/classes → Manage event classes
POST /admin/events/{id}/classes → Add class to event
DELETE /admin/events/{id}/classes/{class} → Remove class

# Vehicle Classes
GET  /admin/classes             → Class list
GET  /admin/classes/create      → Create class form
POST /admin/classes             → Store class
GET  /admin/classes/{id}/edit   → Edit class form
PUT  /admin/classes/{id}        → Update class
DELETE /admin/classes/{id}      → Delete class

# Registrations
GET  /admin/registrations                 → All registrations
GET  /admin/events/{id}/registrations     → Event registrations
POST /admin/events/{id}/registrations     → Add registration
PUT  /admin/registrations/{id}            → Update registration
DELETE /admin/registrations/{id}          → Remove registration
POST /admin/registrations/{id}/checkin    → Check in driver

# Results
GET  /admin/results                        → Results list
GET  /admin/events/{id}/results            → Event results entry
POST /admin/events/{id}/results            → Save results
POST /admin/events/{id}/results/import     → Import from CSV/timing
POST /admin/events/{id}/results/publish    → Publish results

# Teams
GET  /admin/teams               → Team list
GET  /admin/teams/{id}          → Team detail
PUT  /admin/teams/{id}          → Update team
DELETE /admin/teams/{id}        → Delete team

# Drivers
GET  /admin/drivers             → Driver list
GET  /admin/drivers/{id}        → Driver detail
PUT  /admin/drivers/{id}        → Update driver
DELETE /admin/drivers/{id}      → Delete driver

# Users
GET  /admin/users               → User list
PUT  /admin/users/{id}/role     → Update user role
```

### Team Portal Routes (prefix: `/team`)

```
# Auth required, role: team_manager

GET  /team                      → Team dashboard
GET  /team/profile              → Team profile edit
PUT  /team/profile              → Update team profile

# Drivers (team's drivers)
GET  /team/drivers              → Team driver list
GET  /team/drivers/create       → Add driver form
POST /team/drivers              → Add driver to team
GET  /team/drivers/{id}/edit    → Edit driver
PUT  /team/drivers/{id}         → Update driver
DELETE /team/drivers/{id}       → Remove driver from team

# Registrations
GET  /team/registrations                  → Team's registrations
GET  /team/events/{id}/register           → Register for event
POST /team/events/{id}/register           → Submit registration
DELETE /team/registrations/{id}           → Withdraw registration

# Results & Standings
GET  /team/results              → Team's results
GET  /team/standings            → Team standings
```

### Driver Portal Routes (prefix: `/driver`)

```
# Auth required, role: driver

GET  /driver                    → Driver dashboard
GET  /driver/profile            → Driver profile edit
PUT  /driver/profile            → Update profile
GET  /driver/history            → Race history
GET  /driver/standings          → Personal standings
```

### API Routes (prefix: `/api/v1`)

```
# Public
GET  /api/v1/seasons            → Season list
GET  /api/v1/seasons/{slug}/events → Events for season
GET  /api/v1/events/{slug}      → Event detail
GET  /api/v1/events/{slug}/results → Event results
GET  /api/v1/standings/{season}/{class} → Standings

# Admin (auth, admin role)
POST /api/v1/events/{id}/results → Import results
```

---

## Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── SeasonController.php
│   │   │   ├── EventController.php
│   │   │   ├── VehicleClassController.php
│   │   │   ├── RegistrationController.php
│   │   │   ├── ResultController.php
│   │   │   ├── TeamController.php
│   │   │   ├── DriverController.php
│   │   │   └── UserController.php
│   │   ├── Team/
│   │   │   ├── DashboardController.php
│   │   │   ├── ProfileController.php
│   │   │   ├── DriverController.php
│   │   │   └── RegistrationController.php
│   │   ├── Driver/
│   │   │   ├── DashboardController.php
│   │   │   └── ProfileController.php
│   │   ├── Public/
│   │   │   ├── ScheduleController.php
│   │   │   ├── EventController.php
│   │   │   ├── ResultsController.php
│   │   │   ├── StandingsController.php
│   │   │   ├── TeamController.php
│   │   │   └── DriverController.php
│   │   └── Controller.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       ├── TeamManagerMiddleware.php
│       └── DriverMiddleware.php
├── Models/
│   ├── User.php
│   ├── Season.php
│   ├── Event.php
│   ├── VehicleClass.php
│   ├── Team.php
│   ├── Driver.php
│   ├── Registration.php
│   ├── Result.php
│   ├── PointsStanding.php
│   └── EventClass.php
└── Policies/
    ├── SeasonPolicy.php
    ├── EventPolicy.php
    ├── TeamPolicy.php
    └── DriverPolicy.php

database/
├── migrations/
│   ├── 2026_03_07_000001_add_role_to_users.php
│   ├── 2026_03_07_000002_create_teams_table.php
│   ├── 2026_03_07_000003_create_drivers_table.php
│   ├── 2026_03_07_000004_create_seasons_table.php
│   ├── 2026_03_07_000005_create_vehicle_classes_table.php
│   ├── 2026_03_07_000006_create_events_table.php
│   ├── 2026_03_07_000007_create_event_classes_table.php
│   ├── 2026_03_07_000008_create_registrations_table.php
│   ├── 2026_03_07_000009_create_results_table.php
│   └── 2026_03_07_000010_create_points_standings_table.php
└── seeders/
    ├── SeasonSeeder.php
    ├── VehicleClassSeeder.php
    ├── AdminUserSeeder.php
    └── DemoDataSeeder.php

resources/views/
├── layouts/
│   ├── app.blade.php
│   ├── admin.blade.php
│   └── team.blade.php
├── components/
│   ├── nav.blade.php
│   ├── admin-nav.blade.php
│   ├── team-nav.blade.php
│   └── standings-table.blade.php
├── pages/
│   ├── home.blade.php
│   ├── schedule.blade.php
│   ├── rules.blade.php
│   ├── services.blade.php
│   ├── registration.blade.php
│   ├── about.blade.php
│   └── contact.blade.php
├── public/
│   ├── schedule/
│   ├── results/
│   ├── standings/
│   ├── teams/
│   └── drivers/
├── admin/
│   ├── dashboard.blade.php
│   ├── seasons/
│   ├── events/
│   ├── classes/
│   ├── registrations/
│   ├── results/
│   ├── teams/
│   ├── drivers/
│   └── users/
├── team/
│   ├── dashboard.blade.php
│   ├── profile.blade.php
│   ├── drivers/
│   └── registrations/
└── driver/
    ├── dashboard.blade.php
    ├── profile.blade.php
    └── history.blade.php
```

---

## Points Systems

### Standard (default)

| Position | Points |
|----------|--------|
| 1st | 25 |
| 2nd | 22 |
| 3rd | 20 |
| 4th | 18 |
| 5th | 16 |
| 6th | 14 |
| 7th | 12 |
| 8th | 10 |
| 9th | 8 |
| 10th | 6 |
| 11th | 4 |
| 12th | 2 |
| 13th+ | 1 |

Bonus points:
- Pole position: +1
- Leading a lap: +1
- Most laps led: +1

---

## Implementation Phases

### Phase 1: Core Models & Migrations
- User role extension
- Teams, Drivers, Seasons, VehicleClasses
- Events, EventClasses
- Basic admin CRUD

### Phase 2: Registration System
- Registration model
- Event registration flow
- Team portal registration
- Admin registration management

### Phase 3: Results & Points
- Results model
- Results entry interface
- Points calculation
- Standings display

### Phase 4: Public Views
- Schedule with dynamic data
- Results archive
- Standings pages
- Team/Driver profiles

### Phase 5: Advanced Features
- API endpoints
- Timing system integration
- Email notifications
- Mobile-responsive design

---

## CI/CD Pipeline

### GitHub Actions Workflows

#### `.github/workflows/ci.yml`
Runs on push to main/develop and PRs:

| Job | Description |
|-----|-------------|
| `lint-php` | Laravel Pint (code style) + PHPStan (static analysis) |
| `lint-frontend` | ESLint + Prettier for JS/Vue |
| `security` | Composer audit + Psalm security analysis + Trivy secret scan |
| `sast-semgrep` | Semgrep SAST with security rulesets |
| `deps-scan` | Trivy vulnerability scanner for dependencies |
| `test` | PHPUnit tests with MySQL service |
| `build` | Build & push Docker image to GHCR (main only) |

#### `.github/workflows/security.yml`
Weekly security scans:

| Job | Description |
|-----|-------------|
| `trivy-scan` | Vulnerability scan + SARIF upload to GitHub Security |
| `codeql` | CodeQL analysis for JS/Python |
| `dependency-review` | PR dependency review |
| `secrets-scan` | GitLeaks secret scanning |
| `scorecard` | OpenSSF Scorecard |

### Local Commands

```bash
# PHP linting
composer lint          # Run Pint + PHPStan
composer lint:fix      # Fix Pint issues

# Security
composer security      # Run audit + Psalm

# Frontend
npm run lint           # ESLint
npm run format         # Prettier
```

### Configuration Files

| File | Purpose |
|------|---------|
| `phpstan.neon` | PHPStan configuration |
| `psalm.xml` | Psalm configuration |
| `.eslintrc.json` | ESLint configuration |
| `.prettierrc` | Prettier configuration |
| `.trivyignore` | Trivy vulnerability ignores |
| `.semgrepignore` | Semgrep ignore patterns |

### Security Tools

| Tool | Focus |
|------|-------|
| **Laravel Pint** | Code style |
| **PHPStan** | Static analysis |
| **Psalm** | Security analysis |
| **Semgrep** | SAST (OWASP, secrets, Laravel rules) |
| **Trivy** | Container + dependency vulnerabilities |
| **GitLeaks** | Secret detection |
| **CodeQL** | GitHub security analysis |
| **OpenSSF Scorecard** | Supply chain security