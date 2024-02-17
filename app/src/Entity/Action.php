<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Post;
use App\Enum\ActionStatusType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An action performed by a direct agent and indirect participants upon a direct object. Optionally happens at a location with the help of an inanimate instrument. The execution of the action may produce a result. Specific action sub-type documentation specifies the exact expectation of each argument/role.\\n\\nSee also \[blog post\](http://blog.schema.org/2014/04/announcing-schemaorg-actions.html) and \[Actions overview document\](https://schema.org/docs/actions.html).
 *
 * @see https://schema.org/Action
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'action' => Action::class,
    'seekToAction' => SeekToAction::class,
    'searchAction' => SearchAction::class,
    'solveMathAction' => SolveMathAction::class,
    'arriveAction' => ArriveAction::class,
    'departAction' => DepartAction::class,
    'travelAction' => TravelAction::class,
    'tieAction' => TieAction::class,
    'winAction' => WinAction::class,
    'loseAction' => LoseAction::class,
    'exerciseAction' => ExerciseAction::class,
    'performAction' => PerformAction::class,
    'bookmarkAction' => BookmarkAction::class,
    'applyAction' => ApplyAction::class,
    'deleteAction' => DeleteAction::class,
    'replaceAction' => ReplaceAction::class,
    'viewAction' => ViewAction::class,
    'watchAction' => WatchAction::class,
    'installAction' => InstallAction::class,
    'eatAction' => EatAction::class,
    'readAction' => ReadAction::class,
    'listenAction' => ListenAction::class,
    'drinkAction' => DrinkAction::class,
    'playGameAction' => PlayGameAction::class,
    'checkAction' => CheckAction::class,
    'discoverAction' => DiscoverAction::class,
    'trackAction' => TrackAction::class,
    'activateAction' => ActivateAction::class,
    'suspendAction' => SuspendAction::class,
    'deactivateAction' => DeactivateAction::class,
    'resumeAction' => ResumeAction::class,
    'takeAction' => TakeAction::class,
    'downloadAction' => DownloadAction::class,
    'moneyTransfer' => MoneyTransfer::class,
    'sendAction' => SendAction::class,
    'receiveAction' => ReceiveAction::class,
    'borrowAction' => BorrowAction::class,
    'lendAction' => LendAction::class,
    'returnAction' => ReturnAction::class,
    'giveAction' => GiveAction::class,
    'befriendAction' => BefriendAction::class,
    'registerAction' => RegisterAction::class,
    'marryAction' => MarryAction::class,
    'subscribeAction' => SubscribeAction::class,
    'unRegisterAction' => UnRegisterAction::class,
    'leaveAction' => LeaveAction::class,
    'joinAction' => JoinAction::class,
    'followAction' => FollowAction::class,
    'paintAction' => PaintAction::class,
    'filmAction' => FilmAction::class,
    'drawAction' => DrawAction::class,
    'photographAction' => PhotographAction::class,
    'writeAction' => WriteAction::class,
    'cookAction' => CookAction::class,
    'ignoreAction' => IgnoreAction::class,
    'reviewAction' => ReviewAction::class,
    'quoteAction' => QuoteAction::class,
    'preOrderAction' => PreOrderAction::class,
    'buyAction' => BuyAction::class,
    'orderAction' => OrderAction::class,
    'payAction' => PayAction::class,
    'tipAction' => TipAction::class,
    'sellAction' => SellAction::class,
    'rentAction' => RentAction::class,
    'donateAction' => DonateAction::class,
    'acceptAction' => AcceptAction::class,
    'rejectAction' => RejectAction::class,
    'assignAction' => AssignAction::class,
    'authorizeAction' => AuthorizeAction::class,
    'cancelAction' => CancelAction::class,
    'scheduleAction' => ScheduleAction::class,
    'reserveAction' => ReserveAction::class,
    'wearAction' => WearAction::class,
    'shareAction' => ShareAction::class,
    'checkOutAction' => CheckOutAction::class,
    'checkInAction' => CheckInAction::class,
    'commentAction' => CommentAction::class,
    'replyAction' => ReplyAction::class,
    'askAction' => AskAction::class,
    'inviteAction' => InviteAction::class,
    'dislikeAction' => DislikeAction::class,
    'disagreeAction' => DisagreeAction::class,
    'wantAction' => WantAction::class,
    'agreeAction' => AgreeAction::class,
    'likeAction' => LikeAction::class,
    'endorseAction' => EndorseAction::class,
    'voteAction' => VoteAction::class,
    'appendAction' => AppendAction::class,
    'prependAction' => PrependAction::class,
    'confirmAction' => ConfirmAction::class,
    'rsvpAction' => RsvpAction::class,
])]
#[ORM\Table(name: '`action`')]
class Action extends Thing
{
    /**
     * The location of, for example, where an event is happening, where an organization is located, or where an action takes place.
     *
     * @see https://schema.org/location
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
    #[ApiProperty(types: ['https://schema.org/location'])]
    private ?PostalAddress $location = null;

    /**
     * The object that helped the agent perform the action. E.g. John wrote a book with \*a pen\*.
     *
     * @see https://schema.org/instrument
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/instrument'])]
    private ?Thing $instrument = null;

    /**
     * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
     *
     * @see https://schema.org/provider
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/provider'])]
    private ?Person $provider = null;

    /**
     * The object upon which the action is carried out, whose state is kept intact or changed. Also known as the semantic roles patient, affected or undergoer (which change their state) or theme (which doesn't). E.g. John read \*a book\*.
     *
     * @see https://schema.org/object
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/object'])]
    private ?Thing $object = null;

    /**
     * The endTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to end. For actions that span a period of time, when the action was performed. E.g. John wrote a book from January to \*December\*. For media, including audio and video, it's the time offset of the end of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/endTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/endTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endTime = null;

    /**
     * The startTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to start. For actions that span a period of time, when the action was performed. E.g. John wrote a book from \*January\* to December. For media, including audio and video, it's the time offset of the start of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/startTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/startTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startTime = null;

    /**
     * Other co-agents that participated in the action indirectly. E.g. John wrote a book with \*Steve\*.
     *
     * @see https://schema.org/participant
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/participant'])]
    #[Assert\NotNull]
    private Person $participant;

    /**
     * Indicates a target EntryPoint, or url, for an Action.
     *
     * @see https://schema.org/target
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EntryPoint')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/target'])]
    #[Assert\NotNull]
    private EntryPoint $target;

    /**
     * The result produced in the action. E.g. John wrote \*a book\*.
     *
     * @see https://schema.org/result
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/result'])]
    private ?Thing $result = null;

    /**
     * The direct performer or driver of the action (animate or inanimate). E.g. \*John\* wrote a book.
     *
     * @see https://schema.org/agent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/agent'])]
    private ?Person $agent = null;

    /**
     * For failed actions, more information on the cause of the failure.
     *
     * @see https://schema.org/error
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/error'])]
    #[Assert\NotNull]
    private Thing $error;

    /**
     * Indicates the current disposition of the Action.
     *
     * @see https://schema.org/actionStatus
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/actionStatus'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [ActionStatusType::class, 'toArray'])]
    private string $actionStatus;

    public function setLocation(?PostalAddress $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?PostalAddress
    {
        return $this->location;
    }

    public function setInstrument(?Thing $instrument): void
    {
        $this->instrument = $instrument;
    }

    public function getInstrument(): ?Thing
    {
        return $this->instrument;
    }

    public function setProvider(?Person $provider): void
    {
        $this->provider = $provider;
    }

    public function getProvider(): ?Person
    {
        return $this->provider;
    }

    public function setObject(?Thing $object): void
    {
        $this->object = $object;
    }

    public function getObject(): ?Thing
    {
        return $this->object;
    }

    public function setEndTime(?\DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setParticipant(Person $participant): void
    {
        $this->participant = $participant;
    }

    public function getParticipant(): Person
    {
        return $this->participant;
    }

    public function setTarget(EntryPoint $target): void
    {
        $this->target = $target;
    }

    public function getTarget(): EntryPoint
    {
        return $this->target;
    }

    public function setResult(?Thing $result): void
    {
        $this->result = $result;
    }

    public function getResult(): ?Thing
    {
        return $this->result;
    }

    public function setAgent(?Person $agent): void
    {
        $this->agent = $agent;
    }

    public function getAgent(): ?Person
    {
        return $this->agent;
    }

    public function setError(Thing $error): void
    {
        $this->error = $error;
    }

    public function getError(): Thing
    {
        return $this->error;
    }

    public function setActionStatus(string $actionStatus): void
    {
        $this->actionStatus = $actionStatus;
    }

    public function getActionStatus(): string
    {
        return $this->actionStatus;
    }
}
