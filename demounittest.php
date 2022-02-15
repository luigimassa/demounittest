<?php
/**
 * Copyright since 2022 Bwlab.it and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@bwlab.it so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    Bwlab.it SA and Contributors <info@bwlab.it>
 * @copyright Since 2022 Bwlab.it and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

use Demo\UnitTest\Entity\DemoEntity;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

class DemoUnitTest extends Module
{
    protected $config_form = false;


    public function __construct()
    {
        $this->name = 'demounittest';
        $this->version = '1.0.0';
        $this->author = 'info@bwlab.it';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans(
            'How to use Unit Test',
            [],
            'Modules.Demounittest.Admin'
        );
        $this->description = $this->trans(
            'How to use Unit Test',
            [],
            'Modules.Demounittest.Admin'
        );

        $this->confirmUninstall = $this->trans(
            'Are you sure?',
            [],
            'Modules.Demounittest.Admin'
        );

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function getContent()
    {
        Tools::redirectAdmin(
            $this->context->link->getAdminLink(
                'AdminDemounittest',
                //edit
                true,
                ['route' => 'admin_demounittest_configuration']
            )
        );
    }

    public function hookDisplayHome($params)
    {
        $hook = $this->get('demo.unit.test.hook.display_home');
        $result = $hook->exec($params);
        $this->smarty->assign([
            'greetings' => $result
        ]);
        return $this->fetch('module:demounittest/views/templates/hook/display_home.tpl');
    }

    public function install()
    {

        $hooks = ['displayHome'];
        return DemoEntity::createTable() && parent::install() &&
            $this->registerHook($hooks);
    }

    public function uninstall()
    {
        DemoEntity::dropTable();
        return parent::uninstall();
    }
}
