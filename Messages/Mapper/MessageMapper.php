<?php

/**
 * @uses Message
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class MessageMapper
{
    public static function objectToArray(Message $message)
    {
        return [
            "context" => $message->getContext(),
            "icon" => $message->getIcon(),
            "className" => $message->getClassName(),
            "title" => $message->getTitle(),
            "content" => $message->getContent(),
            "timer" => $message->getTimer(),
            "link" => $message->getLink(),
            "enabled" => $message->getEnabled()
        ];
    }

    public static function objectToJson(Message $message)
    {
        return json_encode(self::objectToArray($message), JSON_FORCE_OBJECT);
    }
}