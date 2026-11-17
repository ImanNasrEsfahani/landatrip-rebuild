# Synthetic test accounts

Run `bash scripts/staging-seed.sh` on a fresh staging database. The command checks `APP_ENV=staging`, the configured and actual MySQL database name, the database user, an explicit seed flag, and the absence of non-demo users. It creates a region, country, city, teacher-owned public tour, future tour group, and five panel users. It does not create invoices, bookings, payments, real customer records, or notification targets. The seeder does not use `E2eSeeder`.

| Panel | Email | URL |
|---|---|---|
| Admin | staging-admin@example.invalid | `/admin-panel` |
| Manager | staging-manager@example.invalid | `/manager-panel` |
| Teacher | staging-teacher@example.invalid | `/teacher-panel` |
| Agent | staging-agent@example.invalid | `/agent-panel` |
| User | staging-user@example.invalid | `/user-panel` |

Each password is generated independently by `staging-seed.sh` and saved only in `.staging-credentials` (mode 600). The site's HTTP Basic password is in `.staging-access` for local use; on a server, retain the password in a separate protected secret store. Remove the synthetic accounts and data only through a reviewed, database-specific cleanup plan. Never run destructive reset commands against staging.
