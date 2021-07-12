<?php


namespace Kwreach\Ads\Interfaces;


interface AdsInterface
{
    public function get();

    public function find($id);

    public function insert($criteria);

    public function delete($id);

}
