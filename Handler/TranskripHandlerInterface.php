<?php

namespace Ais\TranskripBundle\Handler;

use Ais\TranskripBundle\Model\TranskripInterface;

interface TranskripHandlerInterface
{
    /**
     * Get a Transkrip given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return TranskripInterface
     */
    public function get($id);

    /**
     * Get a list of Transkrips.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post Transkrip, creates a new Transkrip.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return TranskripInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Transkrip.
     *
     * @api
     *
     * @param TranskripInterface   $transkrip
     * @param array           $parameters
     *
     * @return TranskripInterface
     */
    public function put(TranskripInterface $transkrip, array $parameters);

    /**
     * Partially update a Transkrip.
     *
     * @api
     *
     * @param TranskripInterface   $transkrip
     * @param array           $parameters
     *
     * @return TranskripInterface
     */
    public function patch(TranskripInterface $transkrip, array $parameters);
}
