<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 4:03 PM
 */

namespace App\Coinbase\Commerce\Model;


class Charges
{
    /** @var Pagination */
    protected $pagination;

    /** @var Charge[] */
    protected $data;

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    /**
     * @param Pagination $pagination
     */
    public function setPagination(Pagination $pagination): void
    {
        $this->pagination = $pagination;
    }

    /**
     * @return Charge[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param Charge[] $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

}