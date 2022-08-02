<?php

namespace App\Console\Commands\Concerns;

use Illuminate\Support\Facades\Validator;

trait WithInputValidation
{
    public function askWithValidation(
        string $message,
        array $rules = [],
        string $name = 'value',
        bool $isSecret = false
    ) {
        $answer = null;
        if ($isSecret) {
            $answer = $this->secret($message);
        } else {
            $answer = $this->ask($message);
        }

        $validator = Validator::make([
            $name => $answer,
        ], [
            $name => $rules,
        ]);

        if (! $validator->fails()) {
            return $answer;
        }

        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }

        return $this->askWithValidation($message, $rules, $name, $isSecret);
    }
}
