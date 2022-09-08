<?php

namespace FluxEco\DockerManager;

class Api
{
    private function __construct(
        public Adapters\Outbounds $outbounds,
        public Core\Ports\Service $service
    ) {

    }

    public static function new(Adapters\Configs $configs)
    {
        $outbounds = Adapters\Outbounds::new($configs);
        return new self(
            $outbounds,
            Core\Ports\Service::new($outbounds)
        );
    }

    public function provideApplicationSourceFiles()
    {
        $this->service->provideApplicationSourceFiles();
    }

}