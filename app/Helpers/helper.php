<?php

function Email(string $body, string $message, string $mail) {
    return Mail::raw($body, function ($message)use($mail) {

                $message->from('kaveri.nagunuri@karmanya.co.in', 'kaveri');
                $message->to($mail)->subject('Received Email');
            });
}
