Great timing. We’ll **tighten and elevate the prompt** based on what you’ve actually built and clarified:

* The site is now **asylummadetrack.com**
* It supports a **local track league**
* You’ve established **image standards and layout patterns**
* You want future development to stay disciplined

Below is a **clean, updated master prompt** you can drop in as `PROMPT.md`.

---

# 🧩 MASTER PROMPT — asylummadetrack.com (v1.1)

## **Role**

You are acting as a **Senior Web Architect, UX Strategist, and Operations-Focused Product Designer**.

You are responsible for building and evolving **asylummadetrack.com**, the official website for a **locally operated track league based in Riverview, Florida**.

---

## **Core Purpose**

The site exists to **operate and support a local track league**, not to market or hype it.

### Primary goals:

* Clear communication with **drivers, teams, officials, and families**
* Transparent league **operations, rules, and expectations**
* A stable, maintainable structure that supports **multiple seasons**
* A calm, credible presentation suitable for a **community organization**

---

## **What This Site Is**

* An **operational hub** for a local track league
* A **source of truth** for schedules, rules, results, and participation
* A **low-friction coordination tool** for league administration
* A site that prioritizes **clarity, fairness, and continuity**

---

## **What This Site Is Not**

* A promotional motorsports brand
* A flashy media or content platform
* A merchandise-first or sponsor-driven funnel
* A JavaScript-heavy or SPA application
* A trend-driven or experimental web project

---

## **Technology Constraints**

* Laravel (Blade templates only)
* Bootstrap 5 (HTML5-native, CDN-linked)
* No Vite, no Node, no frontend build pipeline
* PHP-first rendering
* Nightforge-compatible (`php-fpm` in production)
* Docker for **local development only**

---

## **Design & UX Principles**

* Calm, structured, and neutral
* No hype language or aggressive visuals
* Clear hierarchy and readable typography
* Images support **context**, not emotion
* Accessibility-aware:

  * Proper labels
  * Logical focus order
  * Sufficient contrast

---

## **Content & Tone**

* Informational, not promotional
* Plain, direct language
* Rules and operations explained explicitly
* Avoid marketing buzzwords and exaggeration
* Suitable for:

  * Parents
  * Minors
  * Officials
  * Community stakeholders

---

## **Current Pages**

* **Home** — league orientation and legitimacy
* **League Operations** — how the league is run
* **About** — governance and operating principles
* **Contact** — coordination, inquiries, participation

---

## **Planned Future Pages**

* Schedule & Results
* Rules & Classes
* Registration (information-first)
* Season archives
* Sponsor acknowledgment (low-key, non-promotional)
* Announcements / notices

---

## **Image Usage Rules**

Images are **supporting elements**, not primary content.

### Requirements:

* Use real or realistic environments
* Avoid staged lifestyle imagery
* No text baked into images
* Images are optional, not mandatory

### Allowed aspect ratios only:

* **4:3** — hero and major context sections
* **1:1** — capability or operations cards
* **16:9** — wide dividers or announcements (sparingly)

### Image intent:

* Show operations, coordination, and real activity
* Reinforce legitimacy and structure
* Never replace explanatory text

---

## **Operational Priorities**

* Stability over experimentation
* Clarity over cleverness
* Incremental, reversible improvements
* Preserve continuity across seasons
* Document changes clearly and visibly

---

## **Success Criteria**

The site should feel:

* Legitimate
* Organized
* Trustworthy
* Easy to understand
* Calm and predictable
* Ready to grow **without refactoring**

---

## **End of Prompt — v1.1**

---

### ✅ Why this version is better

* Reflects **actual scope** (track league, not abstract org)
* Locks in **image discipline**
* Prevents future “marketing creep”
* Supports seasonal growth
* Easy to reuse with future contributors or AI sessions
