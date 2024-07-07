<?php

namespace Modules\Notifications\Dtos;

use Illuminate\Support\Str;

class BaseDto
{
    public function toArray(): array
    {
        return collect(get_object_vars($this))->mapWithKeys(fn($item, string $key) => [
                Str::of($key)->snake()->value() => $this->getter($key),
            ])->toArray();
    }

    public function getter(string $key)
    {
        $getFunctionName = "get" . Str::of($key)->studly()->value();
        $isFunctionName = "is" . Str::of($key)->studly()->value();

        if (method_exists($this, $getFunctionName)) {
            return $this->$getFunctionName();
        }

        if (method_exists($this, $isFunctionName)) {
            return $this->$isFunctionName();
        }

        return $this->$key;
    }

}
