<?php

namespace AppBundle\Controller;

use Mcfedr\JsonFormBundle\Controller\JsonController;
use Mcfedr\JsonFormBundle\Exception\InvalidJsonHttpException;
use Mcfedr\JsonFormBundle\Exception\MissingFormHttpException;
use Mcfedr\JsonFormBundle\Exception\InvalidFormHttpException;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class CustomJsonController extends JsonController
{
    /**
     * @param Form $form
     * @param Request $request
     * @param callable $preValidation callback to be called before the form is validated
     * @throws \Mcfedr\JsonFormBundle\Exception\InvalidFormHttpException
     * @throws \Mcfedr\JsonFormBundle\Exception\MissingFormHttpException
     * @throws \Mcfedr\JsonFormBundle\Exception\InvalidJsonHttpException
     */
    protected function handleJsonForm(Form $form, Request $request, callable $preValidation = null)
    {
        $bodyJson = $request->getContent();
        if (!($body = json_decode($bodyJson, true))) {
            throw new InvalidJsonHttpException();
        }

        if (!$form->getName()) {
            $form->submit($body, !$request->isMethod('PUT'));
        } else {
            if (!isset($body[$form->getName()])) {
                throw new MissingFormHttpException($form);
            }

            $form->submit($body[$form->getName()], !$request->isMethod('PUT'));
        }

        if ($preValidation) {
            $preValidation();
        }

        if (!$form->isValid()) {
            throw new InvalidFormHttpException($form);
        }
    }
}
