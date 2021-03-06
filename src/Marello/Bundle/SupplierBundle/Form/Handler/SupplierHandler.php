<?php

namespace Marello\Bundle\SupplierBundle\Form\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Marello\Bundle\SupplierBundle\Entity\Supplier;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class SupplierHandler
{
    /** @var FormInterface */
    protected $form;

    /** @var Request */
    protected $request;

    /** @var ObjectManager */
    protected $manager;

    /**
     * @param FormInterface   $form
     * @param Request         $request
     * @param ObjectManager   $manager
     */
    public function __construct(
        FormInterface $form,
        Request $request,
        ObjectManager $manager
    ) {
        $this->form            = $form;
        $this->request         = $request;
        $this->manager         = $manager;
    }

    /**
     * Process form
     *
     * @param  Supplier $entity
     *
     * @return bool True on successful processing, false otherwise
     */
    public function process(Supplier $entity)
    {
        $this->form->setData($entity);

        if (in_array($this->request->getMethod(), ['POST', 'PUT'])) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($entity);

                return true;
            }
        }

        return false;
    }

    /**
     * Returns form instance
     *
     * @return FormInterface
     */
    public function getFormView()
    {
        return $this->form->createView();
    }

    /**
     * "Success" form handler
     *
     * @param Supplier $entity
     */
    protected function onSuccess(Supplier $entity)
    {
        $this->manager->persist($entity);
        $this->manager->flush();
    }
}
