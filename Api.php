<?php

namespace Zelenin\Telegram\Bot;

use stdClass;
use Zelenin\Telegram\Bot\Client\Client;
use Zelenin\Telegram\Bot\Client\Response;
use Zelenin\Telegram\Bot\Exception\NotOkException;
use Zelenin\Telegram\Bot\Type\Chat;
use Zelenin\Telegram\Bot\Type\ChatMember;
use Zelenin\Telegram\Bot\Type\File;
use Zelenin\Telegram\Bot\Type\Keyboard;
use Zelenin\Telegram\Bot\Type\Message;
use Zelenin\Telegram\Bot\Type\Update;
use Zelenin\Telegram\Bot\Type\User;
use Zelenin\Telegram\Bot\Type\UserProfilePhotos;

final class Api
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param array $params
     *
     * @return Response
     */
    public function request($method, array $params = [])
    {
        $response = $this->client->request($method, $params);
        if (!$response->getOk()) {
            throw new NotOkException(sprintf('Code: %s. Description: "%s".', $response->getErrorCode(), $response->getDescription()));
        }

        return $response;
    }

    /**
     * @return User
     */
    public function getMe()
    {
        return User::createFromResponse($this->request('getMe'));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendMessage(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendMessage', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function forwardMessage(array $params)
    {
        return Message::createFromResponse($this->request('forwardMessage', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendPhoto(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendPhoto', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendAudio(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendAudio', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendDocument(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendDocument', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendSticker(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendSticker', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendVideo(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendVideo', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendVoice(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendVideo', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendLocation(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendLocation', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendVenue(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendVenue', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function sendContact(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('sendContact', $params));
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function sendChatAction(array $params)
    {
        return $this->request('sendChatAction', $params);
    }

    /**
     * @param array $params
     *
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos(array $params)
    {
        return UserProfilePhotos::createFromResponse($this->request('getUserProfilePhotos', $params));
    }

    /**
     * @param array $params
     *
     * @return File
     */
    public function getFile(array $params)
    {
        return File::createFromResponse($this->request('getFile', $params));
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function kickChatMember(array $params)
    {
        return $this->request('kickChatMember', $params);
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function leaveChat(array $params)
    {
        return $this->request('leaveChat', $params);
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function unbanChatMember(array $params)
    {
        return $this->request('unbanChatMember', $params);
    }

    /**
     * @param array $params
     *
     * @return Chat
     */
    public function getChat(array $params)
    {
        return Chat::createFromResponse($this->request('getChat', $params));
    }

    /**
     * @param array $params
     *
     * @return ChatMember[]
     */
    public function getChatAdministrators(array $params)
    {
        return array_map(function ($user) {
            return ChatMember::create($user);
        }, $this->request('getChatAdministrators', $params)->getResult());
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function getChatMembersCount(array $params)
    {
        return $this->request('getChatMembersCount', $params);
    }

    /**
     * @param array $params
     *
     * @return ChatMember
     */
    public function getChatMember(array $params)
    {
        return ChatMember::createFromResponse($this->request('getChatMember', $params)->getResult());
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function answerCallbackQuery(array $params)
    {
        return $this->request('answerCallbackQuery', $params);
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function editMessageText(array $params)
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('editMessageText', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function editMessageCaption(array $params = [])
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('editMessageCaption', $params));
    }

    /**
     * @param array $params
     *
     * @return Message
     */
    public function editMessageReplyMarkup(array $params = [])
    {
        if (isset($params['reply_markup']) && $params['reply_markup'] instanceof Keyboard) {
            $params['reply_markup'] = json_encode($params['reply_markup']);
        }

        return Message::createFromResponse($this->request('editMessageReplyMarkup', $params));
    }

    /**
     * @param array $params
     *
     * @return Update[]
     */
    public function getUpdates(array $params = [])
    {
        return array_map(function (stdClass $update) {
            return Update::create($update);
        }, $this->request('getUpdates', $params)->getResult());
    }

    /**
     * @param array $params
     *
     * @return Response
     */
    public function setWebhook(array $params = [])
    {
        return $this->request('setWebhook', $params);
    }
}
