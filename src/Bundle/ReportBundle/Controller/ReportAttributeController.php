<?php

declare(strict_types=1);

namespace Bundle\ReportBundle\Controller;

use FOS\RestBundle\View\View;
use Bundle\ReportBundle\Form\Type\ReportAttributeChoiceType;
use Bundle\ResourceBundle\Controller\ResourceController;
use Component\Attribute\Model\AttributeInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ReportAttributeController extends ResourceController
{
    /**
     * @param Request $request
     * @param string $template
     *
     * @return Response
     */
    public function getAttributeTypesAction(Request $request, string $template): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $view = View::create()
            ->setTemplate($template)
            ->setTemplateVar($this->metadata->getPluralName())
            ->setData([
                'types' => $this->get('sylius.registry.attribute_type')->all(),
                'metadata' => $this->metadata,
            ])
        ;

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @return Response
     */
    public function renderAttributesAction(Request $request): Response
    {
        $template = $request->attributes->get('template', 'SyliusAttributeBundle::attributeChoice.html.twig');

        $form = $this->get('form.factory')->create(ReportAttributeChoiceType::class, null, [
            'multiple' => true,
        ]);

        return $this->render($template, ['form' => $form->createView()]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function renderAttributeValueFormsAction(Request $request): Response
    {
        $template = $request->attributes->get('template', 'SyliusAttributeBundle::attributeValueForms.html.twig');

        $form = $this->get('form.factory')->create(ReportAttributeChoiceType::class, null, [
            'multiple' => true,
        ]);
        $form->handleRequest($request);

        $attributes = $form->getData();
        if (null === $attributes) {
            throw new BadRequestHttpException();
        }

        $localeCodes = $this->get('sylius.translation_locale_provider')->getDefinedLocalesCodes();

        $forms = [];
        foreach ($attributes as $attribute) {
            $forms[$attribute->getCode()] = $this->getAttributeFormsInAllLocales($attribute, $localeCodes);
        }

        return $this->render($template, [
            'forms' => $forms,
            'count' => $request->query->get('count'),
            'metadata' => $this->metadata,
        ]);
    }

    /**
     * @param AttributeInterface $attribute
     * @param array|string[] $localeCodes
     *
     * @return array|FormView[]
     */
    protected function getAttributeFormsInAllLocales(AttributeInterface $attribute, array $localeCodes): array
    {
        $attributeForm = $this->get('sylius.form_registry.attribute_type')->get($attribute->getType(), 'default');

        $forms = [];
        foreach ($localeCodes as $localeCode) {
            $forms[$localeCode] = $this
                ->get('form.factory')
                ->createNamed('value', $attributeForm, null, ['label' => $attribute->getName(), 'configuration' => $attribute->getConfiguration()])
                ->createView()
            ;
        }

        return $forms;
    }
}
