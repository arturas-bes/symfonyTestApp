<?php

namespace App\Controller;

use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class DefaultController extends AbstractController
{
    public function __construct(GiftsService $gifts, $logger)
    {
        //use $logger service

        // As functions in constructor execute first, we ovveride service method below as service was already called
    //    $gifts->gifts = ['a', 'b', 'c', 'd'];


    }
//    /**
//     * @Route("/", name="default")
//     */
//    /**
//     * Set variable into route and use it
//     * @Route("/{name}", name="default")
//     */
    /**
     * @Route("/", name="default")
     * @param GiftsService $gifts
     * @return Response
     */

    public function index(GiftsService $gifts, Request $request, SessionInterface $session)
    {

        $users  = $this->getDoctrine()->getRepository(User::class)->findAll();

        if (!$users)
        {
            throw $this->createNotFoundException('User does not exist');
        }

//        exit($request->get('page', 'default')); // get data from $_GET
        $request->isXmlHttpRequest(); // is it an Ajax request?
        $request->request->get('page'); // get $_POST data
        $request->files->get('foo'); // get uploaded file data


//        $session->set('name', 'session value');
//        $session->remove('name');
//
//        $session->clear();      // clears all session data
//        if ($session->has('name'))
//        {
//            exit($session->get('name'));
//        };

//        exit($request->cookies->get('PHPSESSID'));
//        $cookie = new Cookie(
//            'my_cookie',
//            'cookie_value',
//            time() + (2 * 365 * 24 * 60 * 60)
//        );
//
//        $res = new Response();
//        $res->headers->setCookie($cookie);
//        $res->send();
//
//        $res->headers->clearCookie('my_cookie'); // clears stored cookie on denmand

        //add to database
//        $entityManager = $this->getDoctrine()->getManager(); //responsible for saving operations to DB
//        $user = new User;
//        $user->setName('Bob');
//        $entityManager->persist($user);
//        $entityManager->flush();
        // This was moved to service section
//        $gifts = array('flowers', 'car', 'piano', 'money');
//
//        shuffle($gifts);

        // flash messages

        $this->addFlash(
            'notice',
            'Your changes has been saved!'
        );
        $this->addFlash(
                'warning',
                'Your message has errors be careful!'
            );

//       Render with parameters
        return $this->render('default/index.html.twig', array(
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ));


//        Response with dynamic variable
//         return new Response("Hello there $name");
//        JSON
//        return $this->json(array(
//            'username'=> 'john.doe'
//        ));
//        Redirect to another page
//        return $this->redirect('https://toybox.lt');

//        return $this->redirectToRoute('default2');


    }

//    /**
//     * @Route("/default2/", name="default2")
//     */
//    public function index2()
//    {
//        return new Response("Another route");
//    }


    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     *
     */
    /* if {page?} means its optional*/
    public function index2()
    {
        return new Response('bla bla');
    }
// advanced route with many paramters
    /**
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}/{category}",
     *     defaults={"category": "computers"},
     *     requirements={
     *      "_locale": "en|fr",
     *      "category": "computers|rtv",
     *      "year": "\d+"
     *  }
     * )
     */
    public function index3()
    {
        return new Response('Advanced Route');
    }
//Translations for root
    /**
     * @Route({
     *     "nl": "/beleka",
     *     "en": "/something"
     *  }, name="about_us"
     * )
     */
    public function index4()
    {
        return new Response('Translated route');
    }

    /**
     * @Route("/generate-url/{param?}", name= "generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL)

        );
    }
}
