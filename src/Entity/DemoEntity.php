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

namespace Demo\UnitTest\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Demo\UnitTest\Repository\DemoEntityRepository")
 */
class DemoEntity
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id_entity", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;
    /**
     * @var string
     * @ORM\Column(name="greeting", type="string", length=50, nullable=true)
     */
    private string $greeting;

    public static function createTable()
    {
        $sql = "create table if not exists " . _DB_PREFIX_ . "demo_entity
                    (
                        id_entity int auto_increment,
                        greeting    char(50) not null,
                        constraint " . _DB_PREFIX_ . "_demo_entity_pk
                            primary key (id_entity)
                    )";
        return \Db::getInstance()->execute($sql);
    }

    public static function dropTable()
    {
        $sql = "drop table if exists " . _DB_PREFIX_ . "demo_entity;";
        return \Db::getInstance()->execute($sql);
    }

    /**
     * @return string
     */
    public function getGreeting(): string
    {
        return $this->greeting;
    }

    /**
     * @param string $greeting
     * @return $this
     */
    public function setGreeting(string $greeting): self
    {
        $this->greeting = $greeting;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}