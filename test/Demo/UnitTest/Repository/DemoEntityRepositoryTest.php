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

namespace Demo\UnitTest\Repository;

use PHPUnit\Framework\TestCase;

class DemoEntityRepositoryTest extends TestCase
{
    /**
     * @var \DemoUnitTest
     */
    protected $module;

    public function test_fetchAll()
    {
        /** @var DemoEntityRepository $repo */
        $repo = $this->module->get('demo.unit.test.repository.entity');
        $res = $repo->fetchAllRecords();
        $this->assertCount(
            3,
            $res
        );
    }

    protected function setUp(): void
    {
        $this->module = \Module::getInstanceByName('demounittest');
        $table = 'demo_entity';

        \Db::getInstance()->execute('truncate ' . _DB_PREFIX_ . $table);

        foreach (array(['greeting' => 'ciao'], ['greeting' => 'hello'], ['greeting' => 'bonjour']) as $item) {
            \Db::getInstance()->insert(
                $table,
                $item

            );
        }

    }

}
