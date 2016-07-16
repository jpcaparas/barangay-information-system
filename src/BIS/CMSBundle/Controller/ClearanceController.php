<?php

namespace BIS\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BIS\CMSBundle\Entity\Clearance;
use BIS\CMSBundle\Form\ClearanceType;

/**
 * Clearance controller.
 *
 * @Route("/clearance")
 */
class ClearanceController extends Controller
{

    /**
     * Lists all Clearance entities.
     *
     * @Route("/", name="clearance")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BISCMSBundle:Clearance')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Clearance entity.
     *
     * @Route("/", name="clearance_create")
     * @Method("POST")
     * @Template("BISCMSBundle:Clearance:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Clearance();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clearance_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Clearance entity.
     *
     * @param Clearance $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Clearance $entity)
    {
        $form = $this->createForm(new ClearanceType(), $entity, array(
            'action' => $this->generateUrl('clearance_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Clearance entity.
     *
     * @Route("/new", name="clearance_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Clearance();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Clearance entity.
     *
     * @Route("/{id}", name="clearance_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BISCMSBundle:Clearance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clearance entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Clearance entity.
     *
     * @Route("/{id}/edit", name="clearance_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BISCMSBundle:Clearance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clearance entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Clearance entity.
    *
    * @param Clearance $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Clearance $entity)
    {
        $form = $this->createForm(new ClearanceType(), $entity, array(
            'action' => $this->generateUrl('clearance_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Clearance entity.
     *
     * @Route("/{id}", name="clearance_update")
     * @Method("PUT")
     * @Template("BISCMSBundle:Clearance:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BISCMSBundle:Clearance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clearance entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clearance_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Clearance entity.
     *
     * @Route("/{id}", name="clearance_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BISCMSBundle:Clearance')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Clearance entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clearance'));
    }

    /**
     * Creates a form to delete a Clearance entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clearance_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
