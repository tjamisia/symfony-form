<?php
namespace Itworks\FormBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Itworks\FormBundle\Entity\Person;

class FormController extends Controller {

	/**
	* @Route(path="/", name="index")
	*/
	public function indexAction() {

		$welcomeMsg = 'Välkommen!';

		return $this->render('form/index.html.twig', [
			'welcomeMsg' => $welcomeMsg,
			//pass variable to template. variabeln blir accessible i den templaten
			]);
	}

	/**
	* @Route(path="/form", name="form")
	*/
	public function formAction() {

		return $this->render('form/form.html.twig', [
			'url' => $this->generateUrl('form_new'),
			//skickar med newactions route, som kommer hämtas i länken
			]);

	}

	/**
	* @Route(path="/form/new", name="form_new")
	*/
	public function newAction(Request $request) {

		$person = new Person();

		$form = $this->createFormBuilder($person)
        ->add('name', TextType::class)
        ->add('password', TextType::class)
        ->add('gender', ChoiceType::class, array(
        	'choices' => array(
        		'pick one' => false,
        		'male' => 'male',
        		'female' => 'female',
        		'other' => 'other',
        		),
        	))
        ->add('socialSecurityNr', TextType::class)
        ->add('phoneNumber', TextType::class)
        ->add('save', SubmitType::class, array('label' => 'Add Person'))
        ->getForm();

		$form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        // $form->getData() holds the submitted values
	        // but, the original `$person` variable has also been updated
	        $person = $form->getData();

	        if (!preg_match('/\d+/', $person->getPhoneNumber()) ) {

	        	return $this->render('form/new.html.twig', array(
	        		'error' => true,
	        		'form' 	=> $form->createView(),
	        		));

	        }

	        //var_dump($person); die();

	        // ... perform some action, such as saving the task to the database
	        // for example, if Person is a Doctrine entity, save it!
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($person);
	        $em->flush();

	        return $this->redirectToRoute('task_success');
		}

		    return $this->render('form/new.html.twig', array(
		    	'error' => false,
	        	'form' => $form->createView(),
	    ));
	}

	/**
	* @Route(path="/form/success", name="task_success")
	*/
	public function successAction() {

		$success = 'Thx!';

		return $this->render('form/success.html.twig', [
			'thx' => $success,
			//pass variable to template. variabeln blir accessible i den templaten
			]);

	}

}
