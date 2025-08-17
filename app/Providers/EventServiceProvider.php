<?php

namespace App\Providers;

use App\Events\AcceptedDocEvent;
use App\Events\BadgeUpgradeEvent;
use App\Events\CancellationTourEvent;
use App\Events\ChangePasswordEvent;
use App\Events\MembershipEvent;
use App\Events\RatingTicketEvent;
use App\Events\ContactFormSubmit;
use App\Events\CreateCommunityEvent;
use App\Events\CreateGroupEvent;
use App\Events\CreateTourEvent;
use App\Events\FailsPaymentEvent;
use App\Events\InvoiceEvent;
use App\Events\NewsletterFormSubmit;
use App\Events\NewTicketEvent;
use App\Events\OneDayLeftEvent;
use App\Events\OneWeekLeftEvent;
use App\Events\RegistrationEvent;
use App\Events\RejectedDocEvent;
use App\Events\ResendVrificationCodeEvent;
use App\Events\ResetPasswordEvent;
use App\Events\SuccessPaymentEvent;
use App\Events\TwoDaysLeftEvent;
use App\Events\UnreadTicketEvent;
use App\Listeners\AcceptedDocListener;
use App\Listeners\BadgeUpgradeListener;
use App\Listeners\CancellationTourListener;
use App\Listeners\ChangePasswordListener;
use App\Listeners\RatingTicketListener;
use App\Listeners\ContactFormMailListener;
use App\Listeners\ContactFormSMSListener;
use App\Listeners\CreateCommunityListener;
use App\Listeners\CreateGroupListener;
use App\Listeners\CreateTourListener;
use App\Listeners\FailsPaymentMailListener;
use App\Listeners\FailsPaymentSMSListener;
use App\Listeners\InvoiceListener;
use App\Listeners\LoginListener;
use App\Listeners\MembershipListener;
use App\Listeners\NewsletterFormMailListener;
use App\Listeners\NewsletterFormSMSListener;
use App\Listeners\NewTicketListener;
use App\Listeners\OneDayLeftListener;
use App\Listeners\OneWeekLeftListener;
use App\Listeners\RegistrationMailListener;
use App\Listeners\RegistrationSMSListener;
use App\Listeners\RejectedDocListener;
use App\Listeners\ResetPasswordListener;
use App\Listeners\SuccessPaymentMailListener;
use App\Listeners\SuccessPaymentSMSListener;
use App\Listeners\TwoDaysLeftListener;
use App\Listeners\UnreadTicketListener;
use App\Listeners\VerificationEmailListener;
use App\Listeners\VerifyListener;
use App\Mail\VerifyUserEmailMail;
use App\Models\Article;
use App\Models\City;
use App\Models\Community;
use App\Models\Contact;
use App\Models\Conversation;
use App\Models\ConversationRecord;
use App\Models\Country;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Newsletter;
use App\Models\Region;
use App\Models\Skill;
use App\Models\Ticket;
use App\Models\TicketRecord;
use App\Models\Tour;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAgreement;
use App\Models\UserCompany;
use App\Models\UserDocument;
use App\Models\UserEducation;
use App\Observers\ArticleObserver;
use App\Observers\CityObserver;
use App\Observers\CommunityObserver;
use App\Observers\ContactObserver;
use App\Observers\ConversationObserver;
use App\Observers\ConversationRecordObserver;
use App\Observers\CountryObserver;
use App\Observers\GroupObserver;
use App\Observers\GroupUserObserver;
use App\Observers\NewsletterObserver;
use App\Observers\RegionObserver;
use App\Observers\SkillObserver;
use App\Observers\TicketObserver;
use App\Observers\TicketRecordObserver;
use App\Observers\TourObserver;
use App\Observers\TransactionObserver;
use App\Observers\UserAgreementObserver;
use App\Observers\UserCompanyObserver;
use App\Observers\UserDocumentObserver;
use App\Observers\UserEducationObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Login::class                => [
            LoginListener::class
        ],
        Registered::class           => [
            //RegistrationMailListener::class,
            //RegistrationSMSListener::class
            //SendEmailVerificationNotification::class,
            //VerificationEmailListener::class
        ],

        // In General Email Events
        MessageSending::class       => [
            //LogSendingMessage::class,
        ],
        MessageSent::class          => [
            //NewsletterListener::class
        ],

        // Landa Trip project events
        RegistrationEvent::class    => [
            VerifyListener::class
        ],
        MembershipEvent::class  =>  [
            MembershipListener::class,
        ],
        ResendVrificationCodeEvent::class   =>[
          VerifyListener::class
        ],
        ResetPasswordEvent::class   => [
            ResetPasswordListener::class
        ],
        ChangePasswordEvent::class  =>  [
            ChangePasswordListener::class
        ],
        NewsletterFormSubmit::class => [
            NewsletterFormMailListener::class,
            NewsletterFormSMSListener::class
        ],
        ContactFormSubmit::class    => [
            ContactFormMailListener::class,
            ContactFormSMSListener::class
        ],
        SuccessPaymentEvent::class  => [
            SuccessPaymentMailListener::class,
            SuccessPaymentSMSListener::class
        ],
        FailsPaymentEvent::class    => [
            FailsPaymentMailListener::class,
            FailsPaymentSMSListener::class
        ],
        InvoiceEvent::class => [
            InvoiceListener::class
        ],
        AcceptedDocEvent::class =>  [
            AcceptedDocListener::class
        ],
        RejectedDocEvent::class =>  [
            RejectedDocListener::class
        ],
        BadgeUpgradeEvent::class =>  [
            BadgeUpgradeListener::class
        ],
        CancellationTourEvent::class    => [
            CancellationTourListener::class
        ],
        OneDayLeftEvent::class  =>  [
            OneDayLeftListener::class
        ],
        OneWeekLeftEvent::class =>  [
            OneWeekLeftListener::class
        ],
        TwoDaysLeftEvent::class =>  [
            TwoDaysLeftListener::class
        ],
        NewTicketEvent::class   =>  [
            NewTicketListener::class
        ],
        RatingTicketEvent::class =>  [
            RatingTicketListener::class
        ],
        UnreadTicketEvent::class    =>  [
            UnreadTicketListener::class
        ],
        CreateCommunityEvent::class =>  [
            CreateCommunityListener::class
        ],
        CreateTourEvent::class  =>  [
            CreateTourListener::class
        ],
        CreateGroupEvent::class =>  [
            CreateGroupListener::class
        ]
        //        RegistrationEvent::class => [
        //            RegistrationListener::class
        //        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Tour::observe(TourObserver::class);
        Group::observe(GroupObserver::class);
        GroupUser::observe(GroupUserObserver::class);
        UserAgreement::observe(UserAgreementObserver::class);
        UserEducation::observe(UserEducationObserver::class);
        UserCompany::observe(UserCompanyObserver::class);
        UserDocument::observe(UserDocumentObserver::class);
        Newsletter::observe(NewsletterObserver::class);
        Contact::observe(ContactObserver::class);
        Transaction::observe(TransactionObserver::class);
        Ticket::observe(TicketObserver::class);
        TicketRecord::observe(TicketRecordObserver::class);
        Article::observe(ArticleObserver::class);
        Skill::observe(SkillObserver::class);
        Community::observe(CommunityObserver::class);
        Region::observe(RegionObserver::class);
        Country::observe(CountryObserver::class);
        City::observe(CityObserver::class);
        ConversationRecord::observe(ConversationRecordObserver::class);
        Conversation::observe(ConversationObserver::class);
    }
}
