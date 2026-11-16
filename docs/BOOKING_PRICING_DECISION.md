# Booking pricing decision required before staging checkout

## Evidence from merged main

- `tours.price` and `groups.price` are commented out in their migrations; the old `TourController::booking` reads the absent `groups.price`, selects the latest group instead of the requested one, multiplies by `51000`, assigns invoice `user_id = 1`, and sends a gateway request.
- `group_price_items` stores a title, group, currency and floating amount. `group_price_item_users` associates items with users. Neither the schema nor active application code defines which item is a base fare, whether an item is optional, whether it is per person, or whether adults and children have different prices. Its seeder is empty.
- `currencies` defines names and symbols, with no exchange rates. The invoice stores a currency and subtotal, discount, tax, and total, but there is no active booking calculation for these fields. The old React invoice, sidebar and payment screens use unrelated sample amounts, a 9% tax label, and sample contact details. The invoice factory uses a different 15% tax calculation; factories are test data, not a pricing policy.
- `invoice_details` previously referred only to a tour. The new nullable `group_id` foreign key makes future invoices able to identify the exact selected group. Existing invoice details cannot be backfilled reliably from their tour alone.
- `transactions` stores invoice ID, authority, session ID and status. It has no amount, phone, email or transaction-info columns. A new unique index on authority prevents duplicate callbacks from resolving to ambiguous transactions; existing duplicate non-null authorities must be reconciled before deployment.

## Decision needed

The product owner must specify a versioned booking price contract for one selected group:

1. Which `group_price_items` are mandatory base fare versus selectable services, how quantities are determined for the purchaser and each companion, and whether child prices or other participant categories differ.
2. Whether all payable items must share one `currency_id`; if conversion is permitted, the approved rate source, timestamp, settlement currency, rounding precision and gateway amount unit.
3. The applicable tax rate or tax-exempt rule, coupon eligibility and ordering of discount and tax, and how invoice expiration is chosen.
4. When a seat is reserved, when it is released after failed or expired payment, and which `group_users.status` values consume capacity.
5. Which payment method is supported for each currency and the provider reference and callback contract.

Until those choices are supplied, checkout deliberately returns HTTP 409 before creating an invoice, transaction, reservation or provider call. The booking UI shows stored price items and clearly states that no payable total is available. The old sample invoice and payment details are no longer presented as real bills.

## Implementation after decision

Implement a server-side quote and invoice service under a group row lock. Validate the selected participant and item IDs and currency; create the invoice, detail rows with `group_id`, reservation and transaction with an idempotency key in one transaction. Persist the quoted amount and rule version. Use a fake gateway in tests, then add Chromium coverage for invoice generation, success/failure payment and booking history. Never use the old `51000` multiplier or infer an exchange rate from displayed currency symbols.
