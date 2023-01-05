<?php

namespace App\Service\DataShow;

use App\Model\Request\DataShowRequest;
class DataShowService{
    /**
     * @var DataShowBuilder
     */
    private $dataShowBuilder;

    public function __construct(
        DataShowBuilder $dataShowBuilder
    ) {
        $this->dataShowBuilder = $dataShowBuilder;
    }

    public function saveDataShow(DataShowRequest $dataShowRequest){
        $strategy = $this->dataShowBuilder->getConcreteClass($dataShowRequest->getEntity());
        $strategy->addDataShow($dataShowRequest);
    }

}