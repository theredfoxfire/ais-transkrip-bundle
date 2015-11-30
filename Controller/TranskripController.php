<?php

namespace Ais\TranskripBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ais\TranskripBundle\Exception\InvalidFormException;
use Ais\TranskripBundle\Form\TranskripType;
use Ais\TranskripBundle\Model\TranskripInterface;


class TranskripController extends FOSRestController
{
    /**
     * List all transkrips.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing transkrips.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many transkrips to return.")
     *
     * @Annotations\View(
     *  templateVar="transkrips"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getTranskripsAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_transkrip.transkrip.handler')->all($limit, $offset);
    }

    /**
     * Get single Transkrip.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Transkrip for a given id",
     *   output = "Ais\TranskripBundle\Entity\Transkrip",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the transkrip is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="transkrip")
     *
     * @param int     $id      the transkrip id
     *
     * @return array
     *
     * @throws NotFoundHttpException when transkrip not exist
     */
    public function getTranskripAction($id)
    {
        $transkrip = $this->getOr404($id);

        return $transkrip;
    }

    /**
     * Presents the form to use to create a new transkrip.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newTranskripAction()
    {
        return $this->createForm(new TranskripType());
    }
    
    /**
     * Presents the form to use to edit transkrip.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisTranskripBundle:Transkrip:editTranskrip.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the transkrip id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when transkrip not exist
     */
    public function editTranskripAction($id)
    {
		$transkrip = $this->getTranskripAction($id);
		
        return array('form' => $this->createForm(new TranskripType(), $transkrip), 'transkrip' => $transkrip);
    }

    /**
     * Create a Transkrip from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new transkrip from the submitted data.",
     *   input = "Ais\TranskripBundle\Form\TranskripType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisTranskripBundle:Transkrip:newTranskrip.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postTranskripAction(Request $request)
    {
        try {
            $newTranskrip = $this->container->get('ais_transkrip.transkrip.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newTranskrip->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_transkrip', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing transkrip from the submitted data or create a new transkrip at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\TranskripBundle\Form\TranskripType",
     *   statusCodes = {
     *     201 = "Returned when the Transkrip is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisTranskripBundle:Transkrip:editTranskrip.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the transkrip id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when transkrip not exist
     */
    public function putTranskripAction(Request $request, $id)
    {
        try {
            if (!($transkrip = $this->container->get('ais_transkrip.transkrip.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $transkrip = $this->container->get('ais_transkrip.transkrip.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $transkrip = $this->container->get('ais_transkrip.transkrip.handler')->put(
                    $transkrip,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $transkrip->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_transkrip', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing transkrip from the submitted data or create a new transkrip at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\TranskripBundle\Form\TranskripType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisTranskripBundle:Transkrip:editTranskrip.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the transkrip id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when transkrip not exist
     */
    public function patchTranskripAction(Request $request, $id)
    {
        try {
            $transkrip = $this->container->get('ais_transkrip.transkrip.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $transkrip->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_transkrip', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a Transkrip or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return TranskripInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($transkrip = $this->container->get('ais_transkrip.transkrip.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $transkrip;
    }
    
    public function postUpdateTranskripAction(Request $request, $id)
    {
		try {
            $transkrip = $this->container->get('ais_transkrip.transkrip.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $transkrip->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_transkrip', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
