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

namespace Demo\UnitTest\Controller;

use BwlabDemoUnitTest\Form\Type\ConfigurationType;
use Configuration;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;

class ConfigurationController extends FrameworkBundleAdminController
{
	public function configuration(Request $request)
	{
		$conf = [
		    'CONFNAME',
		];
		$data = [];
		foreach ($conf as $key) {
		    $data[$key] = Configuration::get(
		        $key,
		        $this->getContext()->shop->id_shop_group,
		        $this->getContext()->shop->id
		    );
		}
		$form = $this->createForm(ConfigurationType::class, $data);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
		$data = $form->getData();
		    foreach ($data as $conf_name => $conf_value) {
		        Configuration::updateValue(
		            $conf_name,
		            $conf_value,
		            $this->getContext()->shop->id_shop_group,
		            $this->getContext()->shop->id
		        );
		    }
		$this->addFlash('success', 'Configurazione salvata');
		}
		return $this->render(
		    '@Modules/demounittest/views/templates/admin/controller/admin_configuration.html.twig',
		    array(
		        'form' => $form->createView(),
		        )
		    );
	}
}
