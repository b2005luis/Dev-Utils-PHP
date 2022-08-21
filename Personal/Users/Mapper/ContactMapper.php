<?php

/**
 * Responsible by mapper contacts of the User
 * @uses Contact
 * @author Luis Alberto Batista Pedroso
 */
class ContactMapper
{
    public static function objectToArray(Contact $contact): array
    {
        return [
            "id" => $contact->getId(),
            "content" => $contact->getContent(),
            "description" => $contact->getDescription()
        ];
    }

    public static function listObjectsToArray(array $litOfContacts): array
    {
        $arrayOfContacts = [];

        foreach ($litOfContacts as $contact) {
            $arrayOfContacts[] = self::objectToArray($contact);
        }

        return $arrayOfContacts;
    }

    public static function objectToJson(Contact $contact): string
    {
        return json_encode(self::objectToArray($contact));
    }
}