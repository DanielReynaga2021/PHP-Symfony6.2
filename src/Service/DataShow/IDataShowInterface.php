<?php

namespace App\Service\DataShow;
use App\Model\Request\DataShowRequest;

interface IDataShowInterface
{
    public function addDataShow(DataShowRequest $dataShowRequest);

}