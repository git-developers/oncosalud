<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use FOS\RestBundle\View\View;
use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Bundle\ResourceBundle\Controller\ResourceController;
use Bundle\UserBundle\Form\Model\ChangePassword;
use Bundle\UserBundle\Form\Model\PasswordReset;
use Bundle\UserBundle\Form\Model\PasswordResetRequest;
use Bundle\UserBundle\Form\Type\UserChangePasswordType;
use Bundle\UserBundle\Form\Type\UserRequestPasswordResetType;
use Bundle\UserBundle\Form\Type\UserResetPasswordType;
use Bundle\UserBundle\UserEvents;
use Component\User\Model\UserInterface;
use Component\User\Security\Generator\GeneratorInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Webmozart\Assert\Assert;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class CotizacionController extends BaseController
{
	
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function cotizacionAction(Request $request): Response
    {
	
	    $parameters = [
		    'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
	    ];
	    $applicationName = $this->container->getParameter('application_name');
	    $this->metadata = new Metadata('tianos', $applicationName, $parameters);
	
	    //CONFIGURATION
	    $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
	    $template = $configuration->getTemplate('');
	    $action = $configuration->getAction();
	    $formType = $configuration->getFormType();
	    $vars = $configuration->getVars();
	    $rolesGranted = $configuration->getRolesGranted();
	    $entity = $configuration->getEntity();
	    $entity = new $entity();
	
	    //IS_GRANTED
	    if (!$this->isGranted($rolesGranted)) {
		    return $this->render(
			    "GridBundle::error.html.twig",
			    [
				    'message' => self::ACCESS_DENIED_MSG,
			    ]
		    );
	    }
	
	    $form = $this->createForm($formType, $entity, ['form_data' => []]);
	    $form->handleRequest($request);
	
	    if ($form->isSubmitted()) {
		
		    $errors = [];
		    $entityJson = null;
		    $status = self::STATUS_ERROR;
		
		    try {
			
			    if ($form->isValid()) {
				
				    $this->persist($entity);
				
				    $varsRepository = $configuration->getRepositoryVars();
				    $entity = $this->rowImage($entity);
				    $entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
				    $status = self::STATUS_SUCCESS;
			    } else {
				    foreach ($form->getErrors(true) as $key => $error) {
					    if ($form->isRoot()) {
						    $errors[] = $error->getMessage();
					    } else {
						    $errors[] = $error->getMessage();
					    }
				    }
			    }
			
		    } catch (\Exception $e) {
			    $errors[] = $e->getMessage();
		    }
		
		    return $this->json([
			    'status' => $status,
			    'errors' => $errors,
			    'entity' => $entity,
		    ]);
	    }
	
	    return $this->render(
		    $template,
		    [
			    'vars' => $vars,
			    'action' => $action,
			    'form' => $form->createView(),
		    ]
	    );
    }
	
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function resultadoCotizacionAction(Request $request): Response
    {
	
	    $parameters = [
		    'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
	    ];
	    $applicationName = $this->container->getParameter('application_name');
	    $this->metadata = new Metadata('tianos', $applicationName, $parameters);
	
	    //CONFIGURATION
	    $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
	    $template = $configuration->getTemplate('');
	    $action = $configuration->getAction();
	    $formType = $configuration->getFormType();
	    $vars = $configuration->getVars();
	    $rolesGranted = $configuration->getRolesGranted();
	    $entity = $configuration->getEntity();
	    $entity = new $entity();
	
	    //IS_GRANTED
	    if (!$this->isGranted($rolesGranted)) {
		    return $this->render(
			    "GridBundle::error.html.twig",
			    [
				    'message' => self::ACCESS_DENIED_MSG,
			    ]
		    );
	    }
	
	    $form = $this->createForm($formType, $entity, ['form_data' => []]);
	    $form->handleRequest($request);
	
	    if ($form->isSubmitted()) {
		
		    $errors = [];
		    $entityJson = null;
		    $status = self::STATUS_ERROR;
		
		    try {
			
			    if ($form->isValid()) {
				
				    $this->persist($entity);
				
				    $varsRepository = $configuration->getRepositoryVars();
				    $entity = $this->rowImage($entity);
				    $entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
				    $status = self::STATUS_SUCCESS;
			    } else {
				    foreach ($form->getErrors(true) as $key => $error) {
					    if ($form->isRoot()) {
						    $errors[] = $error->getMessage();
					    } else {
						    $errors[] = $error->getMessage();
					    }
				    }
			    }
			
		    } catch (\Exception $e) {
			    $errors[] = $e->getMessage();
		    }
		
		    return $this->json([
			    'status' => $status,
			    'errors' => $errors,
			    'entity' => $entity,
		    ]);
	    }
	
	    return $this->render(
		    $template,
		    [
			    'vars' => $vars,
			    'action' => $action,
			    'form' => $form->createView(),
		    ]
	    );
    }
    
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function registrarSolicitudAction(Request $request): Response
    {
	
	    $parameters = [
		    'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
	    ];
	    $applicationName = $this->container->getParameter('application_name');
	    $this->metadata = new Metadata('tianos', $applicationName, $parameters);
	
	    //CONFIGURATION
	    $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
	    $template = $configuration->getTemplate('');
	    $action = $configuration->getAction();
	    $formType = $configuration->getFormType();
	    $vars = $configuration->getVars();
	    $rolesGranted = $configuration->getRolesGranted();
	    $entity = $configuration->getEntity();
	    $entity = new $entity();
	
	    //IS_GRANTED
	    if (!$this->isGranted($rolesGranted)) {
		    return $this->render(
			    "GridBundle::error.html.twig",
			    [
				    'message' => self::ACCESS_DENIED_MSG,
			    ]
		    );
	    }
	
	    $form = $this->createForm($formType, $entity, ['form_data' => []]);
	    $form->handleRequest($request);
	
	    if ($form->isSubmitted()) {
		
		    $errors = [];
		    $entityJson = null;
		    $status = self::STATUS_ERROR;
		
		    try {
			
			    if ($form->isValid()) {
				
				    $this->persist($entity);
				
				    $varsRepository = $configuration->getRepositoryVars();
				    $entity = $this->rowImage($entity);
				    $entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
				    $status = self::STATUS_SUCCESS;
			    } else {
				    foreach ($form->getErrors(true) as $key => $error) {
					    if ($form->isRoot()) {
						    $errors[] = $error->getMessage();
					    } else {
						    $errors[] = $error->getMessage();
					    }
				    }
			    }
			
		    } catch (\Exception $e) {
			    $errors[] = $e->getMessage();
		    }
		
		    return $this->json([
			    'status' => $status,
			    'errors' => $errors,
			    'entity' => $entity,
		    ]);
	    }
	
	    return $this->render(
		    $template,
		    [
			    'vars' => $vars,
			    'action' => $action,
			    'form' => $form->createView(),
		    ]
	    );
    }
    
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function aportanteAction(Request $request): Response
    {
	
	    $parameters = [
		    'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
	    ];
	    $applicationName = $this->container->getParameter('application_name');
	    $this->metadata = new Metadata('tianos', $applicationName, $parameters);
	
	    //CONFIGURATION
	    $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
	    $template = $configuration->getTemplate('');
	    $action = $configuration->getAction();
	    $formType = $configuration->getFormType();
	    $vars = $configuration->getVars();
	    $rolesGranted = $configuration->getRolesGranted();
	    $entity = $configuration->getEntity();
	    $entity = new $entity();
	
	    //IS_GRANTED
	    if (!$this->isGranted($rolesGranted)) {
		    return $this->render(
			    "GridBundle::error.html.twig",
			    [
				    'message' => self::ACCESS_DENIED_MSG,
			    ]
		    );
	    }
	
	    $form = $this->createForm($formType, $entity, ['form_data' => []]);
	    $form->handleRequest($request);
	
	    if ($form->isSubmitted()) {
		
		    $errors = [];
		    $entityJson = null;
		    $status = self::STATUS_ERROR;
		
		    try {
			
			    if ($form->isValid()) {
				
				    $this->persist($entity);
				
				    $varsRepository = $configuration->getRepositoryVars();
				    $entity = $this->rowImage($entity);
				    $entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
				    $status = self::STATUS_SUCCESS;
			    } else {
				    foreach ($form->getErrors(true) as $key => $error) {
					    if ($form->isRoot()) {
						    $errors[] = $error->getMessage();
					    } else {
						    $errors[] = $error->getMessage();
					    }
				    }
			    }
			
		    } catch (\Exception $e) {
			    $errors[] = $e->getMessage();
		    }
		
		    return $this->json([
			    'status' => $status,
			    'errors' => $errors,
			    'entity' => $entity,
		    ]);
	    }
	
	    return $this->render(
		    $template,
		    [
			    'vars' => $vars,
			    'action' => $action,
			    'form' => $form->createView(),
		    ]
	    );
    }
    
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function pagoAction(Request $request): Response
    {
	
	    $parameters = [
		    'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
	    ];
	    $applicationName = $this->container->getParameter('application_name');
	    $this->metadata = new Metadata('tianos', $applicationName, $parameters);
	
	    //CONFIGURATION
	    $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
	    $template = $configuration->getTemplate('');
	    $action = $configuration->getAction();
	    $formType = $configuration->getFormType();
	    $vars = $configuration->getVars();
	    $rolesGranted = $configuration->getRolesGranted();
	    $entity = $configuration->getEntity();
	    $entity = new $entity();
	
	    //IS_GRANTED
	    if (!$this->isGranted($rolesGranted)) {
		    return $this->render(
			    "GridBundle::error.html.twig",
			    [
				    'message' => self::ACCESS_DENIED_MSG,
			    ]
		    );
	    }
	
	    $form = $this->createForm($formType, $entity, ['form_data' => []]);
	    $form->handleRequest($request);
	
	    if ($form->isSubmitted()) {
		
		    $errors = [];
		    $entityJson = null;
		    $status = self::STATUS_ERROR;
		
		    try {
			
			    if ($form->isValid()) {
				
				    $this->persist($entity);
				
				    $varsRepository = $configuration->getRepositoryVars();
				    $entity = $this->rowImage($entity);
				    $entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
				    $status = self::STATUS_SUCCESS;
			    } else {
				    foreach ($form->getErrors(true) as $key => $error) {
					    if ($form->isRoot()) {
						    $errors[] = $error->getMessage();
					    } else {
						    $errors[] = $error->getMessage();
					    }
				    }
			    }
			
		    } catch (\Exception $e) {
			    $errors[] = $e->getMessage();
		    }
		
		    return $this->json([
			    'status' => $status,
			    'errors' => $errors,
			    'entity' => $entity,
		    ]);
	    }
	
	    return $this->render(
		    $template,
		    [
			    'vars' => $vars,
			    'action' => $action,
			    'form' => $form->createView(),
		    ]
	    );
    }
    
    
    
    
}
