<p align="center">
  <a href="https://webmakerr.com" target="_blank">
    <img src="https://webmakerr.com/logo.svg" width="200" alt="Webmakerr Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/WebmakerrInc/Webmakerr/releases/">
    <img src="https://img.shields.io/github/release/WebmakerrInc/Webmakerr?include_prereleases=&sort=semver" alt="GitHub release">
  </a>
  <a href="https://github.com/WebmakerrInc/Webmakerr/releases/">
    <img src="https://img.shields.io/github/downloads/WebmakerrInc/Webmakerr/total" alt="Total Downloads">
  </a>
  <a href="#license">
    <img src="https://img.shields.io/badge/License-GPL--2.0-blue" alt="License">
  </a>
</p>

## About Webmakerr

[Webmakerr](https://webmakerr.com) is a fast, modern, and fully customizable [WordPress](https://wordpress.org) theme built on [Tailwind CSS](https://tailwindcss.com).  
It’s designed for developers, agencies, and creators who want clean, efficient, and flexible workflows without the bloat.

Webmakerr gives you a blazing-fast foundation for building beautiful, responsive WordPress themes powered by Tailwind — with all the tools you need to go from concept to production.

To get started, visit the [Webmakerr documentation](https://webmakerr.com/docs).

---

## Features

- Built with Tailwind CSS  
- Modern development workflow  
- SEO-optimized and accessibility-ready  
- Lightweight and performance-focused  
- Developer-friendly structure with extendable hooks  

---

## Installation

Clone or download the repository, then install dependencies and build assets:

```bash
npm install
npm run build
```

### Theme Check Submission Note

Before creating a ZIP for the WordPress.org Theme Directory:

- Run `npm install && npm run build` so compiled assets are included.
- Exclude development dependencies such as `node_modules/`, uncompiled source (`src/`, `resources/`), and build tooling configs from the final archive (e.g., via `.distignore` or `zip -r --exclude`).
- Document the build step in your release notes so reviewers can reproduce it if necessary.

## Theme Features

- Modern development tooling powered by Vite and Tailwind CSS.
- Responsive layout with customizable navigation menus and widget-ready footer.
- Accessibility conscious templates that follow WordPress coding standards.
- Translation ready with full support for `webmakerr` text domain.
