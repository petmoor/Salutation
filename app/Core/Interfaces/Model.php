<?php

namespace PMoor\Core\Interfaces;

interface Model {
    public function get ($value);
    public function save () :bool;
    public function del () :bool;
    public function validate () :bool;
}
