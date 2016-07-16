<?php

namespace BIS\CMSBundle\Controller;

use BIS\CMSBundle\DependencyInjection\PHPWord\ClearanceProcessor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BIS\CMSBundle\Entity\Resident;
use BIS\CMSBundle\Form\ResidentType;

/**
 * Resident controller.
 *
 * @Route("/resident")
 */
class ResidentController extends Controller
{
    /**
     * Download clearance
     *
     * @Route(
     *  "/{id}/clearance",
     *  requirements = {"id" = "\d+"},
     *  name = "resident_clearance"
     * )
     * @Method("GET")
     */
    public function downloadBarangayClearanceAction($id) {
        $entity = $this->getDoctrine()->getManager()->getRepository('BISCMSBundle:Resident')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find resident.');
        }

        // Set input/output parameters
        $resident_name = $entity->getLname() . ', ' . $entity->getFname();
        $resident_filename = preg_replace('[\W+]', '_', strtolower($resident_name)) . '_barangay_clearance.docx';

        // Process the clearance file
        $clearance = new ClearanceProcessor(array(
            'photoPlaceholder' => 'image1.png'
        ));
        $clearance
            ->setName($resident_name)
            ->setPhoto($entity->getPhotoWebPath())
            ->saveNow();

        // Download the file
        header('Content-Disposition: attachment;filename="' . $resident_filename . '"');
        echo file_get_contents($clearance->getClearanceOutputPath());

        // Delete the file
        @unlink($clearance->getClearanceOutputPath());
        exit;
    }

    /**
     * Lists all Resident entities.
     *
     * @Route("/", name="resident")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BISCMSBundle:Resident');

        if (($keyword = $request->query->get('keyword'))) {
            $entities = $repo->findByKeyword($keyword);
        } else {
            $entities = $repo->findAll();
        }

        $paginator = $this->get('knp_paginator');
        $paginated_entities = $paginator->paginate(
            $entities,
            $request->query->get('page', 1), /* page number */
            1 /* limit per page */
        );

        return array(
            'entities' => $paginated_entities,
        );
    }
    /**
     * Creates a new Resident entity.
     *
     * @Route("/", name="resident_create")
     * @Method("POST")
     * @Template("BISCMSBundle:Resident:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Resident();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('resident_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Resident entity.
     *
     * @param Resident $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Resident $entity)
    {
        $form = $this->createForm(new ResidentType(), $entity, array(
            'action' => $this->generateUrl('resident_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Resident entity.
     *
     * @Route("/new", name="resident_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Resident();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Resident entity.
     *
     * @Route("/{id}", name="resident_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BISCMSBundle:Resident')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Resident entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Resident entity.
     *
     * @Route("/{id}/edit", name="resident_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BISCMSBundle:Resident')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Resident entity.');
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
     * Creates a form to edit a Resident entity.
     *
     * @param Resident $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Resident $entity)
    {
        $form = $this->createForm(new ResidentType(), $entity, array(
            'action' => $this->generateUrl('resident_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Resident entity.
     *
     * @Route("/{id}", name="resident_update")
     * @Method("PUT")
     * @Template("BISCMSBundle:Resident:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BISCMSBundle:Resident')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Resident entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('resident_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Resident entity.
     *
     * @Route("/{id}", name="resident_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BISCMSBundle:Resident')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Resident entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('resident'));
    }

    /**
     * Creates a form to delete a Resident entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resident_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
