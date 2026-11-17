# Staging rollback

Before each migration, take a MySQL dump and storage volume backup as described in `STAGING_DEPLOYMENT.md`; record the commit SHA and backup timestamp. To roll back application code, stop the edge, check out the previous reviewed commit in detached state, and rebuild/restart its images. A code rollback does **not** reverse schema changes. Only restore a database dump into a separately named disposable database after a migration-related failure, validate it, and plan a controlled cutover or forward repair. Do not use `migrate:rollback` blindly; the financial migration protects legacy DOUBLE values and can refuse rollback when versioned invoices exist.

Check `docker compose --env-file .env.staging -f compose.staging.yml ps`, Caddy logs, `/healthz`, login, and tour listing after rollback. The storage volume must match the selected database backup. Do not remove named volumes with `down -v`.
