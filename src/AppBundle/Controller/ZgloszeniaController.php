<?php

// src/AppBundle/Controller/ZgloszeniaController.php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;



class ZgloszeniaController extends Controller
{



    /**
     * @Route("/zgloszenia/create")
     */
	 public function createAction()
	 {
		 $product = new Product();
		 $product->setName('A Foo Bar');
		 $product->setPrice('19.99');
		 $product->setDescription('Lorem ipsum dolor');

		 $em = $this->getDoctrine()->getManager();

		 $em->persist($product);
		 $em->flush();

		 return new Response('Created product id '.$product->getId());
	 }

    /**
     * @Route("/zgloszenia/show/{id}")
     */
	public function showAction($id)
	{
		$product = $this->getDoctrine()
			->getRepository('AppBundle:Product')
			->find($id);
		/*
		lub tak
		*/

		$repository = $this->getDoctrine()->getRepository('AppBundle:Product');
		$products = $repository->findAll();

		if (!$product) {
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}

		print_r($products);die;
	}

    /**
     * @Route("/zgloszenia/update/{id}")
     */

	public function updateAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('AppBundle:Product')->find($id);

		if (!$product) {
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}

		$product->setName('New product name!');
		$em->flush();
		print_r($product);die;
		//return $this->redirectToRoute('homepage');
	}


}