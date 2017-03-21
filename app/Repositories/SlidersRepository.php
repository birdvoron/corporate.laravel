<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 17.03.2017
 * Time: 21:54
 */

namespace Corp\Repositories;


use Corp\Slider;

class SlidersRepository extends Repository
{
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }
}