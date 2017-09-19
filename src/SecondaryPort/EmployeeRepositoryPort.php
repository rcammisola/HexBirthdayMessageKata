<?php

namespace Hex\SecondaryPort;

interface EmployeeRepositoryPort
{
    public function findBornOn($date);
}
