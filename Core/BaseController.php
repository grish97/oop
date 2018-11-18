<?php 

namespace Core;

Class BaseController {

    public function validate($data, $rule) {
        $validator = new Validator();
        $validator->make($data, $rule)
                  ->getErrors("email");

    }
}