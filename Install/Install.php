<?php

namespace Apps\Tms\Components\Dashboards\Install;

use System\Base\BasePackage;
use System\Base\Providers\ModulesServiceProvider\MenuInstaller;

class Install extends BasePackage
{
    protected $menuInstaller;

    public function init()
    {
        $this->menuInstaller = new MenuInstaller;

        return $this;
    }

    public function install()
    {
        $dashboards = $this->basepackages->dashboards->getDashboardsByAppType('tms');

        if (count($dashboards) === 0) {
            $this->basepackages->dashboards->addDashboard(
                [
                    "name"          => "TMS Default",
                    "app_type"      => "tms",
                    "app_default"   => 1,
                    "settings"      => [
                        "maxWidgetsPerDashboard"    => 10,
                        "id"                        => 2
                    ]
                ]
            );
        }

        $this->installMenu();

        return true;
    }

    protected function installMenu()
    {
        $this->menuInstaller->installMenu($this);

        return true;
    }

    public function uninstall($remove = false)
    {
        if ($remove) {
            $this->menuInstaller->uninstallMenu($this);
        }

        return true;
    }
}
