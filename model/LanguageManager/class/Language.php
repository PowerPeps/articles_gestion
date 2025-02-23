<?php

class Language
{
    private $language;
    private $translations;

    public function __construct($language = 'en')
    {
        $this->language = $language;
        $this->load();
    }

    private function load()
    {
        $filePath = __DIR__ . '/../lang/' . $this->language . '.php';

        if (file_exists($filePath)) {
            $this->translations = require $filePath;
        } else {
            $this->translations = require __DIR__ . '/../lang/en.php';
        }
    }

    public function get($key)
    {
        return $this->translations[$key] ?? $key;
    }
}