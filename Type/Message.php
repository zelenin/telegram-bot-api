<?php

namespace Zelenin\Telegram\Bot\Type;

final class Message extends Type
{
    /**
     * Unique message identifier
     *
     * @var integer
     */
    public $message_id;

    /**
     * Sender
     *
     * @var User
     */
    public $from;

    /**
     * Date the message was sent in Unix time
     *
     * @var integer
     */
    public $date;

    /**
     * Conversation the message belongs to — user in case of a private message, GroupChat in case of a group
     *
     * @var User|GroupChat
     */
    public $chat;

    /**
     * Optional. For forwarded messages, sender of the original message
     *
     * @var User
     */
    public $forward_from;

    /**
     * Optional. For messages forwarded from a channel, information about the original channel
     *
     * @var Chat
     */
    public $forward_from_chat;

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     *
     * @var integer
     */
    public $forward_date;

    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     *
     * @var static
     */
    public $reply_to_message;

    /**
     * Optional. Date the message was last edited in Unix time
     *
     * @var int
     */
    public $edit_date;

    /**
     * For text messages, the actual UTF-8 text of the message
     *
     * @var string
     */
    public $text;

    /**
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     *
     * @var MessageEntity[]
     */
    public $entities;

    /**
     * Optional. Message is an audio file, information about the file
     *
     * @var Audio
     */
    public $audio;

    /**
     * Optional. Message is a general file, information about the file
     *
     * @var Document
     */
    public $document;

    /**
     * Optional. Message is a photo, available sizes of the photo
     *
     * @var PhotoSize[]
     */
    public $photo;

    /**
     * Optional. Message is a sticker, information about the sticker
     *
     * @var Sticker
     */
    public $sticker;

    /**
     * Optional. Message is a video, information about the video
     *
     * @var Video
     */
    public $video;

    /**
     * Optional. Message is a voice message, information about the file
     *
     * @var Voice
     */
    public $voice;

    /**
     * Optional. Caption for the photo or video
     *
     * @var string
     */
    public $caption;

    /**
     * Optional. Message is a shared contact, information about the contact
     *
     * @var Contact
     */
    public $contact;

    /**
     * Optional. Message is a shared location, information about the location
     *
     * @var Location
     */
    public $location;

    /**
     * Optional. Message is a venue, information about the venue
     *
     * @var Venue
     */
    public $venue;

    /**
     * Optional. A new member was added to the group, information about them (this member may be the bot itself)
     *
     * @var User
     */
    public $new_chat_member;

    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     *
     * @var User
     */
    public $left_chat_member;

    /**
     * Optional. A group title was changed to this value
     *
     * @var string
     */
    public $new_chat_title;

    /**
     * Optional. A group photo was change to this value
     *
     * @var PhotoSize[]
     */
    public $new_chat_photo;

    /**
     * Optional. Informs that the group photo was deleted
     *
     * @var boolean
     */
    public $delete_chat_photo;

    /**
     * Optional. Informs that the group has been created
     *
     * @var boolean
     */
    public $group_chat_created;

    /**
     * Optional. Service message: the supergroup has been created
     *
     * @var boolean
     */
    public $super_group_chat_created;

    /**
     * Optional. Service message: the channel has been created
     *
     * @var boolean
     */
    public $channel_chat_created;

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier, not exceeding 1e13 by absolute value
     *
     * @var int
     */
    public $migrate_to_chat_id;

    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier, not exceeding 1e13 by absolute value
     *
     * @var int
     */
    public $migrate_from_chat_id;

    /**
     * Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
     *
     * @var Message
     */
    public $pinned_message;

    /**
     * @param array $attributes
     */
    public function loadRelated(array $attributes)
    {
        parent::loadRelated($attributes);

        if (isset($attributes['from'])) {
            $this->from = User::create($attributes['from']);
        }

        if (isset($attributes['chat'])) {
            $this->chat = isset($attributes['chat']->title) ? GroupChat::create($attributes['chat']) : User::create($attributes['chat']);
        }

        if (isset($attributes['forward_from'])) {
            $this->forward_from = User::create($attributes['forward_from']);
        }

        if (isset($attributes['forward_from_chat'])) {
            $this->forward_from_chat = Chat::create($attributes['forward_from_chat']);
        }

        if (isset($attributes['reply_to_message'])) {
            $this->reply_to_message = Message::create($attributes['reply_to_message']);
        }

        if (isset($attributes['entities'])) {
            $this->entities = array_map(function ($entity) {
                return MessageEntity::create($entity);
            }, $attributes['entities']);
        }

        if (isset($attributes['audio'])) {
            $this->audio = Audio::create($attributes['audio']);
        }

        if (isset($attributes['document'])) {
            $this->document = Document::create($attributes['document']);
        }

        if (isset($attributes['photo'])) {
            $this->photo = array_map(function ($photo) {
                return PhotoSize::create($photo);
            }, $attributes['photo']);
        }

        if (isset($attributes['sticker'])) {
            $this->sticker = Sticker::create($attributes['sticker']);
        }

        if (isset($attributes['video'])) {
            $this->video = Video::create($attributes['video']);
        }

        if (isset($attributes['voice'])) {
            $this->voice = Voice::create($attributes['voice']);
        }

        if (isset($attributes['contact'])) {
            $this->contact = Contact::create($attributes['contact']);
        }

        if (isset($attributes['location'])) {
            $this->location = Location::create($attributes['location']);
        }

        if (isset($attributes['venue'])) {
            $this->venue = Venue::create($attributes['venue']);
        }

        if (isset($attributes['new_chat_member'])) {
            $this->new_chat_member = User::create($attributes['new_chat_member']);
        }

        if (isset($attributes['left_chat_member'])) {
            $this->left_chat_member = new User($attributes['left_chat_member']);
        }

        if (isset($attributes['new_chat_photo'])) {
            $this->new_chat_photo = array_map(function ($photo) {
                return PhotoSize::create($photo);
            }, $attributes['new_chat_photo']);
        }
    }
}
