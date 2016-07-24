<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Test;
use AppBundle\Entity\Timeslot;
use AppBundle\Entity\Student;
use AppBundle\Entity\StudentTimeslot;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/instructor/createtest/{name}", name="createtest")
     */
    public function createtestAction($name, Request $request)
    {
        $test = new Test();
        $date= new \DateTime("now");
        $form = $this->createFormBuilder($test)
            ->add('testName', TextType::class)
            ->add('instructor', HiddenType::class, array('data' => $name))
            ->getForm();

        //handle submit
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();

            return $this->redirectToRoute("home");
        }
        //render form
        return $this->render('default/createtest.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/instructor/tests/{name}", name="tests")
     */
   public function testsAction($name, Request $request)
    {
        $results = $this->getDoctrine()
            ->getRepository('AppBundle:Test')
            ->createQueryBuilder('t')
            ->select('t.testName, t.id')
            ->where('t.instructor = :query')
            ->orderBy('t.testName', 'ASC')
            ->setParameter('query', $name)
            ->getQuery()
            ->getResult();
        return $this->render('default/tests.html.twig',[
            'results' => $results,
            'instructor' => $name
        ]);
    }

    /**
     * @Route("/instructor/createtimeslot/{testid}", name="createtimeslot")
     */
    public function createtimeslotAction($testid, Request $request)
    {
        $timeslot = new Timeslot();
        $date= new \DateTime("now");
        $form = $this->createFormBuilder($timeslot)
            ->add('startTime', DateTimeType::class)
            ->add('endTime', DateTimeType::class)
            ->add('slotsMax', TextType::class)
        ->add('testId', HiddenType::class, array('data' => $testid))
        ->getForm();

        //handle submit
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($timeslot);
            $em->flush();

            return $this->redirectToRoute("home");
        }
        //render form
        return $this->render('default/createtimeslot.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("student/addstudent", name="addstudent")
     */
       public function adduserAction(Request $request)
        {
            $student = new Student();
            //create form
            $form = $this->createFormBuilder($student)
                ->add('studentName', TextType::class)
                ->add('studentEmail', EmailType::class)

                ->getForm();
    
            //handle submit
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($student);
                $em->flush();
    
                return $this->redirectToRoute("home");
            }
            //render form
            return $this->render('default/addstudent.html.twig',[
                'form' => $form->createView()
            ]);
        }

    /**
     * @Route("/student/timeslot/{id}", name="student_timeslot")
     */
    public function timeslotAction($id, Request $request)
    {
        $results = $this->getDoctrine()
            ->getRepository('AppBundle:StudentTimeslot')
            ->createQueryBuilder('s')
            ->select('t.testName, l.startTime, l.endTime')
            ->innerJoin('AppBundle:Timeslot', 'l', 'WITH', 'l.id = s.timeslotId')
            ->innerJoin('AppBundle:Test', 't', 'WITH', 't.id = l.testId')
            ->where('s.studentId = :query')
            ->orderBy('t.testName', 'ASC')
            ->setParameter('query', $id)
            ->getQuery()
            ->getResult();
        return $this->render('default/studenttimeslots.html.twig',[
            'results' => $results
        ]);
    }

    /**
     * @Route("/student/addtimeslot/{id}", name="addtimeslot")
     */
    public function addtimeslotAction($id, Request $request)
    {
        $timeslot = new StudentTimeslot();
        $date= new \DateTime("now");
        $form = $this->createFormBuilder($timeslot) //should check if slot still available
            ->add('timeslotId', TextType::class) //should come from a list that the student pick as there is no way to know this
            ->add('studentId', HiddenType::class, array('data' => $id))
            ->getForm();

        //handle submit
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($timeslot);
            $em->flush();

            $testtimeslot= $this->getDoctrine()
                ->getRepository('AppBundle:Timeslot')
                ->findOneBy([
                    'id' => $form['timeslotId']->getData()
                ]);
            $testtimeslot->setSlotsTaken($testtimeslot->getSlotsTaken()+1); //increment slots taken
            $em->persist($testtimeslot);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        //render form
        return $this->render('default/addtimeslot.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
