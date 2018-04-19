<?php
namespace Judileroi\MediaBornageBundle;
use Claroline\CoreBundle\Library\DistributionPluginBundle;
use Claroline\KernelBundle\Bundle\ConfigurationBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use FormaLibre\BulletinBundle\Installation\AdditionalInstaller;

class MediaBornageBundle extends DistributionPluginBundle
{
    public function supports($environment)
    {
        return true;
    }

    public function getConfiguration($environment)
    {
        $config = new ConfigurationBuilder();

        return $config->addRoutingResource(__DIR__.'/Resources/config/routing.yml', null);
    }

    public function getExtraRequirements()
    {
        return [
        'libav-tools' => [
            'test' => function () {
                $cmd = 'avconv -h';
                exec($cmd, $output, $return);

                return count($output) > 0 && $return === 0;
            },
            'failure_msg' => 'libavtools_not_installed',
        ],
    ];
    }
}

?>