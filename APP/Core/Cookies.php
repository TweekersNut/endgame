<?php

namespace APP\Core;

class Cookies {

    private $name = false;
    private $value = "";
    private $time;
    private $domain = false;
    private $path = false;
    private $secure = false;

    public function create() {
        return setcookie($this->name, $this->getValue(), $this->getTime(), $this->getPath(), $this->getDomain(), $this->getSecure(), true);
    }

    public function get() {
        return $_COOKIE[$this->getName()];
    }

    public function delete() {
        return setcookie($this->name, '', time() - 3600, $this->getPath(), $this->getDomain(), $this->getSecure(), true);
    }

    public function setDomain($domain) {
        $this->domain = $domain;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function setName($id) {
        $this->name = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getPath() {
        return $this->path;
    }

    public function setSecure($secure) {
        $this->secure = $secure;
    }

    public function getSecure() {
        return $this->secure;
    }

    public function setTime($time) {
        // Create a date
        $date = new DateTime();
        // Modify it (+1hours; +1days; +20years; -2days etc)
        $date->modify($time);
        // Store the date in UNIX timestamp.
        $this->time = $date->getTimestamp();
    }

    public function getTime() {
        return $this->time;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

}
