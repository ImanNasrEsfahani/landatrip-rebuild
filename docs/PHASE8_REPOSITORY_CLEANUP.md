# Phase 8 repository cleanup audit

Baseline: `9596f020d1714da7a5f1ed2b7841f8f497161bef` (`main`, 2026-11-17).
This change removes historical snapshots from the current Git tree. It does not
rewrite history or remove tracked uploads. All byte counts below are decimal.

## Historical trees

The audit covered Composer autoload paths, Laravel bootstrap and route loading,
Vite inputs and imports, Dockerfiles and Compose contexts, test configuration,
scripts, deployment configuration, and all six CI workflows. No executable or
build reference to a historical tree was found. The only references outside
these trees were documentation, editor locale indexing, and the old Docker
ignore entry. Editor indexing and documentation were updated.

| Removed path | Files | File bytes | Same-path files identical to current tree | Assessment |
| --- | ---: | ---: | ---: | --- |
| `old_app/` | 875 | 1,207,280 | 852 | Laravel application snapshot; no old-only relative paths |
| `old_database/` | 298 | 6,384,926 | 296 | Migrations/seeders snapshot; no old-only relative paths |
| `old_lang/` | 41 | 107,818 | 40 | Translation snapshot; no old-only relative paths |
| `old_resources/` | 771 | 46,337,931 | 732 | Frontend snapshot; no old-only relative paths |
| `old_routes/` | 10 | 41,489 | 3 | Route snapshot; no old-only relative paths |
| `old_tests/` | 14 | 8,807 | 11 | Test snapshot; no old-only relative paths |
| `old_vendor/` | 12,638 | 83,289,678 | N/A | Resolved Laravel 10 dependency tree; current Composer installs `vendor/` |
| `old_composer.json`, `old_composer.lock` | 2 | 438,219 | N/A | Historical Laravel 10.38.2 manifest and lock; current lock resolves Laravel 13.42.0 |

The six source snapshots have no relative file absent from the corresponding
current directory. Changed counterparts are retained in their current forms.
The removed files total **14,649 files and 137,816,148 bytes**. They remain
recoverable from Git history until a separately approved history remediation.

## Other size findings

- `storage/app/public/` contains 1,003 non-placeholder files totaling
  265,351,266 bytes. They remain tracked and untouched. The Docker context
  already excludes `storage/` and staging uses a separate storage volume.
- Current source has 7,055,679 redundant bytes among 10 groups of identical
  files at least 100 KB each. The largest examples are images repeated across
  admin, teacher, and user panels. Imports and public paths need review before
  any consolidation.
- Two legacy `RegionSeeder` backups in the current `database/seeders/` tree
  total 2,175,747 bytes. They are excluded from Docker builds but remain in
  Git pending confirmation that their data is preserved elsewhere.
- `resources/js/agent-panel/components/assets/profile.svg` is 6,462,440
  bytes. Its consumers and optimized replacement should be reviewed in a
  separate asset change.
- `public/adminer.php` is a 436,227-byte database administration script. The
  staging Nginx configuration routes PHP files to PHP-FPM. Its intended access
  controls and need in deployable images require a separate security review.

## Public storage exposure

The tracked storage tree includes 107 files under `users/` and five under
`tmp-files/`. A metadata scan opened 832 images, found EXIF in 58, descriptive
EXIF fields in eight, and GPS EXIF tags in four. One image could not be read
by the metadata scanner. This is evidence of possible personal data exposure,
not a determination of ownership, consent, or whether each file is in use.
No media contents or individual upload names are reproduced here.

The same tracked tree contains `storage/app/public/credentials.json`, a cloud
service account JSON with a private key and client email. Git history shows it
has been present since the first commit. The current code reads an optional
`GOOGLE_CLOUD_KEY_FILE` environment setting; no committed configuration points
to this exact path, but live configuration was not inspected. **Treat this key
as compromised and rotate/revoke it promptly.** Removing a file from a new
commit or adding an ignore rule cannot revoke the key or erase prior Git
history, forks, caches, or clones. This cleanup deliberately leaves the
tracked storage tree unchanged until the preservation and key rotation work is
coordinated.

## Separate preservation and remediation plan

1. Identify the owner of the cloud service account, revoke/rotate the exposed
   key, use a secret manager or workload identity for the replacement, and
   review provider audit logs for unauthorized use. Verify the application
   works with the new credential before retiring any deployment dependency.
2. Inventory every tracked upload against application and database references.
   Obtain an access-restricted, encrypted private backup of the complete
   storage tree, record file count and checksums, and verify restoration.
3. Move required uploads to private persistent storage or an access-controlled
   object store. Confirm intended public assets separately, update application
   URLs and upload paths, and test user, course, and temporary-file flows.
4. Only after backup and migration verification, remove tracked uploads in a
   separate reviewed change. The new `.gitignore` rule prevents accidental
   addition of further uploads but does not untrack existing files.
5. Plan a coordinated `git-filter-repo` history rewrite for the credential and
   personal media, with maintainer and collaborator notice, branch protection
   coordination, force-push window, fresh clones, and checks of forks and
   caches. GitHub support may be needed for retained cached objects. Public
   copies cannot be guaranteed erased. No history rewrite is part of Phase 8.

## Verification and size measurements

Measurements use `git ls-files` file bytes, `du -sb` for a Docker context probe
that copies exactly the `.dockerignore` result, and `docker image inspect` for
the staging PHP and Nginx image sizes. Build images used the same PHP 8.4,
Node 22, Composer lock, and npm lock before and after. The Docker builds used
the workspace CA bundle as a BuildKit secret for TLS verification.

| Metric | Before | After | Change |
| --- | ---: | ---: | ---: |
| Tracked file bytes | 458,812,437 | 321,003,971 | -137,808,466 |
| Docker build context bytes | 112,540,513 | 54,476,616 | -58,063,897 |
| Staging PHP image bytes | 536,404,460 | 479,528,403 | -56,876,057 |
| Staging Nginx image bytes | 71,668,419 | 71,668,419 | 0 |

The context reduction exceeds the historical files included in the previous
context because the Docker ignore rules now also omit the legacy seeder
backups, `READMEold.md`, and editor configuration. The `old_vendor/` tree was
already excluded from Docker builds. The old files stay in Git history, so a
normal clone still fetches historical objects. Their Git storage is not
reclaimed until the separate history work is completed.

Local checks: Composer manifests validated; both before and after staging
images built; the PHP images reported the same 339 routes, 207 API routes, and
49 mobile v1 routes. The final PHP image contains its Vite manifest and SSR
bundle, and contains no historical tree or tracked storage credential. Full
backend, frontend, E2E, staging, Apache, and ARM64 checks run in PR CI.

Estimated steady-state runtime RAM effect: **approximately 0 MiB**. These
files were not loaded as Laravel, React, or Vite runtime dependencies. Smaller
image layers and build context save disk and transfer, not application memory.
Build-time peak memory was not measured. This cleanup provides no evidence
that the existing 1 GiB server is suitable for deployment.
