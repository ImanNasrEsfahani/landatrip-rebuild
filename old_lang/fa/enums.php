<?php declare(strict_types=1);

use App\Enums\CertificationStatusEnum;
use App\Enums\CouponStatusEnum;
use App\Enums\GenderStatusEnum;
use App\Enums\GroupStatusEnum;
use App\Enums\GroupUserStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Enums\PermissionLevelEnum;
use App\Enums\TicketPriorityStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\TourStatusEnums;
use App\Enums\TransactionStatusEnum;
use App\Enums\UserAgreementStatusEnum;
use App\Enums\UserCompanyStatusEnum;
use App\Enums\UserDocumentStatusEnum;
use App\Enums\UserEducationStatusEnum;

return [

    GroupStatusEnum::class => [
        GroupStatusEnum::booking   => 'Booking',
        GroupStatusEnum::soldOut   => 'SoldOut',
        GroupStatusEnum::noTime    => 'NoTime',
        GroupStatusEnum::completed => 'Completed',
        GroupStatusEnum::canceled  => 'Canceled',
    ],

    GroupUserStatusEnum::class   => [
        GroupUserStatusEnum::booked         => 'Booked',
        GroupUserStatusEnum::pending        => 'Pending',
        GroupUserStatusEnum::rejected       => 'Rejected',
        GroupUserStatusEnum::canceled       => 'Canceled',
        GroupUserStatusEnum::completed      => 'Completed',
    ],

    TicketStatusEnum::class => [
        TicketStatusEnum::new      => 'New',
        TicketStatusEnum::pending  => 'Pending',
        TicketStatusEnum::answered => 'Answered',
        TicketStatusEnum::rating   => 'Rating',
        TicketStatusEnum::closed   => 'Closed',
    ],

    TicketPriorityStatusEnum::class => [
        TicketPriorityStatusEnum::low     => 'Low',
        TicketPriorityStatusEnum::mediate => 'Mediate',
        TicketPriorityStatusEnum::high    => 'High',
    ],

    TourStatusEnums::class => [
        TourStatusEnums::pending   => 'Pending',
        TourStatusEnums::approved  => 'Approved',
        TourStatusEnums::rejected  => 'Rejected',
        TourStatusEnums::suspended => 'Suspended',
    ],

    UserAgreementStatusEnum::class => [
        UserAgreementStatusEnum::pending   => 'Pending',
        UserAgreementStatusEnum::confirmed => 'Confirmed',
        UserAgreementStatusEnum::canceled  => 'Canceled',
    ],

    UserCompanyStatusEnum::class => [
        UserCompanyStatusEnum::working   => 'Working',
        UserCompanyStatusEnum::completed => 'Completed',
    ],

    UserDocumentStatusEnum::class => [
        UserDocumentStatusEnum::pending  => 'Pending',
        UserDocumentStatusEnum::verified => 'Verified',
        UserDocumentStatusEnum::rejected => 'Rejected',
    ],

    UserEducationStatusEnum::class => [
        UserEducationStatusEnum::student   => 'Student',
        UserEducationStatusEnum::completed => 'Completed',
        UserEducationStatusEnum::canceled  => 'Canceled',
    ],

    PermissionLevelEnum::class => [
        PermissionLevelEnum::private => 'Private',
        PermissionLevelEnum::friends => 'Friends',
        PermissionLevelEnum::public  => 'Public',
    ],

    TransactionStatusEnum::class => [
        TransactionStatusEnum::pending   => 'Pending',
        TransactionStatusEnum::failed    => 'Failed',
        TransactionStatusEnum::completed => 'Completed',
    ],

    CertificationStatusEnum::class => [
        CertificationStatusEnum::pending        => 'Pending',
        CertificationStatusEnum::rejected       => 'Rejected',
        CertificationStatusEnum::completed      => 'Completed'
    ],

    CouponStatusEnum::class  => [
        CouponStatusEnum::active      => 'Active',
        CouponStatusEnum::expired     => 'Expired',
        CouponStatusEnum::used        => 'Used',
    ],

    GenderStatusEnum::class  => [
        GenderStatusEnum::male          => 'Male',
        GenderStatusEnum::female        => 'Female',
        GenderStatusEnum::notSay        => 'NotSay',
    ],

    InvoiceStatusEnum::class    => [
        InvoiceStatusEnum::pending      =>'Pending',
        InvoiceStatusEnum::paid         =>'Paid',
        InvoiceStatusEnum::canceled     =>'Canceled',
        InvoiceStatusEnum::expired      =>'Expired',
    ],

];
