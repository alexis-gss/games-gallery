# Changelog

All notable changes to `games-gallery` will be documented in this file.

- The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
- This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html),
- Commits respect [Conventionnal commits](https://www.conventionalcommits.org/en/v1.0.0/) & use [Gitmoji](https://gitmoji.dev/).

## **[v5.0.0] - 26.06.24**

### Added
-   ci: 👷 update ci/cd (validations & deployment)
-   feat: ✨ add unit tests via [alexis-gss/laravel-unit-tests](https://packagist.org/packages/alexis-gss/laravel-unit-tests)
-   feat: ✨ add sitemap - issue #42
-   feat: ✨ add user filter on activity log
-   feat: ✨ add a showing page for CRUDs
-   feat: ✨ replace old scrollbar by overlayscrollbars-vue package in front navigation
-   feat: ✨ add scroll pagination on games list in front navigation
-   feat: 🎨 upgrade getters to sort all models collection
-   feat: 🚸 update front style (upgrade layout, colors affinity and margin/padding)
-   feat: ♿️ update back cards style
-   feat: ♿️ upgrade front navigation to improve accessibility
-   feat: 🌐 use translations string in request validations

### Changed
-   chore: 📦 bump project to laravel 11
-   refactor: ♻️ use default laravel helpers in blade file
-   refactor: ♻️ use default blade directives in blade file
-   refactor: ♻️ use cache laravel helper in blade filess
-   refactor: ♻️ use helpers laravel trans in php files
-   refactor: ♻️ rewrite all vue components into composition style
-   refactor: ♻️ rewrite toast message functionnality when guest like a picture
-   refactor: ♻️ replace model->id by the primary key

### Fixed
-   fix: 🚨 export sass safelist for purge css in vite.config.ts
-   fix: 🐛 use universal unique identifier to rate a picture
-   fix: 🐛 use cookie to save rating uuid locally
-   fix: 🐛 restrict games ranks only for published games
-   fix: ♿️ update messages when loading pictures

### Removed
-   chore: ➖ remove unused jscolor package

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v4.2.0...v5.0.0

## **[v4.2.0] - 08.03.24**

### Added
-   Add mandatory folders
-   Add pictures/ratings seeder
-   Add on update/on delete action on foreign keys
-   Add administrable translations fields
-   Add vite plugin purge css
-   Add warning sweetalert popup on action event

### Changed
-   Remove unused opacity on folder color (rgba to hex)
-   Clean blades/sass files

### Fixed
-   Fix responsive front
-   Minor fixes/bugs

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v4.1.1...v4.2.0

## **[v4.1.1] - 15.02.24**

### Added
-   Add previous query when redirect on delete model

### Changed
-   Update depedencies
-   Update github actions/issue templates

### Fixed
-   Fix navigation responsive
-   Fix translation of the toast message
-   Fix sass component
-   Minor fixes/bugs

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v4.1.0...v4.1.1

## **[v4.1.0] - 12.02.24**

### Added
-   Add static pages for home and ranking pages
-   Add micro data - issue #33
-   Add ratings functionnality on pictures
-   Add statistics on ratings pictures
-   Add reset password functionnality

### Changed
-   Update bo navigation - issue #37
-   Update front responsive - issue #38 #39
-   Update folder color functionality

### Fixed
-   Minor fixes/bugs

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v4.0.0...v4.1.0

## **[v4.0.0] - 18.01.24**

### Added
-   Add ranking of games - #29
-   Add DeleteUnassociatedPictures job - issue #30
-   Add translations in front & back - issue #31
-   Add range dates for activities statistics

### Changed
-   Update statistics data
-   Update accessibility - issue #32
-   Clean project (docblock, prototype, indentation)
-   Clean upload images method + optimize images with the .webp type mime

### Fixed
-   Minor fixes/bugs

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v3.0.0...v4.0.0

## **[v3.0.0] - 12.10.23**

### Added
-   Bump laravel 8.75->10.\* + bump others depedencies - issue #20
-   Add bootstrap themes - issue #13
-   Add statistics - issue #23
-   Add activity logs - issue #28
-   Add mail test command
-   Add back-end search on relation and enum

### Changed
-   Update saving images functionnality - issue #3
-   Update all translations
-   Update login back-end
-   Update users role/permissions

### Fixed
-   Minor fixes/bugs

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v2.5.0...v3.0.0

## **[v2.5.0] - 17.08.23**

### Added
-   Add duplicate model functionnality
-   Add latest games on homepage
-   Add Community Standards
-   Add composer data in the footer

### Changed
-   Update README.md - issue #15
-   Update Github ISSUE_TEMPLATE - issue #16
-   Update module pagination
-   Update back-office home page
-   Update btn actions on model

### Fixed
-   Fix user's picture when run the command user:create
-   Minor fixes/bugs

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v2.4.0...v2.5.0

## **[v2.4.0] - 22.05.23**

### Added
-   Add glightbox
-   Add simplebar
-   Add folder's color
-   Add github's icon

### Changed
-   Update breadcrumbs bo
-   Update index filters
-   Update search bo
-   Update access rights

### Fixed
-   Minor fixes/bugs

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v2.3.0...v2.4.0

## **[v2.3.0] - 04.04.23**

### Added
-   Add github-actions/github-issue-templates
-   Add status for tags and folders
-   Add breadcrumbs

### Changed
-   Update migrations/seeders

### Fixed
-   Minor fixes

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v2.2.1...v2.3.0

## **[v2.2.1] - 24.01.23**

### Changed
-   Update new method for saving images

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v2.2.0...v2.2.1

## **[v2.2.0] - 11.09.22**

### Added
-   Adding tags for games

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v2.1.0...v2.2.0

## **[v2.1.0] - 10.10.22**

### Added
-   Adding a users administration

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v2.0.0...v2.1.0

## **[v2.0.0] - 12.08.22**

### Added
-   Addition of an administration interface with authentication

### Changed
-   Total redesign of the project under Laravel
-   Separation of the front/back office

Full changelog: https://github.com/alexis-gss/games-gallery/compare/v1.0.0...v2.0.0

## **[v1.0.0] - 17.02.22**

-   Working project
