# Phase 9 security containment and follow-up

This repository is public. This guardrails PR starts from `main` at `9596f020` and
does not change Google Cloud IAM, the Azure VM, live containers, Apache, DNS,
databases, or Git history. Cleanup PR #9 remains separate and unmerged.

## Owner action required now

The first commit contains a Google Cloud service account private key in
`storage/app/public/credentials.json`. Metadata identifies project
`landa-trip` and service account
`storage-landa-trip@landa-trip.iam.gserviceaccount.com`. The key ID was
identified for the service account owner, but no key material is included in
this report. **The owner must revoke or rotate that key immediately in Google
Cloud IAM, review the account's permissions and audit logs, and verify the
application with a replacement credential held outside Git.** Rotation has
not been performed or verified by this PR. The owner should also rotate or
restrict the separately hardcoded Google Places API key found in current and
historical PHP source. Removing that key from current source is prepared in
the held credential-deletion branch. Supply its replacement securely before
any future deployment that needs the Google Places endpoint.

The live server may still have a copy of the credential and may still serve
`/storage/credentials.json`. Repository changes do not alter that running
server. The operator must verify live access controls and remove the live copy
only as part of credential rotation. No live file was touched here.

## Repository containment

- `.gitignore` blocks new uploads, credential JSON, and common private key file
  types. A force-add can bypass ignore rules, so PR secret scanning checks
  every changed file without an exception and redacts any findings.
- The existing credential and Google Places key remain in the current Git tree
  until the owner confirms key revocation. The repository-side removals are
  prepared locally, but GitHub includes the old values in a public deletion
  diff even when those paths are marked binary. A deletion PR is held so this
  change does not draw additional attention to active keys. This guardrails
  PR does not claim to contain the current or historical secret exposure.
- Staging Docker builds already exclude `storage/` and now exclude all `old_*`
  snapshots. The Dockerfile checks that the credential path, Adminer, and
  legacy application tree do not appear in the PHP image.

## Uploaded data preservation plan

Tracked storage includes course, website, post, user, community, group, and
temporary uploads. Code writes to `public/tmp-files` and `public/users`, then
moves files on user and teacher profile/document flows. Database migrations
show `temporary_files.name` and polymorphic `images.url` references; user
profile and header images also use the image relationship. Additional database
relationships and live disk contents cannot be verified without a safe,
read-only inventory of the actual database and storage volume. Four tracked
images have GPS EXIF tags. No upload was deleted or transformed in this PR.

1. Agree on owner, scope, retention, and access policy. Take a complete,
   encrypted, restricted-access backup of the tracked media and the actual
   storage volume. Record per-file hashes and a manifest without publishing
   user filenames or metadata.
2. Restore the backup in an isolated private environment and verify counts,
   hashes, application reads, and database references. Preserve original
   images privately for recovery and evidence.
3. Migrate required files to persistent private storage or an access-controlled
   object store. Separate genuinely public assets from user documents and
   temporary files; update URLs and permissions without breaking database
   links. Verify upload, download, profile, course, and document flows.
4. Strip location EXIF from new public derivatives and review existing public
   images for consent and intended visibility. Do not modify private originals
   until backup restoration is verified.
5. Only after migration and restoration pass, untrack uploaded media in a
   separate PR. Coordinate a `git-filter-repo` rewrite for the credential and
   personal media with maintainers, branch protection, forks, caches, and fresh
   clones. Public copies cannot be guaranteed erased. Do not force-push or
   rewrite history as part of this guardrails PR.

## Frontend advisory assessment

PR #9 frontend CI stopped at `npm audit --audit-level=high`, before its build
steps. The unchanged lockfile had 16 high advisories and no critical ones.
All 16 findings trace to
[GHSA-fc5q-39xc-vjpf](https://github.com/advisories/GHSA-fc5q-39xc-vjpf),
the picomatch repeated-extglob ReDoS advisory, via Vite, tinyglobby/fdir,
Rollup pluginutils, Tailwind/micromatch/chokidar, Sass/Parcel watcher, and
Laravel Vite plugin dependency chains. Installed picomatch versions include
2.3.2 and 4.0.7. The advisory covers all published versions through 4.0.7,
which is the latest published version checked on 2026-11-17. There is no
compatible fixed picomatch release to select today. `npm audit fix --force`
suggests Vite 6 and other major changes that violate the Vite 7/React 18
architecture; no forced downgrade or audit suppression was made.

`@rollup/plugin-inject`, `@vitejs/plugin-react`, and `sass` are used by the
Vite build, so their declarations moved to `devDependencies` without changing
any locked package version. The production-only dependency audit now reports
zero advisories, while the full development/build audit still reports 16 high.
The full audit must remain a failing CI check until a compatible fixed upstream
version is published and tested. Recheck the advisory and lockfile regularly.

## Adminer and PHP exposure

No application route, build script, or deployment configuration references
`public/adminer.php`. The previous Nginx regex forwarded any `.php` path to
PHP-FPM, so Adminer could be invoked wherever the web edge allowed the
request. This hotfix removes Adminer from the repository and Docker context,
permits FastCGI only for `/index.php`, and denies other PHP paths. It also
blocks secret-like files under `/storage/` while retaining the existing
public favicon manifest JSON. The prior broad deny regex also blocked ordinary
public storage images, so it was narrowed to let `/storage/` serve intended
media through the public symlink while the secret-file and PHP rules still
apply. Laravel's `/` front controller rewrite remains.
The running server and its external Apache configuration were not changed;
their current exposure must be checked by the operator.

## Verification

Record final test and PR CI results in the PR description. Do not treat a
successful Docker or current-tree scan as proof that public Git history, forks,
or running servers have been remediated.
