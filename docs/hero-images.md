# Hero Images - Stock Photo Replacement Guide

The hero images are currently placeholders. Replace them with stock photos from Unsplash or similar services.

## Recommended Photo Sources

| Service | URL | License |
|---------|-----|---------|
| Unsplash | https://unsplash.com | Free (no attribution required) |
| Pexels | https://pexels.com | Free (no attribution required) |
| Pixabay | https://pixabay.com | Free |

## Image Specifications

| Image | Size | Aspect Ratio | Location |
|-------|------|--------------|----------|
| Hero (sunset) | 1600×900px | 16:9 | `public/assets/images/hero/track-sunset.jpg` |
| Action shot | 1600×900px | 16:9 | `public/assets/images/hero/racing-action.jpg` |
| Facility | 1600×900px | 16:9 | `public/assets/images/hero/pit-area.jpg` |

## Search Queries

### 1. Hero Image - `track-sunset.jpg`

**Context:** Main banner, top of homepage

**Suggested searches:**
- "youth track and field athlete starting blocks golden hour"
- "sprinter starting position sunset florida"
- "track athlete explosive start dramatic lighting"

**Ideal photo:**
- Wide-angle shot
- Youth athlete in starting position on red 400m track
- Golden hour / sunset lighting
- Florida warmth (orange/pink sky tones)
- Low-angle perspective
- Motion blur for energy

---

### 2. Action Shot - `racing-action.jpg`

**Context:** "Built for athletes of all levels" section

**Suggested searches:**
- "youth track sprinters racing diverse"
- "track and field athletes running competition"
- "sprinters mid race track level view"

**Ideal photo:**
- Dynamic action shot
- Diverse youth and adult athletes (ages 8-adult)
- Mid-race on red track
- Bright sunny Florida afternoon
- Shallow depth of field (background bokeh)
- Track-level perspective

---

### 3. Facility - `pit-area.jpg`

**Context:** "Training Location" section at bottom

**Suggested searches:**
- "track and field facility aerial view"
- "high school track stadium long jump pit"
- "athletic field running track overhead"

**Ideal photo:**
- Overhead or wide-angle view
- Shows long jump sand pit, red oval track
- Green infield grass
- Shot put circle visible
- Late afternoon light
- Clean, welcoming atmosphere
- Optional: a few athletes warming up in background

---

## How to Replace

### Option 1: SVG → JPG/PNG

1. Download photo from Unsplash/Pexels
2. Resize to 1600×900px (or closest 16:9 ratio)
3. Save as:
   - `public/assets/images/hero/track-sunset.jpg`
   - `public/assets/images/hero/racing-action.jpg`
   - `public/assets/images/hero/pit-area.jpg`
4. Update `resources/views/pages/home.blade.php` to reference `.jpg` instead of `.svg`

### Option 2: Keep SVG with Embedded Image

You can also embed a base64-encoded photo into the SVG, but this is not recommended for performance.

---

## Color Palette Reminder

When selecting photos, keep the site's warm Florida palette in mind:

| Color | Hex | Usage |
|-------|-----|-------|
| Sunset Orange | `#D45500` | Primary, buttons |
| Deep Navy | `#1E3A5F` | Secondary, headers |
| Amber/Gold | `#F59E0B` | Accent, highlights |
| Warm Cream | `#FFFBF5` | Background |

Photos with warm tones, red/orange track surfaces, and blue skies will match best.

---

## After Replacing

Run these commands to commit the changes:

```bash
cd /path/to/asylummadeweb
git add public/assets/images/hero/*.jpg
git commit -m "feat: Replace hero placeholders with stock photos"
git push origin main
```

Then update the blade templates to reference `.jpg` files instead of `.svg`.