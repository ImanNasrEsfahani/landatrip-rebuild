# Phase 12 upload ownership and transition

Verified base: `ff9c71c663fd18c14052e5deb736c732d770ae34` (owner-merged #23; supplied baseline 2318b0b7 is its ancestor). Repository remains public. No production data or backup was accessed.

## Reachable paths and findings

- `APIFileUploadController::store` (`POST /api/temporary-file`, Sanctum) and `UserImageProfileTemporaryController::store` (user panel `temporary-file`, field `files`) create `temporary_files` rows. Previously names embedded user identity and timestamps, validation was absent/incomplete, and rows had no uploader or expiry.
- User/teacher `UserDocumentController::store`, user document replacement, `UserTicketRecordController::store`, `UserController::update` and `UserImageProfileController::store` accepted arbitrary temporary IDs. Synthetic HTTP tests reproduce cross-user document, ticket and profile claims. These are verified authorization defects, not inferred production incidents.
- Existing document routes retain their #22 owner policies. Teacher document update is still an empty handler; implementing editing is separate functional work.
- `TemporaryFiles` maps to `temporary_files`, originally name/type/size/timestamps only. `TemporaryFilesPolicy` has placeholder methods and did not protect these lookups. The Web TemporaryFilesController has empty handlers and no registered route. There is no verified scheduled cleanup path.
- `APIFileUploadController` restore/revert handlers are placeholders; `files/upload/temp-store` points at missing `tempStore`. Those legacy endpoints are not repaired in this ownership PR.
- Mobile `POST api/app/v1/file-upload` calls `TourController::uploadFileToCloud`: it writes a timestamp filename to default-disk `public/tmp-files` and stops at `dd`. It creates no TemporaryFiles row. This is a reachable legacy defect; its intended mobile success response requires a separate contract decision. All 49 mobile routes and current responses are preserved here.

## New upload contract

Authenticated upload endpoints keep their field names and plain numeric ID response. Accept detected JPEG, PNG, WebP or PDF up to 10 MiB. New UUID filenames contain no caller path or user name. Temporary bytes live on the explicit local private disk at `temporary-uploads/{uuid}.{extension}`. Profile consumers additionally require an image MIME type.

Nullable owner_id, expires_at and consumed_at additions leave every existing row untouched. New uploads expire after 24 hours. Every web consumer locks the row, verifies current owner and expiry, rejects consumed IDs and unsafe names, copies bytes to a server-selected destination, saves the consuming record and marks consumption in one database transaction. Replay returns 404. On an ordinary failure the destination copy is removed, the source retained and the database rolled back. Existing destinations are never overwritten or deleted by collision handling. Process crashes and failed filesystem cleanup can still leave orphan copies: filesystem and MySQL have no shared atomic commit. No automatic sweeper is introduced.

Original private temporary bytes are retained after consumption until a separately reviewed retention/cleanup job exists. Expiry blocks consumption; it does not delete bytes. This trades temporary disk retention for recoverability.

## Compatibility and preservation

Ownerless, expired and malformed legacy IDs fail with 404 without deleting their row or bytes. Clients with an upload started before rollout must upload again. Never infer ownership from filenames or assign old rows to the next requester. Communicate this transition, coordinate app/schema rollout (nullable migration first), and verify backup/restore before any later cleanup. No migration is applied outside disposable MySQL by this task.

Legacy documents and ticket files continue to use their existing paths. Private document download #19 never falls back to those public paths. A separate attachment PR will protect newly created ticket attachment bytes. Existing encrypted backup remains untouched.

Before any legacy migration: produce a read-only inventory in restricted storage with DB references, disk/path, bytes, checksum, MIME, and EXIF-presence flags; avoid publishing names, GPS coordinates or user content. Verify encrypted restricted-access backup restoration, reconcile missing/duplicate references, define authorized destinations and rollback mapping, then request explicit migration approval. History remediation and credential incident Issue #15 remain separate.
