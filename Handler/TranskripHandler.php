<?php

namespace Ais\TranskripBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\TranskripBundle\Model\TranskripInterface;
use Ais\TranskripBundle\Form\TranskripType;
use Ais\TranskripBundle\Exception\InvalidFormException;

class TranskripHandler implements TranskripHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Transkrip.
     *
     * @param mixed $id
     *
     * @return TranskripInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of Transkrips.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new Transkrip.
     *
     * @param array $parameters
     *
     * @return TranskripInterface
     */
    public function post(array $parameters)
    {
        $transkrip = $this->createTranskrip();

        return $this->processForm($transkrip, $parameters, 'POST');
    }

    /**
     * Edit a Transkrip.
     *
     * @param TranskripInterface $transkrip
     * @param array         $parameters
     *
     * @return TranskripInterface
     */
    public function put(TranskripInterface $transkrip, array $parameters)
    {
        return $this->processForm($transkrip, $parameters, 'PUT');
    }

    /**
     * Partially update a Transkrip.
     *
     * @param TranskripInterface $transkrip
     * @param array         $parameters
     *
     * @return TranskripInterface
     */
    public function patch(TranskripInterface $transkrip, array $parameters)
    {
        return $this->processForm($transkrip, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param TranskripInterface $transkrip
     * @param array         $parameters
     * @param String        $method
     *
     * @return TranskripInterface
     *
     * @throws \Ais\TranskripBundle\Exception\InvalidFormException
     */
    private function processForm(TranskripInterface $transkrip, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new TranskripType(), $transkrip, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $transkrip = $form->getData();
            $this->om->persist($transkrip);
            $this->om->flush($transkrip);

            return $transkrip;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createTranskrip()
    {
        return new $this->entityClass();
    }

}
